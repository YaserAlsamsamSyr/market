<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <nav class="navigation">
        <ul>
            @auth
            <li><a href="{{ Route('profile.edit') }}">My Profile</a></li>
            <li><a href="/product/create">Add Product</a></li>
            <li><a href="/product">My Products</a></li>
            @if(Session::has('items'))
            <li><a href="{{ route('myCard') }}">My Card</a></li>
            @endif
            <li><a href="/bill">My Bills</a></li>
            <li><a href="{{ route('logout') }}">Logout</a></li>
            @else
            <li><a href="{{ route('login') }}">Login</a></li>
            <li><a href="{{ route('register') }}">Register</a></li>
            @endauth
        </ul>
    </nav>
    <div class="items">
        @foreach ($products as $product)
            <div class="item">
                <div class="img"><img src="{{ $product->img }}" alt="No image found"></div>
                <div class="details">
                    <div class="rate">Rate: {{ $product->rate }}</div>
                    <div class="category">Category: {{ $product->category }}</div>
                    <div class="name">Name: {{ $product->name }}</div>
                    <div class="price">Price: {{ $product->price }}</div>
                    <div class="amount">Amount: {{ $product->amount }}</div>
                </div>
                <form method="post" action="{{ route('addToCard') }}">
                    @csrf
                    <input type="hidden" name="page" value="{{ $page }}">
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    <input type="hidden" name="img" value="{{ $product->img }}">
                    <input type="hidden" name="rate" value="{{ $product->rate }}">
                    <input type="hidden" name="category" value="{{ $product->category }}">
                    <input type="hidden" name="name" value="{{ $product->name }}">
                    <input type="hidden" name="price" value="{{ $product->price }}">
                    <input type="hidden" name="amount" value="{{ $product->amount }}">
                    <button type="submit" class="btn">Add to Cart</button>
                </form>
            </div>
        @endforeach
    </div>
    {{ $products->links() }}
</body>
</html>
<style>
    body {
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

.items {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    padding: 20px;
}

.item {
    background-color: white;
    border: 1px solid #ddd;
    border-radius: 8px;
    margin: 10px;
    padding: 20px;
    width: 300px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    transition: box-shadow 0.3s ease;
}

.item:hover {
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

.item .img {
    text-align: center;
}

.item img {
    width: 200px;
    height: 200px;
    border-radius: 8px;
}

.item .details {
    padding: 10px 0;
}

.item .details div {
    margin-bottom: 8px;
}

.item .btn {
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

.item .btn:hover {
    background-color: #0056b3;
}

</style>