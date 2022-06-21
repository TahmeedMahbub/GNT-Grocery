<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Invoice;
use App\SoldItem;
use Session;
use Carbon\Carbon;
use DataTables;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceMail;
use PDF;
use DB;

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
                'selling_price'=>'required|integer',
                'file' => 'mimes:jpg,jpeg,png,bmp|max:3072',
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

                'file.mimes' => 'Only Pictures are allowed',
                'file.max' => 'The Picture should not be more than 3MB',                

            ]
        );

        // $ext = pathinfo($request->file, PATHINFO_EXTENSION);
        // $fileName = $request->sku.'.'.$ext; 

        

        if($request->selling_price < $request->purchase_price)
        {
            $data["p_name"] = $request->name;
            $data["p_sku"] = $request->sku;
            $data["s_price"] = $request->selling_price;
            $data["p_price"] = $request->purchase_price;
            $data["stock"] = $request->stock;
            $product_stock = false;
            
            return view('warning', compact('data', 'product_stock'));
            
        }

        
        $addProducts = new Product(); 
        $addProducts-> name = $request->name;
        $addProducts-> sku = $request->sku;
        $addProducts-> stock = $request->stock;
        $addProducts-> purchase_price = $request->purchase_price;
        $addProducts-> selling_price = $request->selling_price;
        $addProducts-> description = $request->description;

        if($request->file)
        {
            $fileName = $request->sku.'.'.$request->file->extension();    
            $request->file->move(public_path('product images'), $fileName);
            $addProducts->image = $fileName;
        }       

        
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
        $invoice -> date = date("Y-m-d");
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





        $details = [
            'title' => 'Thank You '.$request -> cus_name.', See You Again!',
        ];
       
        if($request->cus_mail)
        {

            $invoice = Invoice::find($invoice->id);
            $products = Product::all();
            $sold_items = SoldItem::where('invoice_id', $invoice->id)->get();


            $data["email"] = $request->cus_mail;
            $data["title"] = 'New1 Thanks for Purchasing from GNT Grocery';
            $data["invoice"] = $invoice;
            $data["products"] = $products;
            $data["sold_items"] = $sold_items;



            $invoiceData = Invoice::find($invoice->id);
            $productsData = Product::all();
            $sold_itemsData = SoldItem::where('invoice_id', $invoice->id)->get();


            $data["invoiceData"] = $invoiceData;
            $data["invoice_no"] = $invoice->id;
            $data["productsData"] = $productsData;
            $data["sold_itemsData"] = $sold_itemsData;
            

            $pdf = PDF::loadView('invoicePDF', $data);
            $data['pdf'] = $pdf;

            Mail::send('MailBodySellConfirm', $data, function($message)use($data) {       
                $message->to($data["email"])
                ->subject($data["title"])
                ->attachData($data['pdf']->output(), 
                'GNT'.$data["invoice_no"].'.pdf', 
                ['mime'=>'application/pdf']);
      
            });

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
                    return view('warning', compact('product_stock'));
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

        $profits = Invoice::select(
            DB::raw('invoices.id, SUM((products.selling_price - products.purchase_price)* sold_items.quantity) as benefit'))
        ->join('sold_items', 'invoices.id', '=', 'sold_items.invoice_id')
        ->join('products', 'products.id', '=', 'sold_items.product_id')
        ->groupBy('invoices.id')
        ->get();
        // dd($profits);
        return view('invoices', compact('invoices', 'profits')); 
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
                            $html = 'Not Given!';
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

        $join_table = Invoice::select('products.name', 'products.selling_price', 'sold_items.quantity', 'invoices.total', 'invoices.created_at', 'invoices.customer_name' )
        ->join('sold_items', 'invoices.id', '=', 'sold_items.invoice_id')
        ->join('products', 'products.id', '=', 'sold_items.product_id')
        ->where('invoices.id', $id)
        ->get();
        return view('invoiceDetails', compact('join_table', 'id'));

    }

    public function downloadInvoice($id)   //DOWNLOAD PDF
    {
        $invoiceData = Invoice::find($id);
        $productsData = Product::all();
        $sold_itemsData = SoldItem::where('invoice_id', $id)->get();


        $data["invoiceData"] = $invoiceData;
        $data["productsData"] = $productsData;
        $data["sold_itemsData"] = $sold_itemsData;
        

        $pdf = PDF::loadView('invoicePDF', $data);
        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('GNT'. $id .'.pdf');
 
    
    
    }

    public function viewInvoice($id)  
    {
        $invoiceData = Invoice::find($id);
        $productsData = Product::all();
        $sold_itemsData = SoldItem::where('invoice_id', $id)->get();


        $data["invoiceData"] = $invoiceData;
        $data["productsData"] = $productsData;
        $data["sold_itemsData"] = $sold_itemsData;
        

        $pdf = PDF::loadView('invoicePDF', $data);
        $pdf->setPaper('A4', 'portrait');
        

        return $pdf->stream('GNT'. $id .'.pdf');
 
    
    
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


    public function stat()
    {   
        // $products = Product::all();
        // return view('allProduct', compact('products'));
        // $invoices = Invoice::all();
        // $products = Product::all();
        // $sold_items = SoldItem::all(); 
        
        $everyday = Invoice::join('sold_items', 'invoices.id', '=', 'sold_items.invoice_id')
        ->join('products', 'products.id', '=', 'sold_items.product_id')
        ->select(
            
            'invoices.date',
            // DB::raw('COUNT(invoices.id) as total_invoices'),
            DB::raw("CONCAT(DAY(invoices.date), '-', LEFT(monthname(invoices.date), 3)) as today"),
            DB::raw('SUM(products.selling_price * sold_items.quantity) as revenue'),
            DB::raw('(SUM(products.selling_price * sold_items.quantity) - SUM(products.purchase_price * sold_items.quantity)) as profit'),
            DB::raw('SUM(sold_items.quantity) as total_product')
            // DB::raw('round(100*(1-(SUM(products.purchase_price)/SUM(products.selling_price))), 2) as percent'),

        )        
        ->orderBy('invoices.date')
        ->groupBy('invoices.date')
        ->get();

        $total_invoices = Invoice::select(
                DB::raw('COUNT(id) as total'), 
                'date'
            )
            ->groupBy('invoices.date')
            ->get();
            // dd($total_invoices);


        $chart_val[] = ['Day','Revenue','Profit'];
        foreach ($everyday as $key => $value) {
            $chart_val[++$key] = [$value->today, (int)$value->revenue, (int)$value->profit];
        }
        $chart_val = json_encode($chart_val);
        return view('stat', compact('everyday', 'total_invoices', 'chart_val')); 
    }
}

