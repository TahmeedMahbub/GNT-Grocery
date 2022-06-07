@extends('index')
@section('content')

<br><br>


    <h2>Invoice No#{{$invoice -> id}}</h2>

    @if(Session::has('message'))
        @if(Session::get('alert') == TRUE)
            <p class="alert alert-success">{{ Session::get('message') }}</p>
        @else
            <p class="alert alert-danger">{{ Session::get('message') }}</p>
        @endif
    @endif

    <table class="table">


    <thead class="thead-dark">
        <tr>
            <th>Product Name</th>
            <th>Unit Price</th>
            <th>Qty</th>
            <th>Total Price</th>
        </tr>
    </thead>
    <tbody>

    <?php $total=0; ?>

    @foreach ($sold_items as $sold)
    @if ($sold -> invoice_id == $invoice->id)
        @foreach ($products as $product)
        @if ($sold -> product_id == $product->id)
            <tr>
                <td> {{$product->name}}</td>
                <td> {{$product->selling_price}} Taka</td>
                <td> {{$sold->quantity}}</td>
                <td> {{$product->selling_price * $sold->quantity}} Taka</td>
                <?php $total += $product->selling_price * $sold->quantity; ?>
            </tr>
        @endif
        @endforeach     
    @endif
    @endforeach
    <tr>
        <td> </td>
        <td> </td>
        <th> Total Amount: </th>
        <th> {{$total}} Taka</th>
    </tr>


    <h3>Hello, {{$invoice->customer_name}}</h3>

    
    </tbody>
    </table>



</center>

@endsection
