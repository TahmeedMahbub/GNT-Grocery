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
            <th>SKU</th>
            <th>DESCRIPTION</th>
            <th>STOCK</th>
            <th>PURCHASE PRICE</th>
            <th>SELLING PRICE</th>
        </tr>

        @foreach ($products as $product)
        <tr>
            <td> {{ ++$sl }}</td>
            <td> {{$product -> name}} </td>
            <td> {{$product -> sku}} </td>
            <td> {{$product -> description}} </td>
            <td> 
                @if ($product->stock < 1)
                    <div style="color: red;"> Out of Stock! </div>
                @else
                    {{$product -> stock}}
                @endif </td>
            <td> {{$product -> purchase_price}} </td>
            <td> {{$product -> selling_price}} </td>
        </tr>
        @endforeach

    </table>

</center>

@endsection
