        <!-- Main content -->
    



<x-layout.admin 
   
/>


    <div class="flex-1 flex flex-col overflow-hidden">
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 px-4 py-4 md:px-8 md:py-8">
                <div class="flex flex-col gap-1">
                    <h1 class="font-semibold md:text-lg text-gray-800">Dashboard</h1>
                    <div class="flex items-center gap-1">
                        <p class="text-xs text-gray-400 md:text-sm">Admin</p>
                        <p class="text-xs text-gray-400 md:text-sm">/</p>
                        <p class="text-xs text-gray-400 md:text-sm">Dashboard</p>

                    </div>
                </div>
  

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mt-6">

  {{-- Total Penulis --}}
    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
        <p class="text-sm text-gray-500">Authors</p>
        <h2 class="text-3xl font-semibold text-gray-800">{{ $totalAuthors }}</h2>
    </div>

    {{-- Total Buku --}}
    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
        <p class="text-sm text-gray-500">Books</p>
        <h2 class="text-3xl font-semibold text-gray-800">{{ $totalBooks }}</h2>
    </div>

  

    {{-- Total Pengguna --}}
    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
        <p class="text-sm text-gray-500">Users</p>
        <h2 class="text-3xl font-semibold text-gray-800">{{ $totalUsers }}</h2>
    </div>
    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
        <p class="text-sm text-gray-500">Publishers</p>
        <h2 class="text-3xl font-semibold text-gray-800">{{ $totalPublisher }}</h2>
    </div>
    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
        <p class="text-sm text-gray-500">Categories</p>
        <h2 class="text-3xl font-semibold text-gray-800">{{ $totalCategory }}</h2>
    </div>
    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
        <p class="text-sm text-gray-500">Shelfs</p>
        <h2 class="text-3xl font-semibold text-gray-800">{{ $totalShelf }}</h2>
    </div>

    {{-- Total Peminjaman (aktifkan jika ingin) --}}
    
    <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
        <p class="text-sm text-gray-500">Borrowing</p>
        <h2 class="text-3xl font-semibold text-gray-800">{{ $totalBorrowings }}</h2>
    </div>
    
</div>



