<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Invoice;
use App\Sold_item;
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
        if(isset($req -> invoice_total))
        {
            // return  $req -> invoice_total;
            $invoice = Invoice::find($req -> invoice_id);
            $invoice -> invoice_number = $req -> invoice_id;
            $invoice -> total = $req -> invoice_total;
            $invoice -> payment_method = $req -> pay_method;
            $invoice -> customer_name = $req -> cus_name;
            $invoice -> customer_email = $req -> cus_mail;
            $invoice -> save();
            Session::flash('message', 'Successfully updated your order!'); 
            Session::flash('alert', TRUE);              
        }
        else
        {
            Session::flash('message', 'Updating Failed!'); 
            Session::flash('alert', FALSE);  
        }
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
        
        $flag = 0; //CHECK ANY ERROR; 0->ERROR, 1->OK
        $time = date("h:i:sa, d/m/Y");
        $invoices = new Invoice();
        $invoices -> date = $time;
        $invoices -> save();

        $invoice = Invoice::where('date', $time)->first();
        if($req -> products1 != "false")
        {
            $productPrice = Product::find($req -> products1);
            $sellProducts = new Sold_item();
            $sellProducts -> product_id = $req -> products1;
            $sellProducts -> quantity = $req -> qty1;
            $sellProducts -> invoice_id = $invoice -> id;
            $sellProducts -> selling_price = $productPrice -> selling_price;
            $sellProducts -> save();
            $flag = 1;
        }
        
        if($req -> products2 != "false")
        {
            $productPrice = Product::find($req -> products2);
            $sellProducts = new Sold_item();
            $sellProducts -> product_id = $req -> products2;
            $sellProducts -> quantity = $req -> qty2;
            $sellProducts -> invoice_id = $invoice -> id;
            $sellProducts -> selling_price = $productPrice -> selling_price;
            $sellProducts -> save();
            $flag = 1;
        }
        
        if($req -> products3 != "false")
        {
            $productPrice = Product::find($req -> products3);
            $sellProducts = new Sold_item();
            $sellProducts -> product_id = $req -> products3;
            $sellProducts -> quantity = $req -> qty3;
            $sellProducts -> invoice_id = $invoice -> id;
            $sellProducts -> selling_price = $productPrice -> selling_price;
            $sellProducts -> save();
            $flag = 1;
        }
        
        if($req -> products4 != "false")
        {
            $productPrice = Product::find($req -> products4);
            $sellProducts = new Sold_item();
            $sellProducts -> product_id = $req -> products4;
            $sellProducts -> quantity = $req -> qty4;
            $sellProducts -> invoice_id = $invoice -> id;
            $sellProducts -> selling_price = $productPrice -> selling_price;
            $sellProducts -> save();
            $flag = 1;
        }
        
        if($req -> products5 != "false")
        {
            $productPrice = Product::find($req -> products5);
            $sellProducts = new Sold_item();
            $sellProducts -> product_id = $req -> products5;
            $sellProducts -> quantity = $req -> qty5;
            $sellProducts -> invoice_id = $invoice -> id;
            $sellProducts -> selling_price = $productPrice -> selling_price;
            $sellProducts -> save();
            $flag = 1;
        }
        
        if($req -> products6 != "false")
        {
            $productPrice = Product::find($req -> products6);
            $sellProducts = new Sold_item();
            $sellProducts -> product_id = $req -> products6;
            $sellProducts -> quantity = $req -> qty6;
            $sellProducts -> invoice_id = $invoice -> id;
            $sellProducts -> selling_price = $productPrice -> selling_price;
            $sellProducts -> save();
            $flag = 1;
        }

        if($flag == 1)
        {
            Session::flash('message', 'Successfully placed your order!'); 
            Session::flash('alert', TRUE); 
        }
        else
        {
            Session::flash('message', 'Something Wrong!'); 
            Session::flash('alert', FALSE); 
        }
        $invoice_success = Invoice::find($invoice -> id);
        $product_success = Product::all();
        $sold_item_success = Sold_item::where('invoice_id', $invoice -> id)->get();
        // return redirect('/invoiceView/{{$invoice -> id}')
        return view('invoiceView')
        ->with('invoice_success',$invoice_success)
        ->with('product_success',$product_success)
        ->with('sold_item_success',$sold_item_success);
    }

    public function invoiceView(Request $req)
    {   
        $invoice_success = Invoice::find($req -> id);
        $product_success = Product::all();
        $sold_item_success = Sold_item::where('invoice_id', $req -> id)->get();
        $products = Product::all();
        // return redirect('/invoiceView/{{$invoice -> id}')
        return redirect()->route('invoiceView', ['id' => $req -> id])
        ->with('invoice_success',$invoice_success)
        ->with('product_success',$product_success)
        ->with('sold_item_success',$sold_item_success); 
    }

    public function invoiceViewId($id)
    {   
        $invoice_success = Invoice::find($id);
        $product_success = Product::all();
        $sold_item_success = Sold_item::where('invoice_id', $id)->get();
        $products = Product::all();
        // return redirect('/invoiceView/{{$invoice -> id}')
        return view('invoiceView')
        ->with('invoice_success',$invoice_success)
        ->with('product_success',$product_success)
        ->with('sold_item_success',$sold_item_success); 
    }

}
