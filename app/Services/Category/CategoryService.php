<?php

namespace App\Services\Category;

use App\Models\Activity;
use Illuminate\Support\Str;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CategoryService
{
    public function getCategories()
    {
        return Category::latest()->paginate(12);
    }

    public function store(array $data)
    {
        if(empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }
        if(request()->hasFile('image')) {
            $data['image'] = request()->file('image')->store('categories', 'public');
        }
        return Category::create($data);

        $activity = Activity::create([
            'user_id' => Auth::id(),
            'activity' => 'Category created',
            'status' => 'success'
        ]);
        $activity->save();
    }
    public function update(array $data, Category $category)
    {
        if(empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }
        if(request()->hasFile('image')) {
            $data['image'] = request()->file('image')->store('categories', 'public');
        }

        return $category->update($data);
        $activity = Activity::create([
            'user_id' => Auth::id(),
            'activity' => 'Category updated',
            'status' => 'success'
        ]);
        $activity->save();

    }
    public function destroy(Category $category)
    {

            return $category->delete();
        $activity = Activity::create([
            'user_id' => Auth::id(),
            'activity' => 'Category deleted',
            'status' => 'success'
        ]);
        $activity->save();

    }

}
