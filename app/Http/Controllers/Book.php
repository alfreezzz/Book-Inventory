<?php

namespace App\Http\Controllers;

use App\Models\book as ModelsBook;
use App\Models\publisher as ModelsPublisher;
use Illuminate\Http\Request;

class Book extends Controller
{
    public function index(Request $request)
    {
        $books = ModelsBook::with('publisher');
        $publisher = ModelsPublisher::all();

        if ($request->has('name')) {
            $books = $books->where('title', 'LIKE', '%' . $request->input('name') . '%');
        }

        $books = $books->get();

        return view('welcome', compact('books', 'publisher'));
    }

    public function sortByStock(Request $request)
    {
        $books = ModelsBook::with('publisher')->orderBy('stock', 'asc')->get();

        return view('procurement', compact('books'));
    }

    public function create()
    {
        $publishers = ModelsPublisher::all();
        return view('admin.book.create', compact('publishers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => ['required', 'max:255'],
            'category' => ['required', 'max:255'],
            'title' => ['required', 'max:255'],
            'price' => ['required', 'max:255'],
            'stock' => ['required', 'max:255'],
            'publisher_id' => ['required'],
        ]);

        $book = new ModelsBook();
        $book->code = $request->code;
        $book->category = $request->category;
        $book->title = $request->title;
        $book->price = $request->price;
        $book->stock = $request->stock;
        $book->publisher_id = $request->publisher_id;
        $book->save();

        return redirect('admin')->with('status', 'Buku berhasil ditambahkan');
    }

    public function edit(string $id)
    {
        $book = ModelsBook::FindOrFail($id);

        return view('admin.book.edit', compact('book'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'code' => ['required', 'max:255'],
            'category' => ['required', 'max:255'],
            'title' => ['required', 'max:255'],
            'price' => ['required', 'max:255'],
            'stock' => ['required', 'max:255'],
            'publisher_id' => ['required'],
        ]);

        $book = ModelsBook::FindOrFail($id);
        $book->code = $request->code;
        $book->category = $request->category;
        $book->title = $request->title;
        $book->price = $request->price;
        $book->stock = $request->stock;
        $book->publisher_id = $request->publisher_id;
        $book->save();

        return redirect('admin')->with('status', 'Penerbit berhasil diubah');
    }

    public function destroy(string $id)
    {
        ModelsBook::destroy($id);
        return redirect('admin')->with('status', 'Buku berhasil dihapus');
    }
}
