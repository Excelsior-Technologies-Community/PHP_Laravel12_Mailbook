<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; }
        .header { text-align: center; font-size: 24px; font-weight: bold; }
        .details { margin-top: 20px; border: 1px solid #ddd; padding: 10px; }
        .total { font-size: 18px; font-weight: bold; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="header">Invoice #{{ $order->id }}</div>
    <div class="details">
        <p>Order ID: {{ $order->id }}</p>
        <p>Date: {{ date('Y-m-d') }}</p>
    </div>
    <div class="total">
        Total Amount: ${{ number_format($order->total, 2) }}
    </div>
</body>
</html>