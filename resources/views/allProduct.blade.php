@extends('index')
@section('content')


<center>
    <h2>Products List</h2>

    <table class="table table-striped">
        <?php $sl=0; ?>
        <tr style="background-color: Lavender;">
            <th>SL</th>
            <th>IMAGE</th>
            <th>NAME</th>
            <th>SKU</th>
            <th>DESCRIPTION</th>
            <th>STOCK</th>
            <th>PURCHASE PRICE</th>
            <th>SELLING PRICE</th>
            <th>PROFIT</th>
        </tr>

        @foreach ($products as $product)
        <tr>
            <td> {{ ++$sl }}</td>
            <td> {{ $product->name }} </td>
            <td> <img src="{{ asset('public/product images/'.$product->image) }}" height="30px" alt="{{ $product->name }} Image"> </td>
            <td> {{ $product->sku }} </td>
            <td> 
                @if ($product->description)
                    {{ $product -> description }}
                @else
                    No Description Given!
                @endif 
            </td>

            <td> 
                @if ($product->stock < 1)
                    <div style="color: red;"> Out of Stock! </div>
                @else
                    {{ $product -> stock }}
                @endif 
            </td>
            <td> {{ $product->purchase_price }} Taka</td>
            <td> {{ $product->selling_price }} Taka</td>
            <td> {{ $product->selling_price - $product->purchase_price }} Taka</td>
        </tr>
        @endforeach

    </table>

</center>

@endsection
