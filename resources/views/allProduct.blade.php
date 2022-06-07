@extends('index')
@section('content')

<br><br>

<center>
    <h2>Products List</h2>

    <table class="table table-striped">
        <?php $sl=0; ?>
        <tr style="background-color: Lavender;">
            <th>SL</th>
            <th>NAME</th>
            <th>ID</th>
            <th>SKU</th>
            <th>STOCK</th>
            <th>PURCHASE PRICE</th>
            <th>SELLING PRICE</th>
            <th>DESCRIPTION</th>
        </tr>

        @foreach ($products as $product)
        <tr>
            <td> <?php $sl++; echo $sl; ?> </td>
            <td> {{$product -> name}} </td>
            <td> {{$product->id}} </td>
            <td> {{$product -> sku}} </td>
            <td> {{$product -> stock}} </td>
            <td> {{$product -> purchase_price}} </td>
            <td> {{$product -> selling_price}} </td>
            <td> {{$product -> description}} </td>
        </tr>
        @endforeach

    </table>

</center>

@endsection
