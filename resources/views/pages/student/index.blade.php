@extends('layouts.user')

@section('title', 'Library App - Books')

@section('content')
{{-- ALERTS --}}
@if (session('success'))
  <div class="max-w-7xl mx-auto px-6 mt-6">
    <div class="bg-green-50 border-l-4 border-green-500 text-green-800 px-5 py-4 rounded-lg shadow-sm transition-all duration-300">
      {{ session('success') }}
    </div>
  </div>
@endif

@if (session('error'))
  <div class="max-w-7xl mx-auto px-6 mt-6">
    <div class="bg-red-50 border-l-4 border-red-500 text-red-800 px-5 py-4 rounded-lg shadow-sm transition-all duration-300">
      {{ session('error') }}
    </div>
  </div>
@endif

{{-- Buku Cards --}}
<section class="py-16 px-6 bg-gray-100">
  <h2 class="text-center text-2xl font-semibold mb-10">Featured Books</h2>
  <div class="max-w-6xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-8">
    @forelse ($books as $book)
      <div class="bg-gray-100 rounded-lg shadow-md p-4 flex items-start">
        <!-- Gambar Buku -->
        <div class="w-1/3">
          @if ($book->book_img)
            <img src="{{ asset('storage/' . $book->book_img) }}"
                 alt="{{ $book->book_name }}"
                 class="w-32 h-40 object-cover rounded" />
          @else
            <img src="{{ asset('images/no-image.png') }}"
                 alt="No Image"
                 class="w-32 h-40 object-cover rounded bg-gray-50" />
          @endif
        </div>
        <!-- Detail Data -->
        <div class="w-2/3 pl-4">
          <h3 class="text-lg font-medium text-gray-800 line-clamp-2">{{ $book->book_name }}</h3>
          <p class="text-sm text-gray-600 mt-1">Author: {{ $book->author->author_name ?? '-' }}</p>
          <p class="text-sm text-gray-500">Publisher: {{ $book->publisher->publisher_name ?? '-' }}</p>
          <p class="text-sm text-gray-500">Category: {{ $book->category->category_name ?? '-' }}</p>
          <p class="text-sm text-gray-500">Shelf: {{ $book->shelf->shelf_name ?? '-' }}</p>
          <div class="mt-2">
            <span class="text-xs bg-gray-200 text-gray-700 px-2 py-1 rounded">
              Stock: {{ $book->book_stock }}
            </span>
            <span class="text-xs font-mono text-gray-500 ml-2">
              ISBN: {{ $book->book_isbn }}
            </span>
          </div>
          @if ($loggedIn)
            <form method="POST" action="{{ route('borrow.book', $book->book_id) }}"
                  onsubmit="return confirm('Are you sure you want to borrow this book?')">
              @csrf
              <button type="submit"
                class="mt-4 w-full bg-blue-600 text-white px-4 py-2 rounded text-sm hover:bg-blue-700 transition flex items-center justify-center gap-2">
                <span>📖</span> Borrow
              </button>
            </form>
          @endif
        </div>
      </div>
    @empty
      <p class="col-span-full text-center text-gray-500 text-lg py-10">No books found.</p>
    @endforelse
  </div>
</section>

{{-- Toggle Script --}}
<script>
  const profileBtn = document.getElementById('profileBtn');
  const profileMenu = document.getElementById('profileMenu');
  const navButton = document.getElementById('navButton');
  const navMenu = document.getElementById('navMenu');

  document.addEventListener('click', function (e) {
    if (profileBtn?.contains(e.target)) {
      profileMenu.classList.toggle('hidden');
    } else if (!profileMenu?.contains(e.target)) {
      profileMenu?.classList.add('hidden');
    }
  });

  navButton?.addEventListener('click', () => {
    navMenu.classList.toggle('hidden');
  });
</script>
@endsection