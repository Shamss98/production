@extends('layoutes.main')

@section('content')
<style>
    /* Custom Modern Dashboard Styles (Soft UI Inspired) */
    :root {
        --primary-color: #4a5568; /* Darker primary for text/icons */
        --secondary-color: #63b3ed; /* Light blue for accents */
        --card-bg: #ffffff;
        --soft-shadow: 0 4px 6px rgba(0, 0, 0, 0.05), 0 1px 3px rgba(0, 0, 0, 0.08);
        --header-bg: #f7f9fc;
        --dashboard-bg: #f0f3f8; /* Light background for the whole dashboard */
    }

    body {
        background-color: var(--dashboard-bg) !important;
    }

    .modern-header {
        background: var(--header-bg);
        border-radius: 15px;
        box-shadow: var(--soft-shadow);
        margin-bottom: 2rem;
        padding: 2rem;
    }

    .modern-header h1 {
        font-size: 2.5rem;
        font-weight: 700; /* Bold */
        color: var(--primary-color);
        text-align: center;
    }

    /* Stats Card Styling */
    .stats-card {
        border: none;
        border-radius: 12px;
        box-shadow: var(--soft-shadow);
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    .stats-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 10px rgba(0, 0, 0, 0.08), 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .icon-shape {
        
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        border-radius: 10px !important; /* Slightly less rounded */
    }

    .stats-label {
        color: #718096 !important; /* Slightly softer text color */
        font-size: 0.9rem;
    }

    .stats-value {
        font-weight: 700;
        color: #2d3748;
    }

    /* Table and Chart Card Styling */
    .card {
        border: none;
        border-radius: 12px;
        box-shadow: var(--soft-shadow);
    }

    .card-header {
        border-bottom: 1px solid #edf2f7; /* Light separator */
    }

    /* Button Styling */
    .btn-info {
        background-color: var(--secondary-color) !important;
        border-color: var(--secondary-color) !important;
        color: white;
        font-weight: 500;
        border-radius: 8px;
    }

    .btn-secondary {
        background-color: #a0aec0 !important;
        border-color: #a0aec0 !important;
        color: white;
        font-weight: 500;
        border-radius: 8px;
    }

    /* RTL specific adjustments for spacing (if not handled by Bootstrap's RTL) */
    .me-3 { /* margin-inline-end for RTL */
        margin-left: 1rem !important;
        margin-right: 0 !important;
    }

</style>

<div class="container-fluid py-4">
    {{-- Dashboard Header --}}
    <div class="modern-header">
        <h1>Dashboard</h1>
    </div>

    {{-- Stats Cards Row --}}
    <div class="row mb-4 justify-content-start g-3">
        {{-- Total Users Card --}}
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-3">
            <div class="card stats-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="icon icon-shape bg-primary text-white rounded-circle shadow me-3">
                            <i class="fas fa-users"></i>
                        </div>
                        <div>
                            <p class="stats-label mb-0">إجمالي المستخدمين</p>
                            <h3 class="stats-value mb-0">{{ $totalUsers }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Active Sessions Card --}}
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-3">
            <div class="card stats-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="icon icon-shape bg-success text-white rounded-circle shadow me-3">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div>
                            <p class="stats-label mb-0">الجلسات النشطة</p>
                            <h3 class="stats-value mb-0">{{ $activeSessions }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Revenue Card --}}
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-3">
            <div class="card stats-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="icon icon-shape bg-warning text-white rounded-circle shadow me-3">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div>
                            <p class="stats-label mb-0">الأرباح</p>
                            <h3 class="stats-value mb-0">${{ $totalRevenue }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Errors Card --}}
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-3">
            <div class="card stats-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="icon icon-shape bg-danger text-white rounded-circle shadow me-3">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div>
                            <p class="stats-label mb-0">الأخطاء</p>
                            <h3 class="stats-value mb-0">{{ $errorsCount }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mb-4 justify-content-start g-3">
        {{-- Categories Card --}}
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-3">
            <a class="text-decoration-none" href="{{ route('admin.categories.index') }}">
                <div class="card stats-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="icon icon-shape bg-info text-white rounded-circle shadow me-3">
                                <i class="fas fa-list"></i>
                            </div>
                            <div>
                                <p class="stats-label mb-0">الأقسام</p>
                                <h3 class="stats-value mb-0"> {{ $totalCategories }} </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        {{-- Products Card --}}
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-3">
            <a class="text-decoration-none" href="{{ route('admin.products.index') }}">
                <div class="card stats-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="icon icon-shape bg-secondary text-white rounded-circle shadow me-3">
                                <i class="fas fa-box"></i>
                            </div>
                            <div>
                                <p class="stats-label mb-0">المنتجات</p>
                                <h3 class="stats-value mb-0">{{ $totalProducts }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        
        {{-- Brands Card --}}
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-3">
            <a class="text-decoration-none" href="{{ route('admin.brands.index') }}">
                <div class="card stats-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="icon icon-shape bg-dark text-white rounded-circle shadow me-3">
                                <i class="fas fa-tags"></i>
                            </div>
                            <div>
                                <p class="stats-label mb-0">العلامات التجارية</p>
                                <h3 class="stats-value mb-0">{{ $brandsCount }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        
        {{-- Member Messages Card (Contacts) --}}
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-3">
            <a class="text-decoration-none" href="{{ route('admin.contacts.index') }}">
                <div class="card stats-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="icon icon-shape bg-success text-white rounded-circle shadow me-3">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div>
                                <p class="stats-label mb-0">رسائل الأعضاء</p>
                                <h3 class="stats-value mb-0">{{ $contactsCount }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        
        {{-- Ads Card --}}
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-3">
            <a class="text-decoration-none" href="{{ route('admin.ads.index') }}">
                <div class="card stats-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="icon icon-shape bg-primary text-white rounded-circle shadow me-3">
                                <i class="fas fa-bullhorn"></i>
                            </div>
                            <div>
                                <p class="stats-label mb-0">الإعلانات</p>
                                <h3 class="stats-value mb-0">{{ $adsCount }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        
        {{-- Offers Card --}}
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-3">
            <a class="text-decoration-none" href="{{ route('admin.offers.index') }}">
                <div class="card stats-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="icon icon-shape bg-danger text-white rounded-circle shadow me-3">
                                <i class="fas fa-gift"></i>
                            </div>
                            <div>
                                <p class="stats-label mb-0">العروض</p>
                                <h3 class="stats-value mb-0">{{ $offersCount }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    

    {{-- Add/Create Buttons --}}
    <div class="row mb-4">
        <div class="col-12">
            <a href="{{ route('admin.categories.create') }}" class="btn btn-info me-2 mb-2">
                <i class="fas fa-plus me-1"></i> اضافة قسم جديد
            </a>
            <a href="{{ route('admin.products.create') }}" class="btn btn-secondary me-2 mb-2">
                <i class="fas fa-plus me-1"></i> اضافة منتج جديد
            </a>
            <a href="{{ route('admin.brands.create') }}" class="btn btn-info me-2 mb-2">
                <i class="fas fa-plus me-1"></i> اضافة علامة تجارية جديدة
            </a>
            <a href="{{ route('admin.ads.create') }}" class="btn btn-secondary me-2 mb-2">
                <i class="fas fa-plus me-1"></i> اضافة اعلان جديد
            </a>
            <a href="{{ route('admin.offers.create') }}" class="btn btn-info mb-2">
                <i class="fas fa-plus me-1"></i> اضافة عرض جديد
            </a>
        </div>
    </div>


    {{-- Charts Row --}}
    <div class="row mb-4 g-4">
        <div class="col-lg-8">
            <div class="card shadow border-0 h-100">
                <div class="card-header bg-white">
                    <h5 class="mb-0 text-muted">نمو المستخدمين</h5>
                </div>
                <div class="card-body">
                    <canvas id="userGrowthChart" height="100"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card shadow border-0 h-100">
                <div class="card-header bg-white">
                    <h5 class="mb-0 text-muted">توزيع الجلسات</h5>
                </div>
                <div class="card-body d-flex align-items-center justify-content-center">
                    <canvas id="sessionPieChart" height="200" style="max-height: 300px;"></canvas>
                </div>
            </div>
        </div>
    </div>

   

    {{-- Categories Table --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow border-0">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-muted">Latest Categories</h5>
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-sm btn-info">
                        <i class="fas fa-plus me-1"></i> Add
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Description</th>
                                    <th class="text-secondary opacity-7">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($topCategories as $category)
                                <tr>
                                    <td class="align-middle">
                                        <div class="d-flex px-2 py-1">
                                            <h6 class="mb-0 text-sm">{{ $category['name'] }}</h6>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <p class="text-xs font-weight-bold mb-0">{{ Str::limit($category['description'], 50) }}</p>
                                    </td>
                                    <td class="align-middle">
                                        <a href="{{ route('admin.categories.edit', $category['id']) }}" class="btn btn-sm btn-warning me-1" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.categories.destroy', $category['id']) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    

    {{-- Products Table --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow border-0">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-muted">Recent Products</h5>
                    <div class="d-flex align-items-center">
                        {{-- Product Search Form --}}
                        <form method="GET" action="{{ route('admin.dashboard') }}" class="me-2 d-flex">
                            <input type="text" name="product_search" class="form-control form-control-sm" placeholder="Search products..." value="{{ request('product_search') }}" style="min-width: 180px;">
                            <button type="submit" class="btn btn-sm btn-outline-primary ms-2">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                        <a href="{{ route('admin.products.create') }}" class="btn btn-sm btn-secondary">
                            <i class="fas fa-plus me-1"></i> Add
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Category</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Image</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Price</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Stock</th>
                                    <th class="text-secondary opacity-7">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentProducts as $product)
                                <tr>
                                    <td class="align-middle">
                                        <h6 class="mb-0 text-sm">{{ $product->name }}</h6>
                                    </td>
                                    <td class="align-middle">
                                        <p class="text-xs font-weight-bold mb-0">{{ $product->category->name ?? 'No Category' }}</p>
                                    </td>
                                    <td class="align-middle">
                                        <img src="{{ asset('storage/' . $product->image) }}" 
                                        alt="{{ $product->name }}" 
                                        width="50" height="50" class="img-fluid rounded shadow-sm">
                                    </td>
                                    <td class="align-middle">
                                        <span class="text-sm font-weight-bold">${{ number_format($product->price, 2) }}</span>
                                    </td>
                                    <td class="align-middle">
                                        <span class="text-sm font-weight-bold">{{ $product->stock }}</span>
                                    </td>
                                    <td class="align-middle">
                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-warning me-1" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                @if($recentProducts->isEmpty())
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">No products found.</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
   

    {{-- Recent Activity Table --}}
    <div class="row">
        <div class="col-12">
            <div class="card shadow border-0">
                <div class="card-header bg-white">
                    <h5 class="mb-0 text-muted">Recent Activity</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">User</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Activity</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentActivities as $activity)
                                <tr>
                                    <td class="align-middle">
                                        <h6 class="mb-0 text-sm">{{ $activity->user?->name ?? 'System' }}</h6>
                                    </td>
                                    <td class="align-middle">
                                        <p class="text-xs font-weight-bold mb-0">{{ $activity->activity }}</p>
                                    </td>
                                    <td class="align-middle">
                                        <span class="text-xs font-weight-bold">{{ $activity->created_at->format('Y-m-d H:i') }}</span>
                                    </td>
                                    <td class="align-middle">
                                        @if($activity->status == 'Success')
                                            <span class="badge rounded-pill bg-success-light text-success">Success</span>
                                        @else
                                            <span class="badge rounded-pill bg-danger-light text-danger">Failed</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                {{-- Added a simple check for empty activity --}}
                                @if(empty($recentActivities)) 
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">No recent activity found.</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Chart.js CDN and Script (Keep this for functionality) --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Chart Data (using your existing logic/variables)
    var userGrowthLabels = {!! json_encode($userGrowthLabels ?? ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']) !!};
    var userGrowthData = {!! json_encode($userGrowthData ?? [120, 190, 300, 500, 200, 300]) !!};
    var sessionLabels = {!! json_encode($sessionLabels ?? ['Desktop', 'Mobile', 'Tablet']) !!};
    var sessionData = {!! json_encode($sessionData ?? [60, 30, 10]) !!};

    // User Growth Line Chart
    var ctx = document.getElementById('userGrowthChart').getContext('2d');
    var userGrowthChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: userGrowthLabels,
            datasets: [{
                label: 'Users',
                data: userGrowthData,
                backgroundColor: 'rgba(74, 85, 104, 0.1)', /* Lighter shade of primary */
                borderColor: 'var(--primary-color)',
                borderWidth: 2,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false, /* Added to make the chart adapt better to the container height */
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: { display: false }
            }
        }
    });

    // Session Distribution Pie Chart
    var ctxPie = document.getElementById('sessionPieChart').getContext('2d');
    var sessionPieChart = new Chart(ctxPie, {
        type: 'doughnut',
        data: {
            labels: sessionLabels,
            datasets: [{
                data: sessionData,
                backgroundColor: [
                    '#63b3ed', /* Light Blue (secondary-color) */
                    '#48bb78', /* Green (for success) */
                    '#fc8181'  /* Red (for danger/warning) */
                ],
                hoverBackgroundColor: [
                    '#4299e1',
                    '#38a169',
                    '#e53e3e'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });
});
</script>
@endsection