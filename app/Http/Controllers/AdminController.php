<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Brand;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
{

    Activity::where('created_at', '<', now()->subMinutes(10))->delete();

    // إحصائيات المستخدمين
    $totalUsers = User::count();
    $newUsersThisMonth = User::whereMonth('created_at', now()->month)->count();
    $newUsersThisWeek = User::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
    $activeUsers = User::where('created_at', '>=', now()->subDays(30))->count();

    // إحصائيات المنتجات
    $totalProducts = Product::count();
    $productsThisMonth = Product::whereMonth('created_at', now()->month)->count();
    $lowStockProducts = Product::where('stock', '<=', 10)->count();
    $outOfStockProducts = Product::where('stock', 0)->count();

    // إحصائيات التصنيفات
    $totalCategories = Category::count();
    $categoriesWithProducts = Category::has('products')->count();
    $emptyCategories = Category::doesntHave('products')->count();

    // إحصائيات العلامات التجارية
    $brandsCount = Brand::count();

    // التصنيفات الأكثر نشاطاً
    $topCategories = Category::withCount('products')
        ->orderBy('products_count', 'desc')
        ->take(5)
        ->get();

    // المنتجات الجديدة
    $recentProducts = Product::with('category')
        ->latest()
        ->take(6)
        ->get();

    // المستخدمين الجدد
    $recentUsers = User::latest()
        ->take(6)
        ->get();

    // إحصائيات شهرية للمستخدمين
    $monthlyUsers = User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
        ->whereYear('created_at', now()->year)
        ->groupBy('month')
        ->orderBy('month')
        ->get();

    // إحصائيات شهرية للمنتجات
    $monthlyProducts = Product::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
        ->whereYear('created_at', now()->year)
        ->groupBy('month')
        ->orderBy('month')
        ->get();

    // إحصائيات إضافية
    $totalRevenue = Product::sum('price');
    $averageProductPrice = Product::avg('price');
    $mostExpensiveProduct = Product::orderBy('price', 'desc')->first();
    $cheapestProduct = Product::orderBy('price', 'asc')->first();

    // الأنشطة الأخيرة
    $recentActivities = Activity::with('user')
        ->latest()
        ->take(10)
        ->get();

        $errorsCount = Activity::where('status', 'Failed')->count();


        $activeSessions = Activity::where('activity', 'Logged in')
        ->where('created_at', '>=', now()->subMinutes(30))
        ->distinct('user_id')
        ->count('user_id');


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
    ));
}


/*******  5586e46d-8a5f-4295-917f-0b0444afa29c  *******/


} 