<?php

namespace App\Http\Controllers\Admin;

use App\Models\Publisher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PublisherRequest;

class PublisherController extends Controller
{
    public function index()
    {
        $publishers = Publisher::getAllPublishersPaginated(5);

        return view('pages.admin.publisher', [
            'publishers' => $publishers
        ]);
    }

    public function store(PublisherRequest $request)
    {
        $data = [
            'publisher_name' => $request->input('publisher_name'),
            'publisher_description' => $request->input('publisher_description'),
        ];

        $operation = Publisher::createPublisher($data);

        if ($operation) {
            return redirect()->route('admin.publisher')->with('success', 'Successfully created publisher data');
        } else {
            return redirect()->route('admin.publisher')->with('error', 'Failed to create publisher data');
        }
    }

    public function update(PublisherRequest $request, string $publisher_id)
    {
        $data = [
            'publisher_name' => $request->input('publisher_name'),
            'publisher_description' => $request->input('publisher_description'),
        ];

        $operation = Publisher::updatePublisher($publisher_id, $data);

        if ($operation) {
            return redirect()->route('admin.publisher')->with('success', 'Successfully updated publisher data');
        } else {
            return redirect()->route('admin.publisher')->with('error', 'Failed to update publisher data');
        }
    }

    public function delete(string $publisher_id)
    {
        $operation = Publisher::deletePublisher($publisher_id);

        if ($operation) {
            return redirect()->route('admin.publisher')->with('success', 'Successfully deleted publisher data');
        } else {
            return redirect()->route('admin.publisher')->with('error', 'Failed to delete publisher data');
        }
    }
}
