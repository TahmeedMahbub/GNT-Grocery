@extends('adminLayout')
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

    <h2>Restock Product</h2><br>
    <table class="table table-striped" style="width: 550px;">

    <form action="{{route('restockProductSub')}}" method="post">
    {{@csrf_field()}}

    <tr>
        <td> 
            <select name="product" style="height: 30px;">
            <option value="false">Choose Product Name</option>    
            @foreach ($products as $product)
                <option value="{{$product->id}}">{{$product->name}} (SKU: {{$product->sku}}), Price: {{$product->selling_price}}tk</option>
            @endforeach
            </select> 
        </td>
        <td>
            <input type="number" name="qty" value="1"  style="width: 80px;" min="0">
        </td>
    </tr>
        
    <tr><td colspan="2"><center><input type="submit" value = "Restock Product" class="btn btn-primary mb-2" style="width: 180px"></center></td></tr>

    </form>

    </table><br><br>

</center>

@endsection
