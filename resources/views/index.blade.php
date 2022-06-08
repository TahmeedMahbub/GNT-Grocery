<!DOCTYPE html>
<html lang="en">

<head>
    <title>Grocery Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{route('index')}}">Home &emsp;&emsp;</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('allProduct')}}">All Products &emsp;&emsp;</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('addProduct')}}">Add Product &emsp;&emsp;</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('sellProduct')}}">Sell Product &emsp;&emsp;</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('invoices')}}">Invoices &emsp;&emsp;</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('restockProduct')}}">Restock Product &emsp;&emsp;</a>
            </li>
        </ul>
        </div>
    </div>
    </nav> <br>

    <div class="container">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

</body>
</html>



