<!DOCTYPE html>
<html lang="en">

<head>
    <title>GNT Grocery Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"/>
</head>

<body>
<div style="position: fixed; width: 100%; z-index: 1000;">
    <nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{route('index')}}"><i class="bi bi-house-fill"></i> Home &emsp;&emsp;</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('allProduct')}}"><i class="bi bi-list-check"></i> All Products &emsp;&emsp;</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('addProduct')}}"><i class="bi bi-node-plus-fill"></i> Add Product &emsp;&emsp;</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('sellProduct')}}"><i class="bi bi-cart-check-fill"></i> Sell Product &emsp;&emsp;</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('invoices')}}"><i class="bi bi-list-task"></i> Invoices &emsp;&emsp;</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('restockProduct')}}"><i class="bi bi-bag-plus-fill"></i> Restock Product &emsp;&emsp;</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('invoicesDataTable')}}"><i class="bi bi-list-stars"></i> Invoices DataTable &emsp;&emsp;</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('stat')}}"><i class="bi bi-file-bar-graph-fill"></i> stat &emsp;&emsp;</a>
            </li>
        </ul>
        </div>
    </div>
    </nav>
</div> <br><br><br>

    <div class="container">
        @yield('content')
    </div>


    

</body>
</html>



