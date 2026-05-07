<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Mail Dashboard</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            background:#0f172a;
            color:white;
            font-family:Arial, Helvetica, sans-serif;
        }

        .container{
            max-width:1200px;
            margin:auto;
            padding:40px 20px;
        }

        .header{
            text-align:center;
            margin-bottom:50px;
        }

        .header h1{
            font-size:42px;
            margin-bottom:10px;
        }

        .header p{
            color:#cbd5e1;
            font-size:18px;
        }

        .stats{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
            gap:20px;
            margin-bottom:40px;
        }

        .stat-card{
            background:#1e293b;
            padding:30px;
            border-radius:18px;
            border:1px solid #334155;
            transition:0.3s;
        }

        .stat-card:hover{
            transform:translateY(-5px);
        }

        .stat-card h2{
            color:#cbd5e1;
            margin-bottom:15px;
            font-size:18px;
        }

        .stat-card h1{
            font-size:42px;
        }

        .search-box{
            margin-bottom:40px;
        }

        .search-box input{
            width:100%;
            padding:16px;
            border:none;
            border-radius:12px;
            background:#1e293b;
            color:white;
            font-size:16px;
            border:1px solid #334155;
            outline:none;
        }

        .mail-grid{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(320px,1fr));
            gap:25px;
        }

        .mail-card{
            background:#1e293b;
            border-radius:18px;
            padding:25px;
            border:1px solid #334155;
            transition:0.3s;
        }

        .mail-card:hover{
            transform:translateY(-6px);
            box-shadow:0 12px 30px rgba(0,0,0,0.35);
        }

        .badge{
            display:inline-block;
            padding:6px 14px;
            border-radius:30px;
            font-size:12px;
            margin-bottom:15px;
            font-weight:bold;
            background:#4f46e5;
        }

        .mail-card h2{
            margin-bottom:15px;
            font-size:24px;
        }

        .mail-card p{
            color:#cbd5e1;
            line-height:1.7;
            margin-bottom:25px;
        }

        .button-group{
            display:flex;
            flex-wrap:wrap;
            gap:10px;
        }

        .btn{
            display:inline-block;
            background:#4f46e5;
            color:white;
            text-decoration:none;
            padding:12px 22px;
            border-radius:10px;
            transition:0.3s;
        }

        .btn:hover{
            background:#4338ca;
        }

        .copy-btn{
            background:#0ea5e9;
            color:white;
            border:none;
            padding:12px 22px;
            border-radius:10px;
            cursor:pointer;
            transition:0.3s;
            font-size:14px;
        }

        .copy-btn:hover{
            background:#0284c7;
        }

        .footer{
            text-align:center;
            margin-top:60px;
            color:#94a3b8;
            font-size:14px;
        }

        @media(max-width:768px){

            .header h1{
                font-size:30px;
            }

            .mail-grid{
                grid-template-columns:1fr;
            }

        }

    </style>

</head>

<body>

    <div class="container">

        <!-- Header -->

        <div class="header">

            <h1>📧 Laravel Mail Dashboard</h1>

            <p>
                Modern Email Preview & Testing Platform
            </p>

        </div>

        <!-- Statistics -->

        <div class="stats">

            <div class="stat-card">

                <h2>Total Templates</h2>

                <h1>{{ count($mails) }}</h1>

            </div>

            <div class="stat-card">

                <h2>Welcome Emails</h2>

                <h1>1</h1>

            </div>

            <div class="stat-card">

                <h2>Invoice Emails</h2>

                <h1>1</h1>

            </div>

        </div>

        <!-- Search -->

        <div class="search-box">

            <input
                type="text"
                id="search"
                placeholder="🔍 Search Email Templates..."
            >

        </div>

        <!-- Mail Cards -->

        <div class="mail-grid">

            @foreach($mails as $mail)

                <div class="mail-item">

                    <div class="mail-card">

                        <span class="badge">

                            {{ $mail['type'] }}

                        </span>

                        <h2>

                            {{ $mail['title'] }}

                        </h2>

                        <p>

                            {{ $mail['description'] }}

                        </p>

                        <!-- Buttons -->

                        <div class="button-group">

                            <a
                                href="{{ $mail['preview'] }}"
                                class="btn"
                            >

                                Preview Email →

                            </a>

                            <button
                                class="copy-btn"
                                onclick="copyBlade('{{ $mail['blade'] }}')"
                            >

                                Copy Blade Path

                            </button>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

        <!-- Footer -->

        <div class="footer">

            © {{ date('Y') }} Laravel Mail Dashboard • Built with Laravel 12

        </div>

    </div>

    <!-- Scripts -->

    <script>

        // Search Function

        const search = document.getElementById('search');

        search.addEventListener('keyup', function(){

            let value = this.value.toLowerCase();

            document.querySelectorAll('.mail-item').forEach(item => {

                let text = item.innerText.toLowerCase();

                if(text.includes(value)){

                    item.style.display = 'block';

                }else{

                    item.style.display = 'none';

                }

            });

        });

        // Copy Blade Path Function

        function copyBlade(path){

            navigator.clipboard.writeText(path);

            alert('Blade path copied: ' + path);

        }

    </script>

</body>

</html>