<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Store;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $store;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Store $store)
    {
        $this->store = $store;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@bankalqita.com')
        ->markdown('emails.index')->with('store', $this->store);
    }
}
