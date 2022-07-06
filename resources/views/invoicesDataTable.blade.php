@extends('admin.layout')
@section('content')


<head>
    <title>Online Invoices by Customer</title>
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
</head>
<body>

<center><h2 style="display: inline;">Online Invoice List (Ordered By Customers)</h2>Laravel Datatable</center>
    <hr>
    <table class="table table-bordered data-table table-striped" id="invoiceDataTable">
        <thead class="table-dark">
            <tr>
                <th>SL</th>
                <th>Inovice Number</th>
                <th>Customer's Name</th>
                <th>Customer's Email</th>
                <th>Total</th>
                <th>Payment Method</th>
                <th>Date & Time</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">

$(document).ready(function() {
    $('#invoiceDataTable').dataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "{{ route('invoicesDataTable') }}",
            "type": "GET"
        },
        "columns": [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'invoice_number', name: 'invoice_number'},
            {data: 'customer_name', name: 'customer_name'},
            {data: 'customer_email', name: 'customer_email'},
            {data: 'total', name: 'total'},
            {data: 'payment_method', name: 'payment_method'},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    } );
} );

</script>


@endsection

 