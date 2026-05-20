<?php

use Xammie\Mailbook\Facades\Mailbook;
use App\Mail\WelcomeMail;
use App\Mail\InvoiceMail;

/*
|--------------------------------------------------------------------------
| Mailbook Configuration
|--------------------------------------------------------------------------
*/

// Simple Welcome Mail
Mailbook::add(function () {
    $user = (object) ['name' => 'Demo User'];
    return new WelcomeMail($user);
});

// Welcome Mail with different user
Mailbook::add(function () {
    $user = (object) ['name' => 'John Smith'];
    return new WelcomeMail($user);
});

// Simple Invoice Mail
Mailbook::add(function () {
    $order = (object) ['id' => 1234, 'total' => 799];
    return new InvoiceMail($order);
});

// Invoice Mail with different order
Mailbook::add(function () {
    $order = (object) ['id' => 5678, 'total' => 1299.99];
    return new InvoiceMail($order);
});