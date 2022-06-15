<head>
    <style>
        table {
        border-collapse: collapse;
        width: 100%;
        }

        td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
        }

        th {
        padding: 8px;
        text-align: left;
        background-color: lavender;
        color: black;
        }

        #watermark { 
            position: fixed; 
            bottom: 20%; 
            right: 20%;
            z-index:999; 
            opacity: 0.3;
            font-size: 40px;
            transform-origin: 0 0;
            transform: rotate(-45deg);

        }

        #below { 
            bottom: 0px; 
            position: fixed; 
            right:0px;
            font-size: 12px;
            color: red;
        }

        </style>
</head>


<div id="watermark">
    <h1> GNT Grocery </h1>
</div>

<center>
    <h1 style="display: inline;">GNT Grocery</h1><br>
    Suite:1301, Sel Trident Tower, <br>
    57 Purana Paltan Line, Dhaka-1000 <br>
</center>

<table>
    <tr>
        <td><h1>Invoice No#GNT{{ $invoiceData->id }}</h1></td>
        <td style="text-align: right;"><h4>{{ date_format(date_create($invoiceData->created_at), "d/M/Y H:i:s") }}</h4></td>
    </tr></table>

<h3>Hello, {{$invoiceData->customer_name}}</h3>


<table>


    <thead>
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

    @foreach ($sold_itemsData as $sold)
    @if ($sold->invoice_id == $invoiceData->id)
        @foreach ($productsData as $product)
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
        <td><b>  Total Amount:  </b></td>
        <td><b> {{$total}} Taka </b></td>
    </tr>



    
    </tbody>
    </table>
    
    <br><br>  <br><br>  <br><br>

    <b><center> Thank You For Purchasing From GNT Grocery! </center></b>

    <p id="below">All Rights Reserved To GNT Grocery!</p>

    