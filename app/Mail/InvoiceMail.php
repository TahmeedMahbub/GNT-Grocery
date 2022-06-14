<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


use App\Product;
use App\Invoice;
use App\SoldItem;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;
  
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }
  
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $invoice = Invoice::find($id);
        $products = Product::all();
        $sold_items = SoldItem::where('invoice_id', $id)->get();

        return view('invoiceDetails', compact('invoice', 'products', 'sold_items')); 
        
        // dd($details);
        return $this->subject('THANK YOU for Purchasing From GNT Grocery')
                    ->view('invoiceMail');
    }
}