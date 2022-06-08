
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<br><br>

<center>
<div class="alert alert-danger alert-dismissible fade show" role="alert" style="width: 600px;">
    <strong>{{ strtoupper($product_stock->name) }} (SKU: {{ $product_stock->sku}})</strong> 
    is out of stock!<br>
    Only {{ $product_stock->stock }} pieces left.
</div>
</center>
                
