<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bill Details</title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    
<nav class="navigation">
        <ul>
            <li><a href="{{ route('index') }}">Home</a></li>
            <li><a href="/bill">Back</a></li>
        </ul>
    </nav>
    <div class="container">
        <div class="items">
            @foreach ($productsInBill as $pro)
                <div class="item">
                    <h2>Product {{ $loop->index + 1 }}:</h2>
                    <img src="{{ URL($pro->img) }}" alt="No image">
                    <p>Category: {{ $pro->category }}</p>
                    <p>Name: {{ $pro->name }}</p>
                    <p>Price: {{ $pro->price }}</p>
                    <p>Amount: {{ $pro->amount }}</p>
                    <form method="post" action="/rateProduct/{{ $pro->id }}">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="billId" value="{{ $billId }}">
                        <input type="number" max="5" min="0" name="rate" required value="{{ $pro->rate }}">
                        <input type="submit" value="Rate" class="btn">
                    </form>
                </div>
            @endforeach
        </div>
    </div>
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

a {
    display: block;
    margin-bottom: 20px;
    color: blue;
    text-decoration: none;
}

.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.items {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

.item {
    width: 45%;
    margin-bottom: 20px;
    padding: 20px;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.item h2 {
    margin-top: 0;
}

.item img {
    width: 100%;
    height: auto;
    border-radius: 8px;
    margin-bottom: 10px;
}

.item p {
    margin: 5px 0;
}

.btn {
    display: inline-block;
    padding: 8px 16px;
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
</style>