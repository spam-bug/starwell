<?php

namespace App\Http\Controllers\Admin;

use App\Enums\TransactionStatus;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductInventory;
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(): View
    {
        return view('admin.products.index', [
            'products' => Product::all(),
        ]);
    }

    public function create(): View
    {
        return view('admin.products.create');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function download(Request $request)
    {
        $range = $request->input('range');

        // Set default dates for the custom range
        $from = $request->input('from', Carbon::now()->subDays(7)->format('Y-m-d'));
        $to = $request->input('to', Carbon::now()->format('Y-m-d'));

        // Validate custom range if applicable
        if ($range == 'custom' && (!$from || !$to)) {
            return redirect()->back()->with('error', 'Invalid date range.');
        }

        // Adjust the query based on the selected range
        $query = ProductInventory::query();

        switch ($range) {
            case 'weekly':
                $query->whereBetween('created_at', [Carbon::now()->subDays(6), Carbon::now()]);
                break;

            case 'monthly':
                $query->whereMonth('created_at', Carbon::now()->month);
                break;

            case 'yearly':
                $query->whereYear('created_at', Carbon::now()->year);
                break;

            case 'custom':
                $query->whereBetween('created_at', [$from, $to]);
                break;

            default:
                // Handle invalid range
                return response()->json(['error' => 'Invalid range provided.'], 422);
        }

        $inventories = $query->when($request->input('product') != 'all', function ($query) use($request) {
            $query->whereHas('product', function($query) use ($request) {
                $query->where('id', $request->input('product'));
            });
        })
        ->when($request->input('business') != 'all', function ($query) use($request) {
            $query->whereHas('product', function ($query) use($request) {
                $query->where('business', $request->input('business'));
            });
        })
        ->get();

        $data = [
            'range' => [$range],
            'inventories' => $inventories,
        ];

        if ($range === 'custom') {
            $data['range'][] = [
                'from' => Carbon::parse($from)->format('M d, Y'),
                'to' => Carbon::parse($to)->format('M d, Y')
            ];
        }

        $pdf = Pdf::loadView('admin.products.download', $data)->setPaper('legal', 'landscape');

        return $pdf->stream();
    }
}
