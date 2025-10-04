<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactStoreRequest;
use App\Models\Contact;
use App\Services\Contact\ContactService;
use Illuminate\Http\Request;

class ContactController extends Controller

{
protected $contactService;

        public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }
       public function adminIndex()
    {
        $contacts = $this->contactService->getAdminIndex();
        return view('admin.contacts.index', compact('contacts'));
    }

    public function index()
    {
        return view('contact.index');
    }

    public function store(ContactStoreRequest $request)
    {

            $this->contactService->store($request->validated());

        return redirect()->back()->with('success', 'تم إرسال رسالتك بنجاح ✅');
    }

}
