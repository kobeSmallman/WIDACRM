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
            'images.*' => 'image|mimes:png,jpg,jpeg'
        ]);

        // Find the note by ID
        $note = Note::findOrFail($note->Note_ID);

        // Retrieve uploaded files
        $imageData = [];
        if ($images = $request->file('images')) {

            foreach ($images as $image) {
                $extension = $image->getClientOriginalExtension();
                $fileName = time() . '.' . $extension;
                $image->storeAs('images', $fileName); // Make sure you have 'images' disk configured in filesystems.php

                $imageData[] = [
                    'Note_ID' => $note->Note_ID,
                    'IMG_MIME' => $extension,
                    'IMG_Data' => file_get_contents($image), // Store the image content
                ];
            }
        }

        Image::insert($imageData);

        // Return a response to the client
        return response()->json(['success' => true, 'message' => 'Note saved successfully note controller']);
    }



    /**
     * Display the specified resource.
     */
    public function getImagesByNote(Note $note)
    {
        $images = Image::where('Note_ID', $note->Note_ID)->get();

        // Assuming you want to send back the image data as a base64 encoded string
        $imageData = $images->map(function ($image) {
            return [
                'id' => $image->Image_ID,
                'mime' => $image->IMG_MIME,
                'data' => base64_encode($image->IMG_data)
            ];
        });

        return response()->json(['success' => true, 'images' => $imageData]);
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
