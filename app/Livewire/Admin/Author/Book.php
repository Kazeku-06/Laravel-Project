<?php

namespace App\Livewire\Admin\Author;

use App\Models\Book as ModelsBook;
use App\Models\Author;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\Shelf;
use Livewire\Component;
use Livewire\WithPagination;

class Book extends Component
{
    use WithPagination;

    public $bookName = '';
    protected $paginationTheme = 'tailwind';

    public function updatingBookName()
    {
        $this->resetPage();
    }

    public function render()
    {
        $books = ModelsBook::with(['author', 'category', 'publisher', 'shelf'])
            ->when($this->bookName !== '', function ($query) {
                $query->where('book_name', 'like', '%' . $this->bookName . '%');
            })
            ->paginate(3);

        $authors = Author::all();
        $categories = Category::all();
        $publishers = Publisher::all();
        $shelves = Shelf::all();

        return view('livewire.admin.author.book', compact('books', 'authors', 'categories', 'publishers', 'shelves'));
    }
}
