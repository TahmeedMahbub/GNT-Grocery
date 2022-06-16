@extends('index')
@section('content')

<h2><center>Invoice List (JQuery DataTable)</center></h2><hr>
@php $serial = 0; @endphp
<table class="table table-bordered table-hover table-striped" id="invoiceTable">
    <thead class="table-dark">
        <tr>
            <th>Sl</th>
            <th>Inovice Number</th>
            <th>Name</th>
            <th>Email</th>
            <th>Total</th>
            <th>Method</th>
            <th>Profit</th>
            <th>Date & Time</th>
            {{-- <th>Actions</th> --}}
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
                    {{ ucfirst($invoice->customer_name) }}  {{-- UCFIRST => FIRST LETTER WILL BE CAPITAZED --}}
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
                @if($invoice->payment_method == 'cash')
                    {{ $invoice->payment_method }} <i class="bi bi-cash"></i>
                    {{-- <p style="font-size: 30px; display: inline;"> &#128181;</p> --}}
                @else
                    {{ $invoice->payment_method }} <i class="bi bi-credit-card"></i>
                    {{-- <p style="font-size: 30px; display: inline;"> &#128179;</p> --}}
                @endif
            </td>
            <td>
                @foreach ($profits as $profit)
                    @if($profit->id == $invoice->id)
                        {{$profit->benefit}} Taka
                    @endif
                @endforeach
            </td>
            <td>{{ date_format(date_create($invoice->created_at), "d-M-y h:iA") }}</td>
            {{-- <td><a href='{{ route("invoice.details", $invoice->id) }}' class="edit btn btn-primary btn-sm">Details</a></td> --}}
        </tr>
        @endforeach
    </tbody>

</table>


<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
        $('#invoiceTable').DataTable();
    } );
</script>




@endsection
