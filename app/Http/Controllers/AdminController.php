<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Ad;
use App\Models\Brand;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
{

    Activity::where('created_at', '<', now()->subMinutes(10))->delete();

    
    $totalUsers = User::count();
    $newUsersThisMonth = User::whereMonth('created_at', now()->month)->count();
    $newUsersThisWeek = User::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
    $activeUsers = User::where('created_at', '>=', now()->subDays(30))->count();


    $totalProducts = Product::count();
    $productsThisMonth = Product::whereMonth('created_at', now()->month)->count();
    $lowStockProducts = Product::where('stock', '<=', 10)->count();
    $outOfStockProducts = Product::where('stock', 0)->count();

    
    $totalCategories = Category::count();
    $categoriesWithProducts = Category::has('products')->count();
    $emptyCategories = Category::doesntHave('products')->count();


    $brandsCount = Brand::count();
    $adsCount = Ad::count();

    $offersCount = DB::table('offers')->count();
    
    $topCategories = Category::withCount('products')
        ->orderBy('products_count', 'desc')
        ->paginate(5);

    
    $recentProducts = Product::with('category')
        ->latest()
        ->take(6)
        ->get();

    
    $recentUsers = User::latest()
        ->take(6)
        ->get();

    
    $monthlyUsers = User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
        ->whereYear('created_at', now()->year)
        ->groupBy('month')
        ->orderBy('month')
        ->get();

    
    $monthlyProducts = Product::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
        ->whereYear('created_at', now()->year)
        ->groupBy('month')
        ->orderBy('month')
        ->get();

    
    $totalRevenue = Product::sum('price');
    $averageProductPrice = Product::avg('price');
    $mostExpensiveProduct = Product::orderBy('price', 'desc')->first();
    $cheapestProduct = Product::orderBy('price', 'asc')->first();

    
    $recentActivities = Activity::with('user')
        ->latest()
        ->take(10)
        ->get();

        $errorsCount = Activity::where('status', 'Failed')->count();


        $activeSessions = Activity::where('activity', 'Logged in')
        ->where('created_at', '>=', now()->subMinutes(30))
        ->distinct('user_id')
        ->count('user_id');

        // Message For Contacts 
        $contactsCount = Contact::count();

        $totalUsersNow = User::count(); 
        $totalUsersLastWeek = User::where('created_at', '<', now()->subWeek())->count();
        
        if ($totalUsersLastWeek > 0) {
            $userGrowth = (($totalUsersNow - $totalUsersLastWeek) / $totalUsersLastWeek) * 100;
        } else {
            $userGrowth = $totalUsersNow > 0 ? 100 : 0;
        }


    return view('admin.dashboard', compact(
        'totalUsers',
        'newUsersThisMonth',
        'newUsersThisWeek',
        'activeUsers',
        'totalProducts',
        'productsThisMonth',
        'lowStockProducts',
        'outOfStockProducts',
        'totalCategories',
        'categoriesWithProducts',
        'emptyCategories',
        'topCategories',
        'recentProducts',
        'recentUsers',
        'monthlyUsers',
        'monthlyProducts',
        'totalRevenue',
        'averageProductPrice',
        'mostExpensiveProduct',
        'cheapestProduct',
        'recentActivities',
        'errorsCount',
        'activeSessions',
        'userGrowth',
        'brandsCount',
        'contactsCount',
        'adsCount',
        'offersCount'

    ));
}


/*******  5586e46d-8a5f-4295-917f-0b0444afa29c  *******/


} 