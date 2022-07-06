@extends('admin.layout')
@section('content')

<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      var chart_val = <?php echo $chart_val; ?>;
      console.log(chart_val);
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable(chart_val);
        var options = {
          title: 'Revenue-Profit Chart Day by Day',
          curveType: 'function',
          legend: { position: 'bottom' }
        };
        var chart = new google.visualization.LineChart(document.getElementById('linechart'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <center><h2>Per Day Sale Statistics</h2></center><br>

@php    
    $subtotal_invoices = 0;
    $subtotal_revenune = 0;
    $subtotal_profit = 0;
    $average_percentage = 0;
@endphp

<div style="position: absolute; left:2%;">
    <table class="table table-striped" id="stat" style="width: 650px; left:0%">
        <?php $sl=0; ?>
        
        <tbody>
            @foreach ($everyday as $day)
            <tr>
                <td> {{ ++$sl }}</td>
                <td> {{ date_format(date_create($day->date), "d-M-Y") }} </td>
                <td> 
                    @foreach($total_invoices as $total_invoice)
                        @if($total_invoice->date == $day->date)
                            {{ $total_invoice->total }}
                            @php $subtotal_invoices += $total_invoice->total; @endphp
                        @endif
                    @endforeach
                </td>
                 {{-- $day->total_invoices --}}
                <td> {{ $day->revenue }} Taka </td>
                @php $subtotal_revenune += $day->revenue ; @endphp
                <td> {{ $day->profit }} Taka </td>
                @php $subtotal_profit += $day->profit; @endphp
                <td> {{ $percent = round($day->profit * 100 / $day->revenue, 2) }}% </td>
                @php $average_percentage += $percent; @endphp
                
            </tr>
            @endforeach
        </tbody>
        <thead>
            <tr style="background-color: Lavender;">
                <th>SL<br>No</th>
                <th>DATE<br>({{ $sl }} Days)</th>
                <th>SOLD<br>({{ $subtotal_invoices }} Inv.)</th>
                <th>REVENUE<br>({{ $subtotal_revenune }} Tk)</th>
                <th>PROFIT<br>({{ $subtotal_profit }} Tk)</th>
                <th>PERCENTAGE<br>({{ round($average_percentage/$sl, 2) }}%)</th>
            </tr>
        </thead>
        

        

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

<div style="position: absolute; right:-10%; width: 900px; height: 500px; top:24%; z-index: -100;"  id="linechart"></div>

<div style="position: absolute; right:2%;">
    <table style="width: 580px;"><tr>
    <td>
        <a class="btn btn-primary" href="{{ route('downloadCSV') }}" role="button"><i class="bi bi-filetype-csv"></i> Download CSV</a>
    </td>
    <td style="text-align:right">
        <a class="btn btn-info" href="{{ route('downloadChart') }}" role="button"><i class="bi bi-graph-up-arrow"></i> Download Chart</a> 
    </td>
    </tr></table>
    <hr>
    
    
</div>

<p style="position: absolute; right:37.7%; top: 57%; transform-origin: 0 0; transform: rotate(-90deg);">Amount (Taka)</p>
  </body>




@endsection
