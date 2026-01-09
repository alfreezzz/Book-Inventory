<?php

namespace App\Http\Controllers;

use App\Models\publisher as ModelsPublisher;
use Illuminate\Http\Request;

class Publisher extends Controller
{
    public function index()
    {
        $publisher = ModelsPublisher::all();

        return view('welcome', compact('publisher'));
    }

    public function create()
    {
        return view('admin.publisher.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => ['required', 'max:255'],
            'name' => ['required', 'max:255'],
            'address' => ['required', 'max:255'],
            'city' => ['required', 'max:255'],
            'phone' => ['required', 'max:255'],
        ]);

        $publisher = new ModelsPublisher();
        $publisher->code = $request->code;
        $publisher->name = $request->name;
        $publisher->address = $request->address;
        $publisher->city = $request->city;
        $publisher->phone = $request->phone;
        $publisher->save();

        return redirect('admin')->with('status', 'Penerbit berhasil ditambahkan');
    }

    public function edit(string $id)
    {
        $publisher = ModelsPublisher::FindOrFail($id);

        return view('admin.publisher.edit', compact('publisher'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'code' => ['required', 'max:255'],
            'name' => ['required', 'max:255'],
            'address' => ['required', 'max:255'],
            'city' => ['required', 'max:255'],
            'phone' => ['required', 'max:255'],
        ]);

        $publisher = ModelsPublisher::FindOrFail($id);
        $publisher->code = $request->code;
        $publisher->name = $request->name;
        $publisher->address = $request->address;
        $publisher->city = $request->city;
        $publisher->phone = $request->phone;
        $publisher->save();

        return redirect('admin')->with('status', 'Penerbit berhasil diubah');
    }

    public function destroy(string $id)
    {
        ModelsPublisher::destroy($id);
        return redirect('admin')->with('status', 'Penerbit berhasil dihapus');
    }
}
