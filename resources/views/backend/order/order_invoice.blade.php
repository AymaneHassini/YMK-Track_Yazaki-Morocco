<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Invoice</title>
    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 20px;
            background-color: #F7F7F7;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .header img {
            width: 150px;
        }
        .header-details {
            text-align: right;
        }
        .details-container {
            display: flex;
            justify-content: space-between; /* This will align them side by side */
            width: 100%; /* Use the full width of the container */
        }
        .section {
            width: 50%; /* Each section will take up half the width of their container */
            padding: 10px;
            box-sizing: border-box; /* Includes padding in the width calculation */
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: black;
            color: white;
        }
        .total {
            text-align: right;
            margin-top: 20px;
        }
        .total h2 {
            color: black;
        }
        .footer p {
            text-align: right;
            font-size: 16px;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<header class="header">
    <img src="backend/assets/images/ymk.webp" alt="Yazaki Logo">
    <div class="header-details">
        <pre>
Yazaki Kenitra
Email: YMK@yazaki-europe.com
Mobile: 061232617181
Kenitra: KM9
        </pre>
    </div>
</header>

<div class="details-container">
    <div class="section customer-details">
        <h3>Customer Details</h3>
        <p>
            <strong>Customer Name:</strong> {{ $order->customer->name }}<br>
            <strong>Customer Email:</strong> {{ $order->customer->email }}<br>
            <strong>Customer Phone:</strong> {{ $order->customer->phone }}<br>
            <strong>Address:</strong> {{ $order->customer->address }}<br>
            <strong>Company Name:</strong> {{ $order->customer->company_name }}<br>
        </p>
    </div>
    <div class="section invoice-details">
        <h3>Invoice Details</h3>
        <p>
            <strong>Invoice #:</strong> {{ $order->invoice_no }}<br>
            <strong>Order Date:</strong> {{ $order->order_date }}<br>
            <strong>Order Status:</strong> {{ $order->order_status }}<br>
            <strong>Payment Status:</strong> {{ $order->payment_status }}<br>
            <strong>Total Pay:</strong> {{ $order->pay }}<br>
            <strong>Total Due:</strong> {{ $order->due }}<br>
        </p>
    </div>
</div>

<h3>Products</h3>
<table>
    <thead>
        <tr>
            <th>Image</th>
            <th>Product Name</th>
            <th>Product Code</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Total(+Vat)</th>
        </tr>
    </thead>
    <tbody>
    @foreach($orderItem as $item)
        <tr>
            <td align="center"><img src="{{ public_path($item->product->product_image) }}" height="50px;" width="50px;" alt=""></td>
            <td align="center">{{ $item->product->product_name }}</td>
            <td align="center">{{ $item->product->product_code }}</td>
            <td align="center">{{ $item->quantity }}</td>
            <td align="center">${{ $item->product->selling_price }}</td>
            <td align="center">$ {{ $item->total }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="total">
    <h2>Subtotal: ${{ $order->total }}</h2>
    <h2>Total: ${{ $order->total }}</h2>
</div>

<footer class="footer">
    <p>To ensure proper delivery and payment, please note: the above mentioned part numbers and purchase order number have to appear in the invoices and delivery notes, the delivery note has to be a part of the delivery itself.</p>
    <p>Best regards, <br> Yazaki Kenitra</p>
</footer>

</body>
</html>
