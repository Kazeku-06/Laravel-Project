<?php

namespace App\Livewire\Admin\Author;

use App\Models\Shelf as ModelsShelf;
use Livewire\Component;
use Livewire\WithPagination;

class Shelf extends Component
{
    use WithPagination;

    public $shelfName = '';

    protected $paginationTheme = 'tailwind';

    public function updatingCategoryName()
    {
        $this->resetPage();
    }

    public function render()
    {
        $shelves = $this->shelfName !== ''
            ? ModelsShelf::where('shelf_name', 'like', '%' . $this->shelfName . '%')->paginate(10)
            : ModelsShelf::paginate(5);

        return view('livewire.admin.author.shelf', compact('shelves'));
    }
}
