   
   <div>
   
   <!-- CREATE BOOK FORM -->


        <div class="bg-white shadow-md rounded-lg p-6 mt-6">
            <h2 class="text-base font-semibold mb-4 text-gray-700">Create Book</h2>
           
            <form action="{{ route('book.store') }}" method="POST" enctype="multipart/form-data">

                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <input type="text" name="book_name" placeholder="Book Name" class="px-3 py-2 border rounded w-full" />
                    <input type="text" name="book_isbn" placeholder="ISBN" class="px-3 py-2 border rounded w-full" />
                   <input type="file" name="book_img" accept="image/*" class="px-3 py-2 border rounded w-full" />
                    <input type="text" name="book_description" placeholder="Description" class="px-3 py-2 border rounded w-full" />
                    <input type="number" name="book_stock" placeholder="Stock" class="px-3 py-2 border rounded w-full" />

                    <select name="book_author_id" class="px-3 py-2 border rounded w-full">
                        <option value="">-- Select Author --</option>
                        @foreach ($authors as $author)
                            <option value="{{ $author->author_id }}">{{ $author->author_name }}</option>
                        @endforeach
                    </select>

                    <select name="book_category_id" class="px-3 py-2 border rounded w-full">
                        <option value="">-- Select Category --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>

                    <select name="book_publisher_id" class="px-3 py-2 border rounded w-full">
                        <option value="">-- Select Publisher --</option>
                        @foreach ($publishers as $publisher)
                            <option value="{{ $publisher->publisher_id }}">{{ $publisher->publisher_name }}</option>
                        @endforeach
                    </select>

                    <select name="book_shelf_id" class="px-3 py-2 border rounded w-full">
                        <option value="">-- Select Shelf --</option>
                        @foreach ($shelves as $shelf)
                            <option value="{{ $shelf->shelf_id }}">{{ $shelf->shelf_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex justify-end mt-6">
                    <button type="submit" class="bg-gray-800 text-white font-semibold py-2 px-6 rounded hover:bg-gray-700 transition">
                        Create Book
                    </button>
                </div>
            </form>
        </div>

        <!-- BOOK TABLE -->
        <div class="bg-white shadow-md rounded-lg p-6 mt-10">
            <h2 class="text-base font-semibold mb-4 text-gray-700">📖 Book List</h2>
<input
    type="search"
    placeholder="Search book"
    wire:model.live.debounce.250ms="bookName"
    class="w-1/2 md:w-1/3 px-3 py-1 text-sm border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition"
/>
<br><br>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
                    <thead class="bg-gray-50">
                        <tr class="text-gray-700 font-semibold text-xs uppercase tracking-wider">
                            <th class="px-4 py-3">No</th>
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">ISBN</th>
                            <th class="px-4 py-3">Stock</th>
                            <th class="px-4 py-3">Description</th>
                            <th class="px-4 py-3">Author</th>
                            <th class="px-4 py-3">Category</th>
                            <th class="px-4 py-3">Publisher</th>
                            <th class="px-4 py-3">Shelf</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @foreach ($books as $book)
                        <tr class="hover:bg-gray-50 cursor-pointer" onclick="openModal('bookModal-{{ $book->book_id }}')">
                            <td class="px-4 py-3">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3">{{ $book->book_name }}</td>
                            <td class="px-4 py-3">{{ $book->book_isbn }}</td>
                            <td class="px-4 py-3">{{ $book->book_stock }}</td>
                            <td class="px-4 py-3">{{ $book->book_description }}</td>
                            <td class="px-4 py-3">{{ $book->author->author_name ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $book->category->category_name ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $book->publisher->publisher_name ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $book->shelf->shelf_name ?? '-' }}</td>
                        </tr>

                        <!-- MODAL EDIT BOOK -->
                        <dialog id="bookModal-{{ $book->book_id }}" class="modal z-50">
                            <div class="modal-box bg-white rounded-lg shadow-lg w-11/12 max-w-xl fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 p-4 sm:p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="font-semibold text-base sm:text-lg text-gray-800">✏️ Update Book</h3>
                                    <form method="dialog">
                                        <button type="submit" class="text-gray-500 hover:text-gray-700 text-lg sm:text-xl">&times;</button>
                                    </form>
                                </div>

                               <form id="updateForm-{{ $book->book_id }}" method="POST" action="{{ route('book.update', $book->book_id) }}" enctype="multipart/form-data" class="space-y-4">

                                    @csrf
                                    @method('PATCH')

                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1">Book Name</label>
                                            <input type="text" name="book_name" value="{{ $book->book_name }}" class="px-2 sm:px-3 py-1 sm:py-2 border border-gray-300 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm sm:text-base" />
                                            @error('book_name')
                                                <p class="text-xs sm:text-sm text-red-600 mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1">ISBN</label>
                                            <input type="text" name="book_isbn" value="{{ $book->book_isbn }}" class="px-2 sm:px-3 py-1 sm:py-2 border border-gray-300 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm sm:text-base" />
                                            @error('book_isbn')
                                                <p class="text-xs sm:text-sm text-red-600 mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1">Image URL</label>
                                            <input type="file" name="book_img" accept="image/*" class="px-2 sm:px-3 py-1 sm:py-2 border border-gray-300 rounded w-full" />
    @if($book->book_img)
        <img src="{{ asset('storage/'.$book->book_img) }}" alt="Book Image" class="mt-2 w-20">
    @endif

                                            @error('book_img')
                                                <p class="text-xs sm:text-sm text-red-600 mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1">Description</label>
                                            <input type="text" name="book_description" value="{{ $book->book_description }}" class="px-2 sm:px-3 py-1 sm:py-2 border border-gray-300 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm sm:text-base" />
                                            @error('book_description')
                                                <p class="text-xs sm:text-sm text-red-600 mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1">Stock</label>
                                            <input type="number" name="book_stock" value="{{ $book->book_stock }}" class="px-2 sm:px-3 py-1 sm:py-2 border border-gray-300 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm sm:text-base" />
                                            @error('book_stock')
                                                <p class="text-xs sm:text-sm text-red-600 mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1">Author</label>
                                            <select name="book_author_id" class="px-2 sm:px-3 py-1 sm:py-2 border border-gray-300 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm sm:text-base">
                                                <option value="">-- Select Author --</option>
                                                @foreach ($authors as $author)
                                                    <option value="{{ $author->author_id }}" @selected($book->book_author_id == $author->author_id)>
                                                        {{ $author->author_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('book_author_id')
                                                <p class="text-xs sm:text-sm text-red-600 mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1">Category</label>
                                            <select name="book_category_id" class="px-2 sm:px-3 py-1 sm:py-2 border border-gray-300 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm sm:text-base">
                                                <option value="">-- Select Category --</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->category_id }}" @selected($book->book_category_id == $category->category_id)>
                                                        {{ $category->category_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('book_category_id')
                                                <p class="text-xs sm:text-sm text-red-600 mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1">Publisher</label>
                                            <select name="book_publisher_id" class="px-2 sm:px-3 py-1 sm:py-2 border border-gray-300 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm sm:text-base">
                                                <option value="">-- Select Publisher --</option>
                                                @foreach ($publishers as $publisher)
                                                    <option value="{{ $publisher->publisher_id }}" @selected($book->book_publisher_id == $publisher->publisher_id)>
                                                        {{ $publisher->publisher_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('book_publisher_id')
                                                <p class="text-xs sm:text-sm text-red-600 mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1">Shelf</label>
                                            <select name="book_shelf_id" class="px-2 sm:px-3 py-1 sm:py-2 border border-gray-300 rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm sm:text-base">
                                                <option value="">-- Select Shelf --</option>
                                                @foreach ($shelves as $shelf)
                                                    <option value="{{ $shelf->shelf_id }}" @selected($book->book_shelf_id == $shelf->shelf_id)>
                                                        {{ $shelf->shelf_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('book_shelf_id')
                                                <p class="text-xs sm:text-sm text-red-600 mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </form>

                                <div class="flex items-center justify-end gap-2 mt-4">
                                    <button type="submit" form="updateForm-{{ $book->book_id }}" class="px-2 sm:px-3 py-1 sm:py-2 bg-gray-800 rounded text-sm text-white font-medium transition-all duration-300">Update</button>
                                    <form id="deleteForm-{{ $book->book_id }}" action="{{ route('book.destroy', $book->book_id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-2 sm:px-3 py-1 sm:py-2 bg-red-600 rounded text-sm text-white font-medium transition-all duration-300">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </dialog>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-6">
                    {{ $books->links() }}
                </div>
            </div>
        </div>
    </main>
</div>

</div>