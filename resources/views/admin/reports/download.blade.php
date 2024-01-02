<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Transaction Report</title>

    <link rel="stylesheet" href="{{ asset('pdf.css') }}">
</head>
<body>
    <header>
        <h1>STARWELL BATAAN PRIVATE RESORT</h1>
        <p>Purok 6, Kawayan Kiling, Cataning, Hermosa, Bataan</p>
        <p>(+63) 939 - 924 - 2023</p>

        @if ($range[0]  !== 'custom')
            <h2>{{ ucfirst($range[0]) }} Transaction Report</h2>
        @else
            <h2>{{ $range[1]['from'] }} - {{ $range[1]['to'] }} Transaction Report</h2>
        @endif
    </header>

    <main>
        <table>
            <thead>
                <tr>
                    <th>Transaction Number</th>
                    <th>Accommodation</th>
                    <th>Accommodation Type</th>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Down Payment</th>
                </tr>
            </thead>
            <tbody>
                @if($transactions->isNotEmpty())
                    @foreach($transactions as $transaction)
                        <tr>
                            <td class="transaction_number">{{ strtoupper($transaction->id) }}</td>
                            @if($transaction->booking()->exists())
                                <td>{{ $transaction->booking->accommodation->name ?? 'Other' }}</td>
                                <td>{{ $transaction->booking->accommodation->type ?? 'N/A' }}</td>
                            @elseif($transaction->membership()->exists())
                                <td>{{ $transaction->booking->accommodation->name ?? 'Other' }}</td>
                                <td>{{ $transaction->booking->accommodation->type ?? 'N/A' }}</td>
                            @else
                                <td></td>
                                <td></td>
                            @endif
                            <td>{{ \Carbon\Carbon::parse($transaction->created_at)->format('M d, Y') }}</td>
                            <td>{{ $transaction->amount() }}</td>
                            <td>{{ $transaction->downPayment() }}</td>
                        </tr>
                    @endforeach

                    <tr class="total">
                        <td colspan="4">TOTAL</td>
                        <td>{{ number_format(substr($total['amount'], 0, -2) . '.' . substr($total['amount'], -2), 2) }}</td>
                        <td>{{ number_format(substr($total['down_payment'], 0, -2) . '.' . substr($total['down_payment'], -2), 2) }}</td>
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
