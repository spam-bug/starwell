<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Equipment Expense Report</title>

    <link rel="stylesheet" href="{{ asset('pdf.css') }}">
</head>

<body>
    <header>
        <h1>STARWELL BATAAN PRIVATE RESORT</h1>
        <p>Purok 6, Kawayan Kiling, Cataning, Hermosa, Bataan</p>
        <p>(+63) 939 - 924 - 2023</p>

        @if ($range[0] !== 'custom')
            <h2>{{ ucfirst($range[0]) }} Equipment Expense Report</h2>
        @else
            <h2>{{ $range[1]['from'] }} - {{ $range[1]['to'] }} Equipment Expense Report</h2>
        @endif
    </header>

    <main>
        <table>
            <thead>
                <tr>
                    <th>Date Added</th>
                    <th>Equipment</th>
                    <th>Unit Price</th>
                    <th>Quantity</th>
                    <th>Total Cost</th>
                </tr>
            </thead>
            <tbody>
                @if ($products->isNotEmpty())
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($product->created_at)->format('M d, Y') }}</td>
                            <td class="transaction_number">{{ $product->name }}</td>
                            <td>{{ str_replace('₱', '', $product->unitPrice()) }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ str_replace('₱', '', $product->totalCost()) }}</td>
                        </tr>
                    @endforeach

                    <tr class="total">
                        <td colspan="4">TOTAL</td>
                        <td>{{ number_format(substr($total['price'], 0, -2) . '.' . substr($total['price'], -2), 2) }}</td>
                    </tr>
                @else
                    <tr>
                        <td colspan="6" style="text-align: center">No Available Data</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </main>
</body>

</html>
