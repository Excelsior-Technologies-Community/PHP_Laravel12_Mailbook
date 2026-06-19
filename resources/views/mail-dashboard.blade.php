<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel Mail Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 p-6">
    <div class="max-w-6xl mx-auto">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-blue-600">Mail Dashboard</h1>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-6 border border-green-200">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 text-red-800 p-4 rounded-lg mb-6 border border-red-200">{{ session('error') }}</div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-white p-6 rounded-xl shadow border">
                <h3 class="text-gray-500 text-sm">Templates</h3>
                <div class="text-3xl font-bold" id="total-templates">0</div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow border">
                <h3 class="text-gray-500 text-sm">Open Rate</h3>
                <div class="text-3xl font-bold" id="open-rate">0%</div>
            </div>
        </div>

        <div id="mail-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($mails as $mail)
            <div class="bg-white p-6 rounded-xl shadow border flex flex-col gap-4">
                <span class="px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-800 w-max">{{ $mail['type'] }}</span>
                <h3 class="text-lg font-bold">{{ $mail['title'] }}</h3>
                <p class="text-gray-600 text-sm flex-grow">{{ $mail['description'] }}</p>
                
                <div class="border-t pt-4">
                    <form action="{{ route('mail.schedule') }}" method="POST" class="flex flex-col gap-2">
                        @csrf
                        <input type="hidden" name="type" value="{{ $mail['type'] }}">
                        <div class="flex gap-2">
                            <input type="email" name="email" required placeholder="Email" class="w-full border p-2 rounded text-sm">
                            <input type="number" name="minutes" placeholder="Min" class="w-16 border p-2 rounded text-sm">
                        </div>
                        <div class="flex gap-2">
                            <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded text-xs font-bold w-full">Schedule</button>
                            <a href="{{ route('mail.test', ['type' => $mail['type']]) }}" class="bg-green-600 text-white px-3 py-1 rounded text-xs font-bold">Test</a>
                        </div>
                    </form>
                    <a href="{{ $mail['preview'] }}" target="_blank" class="block text-center mt-2 bg-gray-200 px-3 py-1 rounded text-xs font-bold">Preview</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <script>
        const mailsData = @json($mails);
        
        async function fetchAnalytics() {
            try {
                const res = await fetch('{{ route("mail.analytics") }}');
                const data = await res.json();
                document.getElementById('open-rate').textContent = data.total > 0 ? Math.round((data.opened/data.total)*100) + '%' : '0%';
            } catch(e) { console.error(e); }
        }

        document.getElementById('total-templates').textContent = mailsData.length;
        fetchAnalytics();
    </script>
</body>
</html>