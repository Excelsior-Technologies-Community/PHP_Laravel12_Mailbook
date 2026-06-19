<?php

namespace App\Jobs;

use App\Mail\InvoiceMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendScheduledEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $order;
    public $email;

    public function __construct($order, $email)
    {
        $this->order = $order;
        $this->email = $email;
    }

    public function handle(): void
    {
        Mail::to($this->email)->send(new InvoiceMail($this->order));
    }
}