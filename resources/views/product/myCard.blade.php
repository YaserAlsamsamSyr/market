<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Card</title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <nav class="navigation">
        <ul>
            <li><a href="{{ route('index') }}">Home</a></li>
        </ul>
    </nav>

    <div class="container">
        @if(Session::has('items'))
            <div class="summary">
                <h1>Your Bill:</h1>
                <p>Total Price: {{ $price }}</p>
                <p>Number of Items: {{ $num }}</p>
            </div>
            @foreach (session('items') as $product)
                <div class="item">
                    <h2>Item {{ $loop->index+1 }}</h2>
                    <div class="img"><img src="{{ $product['img'] }}" alt="No image found"></div>
                    <div class="details">
                        <div class="rate">Rate: {{ $product['rate'] }}</div>
                        <div class="category">Category: {{ $product['category'] }}</div>
                        <div class="name">Name: {{ $product['name'] }}</div>
                        <div class="price">Price: {{ $product['price'] }}</div>
                        <div class="amount">Amount: {{ $product['amount'] }}</div>
                    </div>
                    <form method="post" action="{{ route('removeFromCard') }}">
                        @csrf
                        <input type="hidden" name="itemId" value="{{ $loop->index }}">
                        <button type="submit" class="btn">Remove from Card</button>
                    </form>
                </div>
            @endforeach
            <form method="post" action="/bill">
                @csrf
                <button type="submit" class="btn">Pay</button>
            </form>
        @else
            <h1 class="no-items">No items</h1>
        @endif
    </div>
</body>
</html>
<style>body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

.navigation {
    background-color: #333;
    overflow: hidden;
}

.navigation ul {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: flex-end;
}

.navigation ul li {
    margin: 0;
}

.navigation ul li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 20px;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

.navigation ul li a:hover {
    background-color: #575757;
    border-radius: 4px;
}

.container {
    max-width: 800px;
    margin: 50px auto;
    padding: 20px;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.summary {
    text-align: center;
    margin-bottom: 20px;
}

.item {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    margin-bottom: 20px;
    padding: 20px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    transition: box-shadow 0.3s ease;
}

.item:hover {
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

.item .img {
    text-align: center;
    margin-bottom: 10px;
}

.item img {
    width: 200px;
    height: 200px;
    border-radius: 8px;
}

.item .details {
    margin-bottom: 10px;
}

.item .details div {
    margin-bottom: 8px;
}

.btn {
    display: block;
    width: 100%;
    padding: 10px;
    background-color: #007BFF;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn:hover {
    background-color: #0056b3;
}

.no-items {
    color: red;
    text-align: center;
}
</style>