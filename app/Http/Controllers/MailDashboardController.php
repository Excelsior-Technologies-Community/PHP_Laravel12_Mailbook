<?php

namespace App\Http\Controllers;

class MailDashboardController extends Controller
{
    public function index()
    {
        $mails = [

            [
                'title' => 'Welcome Mail',
                'type' => 'Welcome',
                'preview' => '/mailbook?selected=App%5CMail%5CWelcomeMail&locale=en',
                'description' => 'Professional welcome email template preview with responsive design.',
                'blade' => 'resources/views/emails/welcome.blade.php',
            ],

            [
                'title' => 'Invoice Mail',
                'type' => 'Invoice',
                'preview' => '/mailbook?selected=App%5CMail%5CInvoiceMail&locale=en',
                'description' => 'Modern invoice email template with order details and clean UI.',
                'blade' => 'resources/views/emails/invoice.blade.php',
            ],

        ];

        return view('mail-dashboard', compact('mails'));
    }
}