<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Invoice;
use App\SoldItem;
use Session;
use Carbon\Carbon;
use DataTables;
use Mail;

class GroceryController extends Controller
{
    public function index()
    {      
        $products = Product::all();
        return view('index', compact('products'));
    }
    
    public function allProduct()
    {      


        $products = Product::all();
        return view('allProduct', compact('products'));
    }

    public function addProduct()
    {      
        return view('addProduct');
    }

    public function addProductSub(Request $request)
    {     
        $request->validate(
            [
                'name'=>'required|unique:products,name|regex:/^[a-z A-Z]+$/',
                'sku'=>'required|min:3|max:20|unique:products,sku',
                'stock'=>'required||integer|min:0',                                    
                'purchase_price'=>'required|integer',
                'selling_price'=>'required|integer'
            ],
            [
                'name.required'=>'Insert Product Name',
                'name.regex'=>'Product Name should contain only characters!',
                'name.unique'=>'This product already exists',

                'sku.required'=>'Insert Product name',
                'sku.min'=>'Insert minimum 3 characters in SKU',
                'sku.unique'=>'This SKU already exists!',

                'purchase_price.required'=>'Purchase Price Required',
                'selling_price.required'=>'Must insert Selling Price',
                'purchase_price.min'=>'Purchase Price Cannot Be Greater than Selling Price',

            ]
        );
        if($request->selling_price < $request->purchase_price)
        {
            return "Selling Price(".$request->selling_price." Taka) Cannot Be More Than Purchase Price(".$request->purchase_price." Taka)";
        }

        $addProducts = new Product(); 
        $addProducts-> name = $request->name;
        $addProducts-> sku = $request->sku;
        $addProducts-> stock = $request->stock;
        $addProducts-> purchase_price = $request->purchase_price;
        $addProducts-> selling_price = $request->selling_price;
        $addProducts-> description = $request->description;
        $addProducts-> save();  

        if($addProducts)
        {
            Session::flash('message', 'New product added!'); 
            Session::flash('alert', TRUE); 
        }
        else
        {
            Session::flash('message', 'Something Wrong!'); 
            Session::flash('alert', FALSE); 
        }
        return view('addProduct');
    }

    public function sellProductConfirm(Request $request)
    {   

        $cart = json_decode($request->cart, true);

        $invoice = new Invoice();
        $invoice -> date = Carbon::now();
        $invoice -> save();
        
        $invoice -> invoice_number = $invoice->id;
        $invoice -> total = $request->invoice_total;
        $invoice -> payment_method = $request -> pay_method;
        $invoice -> customer_name = $request -> cus_name;
        $invoice -> customer_email = $request -> cus_mail;
        $invoice -> save();

        foreach($cart as $item)
        {
            $sold_item = new SoldItem();
            $sold_item -> product_id = $item['product_id'];
            $sold_item -> invoice_id = $invoice->id;
            $sold_item -> quantity = $item['quantity'];
            $sold_item -> selling_price = 100;
            $sold_item -> save();
            $product = Product::find($item['product_id']);
            $product -> stock -= $item['quantity'];
            $product -> save();
        }
                     
    
            $products = Product::where('stock', '>', 0)->get();
            return view('sellProduct', compact('products')); 
         
    }

    public function sellProduct()
    {   
        $products = Product::where('stock', '>', 0)->get();
        return view('sellProduct', compact('products'));   
    }

    public function sellProductSub(Request $request)
    {    

        $cart = [];
        $item = [];


        for($i=0; $i < $request->field; $i++)
        {      
            $product = "products".$i;
            $quantity = "qty".$i;    
            if($request->$product != "false")
            {
                $product_stock = Product::find($request->$product);
                if($product_stock->stock >= $request->$quantity)
                {
                    $item['product_id'] = $request->$product;
                    $item['quantity'] = $request->$quantity;
                    $cart[] = $item;
                }
                else
                {
                    return view('stockout', compact('product_stock'));
                }
            }
        }


        if(count($cart) == 0)
        {
            Session::flash('message', 'There is nothing in your cart! Please Choose Some Products.'); 
            Session::flash('alert', FALSE); 
            $products = Product::all();
            return view('sellProduct', compact('products')); 
        }
        else
        {        
            $product_success = Product::all();
            return view('invoiceArray', compact('cart'))
            ->with('product_success',$product_success);
        }
    }

    public function invoiceView(Request $request)
    {   
        $invoice_success = Invoice::find($request -> id);
        $product_success = Product::all();
        $SoldItem_success = SoldItem::where('invoice_id', $request -> id)->get();
        $products = Product::all();
        return redirect()->route('invoiceView', ['id' => $request -> id])
        ->with('invoice_success',$invoice_success)
        ->with('product_success',$product_success)
        ->with('SoldItem_success',$SoldItem_success); 
    }

    public function invoiceViewId($id)
    {   
        $invoice_success = Invoice::find($id);
        $product_success = Product::all();
        $SoldItem_success = SoldItem::where('invoice_id', $id)->get();
        $products = Product::all();
        return view('invoiceView')
        ->with('invoice_success',$invoice_success)
        ->with('product_success',$product_success)
        ->with('SoldItem_success',$SoldItem_success); 
    }
    
    
    public function invoices()
    {  
        
        $invoices = Invoice::where('total', '>', 0)
        ->orderBy('id', 'DESC')->get();
        
        return view('invoices', compact('invoices')); 
    }


    
    public function invoicesDataTable(Request $request)
    {   
        if ($request->ajax()) {
            $invoices = Invoice::where('total', '>', 0)
            ->orderBy('id', 'DESC')->get();

            $x = 0;

            return DataTables::of($invoices)

                    ->addIndexColumn()

                    ->addColumn('invoice_number', function($row) {
                        $html = 'GNT' . $row->invoice_number;
                        return $html;
                    })

                    ->addColumn('customer_name', function($row) {
                        if($row->customer_name)
                        {
                            $html =  ucfirst($row->customer_name);
                        }
                        else
                        {
                            $html = 'Unknown';
                        }
                        return $html;
                    })

                    ->addColumn('customer_email', function($row) {
                        if($row->customer_email)
                        {
                            $html = $row->customer_email;
                        }
                        else
                        {
                            $html = 'Unknown';
                        }
                        return $html;
                    })

                    ->addColumn('total', function($row) {
                        $html = $row->total.' Taka';
                        return $html;
                    })

                    ->addColumn('created_at', function($row) {
                        $html = date_format(date_create($row->created_at), "d-M-Y, h:i:sa");
                        return $html;
                    })

                    ->addColumn('payment_method', function($row) {
                        if($row->payment_method == "cash")
                        {
                            $html = $row->payment_method .' <p style="font-size: 30px; display: inline;"> &#128181;</p>';
                        }
                        else
                        {
                            $html = $row->payment_method .' <p style="font-size: 30px; display: inline;"> &#128179;</p>';
                        }
                        return $html;
                    })
                    

                    ->addColumn('action', function($row) use ($x){  // USE => USED TO ACCESS VARIABLES FROM OUTSIDE OF VARIABLE    
                        $btn = '<a href="'.route("invoice.details", $row->invoice_number + $x).'" class="edit btn btn-primary btn-sm">Details</a>';
                        return $btn;
                    })

                    ->rawColumns(['action', 'invoice_number', 'customer_name', 'customer_email', 'payment_method'])

                    ->make(true);
        }   

        return view('invoicesDataTable');
    
    }



    public function invoicesDetails($id)
    {   
        $invoice = Invoice::find($id);
        $products = Product::all();
        $sold_items = SoldItem::where('invoice_id', $id)->get();

        return view('invoiceDetails', compact('invoice', 'products', 'sold_items')); 
    }
    
    public function restockProduct()
    {   
        $products = Product::all();

        return view('restockProduct', compact('products')); 
    }

    public function restockProductSub(Request $request)
    {   
        $products = Product::all();
        if($request->product != "false")
        {
            $product = Product::find($request->product);
            $product->stock += $request->qty;
            $product->save();
            Session::flash('message', 'Product Restocked!'); 
            Session::flash('alert', TRUE);  
            return view('restockProduct', compact('product', 'products')); 
        }
        else
        {
            Session::flash('message', 'Choose a product to stock again!'); 
            Session::flash('alert', FALSE); 
            return view('restockProduct', compact('products')); 
        }
    }

    public function dataTable()
    {   
        $sold_items = SoldItem::all();        
        return view('dataTable', compact('sold_items')); 
    }
    

}
