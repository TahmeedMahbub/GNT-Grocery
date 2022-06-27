@extends('adminLayout')
@section('content')

<br><br>


    <h2>Invoice No#{{$invoice_success -> id}}</h2>

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

    @foreach ($SoldItem_success as $sold)
    @if ($sold -> invoice_id == $invoice_success->id)
        @foreach ($product_success as $product)
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

    @if(isset($invoice_success->total))

    <h3>Hello, {{$invoice_success->customer_name}}</h3>

    @else
        
    <tr>
        <form action="{{route('sellProductConfirm')}}" method="post"> <center>
            {{@csrf_field()}}
            Name: <input type="text" name="cus_name" placeholder="Enter Customer's Name">&emsp;&emsp;&emsp;&emsp;
            Email: <input type="text" name="cus_mail" placeholder="Enter Customer's Email">&emsp;&emsp;&emsp;&emsp;
            <b>Payment Method</b>&emsp;&emsp;
            
            <input type="radio" name="pay_method" value="card">Card
            <input type="radio" name="pay_method" value="cash">Cash 
            &emsp;&emsp;&emsp;&emsp;

            <input type="hidden" name="invoice_id" value="{{$sold -> invoice_id}}">
            <input type="hidden" name="invoice_total" value="{{$total}}">
            <input type="Submit">
        </center> </form>
    </tr>
    @endif
    
    </tbody>
    </table>



</center>

@endsection
