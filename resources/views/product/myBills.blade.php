<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bills</title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <nav class="navigation">
        <ul>
            <li><a href="{{ route('index') }}">Home</a></li>
        </ul>
    </nav>

    <div class="container">
        <div class="bills">
            <?php 
                $totalPrice = 0; 
                $amount = 0; 
            ?>
            @foreach ($bills as $bill)
                <div class="bill-i">
                    <h2>Bill {{ $loop->index + 1 }}:</h2>
                    <p>ID: {{ $bill->id }}</p>
                    @foreach ($bill->products as $pro)
                        <?php 
                            $totalPrice += $pro->price; 
                            $amount = $loop->index + 1; 
                        ?>
                    @endforeach
                    <p>Total Price: {{ $totalPrice }}</p>
                    <p>Number of Items: {{ $amount }}</p>
                    <?php 
                        $totalPrice = 0; 
                        $amount = 0; 
                    ?>
                    <p>Created At: {{ $bill->created_at }}</p>
                    <a href="/bill/{{ $bill->id }}"><button class="btn info">More Info</button></a>
                    <button class="btn delete" onclick="del(this, {{ $bill->id }})">Delete</button>
                    <div class="delete-confirm delete{{ $bill->id }}">
                        <form method="post" action="/bill/{{ $bill->id }}">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Are you sure?" class="btn confirm">
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script>
        function del(parent, childId) {
            parent.style.visibility = "hidden";
            document.querySelector('.delete' + childId).style.visibility = "visible";
        }
    </script>
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

.bills {
    margin-top: 20px;
}

.bill-i {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    margin-bottom: 20px;
    padding: 20px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    transition: box-shadow 0.3s ease;
}

.bill-i:hover {
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

.bill-i h2 {
    margin-top: 0;
}

.bill-i p {
    margin: 10px 0;
}

.btn {
    display: inline-block;
    padding: 10px 15px;
    background-color: #007BFF;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    text-decoration: none;
    text-align: center;
}

.btn:hover {
    background-color: #0056b3;
}

.btn.info {
    background-color: #28a745;
}

.btn.info:hover {
    background-color: #218838;
}

.btn.delete {
    background-color: #dc3545;
}

.btn.delete:hover {
    background-color: #c82333;
}

.delete-confirm {
    visibility: hidden;
    margin-top: 10px;
}

.confirm {
    background-color: #ffc107;
}

.confirm:hover {
    background-color: #e0a800;
}
</style>