@extends('index')
@section('content')

<br><br>

<table class="table">


    <thead class="thead-dark">
        <tr>
            <th>Inovice Number</th>
            <th>Customer's Name</th>
            <th>Customer's Email</th>
            <th>Total</th>
            <th>Payment Method</th>
            <th>Time & Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($invoices as $invoice)
        <tr>
            <td><a href="{{route('invoice.details', $invoice->id)}}"> {{$invoice->id}} </a></td>
            <td>{{$invoice->customer_name}}</td>
            <td>{{$invoice->customer_email}}</td>
            <td>{{$invoice->total}} Taka</td>
            <td>{{$invoice->payment_method}}</td>
            <td>{{$invoice->date}}</td>
        </tr>
        @endforeach
    </tbody>

</table>


@endsection
