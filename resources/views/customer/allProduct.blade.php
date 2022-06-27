@extends('customer.layout')
@section('content')


<center>
    <h2>Products List</h2>

<div style="width: 1300px; position: absolute; left: 2%;" class="d-flex justify-content-center">
    <table class="table table-striped table-hover" id="allProducts">
        {{-- style="width: 1300px;" --}}
        <?php $sl=0; ?>
        <thead>
            <tr style="background-color: Lavender;">
                <th>SL</th>
                <th>IMAGE</th>
                <th>NAME</th>
                <th>SKU</th>
                <th>DESCRIPTION</th>
                <th>STOCK</th>
                <th>SELLING PRICE</th>
            </tr>
        </thead>
        <tbody>
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
                <td> {{ $product->selling_price }} Taka</td>
            </tr>
            @endforeach
        </tbody>

        

        

    </table>
</div>

</center>


<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
        $('#allProducts').DataTable();
    } );
</script>


@endsection
