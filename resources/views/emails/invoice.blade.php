<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Email</title>
    <style>
        body { font-family: 'Helvetica', Arial, sans-serif; background-color: #f4f6f8; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 30px auto; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); }
        .header { background-color: #10b981; color: #ffffff; padding: 30px; text-align: center; }
        .header h1 { margin: 0; font-size: 28px; }
        .content { padding: 40px 30px; color: #333333; line-height: 1.6; }
        .invoice-details { background-color: #f8f9fa; padding: 20px; border-radius: 8px; margin: 20px 0; }
        .invoice-details p { margin: 10px 0; }
        .button { display: inline-block; background-color: #10b981; color: #ffffff; padding: 12px 30px; border-radius: 5px; text-decoration: none; margin-top: 20px; }
        .footer { padding: 20px; font-size: 12px; color: #888888; text-align: center; background-color: #f8f9fa; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Invoice</h1>
        </div>
        <div class="content">
            <h2>Order #{{ $order->id }}</h2>
            <div class="invoice-details">
                <p><strong>Order ID:</strong> {{ $order->id }}</p>
                <p><strong>Total Amount:</strong> ${{ number_format($order->total, 2) }}</p>
                <p><strong>Status:</strong> Paid</p>
            </div>
            <p>Thank you for your purchase! Your order will be processed shortly.</p>
            <a href="#" class="button">View Order Details</a>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Our Company. All rights reserved.
        </div>
        
        <img src="{{ route('mail.track', ['id' => $order->id]) }}" width="1" height="1" alt="" style="display:none;">
    </div>
</body>
</html>