<!DOCTYPE html>
<html lang="ar" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title ?? config('app.name', 'كابتن كورة') }}</title>
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.min.css">
        <style>
            :root {
                --primary: #667eea;
                --secondary: #764ba2;
                --accent: #f093fb;
                --success: #4facfe;
                --warning: #f093fb;
                --danger: #ff6b6b;
                --info: #4ecdc4;
                --dark: #2c3e50;
                --light: #f8f9fa;
                --white: #ffffff;
                --text: #2c3e50;
                --text-light: #6c757d;
                --border: #e9ecef;
                --shadow: 0 10px 30px rgba(0,0,0,0.1);
                --shadow-lg: 0 20px 60px rgba(0,0,0,0.15);
                --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                --gradient-success: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
                --gradient-warning: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
                --gradient-info: linear-gradient(135deg, #4ecdc4 0%, #44a08d 100%);
            }
            
            * { 
                margin: 0; 
                padding: 0; 
                box-sizing: border-box; 
            }
            
            html { 
                scroll-behavior: smooth; 
            }
            
            body { 
                font-family: 'Inter', 'Segoe UI', -apple-system, BlinkMacSystemFont, sans-serif; 
                line-height: 1.6; 
                color: var(--text); 
                background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
                min-height: 100vh;
                overflow-x: hidden;
            }
            
            .container { 
                max-width: 1400px; 
                margin: 0 auto; 
                padding: 0 20px; 
            }
            
            /* Header */
            header { 
                position: sticky; 
                top: 0; 
                background: var(--gradient-primary);
                color: white; 
                z-index: 1000; 
                box-shadow: var(--shadow);
                backdrop-filter: blur(10px);
            }
            
            .navbar { 
                display: flex; 
                justify-content: space-between; 
                align-items: center; 
                padding: 1rem 2rem; 
                gap: 1rem;
                position: relative;
            }
            
            .brand { 
                font-weight: 800; 
                font-size: 1.5rem;
                background: linear-gradient(45deg, #fff, #f0f0f0);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                text-shadow: 0 2px 4px rgba(0,0,0,0.1);
            }
            
            .brand-content {
                display: flex;
                align-items: center;
                gap: 12px;
            }
            
            .captain-avatar {
                width: 45px;
                height: 45px;
                border-radius: 50%;
                overflow: hidden;
                border: 3px solid rgba(255, 255, 255, 0.3);
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
                transition: all 0.3s ease;
            }
            
            .captain-avatar:hover {
                transform: scale(1.05);
                box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
                border-color: rgba(255, 255, 255, 0.6);
            }
            
            .captain-image {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform 0.3s ease;
            }
            
            .captain-avatar:hover .captain-image {
                transform: scale(1.1);
            }
            
            .captain-name {
                font-weight: 700;
                font-size: 1.4rem;
                background: linear-gradient(45deg, #fff, #f0f0f0);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                text-shadow: 0 2px 4px rgba(0,0,0,0.1);
            }
            
            .navbar ul { 
                list-style: none; 
                display: flex; 
                gap: 1rem; 
                margin: 0; 
                padding: 0; 
            }
            
            .navbar a, .navbar button { 
                color: white; 
                text-decoration: none; 
                padding: 0.75rem 1.5rem; 
                border-radius: 25px; 
                transition: all 0.3s ease;
                background: transparent;
                border: 0;
                cursor: pointer;
                font-weight: 500;
                position: relative;
                overflow: hidden;
            }
            
            .navbar a::before, .navbar button::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
                transition: left 0.5s;
            }
            
            .navbar a:hover::before, .navbar button:hover::before {
                left: 100%;
            }
            
            .navbar a:hover, .navbar button:hover { 
                background: rgba(255,255,255,0.1);
                transform: translateY(-2px);
            }
            
            /* Mobile Menu */
            .menu-toggle{ 
                display: none; 
                width: 50px; 
                height: 50px; 
                border-radius: 12px; 
                border: 2px solid rgba(255,255,255,0.2); 
                align-items: center; 
                justify-content: center;
                background: rgba(255,255,255,0.1);
                transition: all 0.3s ease;
            }
            
            .menu-toggle:hover {
                background: rgba(255,255,255,0.2);
                transform: scale(1.05);
            }
            
            .menu-toggle svg{ 
                pointer-events: none;
                width: 24px;
                height: 24px;
            }
            
            .mobile-menu{ 
                display: none; 
                background: var(--gradient-primary);
                border-top: 1px solid rgba(255,255,255,0.1);
                backdrop-filter: blur(10px);
            }
            
            .mobile-menu a{ 
                display: block; 
                padding: 1rem 2rem;
                color: white;
                text-decoration: none;
                transition: all 0.3s ease;
                border-bottom: 1px solid rgba(255,255,255,0.1);
            }
            
            .mobile-menu a:hover {
                background: rgba(255,255,255,0.1);
                padding-right: 2.5rem;
            }
            
            @media (max-width: 860px){
                .navbar ul.primary{ 
                    display: none; 
                }
                .menu-toggle{ 
                    display: flex; 
                }
                .mobile-menu{ 
                    display: block; 
                }
                .navbar {
                    padding: 1rem;
                }
                .brand-content {
                    gap: 8px;
                }
                .captain-avatar {
                    width: 35px;
                    height: 35px;
                }
                .captain-name {
                    font-size: 1.2rem;
                }
            }
            
            /* Buttons */
            .btn { 
                background: var(--gradient-primary);
                color: white; 
                padding: 0.75rem 1.5rem; 
                border: none; 
                border-radius: 50px; 
                cursor: pointer; 
                transition: all 0.3s ease;
                font-weight: 600;
                text-decoration: none;
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                box-shadow: var(--shadow);
                position: relative;
                overflow: hidden;
            }
            
            .btn::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
                transition: left 0.5s;
            }
            
            .btn:hover::before {
                left: 100%;
            }
            
            .btn:hover { 
                transform: translateY(-3px);
                box-shadow: var(--shadow-lg);
            }
            
            .btn-outline{ 
                background: transparent; 
                color: var(--primary); 
                border: 2px solid var(--primary);
                box-shadow: none;
            }
            
            .btn-outline:hover{ 
                background: var(--primary); 
                color: white;
                transform: translateY(-3px);
            }
            
            /* Cards */
            .card { 
                background: white; 
                padding: 2rem; 
                border-radius: 20px; 
                box-shadow: var(--shadow);
                margin-bottom: 2rem;
                border: 1px solid var(--border);
                position: relative;
                overflow: hidden;
                transition: all 0.3s ease;
            }
            
            .card::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 4px;
                background: var(--gradient-primary);
            }
            
            .card:hover {
                transform: translateY(-5px);
                box-shadow: var(--shadow-lg);
            }
            
            /* Forms */
            .form-group { 
                margin-bottom: 1.5rem; 
            }
            
            .form-label { 
                display: block; 
                margin-bottom: 0.75rem; 
                font-weight: 600;
                color: var(--text);
                font-size: 0.95rem;
            }
            
            .form-control { 
                width: 100%; 
                padding: 1rem; 
                border: 2px solid var(--border); 
                border-radius: 12px; 
                font-size: 1rem;
                transition: all 0.3s ease;
                background: white;
            }
            
            .form-control:focus {
                outline: none;
                border-color: var(--primary);
                box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
                transform: translateY(-2px);
            }
            
            /* Tables */
            table { 
                width: 100%; 
                border-collapse: collapse; 
                margin-top: 1.5rem;
                background: white;
                border-radius: 15px;
                overflow: hidden;
                box-shadow: var(--shadow);
            }
            
            th, td { 
                padding: 1rem; 
                text-align: left; 
                border-bottom: 1px solid var(--border);
            }
            
            th { 
                background: var(--gradient-primary);
                color: white;
                font-weight: 600;
                text-transform: uppercase;
                font-size: 0.85rem;
                letter-spacing: 0.5px;
            }
            
            tr:hover {
                background: rgba(102, 126, 234, 0.05);
            }
            
            /* Footer */
            footer { 
                background: var(--gradient-primary);
                color: white; 
                text-align: center; 
                padding: 3rem 0; 
                margin-top: 4rem;
                position: relative;
                overflow: hidden;
            }
            
            footer::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 1px;
                background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            }
            
            .social { 
                display: flex; 
                gap: 1rem; 
                justify-content: center; 
                align-items: center; 
                margin-top: 1.5rem; 
            }
            
            .social a{ 
                width: 50px; 
                height: 50px; 
                border-radius: 50%; 
                display: flex; 
                align-items: center; 
                justify-content: center; 
                color: white; 
                text-decoration: none;
                transition: all 0.3s ease;
                box-shadow: var(--shadow);
            }
            
            .social a:hover {
                transform: translateY(-3px) scale(1.1);
                box-shadow: var(--shadow-lg);
            }
            
            .social .whatsapp{ 
                background: linear-gradient(135deg, #25D366, #128C7E);
            }
            
            .social .facebook{ 
                background: linear-gradient(135deg, #1877F2, #0A5F9A);
            }
            
            
            /* Animations */
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            
            @keyframes pulse {
                0% { transform: scale(1); }
                50% { transform: scale(1.05); }
                100% { transform: scale(1); }
            }
            
            .animate-fadeInUp {
                animation: fadeInUp 0.6s ease-out;
            }
            
            .animate-pulse {
                animation: pulse 2s infinite;
            }
            
            /* Scrollbar */
            ::-webkit-scrollbar {
                width: 8px;
            }
            
            ::-webkit-scrollbar-track {
                background: var(--light);
            }
            
            ::-webkit-scrollbar-thumb {
                background: var(--gradient-primary);
                border-radius: 4px;
            }
            
            ::-webkit-scrollbar-thumb:hover {
                background: var(--secondary);
            }
        </style>
        @stack('styles')
    </head>
    <body>
        <header>
            <nav class="navbar container">
                <div class="brand">
                    <div class="brand-content">
                        <div class="captain-avatar">
                            <img src="{{ asset('photo_2025-01-18_01-41-00.jpg') }}" alt="Ragab Elwageh" class="captain-image">
                        </div>
                        <span class="captain-name">Ragab Elwageh</span>
                    </div>
                </div>
                <button class="menu-toggle" id="menuToggle" aria-label="القائمة">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 6h18v2H3V6zm0 5h18v2H3v-2zm0 5h18v2H3v-2z" fill="#fff"/></svg>
                </button>
                <ul class="primary">
                    <li><a href="{{ url('/#home') }}">الرئيسية</a></li>
                    <li><a href="{{ url('/#ranking') }}">الترتيب</a></li>
                    <li><a href="{{ url('/#contact') }}">التواصل</a></li>
                    
                    @auth
                        <li><a href="{{ route('admin.news.index') }}">إدارة الأخبار</a></li>
                        <li><a href="{{ route('admin.ranking.index') }}">إدارة الترتيب</a></li>
                        <li><a href="{{ route('admin.images.index') }}">إدارة القنوات</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" style="display:inline">
                                @csrf
                                <button type="submit" title="تسجيل الخروج" aria-label="تسجيل الخروج" style="display:inline-flex;align-items:center;gap:8px">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M16 17l5-5-5-5v3H9v4h7v3zM4 5h7V3H4c-1.1 0-2 .9-2 2v14a2 2 0 002 2h7v-2H4V5z" fill="#fff"/></svg>
                                </button>
                            </form>
                        </li>
                    @endauth
                </ul>
            </nav>
            <div class="mobile-menu" id="mobileMenu">
                <a href="{{ url('/#home') }}">الرئيسية</a>
                <a href="{{ url('/#ranking') }}">الترتيب</a>
                <a href="{{ url('/#contact') }}">التواصل</a>
                @auth
                    <a href="{{ route('admin.news.index') }}">إدارة الأخبار</a>
                    <a href="{{ route('admin.ranking.index') }}">إدارة الترتيب</a>
                    <form method="POST" action="{{ route('logout') }}" style="border-top:1px solid rgba(255,255,255,.08)">
                        @csrf
                        <button type="submit" style="width:100%; text-align:right; padding:12px 20px">تسجيل الخروج</button>
                    </form>
                @endauth
            </div>
        </header>

        <main class="container">
            @yield('content')
        </main>


        <footer id="contact">
            <div>© {{ date('Y') }} موقع كرة القدم. جميع الحقوق محفوظة.</div>
            <div class="social" style="margin-top:12px">
                <a class="whatsapp" href="https://wa.me/201271889673" target="_blank" aria-label="WhatsApp">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20.52 3.48A11.79 11.79 0 0012 0C5.37 0 0 5.37 0 12c0 2.1.54 4.08 1.5 5.82L0 24l6.39-1.47A11.93 11.93 0 0012 24c6.63 0 12-5.37 12-12 0-3.18-1.26-6.09-3.48-8.52zM12 21.6a9.57 9.57 0 01-4.89-1.35l-.36-.21-3.78.87.81-3.69-.24-.39A9.61 9.61 0 1121.6 12c0 5.28-4.32 9.6-9.6 9.6zm5.52-7.41c-.3-.15-1.77-.87-2.04-.96-.27-.09-.48-.15-.69.15s-.78.96-.96 1.17-.36.21-.66.06c-.3-.15-1.26-.45-2.4-1.44a8.91 8.91 0 01-1.65-2.04c-.18-.3 0-.45.12-.6.12-.12.27-.3.39-.45.12-.15.18-.24.27-.39.09-.15.06-.3 0-.45-.06-.15-.69-1.65-.94-2.25-.24-.57-.48-.48-.69-.48h-.6c-.21 0-.45.06-.69.33-.24.27-.9.87-.9 2.13s.9 2.46 1.02 2.64c.12.18 1.77 2.7 4.29 3.78.6.27 1.05.42 1.41.54.6.18 1.14.15 1.56.09.48-.06 1.77-.72 2.01-1.41.24-.69.24-1.29.18-1.41-.06-.12-.24-.18-.54-.33z" fill="#fff"/>
                    </svg>
                </a>
                <a class="facebook" href="https://www.facebook.com/profile.php?id=100009692892743" target="_blank" aria-label="Facebook">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M22.675 0h-21.35C.595 0 0 .594 0 1.326v21.348C0 23.406.595 24 1.325 24h11.49v-9.294H9.691v-3.622h3.124V8.413c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.796.715-1.796 1.763v2.313h3.587l-.467 3.622h-3.12V24h6.116C23.406 24 24 23.406 24 22.674V1.326C24 .594 23.406 0 22.675 0z" fill="#fff"/>
                    </svg>
                </a>
            </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.all.min.js"></script>
        <script>
            // ضبط افتراضي عربي لـ SweetAlert عبر الموقع
            const SwalAr = Swal.mixin({
                confirmButtonText: 'موافق',
                cancelButtonText: 'إلغاء',
                showCancelButton: false,
                reverseButtons: true,
                buttonsStyling: true
            });
            window.Swal = SwalAr;

            // عرض SweetAlert للرسائل من السيرفر
            @if(session('sweetalert'))
                Swal.fire({
                    title: '{{ session('sweetalert.title') }}',
                    text: '{{ session('sweetalert.message') }}',
                    icon: '{{ session('sweetalert.type') }}',
                    confirmButtonText: 'موافق',
                    confirmButtonColor: '#4CAF50',
                    timer: 3000,
                    timerProgressBar: true
                });
            @endif

            // تأكيد عام للنماذج التي عليها data-confirm
            document.addEventListener('DOMContentLoaded', function(){
                document.querySelectorAll('form[data-confirm]')?.forEach(function(f){
                    f.addEventListener('submit', function(e){
                        e.preventDefault();
                        Swal.fire({
                            title: f.getAttribute('data-title') || 'تأكيد الإجراء',
                            text: f.getAttribute('data-text') || 'هل أنت متأكد؟',
                            icon: 'warning',
                            showCancelButton: true
                        }).then(function(r){ if(r.isConfirmed){ f.submit(); } });
                    });
                // فتح/إغلاق القائمة للموبايل
                const mt = document.getElementById('menuToggle');
                const mm = document.getElementById('mobileMenu');
                if (mt && mm){
                    mt.addEventListener('click', function(){ mm.style.display = mm.style.display === 'block' ? 'none' : 'block'; });
                }
                });

                // أزيلت أكواد تبديل المظهر
            });
        </script>
        @stack('scripts')
    </body>
</html>


