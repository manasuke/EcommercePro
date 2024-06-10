<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order PDF</title>
</head>

<body>
    <h1>Oder Details</h1>
    <p>Name: {{ $order->name }}</p>
    <p>Email: {{ $order->email }}</p>
    <p>Address: {{ $order->address }}</p>
    <p>Phone: {{ $order->phone }}</p>
    <p>Product Title: {{ $order->product_title }}</p>
    <p>Quantity: {{ $order->quantity }}</p>
    <p>Price: {{ $order->price }}</p>
    <p>Payment Status: {{ $order->payment_status }}</p>
    <p>Delivery Status: {{ $order->delivery_status }}</p>
    <p>Image:
        <img height="100" width="100" src="product/{{ $order->image }}" alt="">
    </p>
    <p>Delivered: {{ $order->delivery_status }}</p>
</body>

</html>
