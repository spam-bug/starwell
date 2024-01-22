<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Equipment Inventory Report</title>

    <link rel="stylesheet" href="{{ asset('pdf.css') }}">
</head>

<body>
    <header>
        <h1>STARWELL BATAAN</h1>
        <p>Purok 6, Kawayan Kiling, Cataning, Hermosa, Bataan</p>
        <p>(+63) 939 - 924 - 2023</p>

        @if ($range[0] !== 'custom')
            <h2>{{ ucfirst($range[0]) }} Equipment Inventory Report</h2>
        @else
            <h2>{{ $range[1]['from'] }} - {{ $range[1]['to'] }} Equipment Inventory Report</h2>
        @endif
    </header>

    <main>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Business</th>
                    <th>Equipment</th>
                    <th>Unit Price</th>
                    <th>Rented Quantity</th>
                    <th>Return Quantity</th>
                    <th>Damage Quantity</th>
                    <th>Total Income</th>
                </tr>
            </thead>
            <tbody>
                @if ($inventories->isNotEmpty())
                    @php
                        $total = 0;
                    @endphp

                    @foreach ($inventories as $inventory)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($inventory->created_at)->format('M d, Y') }}</td>
                            <td>{{ $inventory->product->business }}</td>
                            <td class="transaction_number">{{ $inventory->product->name }}</td>
                            <td>{{ str_replace('₱', '', $inventory->product->unitPrice()) }}</td>
                            <td>{{ $inventory->rented_quantity }}</td>
                            <td>{{ $inventory->return_quantity ?? 0 }}</td>
                            <td>{{ $inventory->damage_quantity ?? 0 }}</td>
                            <td>
                                @php
                                    $total += $inventory->product->price * $inventory->rented_quantity;
                                @endphp
                                {{ number_format(substr($inventory->product->price * $inventory->rented_quantity, 0, -2) . '.' . substr($inventory->product->price * $inventory->rented_quantity, -2), 2) }}
                            </td>
                        </tr>
                    @endforeach

                    <tr class="total">
                        <td colspan="6">TOTAL</td>
                        <td>{{ number_format(substr($total, 0, -2) . '.' . substr($total, -2), 2) }}</td>
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
