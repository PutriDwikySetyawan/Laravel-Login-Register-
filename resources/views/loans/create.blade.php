@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-6">Pinjam Buku</h1>

    <form action="{{ route('loans.store') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Book Selection -->
        <div>
            <label class="block mb-4 font-semibold">Pilih Buku:</label>
            @if($books->count())
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($books as $book)
                        <div class="bg-gray-50 rounded shadow hover:shadow-lg transition p-4 border-2 border-transparent hover:border-indigo-300">
                            <!-- Radio Button -->
                            <div class="flex items-center mb-3">
                                <input type="radio" name="book_id" value="{{ $book->id }}" id="book-{{ $book->id }}" required
                                       class="mr-2">
                                <label for="book-{{ $book->id }}" class="cursor-pointer font-medium">{{ $book->title }}</label>
                            </div>

                            <!-- Cover -->
                            @if($book->cover)
                                <img src="{{ asset('storage/' . $book->cover) }}"
                                     alt="{{ $book->title }}"
                                     class="w-full h-32 object-cover rounded mb-3">
                            @else
                                <div class="w-full h-32 bg-gray-200 flex items-center justify-center rounded mb-3">
                                    <span class="text-gray-500 text-sm">Tidak ada gambar</span>
                                </div>
                            @endif

                            <!-- Info Buku -->
                            <p class="text-sm text-gray-600 mb-1">Pengarang: {{ $book->author }}</p>
                            <p class="text-sm text-gray-600 mb-1">Kategori: {{ $book->category }}</p>
                            <p class="text-sm text-gray-600">Stok:
                                <span class="font-bold {{ $book->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $book->stock }}
                                </span>
                            </p>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-gray-500">Tidak ada buku tersedia untuk dipinjam.</p>
            @endif
        </div>

        <div>
            <label for="loan_date" class="block mb-2 font-semibold">Tanggal Pinjam:</label>
            <input type="date" name="loan_date" id="loan_date" value="{{ date('Y-m-d') }}"
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <div>
            <label for="return_date" class="block mb-2 font-semibold">Tanggal Pengembalian:</label>
            <input type="date" name="return_date" id="return_date" value="{{ date('Y-m-d', strtotime('+7 days')) }}" required
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        @if(Auth::user()->role === 'admin' || Auth::user()->role === 'guru')
            <div>
                <label for="user_id" class="block mb-2 font-semibold">Pilih User (Opsional):</label>
                <select name="user_id" id="user_id"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="">-- Untuk User Ini --</option>
                    @foreach(\App\Models\User::where('role', 'siswa')->get() as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
        @endif

        <button type="submit"
                class="w-full bg-indigo-600 text-white font-semibold px-4 py-2 rounded hover:bg-indigo-700 transition">
            Pinjam Buku
        </button>
    </form>
</div>

<script>
    // Optional: Highlight selected book card
    document.querySelectorAll('input[name="book_id"]').forEach(radio => {
        radio.addEventListener('change', function() {
            document.querySelectorAll('.bg-gray-50').forEach(card => {
                card.classList.remove('border-indigo-500', 'bg-indigo-50');
            });
            if (this.checked) {
                this.closest('.bg-gray-50').classList.add('border-indigo-500', 'bg-indigo-50');
            }
        });
    });
</script>
@endsection
