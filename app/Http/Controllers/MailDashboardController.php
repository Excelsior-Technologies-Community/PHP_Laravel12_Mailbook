<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use App\Mail\InvoiceMail;

class MailDashboardController extends Controller
{
    public function index()
    {
        $mails = [
            [
                'title' => 'Welcome to Our Platform',
                'type' => 'Welcome',
                'preview' => '/mailbook?selected=' . urlencode('App\\Mail\\WelcomeMail'),
                'description' => 'A warm welcome email for new users with getting started guide and helpful resources.',
                'blade_path' => 'resources/views/emails/welcome.blade.php',
                'status' => 'Active',
                'updated_at' => '2 days ago',
                'test_url' => route('mail.test', ['type' => 'welcome']),
            ],
            [
                'title' => 'Order Invoice',
                'type' => 'Invoice',
                'preview' => '/mailbook?selected=' . urlencode('App\\Mail\\InvoiceMail'),
                'description' => 'Detailed invoice email with order summary, pricing breakdown, and payment link.',
                'blade_path' => 'resources/views/emails/invoice.blade.php',
                'status' => 'Active',
                'updated_at' => '5 days ago',
                'test_url' => route('mail.test', ['type' => 'invoice']),
            ],
        ];

        return view('mail-dashboard', compact('mails'));
    }

    public function sendTest(Request $request)
    {
        $type = $request->query('type');
        $to = $request->input('email', config('mail.from.address'));

        try {
            switch ($type) {
                case 'welcome':
                    $user = (object) ['name' => 'Test User', 'email' => $to];
                    Mail::to($to)->send(new WelcomeMail($user));
                    break;
                case 'invoice':
                    $order = (object) ['id' => 12345, 'total' => 799.00];
                    Mail::to($to)->send(new InvoiceMail($order));
                    break;
                default:
                    if ($request->wantsJson()) {
                        return response()->json(['error' => 'Unknown mail type'], 400);
                    }
                    return back()->with('error', 'Unknown mail type');
            }

            if ($request->wantsJson()) {
                return response()->json(['message' => "Test {$type} email sent to {$to}"]);
            }

            return back()->with('success', "Test email sent to {$to}");
        } catch (\Exception $e) {
            if ($request->wantsJson()) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
            return back()->with('error', 'Failed to send: ' . $e->getMessage());
        }
    }
}