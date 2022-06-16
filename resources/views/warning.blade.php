
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<br><br>
<center><div class="alert alert-danger alert-dismissible fade show" role="alert" style="width: 600px;">

    @if($product_stock)
        <strong>{{ strtoupper($product_stock->name) }} (SKU: {{ $product_stock->sku}})</strong> 
        is out of stock!<br>
        Only {{ $product_stock->stock }} pieces left.
    @else
        Selling Price({{ $data['s_price'] }} Taka) Cannot Be More Than Purchase Price({{ $data['p_price'] }} Taka) <br>
        There will be {{ $data['p_price']-$data['s_price'] }} Taka Loss to Sell Per Unit of <strong>{{ $data["p_name"] }}</strong> <br>
        And <strong>{{ ($data['p_price'] - $data['s_price']) * $data['stock'] }} Taka</strong> Loss In Total to Sell All Units <br>
    @endif

</div></center>


    


                
