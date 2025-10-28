<?php

namespace App\Livewire\Admin\Author;

use Livewire\Component;
use App\Models\Author;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public $authorName = '';
    public $authorId;
    public $author_name;
    public $author_description;
    public $confirmingAuthorDeletion = false;
    public $showEditModal = false;

    protected $paginationTheme = 'tailwind';

    public function updatingAuthorName()
    {
        $this->resetPage();
    }

    public function render()
    {
        $authors = $this->authorName !== ''
            ? Author::where('author_name', 'like', '%' . $this->authorName . '%')->paginate(10)
            : Author::paginate(5);

        return view('livewire.admin.author.table', compact('authors'));
    }

    public function edit($id)
    {
        $author = Author::findOrFail($id);
        $this->authorId = $author->id;
        $this->author_name = $author->author_name;
        $this->author_description = $author->author_description;
        $this->showEditModal = true;
    }

    public function update()
    {
        $this->validate([
            'author_name' => 'required|string|max:255',
            'author_description' => 'nullable|string',
        ]);

        $author = Author::findOrFail($this->authorId);
        $author->update([
            'author_name' => $this->author_name,
            'author_description' => $this->author_description,
        ]);

        session()->flash('success', 'Author updated successfully.');
        $this->showEditModal = false;
    }

    public function confirmDelete($id)
    {
        $this->authorId = $id;
        $this->confirmingAuthorDeletion = true;
    }

    public function delete()
    {
        Author::findOrFail($this->authorId)->delete();
        session()->flash('success', 'Author deleted successfully.');
        $this->confirmingAuthorDeletion = false;
    }
}
