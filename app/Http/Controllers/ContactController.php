<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    
    public function index()
    {
        return view('contact.index');
    }

    // تخزين الرسالة
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'message' => 'required|string',
        ]);

        Contact::create($request->all());

        return redirect()->back()->with('success', 'تم إرسال رسالتك بنجاح ✅');
    }
    public function adminIndex()
    {
        $contacts = Contact::latest()->paginate(10);
        Contact::where('created_at', '<', now()->subDays(2))->delete(); 
        return view('admin.contacts.index', compact('contacts'));
    }
}
