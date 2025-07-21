<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Order; // Import the Order model

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order; // Declare a public property to store the order details

    /**
     * Create a new message instance.
     *
     * @param Order $order
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your Order Status')
                    ->view('emails.order-status'); // Use a Blade template for the email
    }
}
