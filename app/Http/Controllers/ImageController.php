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
    // public function store(Request $request, Note $note)
    // {
    //     $images = $request->file('images'); // Assuming 'images' is the name attribute in your file input field.

    //     foreach ($images as $image) {
    //         $imageData = file_get_contents($image->getRealPath());
    //         $mime = $image->getMimeType();

    //         $note->images()->create([
    //             'image_data' => $imageData,
    //             'img_mime' => $mime,
    //         ]);
    //     }
    public function store(Request $request, Note $note) // maybe add int to $noteId
    {
        $request->validate([
            'images.*' => 'required|image|mimes:png,jpg,jpeg,webp'
        ]);

        // Find the note by ID
        $note = Note::findOrFail($note->noteId);

        // Retrieve uploaded files
        $imageData = [];
        if ($images = $request->file('images')) {

            foreach ($images as $image) {
                $extension = $image-> getClientOriginalExtension();
                $fileName = time(). '.' .$extension;

                $imageData[] = [
                    'note_ID' => $note->id,
                    'IMG_MIME' => $extension,
                    'IMG_Data' => $image,
                ];
            }
        }

        Image::insert($imageData);

        // Return a response to the client
        return response()->json(['success' => true, 'message' => 'Note saved successfully', 'noteId' => $note->Note_ID]);
    }

    // public function store(Request $request, $noteId) // maybe add int to $noteId
    // {
    //     // Find the note by ID
    //     $note = Note::findOrFail($noteId);

    //     // Retrieve uploaded files
    //     $imageData = [];
    //     if ($images = $request->file('images')) {

    //         foreach ($images as $image) {
    //             // Save each image with the Note_ID
    //             $newImage = new Image();
    //             $newImage->Note_ID = $note->Note_ID; // Associate image with the note
    //             $newImage->IMG_MIME = $image->getClientMimeType();
    //             $newImage->IMG_Data = file_get_contents($image); // Store the image file's contents
    //             $newImage->save();

    //             $imageData[] = [
    //                 'note_ID' => $noteId->id,
    //             ];
    //         }
    //     }
    //     // Return a response to the client
    //     return response()->json(['success' => true, 'message' => 'Images uploaded successfully']);
    // }





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
