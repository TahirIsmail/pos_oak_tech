<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
</head>

<body>
    <h2>Products</h2>

    @foreach ($items as $item)
        <div>Product Name: {{ $item['name'] }}</div>
        <div>Product Quantity: {{ $item['quantity'] }}</div>
        <div>Product Specifications: {{ $item['specifications'] }}</div>
        <div>Product Descriptions: {{ $item['descriptions'] }}</div>
    @endforeach
</body>

</html>
