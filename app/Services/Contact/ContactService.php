<?php

namespace App\Services\Contact;

use App\Http\Requests\ContactStoreRequest;
use App\Models\Contact;

class ContactService
{
    public function getAdminIndex()
    {
        return Contact::latest()->paginate(10);
    }

    public function store( array $data)
    {
        return Contact::create($data);
    }
}
