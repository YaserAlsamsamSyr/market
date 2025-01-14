<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Product</title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <nav class="navigation">
        <ul>
            <li><a href="{{ route('index') }}">Home</a></li>
        </ul>
    </nav>
    <div class="container">
        <h1>Add Product Page</h1>
        @if($isAdded=="yes")
            <h3 class="success">Added successfully</h3>
            <?php $isAdded = "no"; ?>
        @endif
        @if($errors->any())
            @foreach ($errors->all() as $e)
                <h3 class="error">{{ $e }}</h3>
            @endforeach
        @endif
        <form method="post" action="/product" enctype="multipart/form-data" class="product-form">
            @csrf
            <label for="img">Image:</label>
            <input type="file" name="img" id="img">
            
            <input type="hidden" name="rate" value="0">

            <label for="category">Category:</label>
            <input type="text" name="category" id="category" value="{{ old('category') }}">

            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}">

            <label for="price">Price:</label>
            <input type="text" name="price" id="price" value="{{ old('price') }}">

            <label for="amount">Amount:</label>
            <input type="number" name="amount" id="amount" value="{{ old('amount') }}">

            <button type="submit" class="btn">Add</button>
        </form>
    </div>
</body>
</html>
<style>body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
}

.navigation {
    background-color: #333;
    width: 100%;
    overflow: hidden;
    padding: 10px 0;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.navigation ul {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
}

.navigation ul li {
    margin: 0 15px;
}

.navigation ul li a {
    color: white;
    text-decoration: none;
    font-size: 18px;
    padding: 8px 16px;
    border-radius: 4px;
    transition: background-color 0.3s ease;
}

.navigation ul li a:hover {
    background-color: #575757;
}

.container {
    background-color: white;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 20px;
    width: 80%;
    max-width: 600px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    text-align: center;
    margin: 20px 0;
}

h1 {
    font-size: 24px;
    margin-bottom: 20px;
}

.success {
    color: green;
}

.error {
    color: red;
}

.product-form {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.product-form label {
    font-size: 16px;
    margin-top: 10px;
}

.product-form input, .product-form button {
    width: 100%;
    max-width: 400px;
    padding: 10px;
    margin: 5px 0;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 16px;
}

.product-form input[type="file"] {
    padding: 3px;
}

.product-form button {
    background-color: #007BFF;
    color: white;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.product-form button:hover {
    background-color: #0056b3;
}
</style>
