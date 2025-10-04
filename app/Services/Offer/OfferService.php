<?php

namespace App\Services\Offer;

use App\Models\Activity;
use App\Models\Offer;
use Illuminate\Support\Facades\Auth;

class OfferService
{
    public function getOffers()
    {
        return Offer::with('product')->latest()->paginate(10);
    }
    public function store(array $data)
    {
        return Offer::create($data);

        $activity = Activity::create([
            'user_id' => Auth::id(),
            'activity' => 'Offer created',
            'status' => 'success'
        ]);
        $activity->save();
    }

    public function update(array $data, Offer $offer)
    {
        return $offer->update($data);

        $activity = Activity::create([
            'user_id' => Auth::id(),
            'activity' => 'Offer updated',
            'status' => 'success'
        ]);
        $activity->save();
    }

    public function destroy(Offer $offer)
    {
        $offer->delete();
        $activity = Activity::create([
            'user_id' => Auth::id(),
            'activity' => 'Offer deleted',
            'status' => 'success'
        ]);
        $activity->save();
    }
}
