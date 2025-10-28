<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShelfRequest;
use App\Models\Shelf;
use Illuminate\Http\Request;

class ShelfController extends Controller
{
    public function index()
    {
        $shelves = Shelf::getAllShelvesPaginated(5);

        return view('pages.admin.shelf', [
            'shelves' => $shelves
        ]);
    }

    public function store(ShelfRequest $request)
    {
        $data = [
            'shelf_name' => $request->input('shelf_name'),
            'shelf_position' => $request->input('shelf_position'),
        ];

        $operation = Shelf::createShelf($data);

        if ($operation) {
            return redirect('/admin/shelf')->with('success', 'Successfully created shelf data');
        } else {
            return redirect('/admin/shelf')->with('error', 'Failed to create shelf data');
        }
    }

    public function update(ShelfRequest $request, string $shelf_id)
    {
        $data = [
            'shelf_name' => $request->input('shelf_name'),
            'shelf_position' => $request->input('shelf_position'),
        ];

        $operation = Shelf::updateShelf($shelf_id, $data);

        if ($operation) {
            return redirect('/admin/shelf')->with('success', 'Successfully updated shelf data');
        } else {
            return redirect('/admin/shelf')->with('error', 'Failed to update shelf data');
        }
    }

    public function delete(string $shelf_id)
    {
        $operation = Shelf::deleteShelf($shelf_id);

        if ($operation) {
            return redirect('/admin/shelf')->with('success', 'Successfully deleted shelf data');
        } else {
            return redirect('/admin/shelf')->with('error', 'Failed to delete shelf data');
        }
    }
}
