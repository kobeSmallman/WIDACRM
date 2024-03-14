<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Note $note, Request $request)
{
    if ($request->hasFile('images')) {
        $files = $request->file('images');
        foreach ($files as $file) {
            $filename = time() . '_' . $file->getClientOriginalName();
            $folder = 'note_images';
            $path = $file->storeAs($folder, $filename, 'public');
            $mimeType = $file->getClientMimeType();

            $image = new Image();
            $image->Note_ID = $note;
            $image->IMG_data = $path;
            $image->IMG_MIME = $mimeType;
            
            $image->save();
        }

        return response()->json(['success' => true, 'message' => 'Images saved successfully']);
    }

    return response()->json(['success' => false, 'message' => 'No images found to upload']);
}


    

    /**
     * Display the specified resource.
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Image $image)
    {
        //
    }
}
