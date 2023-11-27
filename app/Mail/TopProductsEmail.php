<?php

namespace App\Mail;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TopProductsEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @param  Brand  $brand
     * @param  Product[]  $products
     * @return void
     */
    public function __construct(private $brand, private $products)
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.top-products', [
            'brand' => $this->brand,
            'products' => $this->products,
        ]);
    }
}
