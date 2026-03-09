<?php

use Xammie\Mailbook\Facades\Mailbook; // Correct import

use App\Mail\WelcomeMail;
use App\Mail\InvoiceMail;

// Add WelcomeMail preview
Mailbook::add(function () {
    $user = (object) ['name' => 'Demo User'];
    return new WelcomeMail($user);
});

// Add InvoiceMail preview
Mailbook::add(function () {
    $order = (object) ['id' => 1234, 'total' => 799];
    return new InvoiceMail($order);
});