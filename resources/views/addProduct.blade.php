@extends('index')
@section('content')


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

    <table class="table table-bordered" style="width: 500px;">
    <form action="{{route('addProductSub')}}" method="post">
    {{@csrf_field()}}
        <tr>
            <td>Product Name:</td>
            <td>
                <input type="text" placeholder="Enter Product Name" name="name"  value="{{old('name')}}" >
            </td>
        </tr>
        @error('name')                
            <tr class="table-danger">
                <td colspan = "2">
                    <center>{{$message}}</center>
                </td>
            </tr>
        @enderror
        <tr>
            <td>Product SKU:</td>
            <td>
                <input type="text" placeholder="Enter Product SKU" name="sku"  value="{{old('sku')}}" >
            </td>
        </tr>
        @error('sku')
            <tr class="table-danger">
                <td colspan = "2">
                    <center>{{$message}}</center>
                </td>
            </tr>
        @enderror
        <tr>
            <td>Available Quantity:</td>
            <td>
                <input type="number" min="0" placeholder="Enter Available Quantity" name="stock"  value="{{old('stock')}}">
            </td>
        </tr>
            @error('stock')
                <tr class="table-danger">
                    <td colspan = "2">
                        <center>{{$message}}</center>
                    </td>
                </tr>
            @enderror
        <tr>
            <td>Purchase Price:</td>
            <td>
                <input type="number" min="0" placeholder="Enter Purchasing Price" name="purchase_price"  value="{{old('purchase_price')}}">
            </td>
        </tr>
        @error('purchase_price')
            <tr class="table-danger">
                <td colspan = "2">
                    <center>{{$message}}</center>
                </td>
            </tr>
        @enderror
        <tr>
                <td>Selling Price:</td>
                <td>
                    <input type="number" min="0" placeholder="Enter Selling Price" name="selling_price" value="{{old('selling_price')}}">
                </td>
        </tr>
        @error('selling_price')
            <tr class="table-danger">
                <td colspan = "2">
                    <center>{{$message}}</center>
                </td>
            </tr>
        @enderror
        <tr>
                <td>Product Description:</td>
                <td>
                    <!-- <input type="text" placeholder="Enter Product Description" name="desc"> -->
                    <textarea  placeholder="Enter Product Description" name="description" style="resize: none; height: 85px; width: 190px;" ></textarea>
                </td>
        </tr>
        <tr><td colspan="2"><center><input type="submit" value = "Insert Product" class="btn btn-primary mb-2" style="width: 160px"></center></td></tr>
        
    </form>

    

    </table>

</center>

@endsection
