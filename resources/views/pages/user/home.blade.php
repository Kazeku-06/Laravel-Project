@extends('layouts.user')

@section('title', 'Library App - Home')

@section('content')
<!-- Hero -->
<section class="relative bg-cover bg-center h-[80vh] flex items-center justify-center" style="background-image: url('pp.jpg');">
  <div class="absolute inset-0 bg-black opacity-60"></div>
  <div class="relative z-10 text-center text-white max-w-xl px-4">
    <h1 class="text-3xl md:text-4xl font-semibold mb-4">Welcome to Library App</h1>
    <p class="text-base mb-6">Choose from a wide range of popular books from all the categories you want here.</p>
    <a href="#" class="px-6 py-2 bg-white text-gray-800 rounded hover:bg-gray-200 transition">Check Our Books</a>
  </div>
</section>

<!-- Welcome Section -->
<section class="bg-gray-50 py-10 px-4">
  <div class="max-w-xl mx-auto flex flex-col items-center text-center gap-4">
    <img src="https://cdn-icons-png.freepik.com/512/15772/15772135.png" alt="Book Image" class="w-24" />
    <h2 class="text-xl font-semibold ">WELCOME TO LIBRARY APP</h2>
    <p class="text-sm text-gray-700">Choose the best books you want to read in here.</p>
    <button class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-700 transition">
      Check Our Books
    </button>
  </div>
</section>


<!-- Featured Books -->
<section class="py-16 px-6 bg-white">
  <h2 class="text-center text-2xl font-semibold mb-10">Buku Populer</h2>
  <div class="max-w-6xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
    <!-- Book Cards -->
    <div class="bg-gray-100 rounded-lg shadow-md p-4 text-center">
      <img src="deetectivconan.jpg" alt="Madilog" class="w-32 h-44 object-cover mx-auto rounded" />
      <h3 class="mt-4 font-medium text-gray-700">Detective Conan</h3>
      <h5 class="mt-4 font-small text-gray-700">By : Tegar</h5>
    </div>
    <div class="bg-gray-100 rounded-lg shadow-md p-4 text-center">
      <img src="dragonball.jpg" alt="Book 2" class="w-32 h-44 object-cover mx-auto rounded" />
      <h3 class="mt-4 font-medium text-gray-700">Dragon Ball</h3>
      <h5 class="mt-4 font-small text-gray-700">by : Atta</h5>
    </div>
    <div class="bg-gray-100 rounded-lg shadow-md p-4 text-center">
      <img src="novel.jpg" alt="Book 3" class="w-32 h-44 object-cover mx-auto rounded" />
      <h3 class="mt-4 font-medium text-gray-700">Novel</h3>
      <h5 class="mt-4 font-small text-gray-700">by : Gopeks</h5>
    </div>
    <div class="bg-gray-100 rounded-lg shadow-md p-4 text-center">
      <img src="tokyoravengers.jpeg" alt="Book 4" class="w-32 h-44 object-cover mx-auto rounded" />
      <h3 class="mt-4 font-medium text-gray-700">Tokyo Ravengers</h3>
      <h5 class="mt-6 font-small text-gray-700">by : Nopall</h5>
    </div>
  </div>
</section>

<!-- Book Categories -->
@endsection
