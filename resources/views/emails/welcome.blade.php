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