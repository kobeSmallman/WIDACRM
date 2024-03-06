<?php
// FAQController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Ensure you have the FAQ model linked correctly
use App\Models\FAQ; 

class FAQController extends Controller
{
    public function showFAQ()
    {
        // You can pass data to your view if needed, for example:
        // $faqs = FAQ::all(); // Assuming you want to display all FAQs
        
        // Return the FAQ view
        // The path 'FAQ.faq' corresponds to resources/views/FAQ/faq.blade.php
        return view('FAQ.faq');
    }
}
