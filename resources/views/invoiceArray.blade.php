@extends('index')
@section('content')

<br><br>


    

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

    @for ($i = 1; $i <= $n; $i++)
        @foreach ($product_success as $product)
            @if($prod[$i] == $product->id)
                <tr>
                    <td> {{$product->name}}</td>
                    <td> {{$product->selling_price}} Taka</td>
                    <td> {{$qty[$i]}}</td>
                    <td> {{$product->selling_price * $qty[$i]}} Taka</td>
                    <?php $total += $product->selling_price * $qty[$i]; ?>
                </tr>
            @endif
        @endforeach
    @endfor


    <tr>
        <td> </td>
        <td> </td>
        <th> Total Amount: </th>
        <th> {{$total}} Taka</th>
    </tr>  

    <tr>
        <form action="{{route('sellProductConfirm')}}" method="post"> <center>
            {{@csrf_field()}}
            Name: <input type="text" name="cus_name" placeholder="Enter Customer's Name">&emsp;&emsp;&emsp;&emsp; 
            Email: <input type="text" name="cus_mail" placeholder="Enter Customer's Email">&emsp;&emsp;&emsp;&emsp;
            <b>Payment Method</b>
            
            <input type="radio" name="pay_method" value="card">Card
            <input type="radio" name="pay_method" value="cash">Cash 
            &emsp;&emsp;&emsp;&emsp;

            <input type="hidden" name="cart" value="{{ json_encode($cart) }}">

            {{-- @for ($i = 1; $i <= $n; $i++)
                <input type="hidden" name="prod{{$i}}" value="{{ $prod[$i] }}">
                <input type="hidden" name="qty{{$i}}" value="{{ $qty[$i] }}">
            @endfor
            <input type="hidden" name="n" value="{{ $n }}"> NUMBER OF VALAUES IN ARRAY --}}

            <input type="hidden" name="invoice_total" value="{{ $total }}">
            <input type="Submit" value="Confirm Order">
        </center> </form><br><br>
    </tr>

    
    </tbody>
    </table>



</center>

@endsection
