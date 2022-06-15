@extends('index')
@section('content')

<br><br>

<table class="table"><tr width="100%">
    <td><h2>Invoice No#GNT{{$invoice -> id}}</h2></td>
    <td style="text-align: right;"><h4>{{ date_format(date_create($invoice->created_at), "d/M/Y H:i:s") }}</h4></td>
</tr>


<tr>
    <td>
        <h3>Hello, {{$invoice->customer_name}}</h3>
    </td>
    <td style="text-align: right;">
        <a class="btn btn-info" href="{{ route('viewInvoice', $invoice -> id) }}" role="button">View Invoice</a> 
        <a class="btn btn-primary" href="{{ route('downloadInvoice', $invoice -> id) }}" role="button">Download Invoice</a>
    </td>
</tr>

</table>


{{-- {{ dd($sold_items) }} --}}
    

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

    <table class="table">


    <thead class="thead-dark">
        <tr>
            <th>Product Name</th>
            <th>Unit Price</th>
            <th>Quantity</th>
            <th>Total Price</th>
        </tr>
    </thead>
    <tbody>

    <?php $total=0; ?>
    
    {{-- @foreach($sold_items as $sold_item)
        {{ $sold_item['product_id'] }}
    @endforeach --}}

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

    

    
    </tbody>
    </table>




@endsection
