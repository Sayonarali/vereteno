<?php

namespace App\Mail;

use App\Models\CustomOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomOrderMail extends Mailable {
    use Queueable, SerializesModels;
    public function __construct(public readonly CustomOrder $order) {
    }

    public function build() {
        return $this
            ->subject('Пошив на заказ')
            ->view('emails.custom_order');
    }
}
