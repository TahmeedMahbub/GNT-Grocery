@extends('index')
@section('content')


<center><h2>Per Day Sale Statistics</h2></center><br>

<div style="position: absolute; left:2%">
    <table class="table table-striped" id="stat" style="width: 700px; left:0%">
        <?php $sl=0; ?>
        <thead>
            <tr style="background-color: Lavender;">
                <th>SL</th>
                <th>DATE</th>
                <th>TOTAL INVOICES</th>
                <th>REVENUE</th>
                <th>PROFIT</th>
                <th>PERCENTAGE</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($everyday as $day)
            <tr>
                <td> {{ ++$sl }}</td>
                <td> {{ date_format(date_create($day->date), "d-M-Y") }} </td>
                <td> 
                    @foreach($total_invoices as $total_invoice)
                        @if($total_invoice->date == $day->date)
                            {{ $total_invoice->total }}
                        @endif
                    @endforeach
                    {{ $day->total_invoices }} </td>
                <td> {{ $day->revenue }} Taka </td>
                <td> {{ $day->profit }} Taka </td>
                <td> {{ round($day->profit * 100 / $day->revenue, 2) }}% </td>
                
            </tr>
            @endforeach
        </tbody>

        

        

    </table>




<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
        $('#stat').DataTable();
    } );
</script>
</div>

<div style="position: absolute; right:2%">

    <img src="https://www.researchgate.net/profile/Vijay-Kumar-30/publication/293014146/figure/fig3/AS:334712682893314@1456813130243/Graph-of-profit-at-time-t.png" alt="" width="600px">

</div>

@endsection
