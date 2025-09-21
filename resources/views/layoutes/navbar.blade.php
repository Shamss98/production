<nav class="navbar">
    <style>
        .navbar { position: sticky; top: 0; z-index: 50; background: #ffffff; border-bottom: 1px solid #e5e7eb; }
        .navbar .container { max-width: 1200px; margin: 0 auto; padding: 0.5rem 1rem; display: flex; align-items: center; justify-content: space-between; gap: 1rem; }
        .navbar .brand { font-weight: 700; font-size: 1.25rem; color: #111827; text-decoration: none; }
        .navbar .toggle { display: none; background: none; border: 0; padding: 0.25rem; cursor: pointer; }
        .navbar .toggle svg { width: 28px; height: 28px; color: #374151; }
        .navbar .nav-links { display: flex; align-items: center; gap: 1rem; flex: 1; justify-content: space-between; }
        .navbar .search { flex: 1; max-width: 520px; }
        .navbar .search form { display: flex; align-items: center; gap: 0.5rem; }
        .navbar .search input { width: 100%; padding: 0.5rem 0.75rem; border: 1px solid #d1d5db; border-radius: 6px; }
        .navbar .links, .navbar .actions { display: flex; align-items: center; gap: 0.75rem; list-style: none; margin: 0; padding: 0; }
        .navbar a { text-decoration: none; color: #374151; padding: 0.25rem 0.5rem; border-radius: 6px; }
        .navbar a:hover { background: #f3f4f6; }
        @media (max-width: 768px) {
            .navbar .toggle { display: inline-flex; }
            .navbar .nav-links { display: none; flex-direction: column; align-items: stretch; gap: 0.75rem; padding: 0.75rem 0; }
            .navbar .nav-links.open { display: flex; }
            .navbar .search { order: 2; max-width: none; }
            .navbar .links, .navbar .actions { flex-direction: column; align-items: stretch; gap: 0.25rem; }
        }
    </style>
    <div class="container">
        <a class="brand" href="{{ url('/') }}" style="color: #2563eb; padding: 0.5rem 1rem; border-radius: 10px; font-size: 1.35rem; font-weight: bold; background: #f3f4f6; box-shadow: 0 2px 8px rgba(37,99,235,0.08);">
            السوق
        </a>
        <button class="toggle" id="navToggle" aria-label="Toggle navigation" aria-expanded="false">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </button>
        <div class="nav-links" id="navMenu">
            <div class="search">
                <form action="{{ url('/search') }}" method="GET">
                    <input type="text" name="q" placeholder="Search products..." value="{{ request('q') }}">
                </form>
            </div>
            <ul class="links">
                <li><a href="{{ route('index') }}">الرئيسية</a></li>
                <li><a href="{{ route('products.index') }}">المنتجات</a></li>
                <li><a href="{{ url('/offers') }}">العروض</a></li>
                <li><a href="{{ url('/contact') }}">اتصل بنا</a></li>
            </ul>
            <ul class="actions">
                <li>
                    @auth
                        <a href="{{ url('/cart') }}">
                            <i class="fas fa-shopping-cart" style="margin-left: 4px;"></i> 
                        </a>
                    @else
                        <a href="{{ url('/cartmessage') }}">
                            <i class="fas fa-shopping-cart" style="margin-left: 4px;"></i> 
                        </a>
                    @endauth
                </li>
                @auth
                    @if(auth()->user()->role === 'admin')
                        <li>
                            <a href="{{ route('admin.dashboard') }}" style="color: #2563eb; font-weight: bold;">
                                لوحة التحكم
                            </a>
                        </li>
                    @endif
                    <li><a href="{{ route('profile') }}">الملف الشخصي</a></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                            @csrf
                            <button 
                                type="submit" 
                                style="
                                    background: linear-gradient(90deg, #f43f5e 0%, #f59e42 100%);
                                    border: 2px solid #f43f5e;
                                    color: #fff;
                                    padding: 0.25rem 0.75rem;
                                    border-radius: 8px;
                                    cursor: pointer;
                                    font-weight: bold;
                                    box-shadow: 0 2px 8px rgba(244,63,94,0.08);
                                    transition: 
                                        background 0.3s cubic-bezier(.4,0,.2,1), 
                                        border-color 0.3s cubic-bezier(.4,0,.2,1), 
                                        transform 0.2s cubic-bezier(.4,0,.2,1),
                                        box-shadow 0.3s cubic-bezier(.4,0,.2,1);
                                "
                                onmouseover="this.style.background='linear-gradient(90deg, #f59e42 0%, #f43f5e 100%)';this.style.borderColor='#f59e42';this.style.transform='scale(1.07)';this.style.boxShadow='0 4px 16px rgba(245,158,66,0.15)';"
                                onmouseout="this.style.background='linear-gradient(90deg, #f43f5e 0%, #f59e42 100%)';this.style.borderColor='#f43f5e';this.style.transform='scale(1)';this.style.boxShadow='0 2px 8px rgba(244,63,94,0.08)';"
                            >
                                اطلع برا🚪
                            </button>
                        </form>
                    </li>
                @else
                    <li><a href="{{ url('/login') }}">تسجيل الدخول</a></li>
                    <li><a href="{{ url('/register') }}">انشاء حساب</a></li>
                @endauth
            </ul>
        </div>
    </div>
    <script>
        (function() {
            var toggle = document.getElementById('navToggle');
            var menu = document.getElementById('navMenu');
            if (toggle && menu) {
                toggle.addEventListener('click', function() {
                    var isOpen = menu.classList.toggle('open');
                    this.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
                });
            }
        })();
    </script>
</nav>

