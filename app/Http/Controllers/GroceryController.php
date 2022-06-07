<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Invoice;
use App\SoldItem;
use Session;

class GroceryController extends Controller
{
    public function index()
    {      
        $products = Product::all();
        return view('index', compact('products'));
    }
    
    public function allProduct()
    {      

        // $invoice = Invoice::find(89);
        // $SoldItem = SoldItem::find(115);
        // dd($SoldItem->invoice);
        // dd($invoice->soldItems);

        $products = Product::all();
        return view('allProduct', compact('products'));
    }

    public function addProduct()
    {      
        return view('addProduct');
    }

    public function addProductSub(Request $req)
    {     
        $addProducts = new Product(); 
        $addProducts-> name = $req->name;
        $addProducts-> sku = $req->sku;
        $addProducts-> stock = $req->stock;
        $addProducts-> purchase_price = $req->purchase_price;
        $addProducts-> selling_price = $req->selling_price;
        $addProducts-> description = $req->description;
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

    public function sellProductConfirm(Request $req)
    {   
        // dd($req->all());
        
        for ($i = 1; $i < $req->n; $i++)
        {
            echo $req->prod.$i."<br>";
        }

        $cart = json_decode($req->cart, true);

        // dd($cart);
        
        $time = date("h:i:sa, d/m/Y", strtotime('6 hour'));
        $invoice = new Invoice();
        $invoice -> date = $time;
        $invoice -> save();
        
        $invoice -> invoice_number = $invoice->id;
        $invoice -> total = $req->invoice_total;
        $invoice -> payment_method = $req -> pay_method;
        $invoice -> customer_name = $req -> cus_name;
        $invoice -> customer_email = $req -> cus_mail;
        $invoice -> save();

        foreach($cart as $item)
        {
            $sold_item = new SoldItem();
            $sold_item -> product_id = $item['product_id'];
            $sold_item -> invoice_id = $invoice->id;
            $sold_item -> quantity = $item['quantity'];
            $sold_item -> selling_price = 100;
            $sold_item -> save();
        }



        


        Session::flash('message', 'Successfully updated your order!'); 
        Session::flash('alert', TRUE);              
    
            $products = Product::all();
            return view('sellProduct', compact('products')); 
         
    }

    public function sellProduct()
    {   
        $products = Product::all();
        return view('sellProduct', compact('products'));   
    }

    public function sellProductSub(Request $req)
    {    
        $n = 0; //HOW MANY PRODUCTS INSERTED
        $prod[$n] = 0; //PRODUCT ARRAY
        $qty[$n] = 0; //QTY ARRAY
        $flag = 0; //CHECK ANY ERROR; 0->ERROR, 1->OK
        $time = date("h:i:sa, d/m/Y", strtotime('6 hour'));
        $invoices = new Invoice();
        $invoices -> date = $time;
        $invoices -> save();

        $cart = [];
        $item = [];

        $invoice = Invoice::where('date', $time)->first();
        if($req -> products1 != "false")
        {

            // $n++;
            // $prod[$n] = $req->products1;
            // $qty[$n] = $req->qty1;

            $item['product_id'] = $req->products1;
            $item['quantity'] = $req->qty1;
            $cart[] = $item;



            // $productPrice = Product::find($req -> products1);
            // $productPrice -> stock -= $req -> qty1;
            // $productPrice -> save();
            // $sellProducts = new SoldItem();
            // $sellProducts -> product_id = $req -> products1;
            // $sellProducts -> quantity = $req -> qty1;
            // $sellProducts -> invoice_id = $invoice -> id;
            // $sellProducts -> selling_price = $productPrice -> selling_price;
            // $sellProducts -> save();
            // $flag = 1;
        }
        
        if($req -> products2 != "false")
        {
            
            // $n++;
            // $prod[$n] = $req->products2;
            // $qty[$n] = $req->qty2;

            $item['product_id'] = $req->products2;
            $item['quantity'] = $req->qty2;
            $cart[] = $item;
        }
        
        if($req -> products3 != "false")
        {
            
            // $n++;
            // $prod[$n] = $req->products3;
            // $qty[$n] = $req->qty3;
            $item['product_id'] = $req->products3;
            $item['quantity'] = $req->qty3;
            $cart[] = $item;
        }
        
        if($req -> products4 != "false")
        {
            
            // $n++;
            // $prod[$n] = $req->products4;
            // $qty[$n] = $req->qty4;

            $item['product_id'] = $req->products4;
            $item['quantity'] = $req->qty4;
            $cart[] = $item;
        }
        
        if($req -> products5 != "false")
        {
            
            // $n++;
            // $prod[$n] = $req->products5;
            // $qty[$n] = $req->qty5;

            $item['product_id'] = $req->products5;
            $item['quantity'] = $req->qty5;
            $cart[] = $item;
        }
        
        if($req -> products6 != "false")
        {
            
            // $n++;
            // $prod[$n] = $req->products6;
            // $qty[$n] = $req->qty6;

            $item['product_id'] = $req->products6;
            $item['quantity'] = $req->qty6;
            $cart[] = $item;

        }

        if(count($cart) == 0)
        {
            Session::flash('message', 'Something Wrong!'); 
            Session::flash('alert', FALSE); 
        }
        else
        {
            Session::flash('message', 'Successfully placed your order!'); 
            Session::flash('alert', TRUE);         
            $product_success = Product::all();
            return view('invoiceArray', compact('cart'))
            ->with('prod',$prod)
            ->with('qty',$qty)
            ->with('n', $n)
            ->with('product_success',$product_success);
        }
    }

    public function invoiceView(Request $req)
    {   
        $invoice_success = Invoice::find($req -> id);
        $product_success = Product::all();
        $SoldItem_success = SoldItem::where('invoice_id', $req -> id)->get();
        $products = Product::all();
        // return redirect('/invoiceView/{{$invoice -> id}')
        return redirect()->route('invoiceView', ['id' => $req -> id])
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
        // return redirect('/invoiceView/{{$invoice -> id}')
        return view('invoiceView')
        ->with('invoice_success',$invoice_success)
        ->with('product_success',$product_success)
        ->with('SoldItem_success',$SoldItem_success); 
    }
    public function invoices()
    {   
        // $invoice = Invoice::where('total', null)->get();
        // if(isset($invoice))
        // {
        //     foreach($invoice as $i)
        //     {
        //         $sold = SoldItem::where('invoice_id', $i->id)->delete();
        //     }
        //     $invoiceDel = Invoice::find($invoice->id)->delete();
        
        // }
        
        $invoices = Invoice::all();
        
        return view('invoices', compact('invoices')); 
    }


    public function invoicesDetails($id)
    {   
        $invoice = Invoice::find($id);
        $products = Product::all();
        $sold_items = SoldItem::where('invoice_id', $id)->get();

        // $invoice = Invoice::find(89);
        // $SoldItem = SoldItem::find(115);
        // dd($SoldItem->invoice);
        dd($invoice->soldItems);

        return view('invoiceDetails', compact('invoice', 'products', 'sold_items')); 
    }

    

}
