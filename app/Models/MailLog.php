<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MailLog extends Model
{
    protected $fillable = [
        'mail_type',
        'recipient_email',
        'opened_at'
    ];
}