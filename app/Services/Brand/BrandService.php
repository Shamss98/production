<?php

namespace App\Services\Brand;

use App\Models\Activity;
use App\Models\Brand;
use Illuminate\Support\Facades\Auth;

class BrandService
{
    public function getBrands ()
    {
       return Brand::with('category')->latest()->paginate(10);
    }

    public function store(array $data)
    {
        if(request()->hasFile('image')) {
            $data['image'] = request()->file('image')->store('brands', 'public');
        }
        return Brand::create($data);

        $activity = Activity::create([
            'user_id' => Auth::id(),
            'activity' => 'Brand created',
            'status' => 'success'
        ]);
        $activity->save();
    }

    public function update($Brand, $brand, array $data)
    {
        if(request()->hasFile('image')) {
            $data['image'] = request()->file('image')->store('brands', 'public');
        }
        return Brand::update($data);

        $activity = Activity::create([
            'user_id' => Auth::id(),
            'activity' => 'Brand updated',
            'status' => 'success'
        ]);
        $activity->save();
    }

    public function delete($Brand, $brand)
    {
        return Brand::delete();
    }
}
