@extends('customer.layout')
@section('content')

<br><br>


    

    <table class="table">


    <thead class="thead-dark">
        <tr>
            <th>Product Name</th>
            <th>Unit Price</th>
            <th>Qty</th>
            <th style = "text-align: right;">Total Price</th>
        </tr>
    </thead>
    <tbody>

    {{-- {{ dd($cart) }} --}}

    <?php $total=0; ?>

    


    
    @foreach($cart as $item)
        @foreach ($product_success as $product)
            @if($item['product_id'] == $product->id)
                <tr>
                    <td> {{ $product->name }}</td>
                    <td> {{ $product->selling_price }} Taka</td>
                    <td> {{ $item['quantity'] }}</td>
                    <td style = "text-align: right;"> {{ $product->selling_price * $item['quantity'] }} Taka</td>
                    <?php $total += $product->selling_price * $item['quantity']; ?>
                </tr>
            @endif
        @endforeach
    @endforeach
    


    <tr>
        <td> </td>
        <td> </td>
        <th> Total Amount: </th>
        <th style = "text-align: right;"> {{ $total }} Taka</th>
    </tr>  

    <tr>
        <h2 style=" display: inline; position: absolute; left:10%;">Good Day, {{ ucfirst(Session()->get('name')) }}</h2>
        <div style="position: absolute; right:10%;">
        <form action="{{route('sellProductConfirm')}}" method="post"> <center>
            {{ @csrf_field() }}
            <input type="hidden" name="cus_name" value="{{ Session()->get('name') }}">
            <input type="hidden" name="cus_mail" value="{{ Session()->get('email') }}">
            <input type="hidden" name="bought_by" value="{{ Session()->get('id') }}">
            <b>Payment Method</b>
            
            <input type="radio" name="pay_method" value="card">Card
            <input type="radio" name="pay_method" value="cash" checked>Cash 
            

            <input type="hidden" name="cart" value="{{ json_encode($cart) }}">

            <input type="hidden" name="invoice_total" value="{{ $total }}">
            <input type="Submit" value="Confirm Order">
        </center> </form>
        </div>
        <br><br><br>
    </tr>

    
    </tbody>
    </table>



</center>

@endsection
