<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Inertia\Inertia;
use App\Models\Author;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $book = Book::with(['author:id,name', 'tag:id,name'])->get();
        // all(['id', 'title', 'publication_yr']);
        // return response()->json($book);

        return Inertia::render(
            'components/book/List',
            [
                'book' => $book
            ]
        );
    }

    public function create()
    {
        return Inertia::render(
            'components/book/Add'
        );
    }

    public function store(Request $request)
    {
        //$book = Book::create($request->post());
        // return response()->json([
        //     'message' => 'Book Created Successfully!!',
        //     'book' => $book
        // ]);

        // return Inertia::render(
        //     'component/book/Add'
        // );

        $request->validate([
            'title' => 'required|string|max:255',
            'publication_yr' => 'nullable',
            'author_id' => 'required|exists:authors,id'
        ]);
        Book::create([
            'title' => $request->title,
            'publication_yr' => $request->publication_yr,
            'author_id' => $request->author_id

        ]);
        sleep(1);

        return redirect()->route('book.index')->with('message', 'Book Created Successfully');
    }

    public function show(Book $book)
    {
        // return response()->json($book);
    }

    public function edit(Book $book)
    {
        // $book = Book::with(['author:id,name', 'tag:id,name'])->get();
        $authors = Author::all(['id', 'name']);
        $book->load('author:id,name');

        return Inertia::render(
            'components/book/Edit',
            [
                'book' => $book,
                'authors' => $authors,
            ]
        );
    }

    public function update(Request $request, Book $book)
    {
        // $book->fill($request->post())->save();
        // return response()->json([
        //     'message' => 'Book Updated Successfully!!',
        //     'book' => $book
        // ]);

        $request->validate([
            'title' => 'required|string|max:255',
            'publication_yr' => 'nullable',
            'author_id' => 'required|exists:authors,id'
        ]);

        $book->title = $request->title;
        $book->publication_yr = $request->publication_yr;
        $book->author_id = $request->author_id;
        $book->save();
        sleep(1);

        return redirect()->route('book.index')->with('message', 'Book Updated Successfully');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        sleep(1);

        return redirect()->route('book.index')->with('message', 'Book Delete Successfully');
    }
}
