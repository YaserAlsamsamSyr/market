<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Products</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <nav class="navigation">
        <ul>
            <li><a href="{{ route('index') }}">Home</a></li>
            <li><a href="{{ route('product.create') }}">Add Product</a></li>
        </ul>
    </nav>
    <div class="items">
        @foreach ($products as $pro)
            <div class="item">
                <img src="{{ URL($pro->img) }}" alt="no image">
                <p>Category: {{ $pro->category }}</p>
                <p>Name: {{ $pro->name }}</p>
                <p>Price: {{ $pro->price }}</p>
                <p>Amount: {{ $pro->amount }}</p>
                <p>Rate: {{ $pro->rate }}</p>
                <div class="buttons">
                    <button onclick="hiddeMe(this, {{ $loop->index }})">Delete</button>
                    <a href="{{ route('product.edit', $pro->id) }}"><button>Update</button></a>
                </div>
                <div class="confirmation i{{ $loop->index }}" style="visibility: hidden;">
                    <form action="{{ route('product.destroy', $pro->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Are you sure?">
                    </form>
                </div>
            </div>
        @endforeach
    </div>
    <script>
        function hiddeMe(btn, item) {
            btn.style.display = "none";
            document.querySelector('.i' + item).style.visibility = "visible";
        }
    </script>
</body>
</html>

<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.navigation {
    background-color: #333;
    padding: 10px 0;
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

.item img {
    width: 100%;
    height: auto;
    border-radius: 8px;
    margin-bottom: 10px;
}

.item p {
    margin: 5px 0;
}

button {
    padding: 10px 40px;
    margin-right: 9%;
    background-color: #007BFF;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #0056b3;
}

.confirmation {
    margin-top: 10px;
}

</style>