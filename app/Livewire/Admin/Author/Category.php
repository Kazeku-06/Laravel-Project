<?php

namespace App\Livewire\Admin\Author;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Category as ModelsCategory;

class Category extends Component
{
       use WithPagination;

    public $categoryName = '';
    public $categoryId;
    public $category_name;
    public $category_description;
    public $confirmingcategoryDeletion = false;
    public $showEditModal = false;

    protected $paginationTheme = 'tailwind';

    public function updatingCategoryName()
    {
        $this->resetPage();
    }

    public function render()
    {
        $categories = $this->categoryName !== ''
            ? ModelsCategory::where('category_name', 'like', '%' . $this->categoryName . '%')->paginate(10)
            : ModelsCategory::paginate(5);

        return view('livewire.admin.author.category', compact('categories'));
    }
}
