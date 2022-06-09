@extends('index')
@section('content')

<h2><center>Invoice List</center></h2><hr>
@php $serial = 0; @endphp
<table class="table table-bordered table-hover table-striped" id="invoiceTable">
    <thead class="table-dark">
        <tr>
            <th>SL</th>
            <th>Inovice Number</th>
            <th>Customer's Name</th>
            <th>Customer's Email</th>
            <th>Total</th>
            <th>Payment Method</th>
            <th>Date & Time</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($invoices as $invoice)
        <tr class="clickable" 
        onclick="window.location='{{route('invoice.details', $invoice->id)}}'"
        onMouseOver="this.style.backgroundColor='#C0C0C0'" 
        onMouseOut="this.style.backgroundColor='#FFFFFF'">

            <td>{{ ++$serial }}</td>
            <td>GNT{{$invoice->id}}</td>
            <td>
                @if($invoice->customer_name == NULL)
                    Not Inserted!
                @else
                    {{ $invoice->customer_name }}
                @endif
            </td>
            <td>
                @if($invoice->customer_email == NULL)
                    Not Inserted!
                @else
                    {{ $invoice->customer_email }}
                @endif
            </td>
            <td>{{$invoice->total}} Taka</td>
            <td>
                @if($invoice->payment_method == NULL)
                    Not Defined!
                @else
                    {{ $invoice->payment_method }}
                @endif
            </td>
            <td>{{ date_format(date_create($invoice->created_at), "d/M/Y H:i:s") }}</td>
            {{-- {{date_format(date_create($invoice->date), "d/M/Y H:i:s")}} --}}
        </tr>
        @endforeach
    </tbody>

</table>




@endsection
