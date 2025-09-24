
@extends('layoutes.main') {{-- تأكد أن هذا الملف موجود في resources/views/layouts/admin.blade.php --}}

@section('content')
        <div class="container-fluid py-4"  style="background: linear-gradient(90deg, #f8fafc 0%, #e0e7ef 100%); border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); margin-bottom: 24px;">
            <h1 style="font-size: 2.5rem; text-align: center; font-weight: bold; color: #344767; letter-spacing: 1px; text-shadow: 0 1px 2px rgba(52,71,103,0.08);">
                Dashboard
            </h1>
        </div>

<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
            <div class="card shadow border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="icon icon-shape bg-primary text-white rounded-circle shadow me-3">
                            <i class="fas fa-users"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1">إجمالي المستخدمين</h6>
                            <h3 class="mb-0">{{ $totalUsers  }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
            <div class="card shadow border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="icon icon-shape bg-success text-white rounded-circle shadow me-3">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1">الجلسات النشطة</h6>
                            <h3 class="mb-0">{{ $activeSessions }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
            <div class="card shadow border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="icon icon-shape bg-warning text-white rounded-circle shadow me-3">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1">الارباح</h6>
                            <h3 class="mb-0">${{ $totalRevenue }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
            <div class="card shadow border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="icon icon-shape bg-danger text-white rounded-circle shadow me-3">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1">الاخطاء</h6>
                            <h3 class="mb-0">{{ $errorsCount  }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Category Card -->
        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
            <div class="card shadow border-0">
                <a class="text-decoration-none" href="{{ route('admin.categories.index') }}">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="icon icon-shape bg-info text-white rounded-circle shadow me-3">
                            <i class="fas fa-list"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1">الأقسام</h6>
                            <h3 class="mb-0">{{ $totalCategories }}</h3>
                        </div>
                    </div>
                </div>
                </a>
            </div>
        </div>
        <!-- Products Card -->
        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
            <div class="card shadow border-0">
                <a class="text-decoration-none" href="{{ route('admin.products.index') }}">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="icon icon-shape bg-secondary text-white rounded-circle shadow me-3">
                            <i class="fas fa-box"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1">المنتجات</h6>
                            <h3 class="mb-0">{{ $totalProducts }}</h3>
                        </div>
                    </div>
                </div>
                </a>
            </div>
        </div>
        <!-- End Products Card -->
        <!-- Start Brands Card -->
        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
            <div class="card shadow border-0">
                <a class="text-decoration-none" href="{{ route('admin.brands.index') }}">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="icon icon-shape bg-info text-white rounded-circle shadow me-3">
                            <i class="fas fa-tags"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1">العلامات التجارية</h6>
                            <h3 class="mb-0">{{ $brandsCount }}</h3>
                        </div>
                    </div>
                </div>
                </a>
            </div>
        </div>
        <!-- End Brands Card -->
        <!-- Start Brands Card -->
        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
            <div class="card shadow border-0">
                <a class="text-decoration-none" href="{{ route('admin.contacts.index') }}">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="icon icon-shape bg-info text-white rounded-circle shadow me-3">
                            <i class="fas fa-tags"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1">رسائل الاعضاء</h6>
                            <h3 class="mb-0">{{ $contactsCount }}</h3>
                        </div>
                    </div>
                </div>
                </a>
            </div>
        </div>
        <!-- End Brands Card -->
        <!-- Start Ads Card -->
        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
            <div class="card shadow border-0">
                <a class="text-decoration-none" href="{{ route('admin.ads.index') }}">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="icon icon-shape bg-info text-white rounded-circle shadow me-3">
                            <i class="fas fa-tags"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1">الاعلانات</h6>
                            <h3 class="mb-0">{{ $adsCount }}</h3>
                        </div>
                    </div>
                </div>
                </a>
            </div>
        </div>
        <!-- End Ads Card -->
    </div>

    <!-- Add Category & Product Buttons -->
    <div class="row mb-4">
        <div class="col-lg-6 mb-3">
            <a href="{{ route('admin.categories.create') }}" class="btn btn-info me-2 mb-2">
                <i class="fas fa-plus"></i> اضافة قسم جديد
            </a>
            <a href="{{ route('admin.products.create') }}" class="btn btn-secondary mb-2">
                <i class="fas fa-plus"></i> اضافة منتج جديد
            </a>
            <a href="{{ route('admin.brands.create') }}" class="btn btn-info mb-2">
                <i class="fas fa-plus"></i> اضافة علامة تجارية جديدة
            </a>
            <a href="{{ route('admin.ads.create') }}" class="btn btn-info mb-2">
                <i class="fas fa-plus"></i> اضافة اعلان جديد
                </a>
            </div>
    </div>

    <!-- Charts Row -->
    <div class="row mb-4">
        <div class="col-lg-8 mb-3">
            <div class="card shadow border-0">
                <div class="card-header bg-transparent">
                    <h5 class="mb-0">نمو المستخدمين</h5>
                </div>
                <div class="card-body">
                    <canvas id="userGrowthChart" height="100"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mb-3">
            <div class="card shadow border-0">
                <div class="card-header bg-transparent">
                    <h5 class="mb-0">توزيع الجلسات</h5>
                </div>
                <div class="card-body">
                    <canvas id="sessionPieChart" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Categories Table -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow border-0">
                <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Categories</h5>
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-sm btn-info">
                        <i class="fas fa-plus"></i> Add
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($topCategories  as $category)
                                <tr>
                                    <td>{{ $category['name'] }}</td>
                                    <td>{{ $category['description'] }}</td>
                                    <td>
                                        <a href="{{ route('admin.categories.edit', $category['id']) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.categories.destroy', $category['id']) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash"></i> Delete
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



    <!-- Products Table -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow border-0">
                <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Products</h5>
                    <div class="d-flex align-items-center">
                        <!-- Product Search Form -->
                        <form method="GET" action="{{ route('admin.dashboard') }}" class="me-2 d-flex">
                            <input type="text" name="product_search" class="form-control form-control-sm" placeholder="Search products..." value="{{ request('product_search') }}">
                            <button type="submit" class="btn btn-sm btn-outline-primary ms-2">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                        <a href="{{ route('admin.products.create') }}" class="btn btn-sm btn-secondary">
                            <i class="fas fa-plus"></i> Add
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Image</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentProducts as $product)
                                <tr>
                                    <!-- اسم المنتج -->
                                    <td>{{ $product->name }}</td>
                                
                                    <!-- اسم التصنيف -->
                                    <td>{{ $product->category->name ?? 'No Category' }}</td>
                                
                                    <!-- صورة المنتج -->
                                    <td>
                                        <img src="{{ asset('storage/' . $product->image) }}" 
                                        alt="{{ $product->name }}" 
                                        width="50" height="50">
                                    </td>
                                
                                    <!-- السعر -->
                                    <td>${{ number_format($product->price, 2) }}</td>
                                
                                    <!-- المخزون -->
                                    <td>{{ $product->stock }}</td>
                                
                                    <!-- أزرار التعديل والحذف -->
                                    <td>
                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                @if($recentProducts->isEmpty())
                                <tr>
                                    <td colspan="6" class="text-center">No products found.</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity Table -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow border-0">
                <div class="card-header bg-transparent">
                    <h5 class="mb-0">Recent Activity</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Activity</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentActivities as $activity)
                                <tr>
                                    <td>{{ $activity->user?->name ?? 'System' }}</td>
                                    <td>{{ $activity->activity }}</td>
                                    <td>{{ $activity->created_at->format('Y-m-d H:i') }}</td>
                                    <td>
                                        @if($activity->status == 'Success')
                                            <span class="badge bg-success">Success</span>
                                        @else
                                            <span class="badge bg-danger">Failed</span>
                                        @endif
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
</div>

<!-- Chart.js CDN (if not already included in your layout) -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // User Growth Line Chart
    var ctx = document.getElementById('userGrowthChart').getContext('2d');
    var userGrowthChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($userGrowthLabels ?? ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']) !!},
            datasets: [{
                label: 'Users',
                data: {!! json_encode($userGrowthData ?? [120, 190, 300, 500, 200, 300]) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 2,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
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
            labels: {!! json_encode($sessionLabels ?? ['Desktop', 'Mobile', 'Tablet']) !!},
            datasets: [{
                data: {!! json_encode($sessionData ?? [60, 30, 10]) !!},
                backgroundColor: [
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(255, 205, 86, 0.7)',
                    'rgba(255, 99, 132, 0.7)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });
});
</script>
@endsection
