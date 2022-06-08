@extends('index')
@section('content')

<br><br>

<center>
    @if(Session::has('message'))
        @if(Session::get('alert') == TRUE)
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @else
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ Session::get('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    @endif

    <h2>Enter Product Information</h2>

    <table>
    <form action="{{route('addProductSub')}}" method="post">
    {{@csrf_field()}}
        <tr>
                <td>Product Name:</td>
                <td><input type="text" placeholder="Enter Product Name" name="name" required></td>
        </tr>
        <tr>
                <td>Product SKU:</td>
                <td><input type="text" placeholder="Enter Product SKU" name="sku" required></td>
        </tr>
        <tr>
                <td>Available Quantity:</td>
                <td><input type="number" min="0" placeholder="Enter Available Quantity" name="stock" required></td>
        </tr>
        <tr>
                <td>Purchase Price:</td>
                <td><input type="number" min="0" placeholder="Enter Purchasing Price" name="purchase_price" required></td>
        </tr>
        <tr>
                <td>Selling Price:</td>
                <td><input type="number" min="0" placeholder="Enter Selling Price" name="selling_price" required></td>
        </tr>
        <tr>
                <td>Product Description:</td>
                <td>
                    <!-- <input type="text" placeholder="Enter Product Description" name="desc"> -->
                    <textarea  placeholder="Enter Product Description" name="description" style="resize: none; height: 85px; width: 190px;" required></textarea>
                </td>
        </tr>
        <tr><td colspan="2"><center><input type="submit" value = "Insert Product" class="btn btn-primary mb-2" style="width: 160px"></center></td></tr>
        
    </form>

    

    </table>

</center>

@endsection
