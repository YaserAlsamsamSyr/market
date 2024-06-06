<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Product</title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <nav class="navigation">
        <ul>
            <li><a href="{{ route('index') }}">Home</a></li>
        </ul>
    </nav>

    <div class="container">
        @if($updated)
            <h2 class="success-message">Update success</h2>
            {{ $updated=false }}
        @endif

        @if($errors->any())
            @foreach ($errors->all() as $e)
                <h2 class="error-message">{{ $e }}</h2>
            @endforeach
        @endif

        <form method="POST" action="/product/{{ $product->id }}" enctype="multipart/form-data" class="form">
            @csrf
            @method('PUT')
            <input type="hidden" name="rate" value="{{ $product->rate }}"/>
            <label for="img">Image:</label>
            <input type="hidden" name="oldImg" value="{{ $product->img }}" />
            <input type="file" name="img" id="img" />
            
            <label for="category">Category:</label>
            <input type="text" name="category" value="{{ $product->category }}" id="category" />
            
            <label for="name">Name:</label>
            <input type="text" name="name" value="{{ $product->name }}" id="name" />
            
            <label for="price">Price:</label>
            <input type="text" name="price" value="{{ $product->price }}" id="price" />
            
            <label for="amount">Amount:</label>
            <input type="number" name="amount" value="{{ $product->amount }}" id="amount" />
            
            <button type="submit" class="btn">Update</button>
        </form>
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
    max-width: 600px;
    margin: 50px auto;
    padding: 20px;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.success-message {
    color: green;
    text-align: center;
}

.error-message {
    color: red;
    text-align: center;
}

.form {
    display: flex;
    flex-direction: column;
}

.form label {
    margin-top: 10px;
    font-weight: bold;
}

.form input,
.form button {
    margin-top: 5px;
    padding: 10px;
    border-radius: 4px;
    border: 1px solid #ddd;
}

.form input[type="file"] {
    padding: 3px;
}

.form button {
    background-color: #007BFF;
    color: white;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.form button:hover {
    background-color: #0056b3;
}
</style>