<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;

class NoteController extends Controller
{
    // Menampilkan halaman notes
    public function index()
    {
        $notes = Note::orderBy('created_at', 'desc')->get();
        return view('todos.notes', compact('notes'));
    }

    // Menambah note baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:10000'
        ]);

        Note::create([
            'title' => $request->title
        ]);

        return redirect()->back()->with('success', 'Note berhasil ditambahkan!');
    }

    // Update note
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:10000'
        ]);

        $note = Note::findOrFail($id);
        $note->update([
            'title' => $request->title
        ]);

        return redirect()->back()->with('success', 'Note berhasil diupdate!');
    }

    // Hapus note
    public function destroy($id)
    {
        $note = Note::findOrFail($id);
        $note->delete();

        return redirect()->back()->with('success', 'Note berhasil dihapus!');
    }
}
