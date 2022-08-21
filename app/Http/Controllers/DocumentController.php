<?php

namespace App\Http\Controllers;

use App\Http\Requests\DocumentRequest;
use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function create()
    {
        $documents = Document::orderBy('id', 'desc')->paginate(10);
        return view('documents.create', compact('documents'));
    }

    public function store(DocumentRequest $request)
    {
        // Data Insert
        foreach ($request->documents as $i => $documentFile) {
            $document = new Document();
            $document->name = $request->name . '-' . $i + 1;

            $fileName = $i + 1 . '-' . time() . '.' . $documentFile->extension();
            $document->file = $documentFile->storePubliclyAs('public/documents', $fileName);
            $document->save();
        }

        // Session a success/error
        session()->flash('success', 'Documents added successfully.');

        // return back();
        return redirect()->route('documents.create');
    }
}
