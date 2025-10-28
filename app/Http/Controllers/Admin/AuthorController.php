<?php

namespace App\Http\Controllers\Admin;

use App\Models\Author;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthorRequest;


class AuthorController extends Controller
{
   public function index () {


    return view('pages.admin.author');
}


public function store (AuthorRequest $request) {
    $data = array(
        'author_name' => $request->input('author_name'),
        'author_description' => $request->input('author_description'),
    );
    $operation = Author::create($data);

    if ($operation) {
        return redirect()->route('admin.author')->with('success', 'Successfully create author data');
    } else {
        return redirect()->route('admin.author')->with('error', 'Failed to create author data');
    }
}

public function update (AuthorRequest $request, string $author_id) {
    $data = array(
        'author_name' => $request->input('author_name'),
        'author_description' => $request->input('author_description'),
    );


    $operation = Author::updateAuthor($data, $author_id);

    if ($operation) {
        return redirect()->route('admin.author')->with('success', 'Successfully update author data');
    } else {
        return redirect()->route('admin.author')->with('error', 'Failed to update author data');
    }
}


public function delete (string $author_id) {
   $operation = Author::deleteAuthor($author_id);

    if ($operation) {
        return redirect()->route('admin.author')->with('success', 'Successfully delete author data');
    } else {
        return redirect()->route('admin.author')->with('error', 'Failed to delete author data');
    }



}









}
