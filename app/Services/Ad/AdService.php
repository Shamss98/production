<?php

namespace App\Services\Ad;

use App\Models\Ad;


class AdService
{
    public function getAds()
    {
        return Ad::latest()->get();
    }
    public function store()
    {

        if(request()->hasFile('image')) {
            $data['image'] = request()->file('image')->store('ads', 'public');
        }

        return Ad::create($data);

    }
    public function update()
    {
        if(request()->hasFile('image')) {
            $data['image'] = request()->file('image')->store('ads', 'public');
        }

        return Ad::update($data);

    }

    public function destroy(Ad $ad)
    {
        $ad->delete();
    }
}
