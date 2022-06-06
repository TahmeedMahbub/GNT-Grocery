@extends('index')
@section('content')

<br><br>

<center>
    <h2>Enter Product Information</h2>

    <table>
    <form action="{{route('addProductSub')}}" method="post">
    {{@csrf_field()}}
        <tr>
                <td>Product Name:</td>
                <td><input type="text" placeholder="Enter Product Name" name="name" ></td>
        </tr>
        <tr>
                <td>Product SKU:</td>
                <td><input type="text" placeholder="Enter Product SKU" name="sku"></td>
        </tr>
        <tr>
                <td>Available Quantity:</td>
                <td><input type="number" placeholder="Enter Available Quantity" name="stock"></td>
        </tr>
        <tr>
                <td>Purchase Price:</td>
                <td><input type="number" placeholder="Enter Purchasing Price" name="purchase_price"></td>
        </tr>
        <tr>
                <td>Selling Price:</td>
                <td><input type="number" placeholder="Enter Selling Price" name="selling_price"></td>
        </tr>
        <tr>
                <td>Product Description:</td>
                <td>
                    <!-- <input type="text" placeholder="Enter Product Description" name="desc"> -->
                    <textarea  placeholder="Enter Product Description" name="description" style="resize: none; height: 85px; width: 190px;"></textarea>
                </td>
        </tr>
        <tr><td colspan="2"><center><input type="submit" value = "Insert Product" class="btn btn-primary mb-2" style="width: 160px"></center></td></tr>
        
    </form>

    

    </table>

    @if(Session::has('message'))
        @if(Session::get('alert') == TRUE)
            <p class="alert alert-success">{{ Session::get('message') }}</p>
        @else
            <p class="alert alert-danger">{{ Session::get('message') }}</p>
        @endif
    @endif

</center>

@endsection
