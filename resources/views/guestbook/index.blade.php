<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Tamu (No Controller)</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 p-8 font-sans">

    <div class="max-w-3xl mx-auto">
        
        <div class="text-center mb-8">
            <h1 class="text-4xl font-extrabold text-slate-800">📖 Buku Tamu Digital</h1>
            <p class="text-slate-500">Contoh CRUD Laravel Tanpa Controller & Model</p>
        </div>

        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded-lg mb-6 shadow-lg text-center font-bold">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white p-6 rounded-xl shadow-md mb-8">
            <h3 class="text-xl font-bold mb-4 text-slate-700">Tulis Pesan Anda</h3>
            <form action="{{ route('guestbook.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 gap-4">
                    <input type="text" name="visitor_name" placeholder="Nama Kamu" class="border p-3 rounded-lg w-full focus:ring-2 focus:ring-blue-500 outline-none" required>
                    <textarea name="message" rows="3" placeholder="Pesan & Kesan..." class="border p-3 rounded-lg w-full focus:ring-2 focus:ring-blue-500 outline-none" required></textarea>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg transition">Kirim Pesan</button>
                </div>
            </form>
        </div>

        <div class="space-y-4">
            @foreach($messages as $msg)
            <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-blue-500 flex justify-between items-start">
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <h4 class="font-bold text-lg text-slate-800">{{ $msg->visitor_name }}</h4>
                        <span class="text-xs text-gray-400 bg-gray-100 px-2 py-1 rounded">
                            {{ \Carbon\Carbon::parse($msg->created_at)->diffForHumans() }}
                        </span>
                    </div>
                    <p class="text-slate-600">{{ $msg->message }}</p>
                </div>

                <div class="flex flex-col gap-2 ml-4">
                    <a href="{{ route('guestbook.edit', $msg->id) }}" class="text-yellow-500 hover:text-yellow-700 font-bold text-sm text-right">Edit</a>
                    
                    <form action="{{ route('guestbook.destroy', $msg->id) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700 font-bold text-sm">Hapus</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</body>
</html>