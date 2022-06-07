@extends('index')
@section('content')

<br><br>

<center>
    <h2>Product Selling Page</h2>

    <table class="table table-striped" style="width: 550px;">

    <form action="{{route('sellProductSub')}}" method="post">
    {{@csrf_field()}}
    
    <tr><td> <select name="products1" style="height: 30px;">
        <option value="false">Choose Product Name</option>
        
        @foreach ($products as $product)
            <option value="{{$product->id}}">{{$product->name}} (SKU: {{$product->sku}}), Price: {{$product->selling_price}}tk</option>
        @endforeach
    </select> </td>
    <td><input type="number" name="qty1" value="1" style="width: 80px;"></td>
    </tr>
    
    <tr><td> <select name="products2" style="height: 30px;">
        <option value="false" name="name2">Choose Product Name</option>
        
        @foreach ($products as $product)
            <option value="{{$product->id}}" name="name2">{{$product->name}} (SKU: {{$product->sku}}), Price: {{$product->selling_price}}tk</option>
        @endforeach
    </select> </td>
    <td><input type="number" name="qty2" value="1" style="width: 80px;"></td>
    </tr>
    
    <tr><td> <select name="products3" style="height: 30px;">
        <option value="false" name="name3">Choose Product Name</option>
        
        @foreach ($products as $product)
            <option value="{{$product->id}}" name="name3">{{$product->name}} (SKU: {{$product->sku}}), Price: {{$product->selling_price}}tk</option>
        @endforeach
    </select> </td>
    <td><input type="number" name="qty3" value="1" style="width: 80px;"></td>
    </tr>
    
    <tr><td> <select name="products4" style="height: 30px;">
        <option value="false" name="name4">Choose Product Name</option>
        
        @foreach ($products as $product)
            <option value="{{$product->id}}" name="name4">{{$product->name}} (SKU: {{$product->sku}}), Price: {{$product->selling_price}}tk</option>
        @endforeach
    </select> </td>
    <td><input type="number" name="qty4" value="1" style="width: 80px;"></td>
    </tr>
    
    <tr><td> <select name="products5" style="height: 30px;">
        <option value="false" name="name5">Choose Product Name</option>
        
        @foreach ($products as $product)
            <option value="{{$product->id}}" name="name5">{{$product->name}} (SKU: {{$product->sku}}), Price: {{$product->selling_price}}tk</option>
        @endforeach
    </select> </td>
    <td><input type="number" name="qty5" value="1" style="width: 80px;"></td>
    </tr>
    
    <tr><td> <select name="products6" style="height: 30px;">
        <option value="false" name="name6">Choose Product Name</option>
        
        @foreach ($products as $product)
            <option value="{{$product->id}}" name="name6">{{$product->name}} (SKU: {{$product->sku}}), Price: {{$product->selling_price}}tk</option>
        @endforeach
    </select> </td>
    <td><input type="number" name="qty6" value="1" style="width: 80px;"></td>
    </tr>

    <tr><td colspan="2"><center><input type="submit" value = "Sell Product" class="btn btn-primary mb-2" style="width: 180px"></center></td></tr>
    
    
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
