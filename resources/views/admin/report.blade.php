<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monthly Report</title>
    <script>
        // Memicu dialog cetak secara otomatis ketika halaman selesai dimuat
        window.onload = function() {
            window.print();
        };
    </script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            color: #333;
        }

        h2,
        h3 {
            color: #4A90E2;
            border-bottom: 2px solid #4A90E2;
            padding-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 16px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #4A90E2;
            color: #fff;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .total-revenue {
            font-size: 18px;
            font-weight: bold;
            color: #4A90E2;
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <h2>Monthly Report for {{ DateTime::createFromFormat('!m', $month)->format('F') }} {{ $year }}</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Date</th>
                <th>Total Price</th>
                <th>Note</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->o_id }}</td>
                    <td>{{ $order->title }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>{{ number_format($order->price, 3) }}</td>
                    <td>{{ $order->date }}</td>
                    <td>{{ number_format($order->total_price, 3) }}</td>
                    <td>{{ $order->note }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p class="total-revenue">
        Total Revenue for {{ DateTime::createFromFormat('!m', $month)->format('F') }} {{ $year }}:
        {{ number_format($totalRevenue, 3) }}
    </p>

    <h3>Best-Selling Products for {{ DateTime::createFromFormat('!m', $month)->format('F') }} {{ $year }}</h3>

    <table>
        <thead>
            <tr>
                <th>Product Title</th>
                <th>Total Quantity Sold</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bestSellingProducts as $product)
                <tr>
                    <td>{{ $product->title }}</td>
                    <td>{{ $product->total_quantity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
