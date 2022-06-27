@extends('customer.layout')
@section('content')
<head>
    <style>
        #sellButton { 
            position: fixed; 
            bottom: 70%; 
            right: 2%;
            /* transform-origin: 0 0; */
            /* transform: rotate(-45deg); */

        }
        </style>
</head>


<center>

    @if(Session::has('message'))
        @if(Session::get('alert') == TRUE)
            <div class="justify-content-center alert alert-success alert-dismissible fade show" role="alert">
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

    <h2>Product Selling Page</h2>

    <table class="table table-striped" style="width: 550px;">

    <form action="{{route('sellProductSub')}}" method="post">
    {{@csrf_field()}}

    @php $field = 20; @endphp {{-- HOW MANY SELLING FIELD WILL ARRIVE --}}

    @for ($i = 0; $i < $field; $i++)
        <tr><td> <select name="products{{ $i }}" style="height: 30px;">
        <option value="false">Choose Product Name</option>
        
        @foreach ($products as $product)
            <option value="{{$product->id}}">{{$product->name}} (SKU: {{$product->sku}}), Price: {{$product->selling_price}}tk</option>
        @endforeach

        </select> </td>
        <td><input type="number" name="qty{{ $i }}" value="1"  style="width: 80px;" min="0"></td>
        </tr>
    @endfor

    <input type="hidden" name="field" value="{{ $field }}">
    <div id="sellButton">
        <input type="submit" value = "Buy Product" class="btn btn-primary mb-2" style="width: 180px">
    </div>
    
    </form>

    </table>

    

    


</center>
<br><br>
<p style='text-align: right; font-size: 12px;;'>Change number of fields from sellProduct.blade.php to the variable $field</p>
@endsection
