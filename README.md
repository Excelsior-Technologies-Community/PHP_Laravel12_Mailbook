# PHP_Laravel12_Mailbook


## Project Description

PHP_Laravel12_Mailbook is a Laravel 12 web application that allows developers to preview and test email templates (mailables) in the browser without sending them to real users.

It is ideal for frontend and backend developers to design, iterate, and debug email templates during development. The project uses the Mailbook package to generate a beautiful email preview dashboard.

With this project, you can create modern, responsive, and professional email templates for your Laravel application and preview them live before sending them to actual users.


## Features

- Preview Emails in Browser: View all your Laravel mailables at http://127.0.0.1:8000/mailbook.

- Modern Email Templates: Includes professional, responsive, and clean email layouts for Welcome and Invoice emails.

- Multiple Mailables: Easily register multiple mailables for preview.

- Variant Support: Preview emails with different example data.

- Responsive Design: Email templates are mobile-friendly.

- No Actual Sending Required: All previews are rendered locally without sending emails.

- Easy Setup: Simple installation with Laravel 12 and Mailbook.


## Technologies Used

1. Laravel 12 – PHP framework for web development.

2. PHP 8.x – Backend programming language.

3. Mailbook Package – Development tool to preview mailables.

4. Blade Templates – Laravel’s templating engine for email design.

5. HTML & CSS – Modern and responsive email layout design.

6. MySQL (optional) – For Laravel database setup if needed.


---



## Installation Steps


---


## STEP 1: Create Laravel 12 Project

### Open terminal / CMD and run:

```
composer create-project laravel/laravel PHP_Laravel12_Mailbook "12.*"

```

### Go inside project:

```
cd PHP_Laravel12_Mailbook

```

#### Explanation:

This command installs a fresh Laravel 12 application and creates the project folder.

The cd command moves into the newly created project directory.




## STEP 2: Database Setup (Optional)

### Update database details:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel12_Mailbook
DB_USERNAME=root
DB_PASSWORD=

```

### Create database in MySQL / phpMyAdmin:

```
Database name: laravel12_Mailbook

```

### Then Run:

```
php artisan migrate

```


#### Explanation:

Connects Laravel to MySQL and creates default tables for the project.




## STEP 3: Install Mailbook 

### Run:

```
composer require --dev xammie/mailbook

```

#### Explanation

Installs Mailbook, a development tool for previewing Laravel mailables in the browser.




## STEP 4: Publish Mailbook Files

### Run:

```
php artisan mailbook:install

```

#### Explanation:

Publishes Mailbook configuration and route files for email preview setup.




## STEP 5: Create Mailables

### app/Mail/WelcomeMail.php

```
<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject("Welcome to Our App")
                    ->view("emails.welcome");
    }
}

```

#### Explanation:

Defines a Welcome email that accepts a user object and renders the welcome Blade view.




### app/Mail/InvoiceMail.php

```
<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function build()
    {
        return $this->subject("Your Order Invoice")
                    ->view("emails.invoice");
    }
}

```

#### Explanation:

Defines an Invoice email that accepts order data and renders the invoice Blade view.





## STEP 6: Create Email Blade Views

### resources/views/emails/welcome.blade.php 

```
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Welcome Email</title>
    <style>
        body {
            font-family: 'Helvetica', Arial, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 30px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #4F46E5;
            /* Indigo 600 */
            color: #ffffff;
            padding: 20px;
            text-align: center;
            font-size: 24px;
        }

        .content {
            padding: 30px;
            color: #333333;
            line-height: 1.6;
        }

        .button {
            display: inline-block;
            background-color: #4F46E5;
            color: #ffffff;
            padding: 12px 25px;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 20px;
            font-weight: bold;
        }

        .footer {
            padding: 15px;
            font-size: 12px;
            color: #888888;
            text-align: center;
            background-color: #f0f0f0;
        }

        @media (max-width: 600px) {
            .container {
                margin: 15px;
            }

            .content {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            Welcome to Our App
        </div>
        <div class="content">
            <h2>Hello, {{ $user->name }}!</h2>
            <p>We’re thrilled to have you join our community. Explore our features and start your journey with us.</p>
            <a href="#" class="button">Get Started</a>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Our Company. All rights reserved.
        </div>
    </div>
</body>

</html>

```


### resources/views/emails/invoice.blade.php

```
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Invoice Email</title>
    <style>
        body {
            font-family: 'Helvetica', Arial, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 30px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #10B981;
            /* Emerald 500 */
            color: #ffffff;
            padding: 20px;
            text-align: center;
            font-size: 24px;
        }

        .content {
            padding: 30px;
            color: #333333;
            line-height: 1.6;
        }

        .invoice-box {
            border: 1px solid #e0e0e0;
            padding: 20px;
            border-radius: 5px;
            background-color: #fafafa;
            margin-top: 20px;
        }

        .button {
            display: inline-block;
            background-color: #10B981;
            color: #ffffff;
            padding: 12px 25px;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 20px;
            font-weight: bold;
        }

        .footer {
            padding: 15px;
            font-size: 12px;
            color: #888888;
            text-align: center;
            background-color: #f0f0f0;
        }

        @media (max-width: 600px) {
            .container {
                margin: 15px;
            }

            .content {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            Your Order Invoice
        </div>
        <div class="content">
            <h2>Invoice for Order #{{ $order->id }}</h2>
            <div class="invoice-box">
                <p><strong>Order ID:</strong> {{ $order->id }}</p>
                <p><strong>Amount:</strong> ₹{{ $order->total }}</p>
                <p>Thank you for your purchase! Your order will be processed shortly.</p>
            </div>
            <a href="#" class="button">View Order</a>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Our Company. All rights reserved.
        </div>
    </div>
</body>

</html>

```

#### Explanation:

Provides a clean, responsive design for the Welcome email with header, content, and CTA button.

Provides a professional layout for invoices with order details, styled box, and a CTA button.





## STEP 7: Register Mailbook Routes

### Open routes/mailbook.php and paste:

```
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

```

#### Explanation:

Registers the mailables with Mailbook so you can preview them in the browser.






## STEP 8:  Run Project

### Start server

```
php artisan serve

```

### Open in browser

```
http://127.0.0.1:8000/mailbook

```

#### Explanation:

Starts Laravel server and lets you preview all registered mailables via Mailbook.





## Expected Output:

### Welcome Mail:


<img width="1919" height="959" alt="Screenshot 2026-03-09 154757" src="https://github.com/user-attachments/assets/115ac398-dc4a-42be-b8fe-b8813f2a45f7" />


### Invoice Mail:


<img width="1919" height="960" alt="Screenshot 2026-03-09 154807" src="https://github.com/user-attachments/assets/570efc46-053d-4124-a10b-94c8c03ebe4a" />



---

# Project Folder Structure:

```
PHP_Laravel12_Mailbook/
├─ app/
│  └─ Mail/
│      ├── WelcomeMail.php       # Your Welcome email class
│      └── InvoiceMail.php       # Your Invoice email class
├─ config/
│  └─ mailbook.php               # Mailbook configuration
├─ resources/
│  └─ views/
│      └─ emails/
│          ├── welcome.blade.php # Modern Welcome email template
│          └── invoice.blade.php # Modern Invoice email template
├─ routes/
│  └─ mailbook.php               # Register Mailbook previews
├─ .env                          # Database / environment settings
└─ composer.json                 # Laravel project dependencies

```
