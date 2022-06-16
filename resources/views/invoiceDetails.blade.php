@extends('index')
@section('content')


<br><br>

<table width="100%">

    <tr>
        <td><h2>Invoice No#<p style="color:rgb(41, 41, 255); display: inline;">GNT{{$id}}</p></h2></td>
        <td style="text-align: right;"><h4>{{ date_format(date_create($join_table[0]->created_at), "d/M/Y H:i:s") }}</h4></td>
    </tr>

    <tr>
        <td>
            <h3>Hello, {{$join_table[0]->customer_name}}</h3>
        </td>
        <td style="text-align: right;">
            <a class="btn btn-info" href="{{ route('viewInvoice', $id) }}" role="button"><i class="bi bi-eye"></i> View Invoice</a> 
            <a class="btn btn-primary" href="{{ route('downloadInvoice', $id) }}" role="button"><i class="bi bi-download"></i> Download Invoice</a>
        </td>
    </tr>
    
</table>
    
    

    
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

@php $total=0; @endphp
    
<table class="table">
    
    <thead class="thead-dark">
        <tr  style="background-color: Lavender;">
            <th>Product Name</th>
            <th>Unit Price</th>
            <th>Quantity</th>
            <th>Total Price</th>
        </tr>
    </thead>

    <tbody>
        
        @foreach ($join_table as $join)
            <tr>
                <td> {{$join->name}}</td>
                <td> {{$join->selling_price}} Taka</td>
                <td> {{$join->quantity}}</td>
                <td> {{$join->selling_price * $join->quantity}} Taka</td>
                <?php $total += $join->selling_price * $join->quantity; ?>
            </tr>
        @endforeach
        <tr style="background-color:rgb(204, 204, 204)">
            <td> </td>
            <td> </td>
            <th> Total Amount: </th>
            <th> {{$total}} Taka</th>
        </tr> 
    
    </tbody>
</table>
        


@endsection
