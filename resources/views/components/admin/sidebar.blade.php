<div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <nav class="bg-white border-r border-r-gray-200 text-gray-700 w-64 space-y-1 py-6 px-2 absolute inset-y-0 left-0 transform -translate-x-full lg:relative lg:translate-x-0 transition duration-200 ease-in-out md:px-4"
            id="sidebar">
            <a href="/admin"
                class="text-sm flex items-center gap-3 px-4 py-3 rounded transition-all duration-300 hover:bg-gray-200 hover:text-black">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>

             <a href="/admin/author"
                class="text-sm flex items-center gap-3 px-4 py-3 rounded transition-all duration-300 hover:bg-gray-200 hover:text-black">
                <i class="fas fa-user"></i>
                <span>Author</span>
            </a>
             <a href="/admin/publisher"
                class="text-sm flex items-center gap-3 px-4 py-3 rounded transition-all duration-300 hover:bg-gray-200 hover:text-black">
                <i class="fas fa-globe"></i>
                <span>Publisher</span>
            </a>
             <a href="/admin/category"
                class="text-sm flex items-center gap-3 px-4 py-3 rounded transition-all duration-300 hover:bg-gray-200 hover:text-black">
                <i class="fas fa-tags"></i>
                <span>Category</span>
            </a>
             <a href="/admin/shelf"
                class="text-sm flex items-center gap-3 px-4 py-3 rounded transition-all duration-300 hover:bg-gray-200 hover:text-black">
                <i class="fas fa-layer-group"></i>
                <span>Shelf</span>
            </a>
             <a href="/admin/book"
                class="text-sm flex items-center gap-3 px-4 py-3 rounded transition-all duration-300 hover:bg-gray-200 hover:text-black">
                <i class="fas fa-book"></i>
                <span>Book</span>
            </a>
             <a href="/admin/borrowing"
                class="text-sm flex items-center gap-3 px-4 py-3 rounded transition-all duration-300 hover:bg-gray-200 hover:text-black">
                <i class="fas fa-clock"></i>
                <span>Borrowing</span>
            </a>
            <a href="{{ route('profile.edit', Auth::user()->id) }}"
                class="text-sm flex items-center gap-3 px-4 py-3 rounded transition-all duration-300 hover:bg-gray-200 hover:text-black">
                <i class="fas fa-gear"></i>
                <span>Settings</span>
            </a>
           
        </nav>

        <!-- Main content -->

