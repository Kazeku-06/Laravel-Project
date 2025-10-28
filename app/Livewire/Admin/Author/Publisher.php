<?php

namespace App\Livewire\Admin\Author;

use App\Models\Publisher as ModelsPublisher;
use Livewire\Component;
use Livewire\WithPagination;

class Publisher extends Component
{
     use WithPagination;

    public $publisherName = '';
    public $publisherId;
    public $publisher_name;
    public $publisher_description;
    public $confirmingpublisherDeletion = false;
    public $showEditModal = false;

    protected $paginationTheme = 'tailwind';

    public function updatingAuthorName()
    {
        $this->resetPage();
    }

    public function render()
    {
        $publishers = $this->publisherName !== ''
            ? ModelsPublisher::where('publisher_name', 'like', '%' . $this->publisherName . '%')->paginate(10)
            : ModelsPublisher::paginate(5);

        return view('livewire.admin.author.publisher', compact('publishers'));
    }
}
