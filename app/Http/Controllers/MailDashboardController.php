<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use App\Mail\InvoiceMail;
use App\Jobs\SendScheduledEmail;
use App\Models\MailLog;

class MailDashboardController extends Controller
{
    public function index()
    {
        $mails = [
            ['title' => 'Welcome to Our Platform', 'type' => 'welcome', 'preview' => '/mailbook?selected=' . urlencode('App\\Mail\\WelcomeMail'), 'description' => 'A warm welcome email for new users.', 'status' => 'Active'],
            ['title' => 'Order Invoice', 'type' => 'invoice', 'preview' => '/mailbook?selected=' . urlencode('App\\Mail\\InvoiceMail'), 'description' => 'Detailed invoice with PDF attachment.', 'status' => 'Active'],
        ];
        return view('mail-dashboard', compact('mails'));
    }

    public function sendTest(Request $request)
    {
        $type = $request->query('type');
        $to = $request->input('email', config('mail.from.address'));

        try {
            if ($type === 'welcome') {
                $user = (object) ['name' => 'Test User', 'email' => $to];
                Mail::to($to)->send(new WelcomeMail($user));
            } elseif ($type === 'invoice') {
                $order = (object) ['id' => rand(1000, 9999), 'total' => 799.00];
                Mail::to($to)->send(new InvoiceMail($order));
            }

            MailLog::create(['mail_type' => $type, 'recipient_email' => $to]);

            return back()->with('success', "Test email sent successfully to {$to}");
        } catch (\Exception $e) {
            return back()->with('error', 'Failed: ' . $e->getMessage());
        }
    }

    public function scheduleEmail(Request $request)
    {
        $request->validate(['email' => 'required|email', 'type' => 'required', 'minutes' => 'required|numeric']);
        
        $order = (object) ['id' => 12345, 'total' => 799.00];
        $minutes = (int) $request->input('minutes', 1);
        $delay = now()->addMinutes($minutes);

       
        MailLog::create(['mail_type' => $request->type, 'recipient_email' => $request->email]);

        SendScheduledEmail::dispatch($order, $request->email)->delay($delay);

        return back()->with('success', 'Email scheduled successfully!');
    }

    public function track($id)
    {
      
        $log = MailLog::find($id);
        if ($log) {
            $log->update(['opened_at' => now()]);
        }
        return response()->file(public_path('pixel.png'));
    }

    public function getAnalytics()
    {
        $total = MailLog::count();
        $opened = MailLog::whereNotNull('opened_at')->count();
        return response()->json(['total' => $total, 'opened' => $opened]);
    }
}