<x-app-layout>
    @push('styles')
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800&display=swap" rel="stylesheet">
    
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom Styles - Blue Academic Theme -->
    <style>
        :root {
            /* Brand Blue Colors */
            --primary: #2563eb;
            --primary-light: #3b82f6;
            --primary-dark: #1d4ed8;
            --primary-gradient: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            --primary-glow: rgba(37, 99, 235, 0.3);
            
            /* Supporting Colors */
            --secondary: #60a5fa;
            --accent: #93c5fd;
            --background: #f8fafc;
            --surface: #ffffff;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --text-muted: #94a3b8;
            --border: #e2e8f0;
            
            /* Level Colors */
            --level-beginner: #f59e0b;
            --level-intermediate: #10b981;
            --level-advanced: #ef4444;
            
            /* Shadows */
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.15);
            --shadow-lg: 0 10px 25px -5px rgba(37, 99, 235, 0.2);
            --shadow-glow: 0 0 40px rgba(37, 99, 235, 0.25);
        }

        * { scroll-behavior: smooth; }

        body {
            font-family: 'Tajawal', sans-serif;
            background: var(--background);
            color: var(--text-primary);
            overflow-x: hidden;
        }

        /* ============ HERO SECTION - FIXED BACKGROUND ============ */
        .hero-section {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
            padding-top: 100px;
            padding-bottom: 4rem;
            /* ✅ الخلفية الزرقاء المباشرة - لا تعتمد على Tailwind */
            background: var(--primary-gradient);
            overflow: hidden;
        }

        /* Animated Overlay */
        .hero-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: 
                radial-gradient(circle at 20% 80%, rgba(255,255,255,0.15) 0%, transparent 40%),
                radial-gradient(circle at 80% 20%, rgba(255,255,255,0.1) 0%, transparent 40%),
                radial-gradient(circle at 50% 50%, rgba(255,255,255,0.08) 0%, transparent 60%);
            animation: bgMove 20s ease-in-out infinite;
            pointer-events: none;
            z-index: 1;
        }

        @keyframes bgMove {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            25% { transform: translate(2%, 2%) rotate(0.5deg); }
            50% { transform: translate(0, 4%) rotate(0deg); }
            75% { transform: translate(-2%, 2%) rotate(-0.5deg); }
        }

        /* Floating Particles */
        .particles {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            overflow: hidden;
            z-index: 2;
            pointer-events: none;
        }

        .particle {
            position: absolute;
            width: 4px; height: 4px;
            background: rgba(255, 255, 255, 0.6);
            border-radius: 50%;
            animation: float 15s infinite;
            opacity: 0;
        }

        .particle:nth-child(1) { left: 10%; animation-delay: 0s; animation-duration: 12s; }
        .particle:nth-child(2) { left: 20%; animation-delay: 2s; animation-duration: 18s; }
        .particle:nth-child(3) { left: 30%; animation-delay: 4s; animation-duration: 14s; }
        .particle:nth-child(4) { left: 40%; animation-delay: 1s; animation-duration: 16s; }
        .particle:nth-child(5) { left: 50%; animation-delay: 3s; animation-duration: 20s; }
        .particle:nth-child(6) { left: 60%; animation-delay: 5s; animation-duration: 13s; }
        .particle:nth-child(7) { left: 70%; animation-delay: 2s; animation-duration: 17s; }
        .particle:nth-child(8) { left: 80%; animation-delay: 4s; animation-duration: 15s; }
        .particle:nth-child(9) { left: 90%; animation-delay: 1s; animation-duration: 19s; }
        .particle:nth-child(10) { left: 15%; animation-delay: 3s; animation-duration: 14s; }

        @keyframes float {
            0% { transform: translateY(100vh) scale(0); opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { transform: translateY(-100px) scale(1); opacity: 0; }
        }

        /* Hero Content - Above Background */
        .hero-content {
            position: relative;
            z-index: 10;
            text-align: center;
            max-width: 900px;
            margin: 0 auto;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            padding: 0.5rem 1.25rem;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 500;
            margin-bottom: 1.5rem;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            animation: fadeInDown 0.8s ease;
        }

        .hero-badge i { animation: pulse 2s infinite; }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        .hero-title {
            font-size: clamp(2rem, 5vw, 3.5rem);
            font-weight: 800;
            color: white;
            margin-bottom: 1.25rem;
            line-height: 1.3;
            animation: fadeInUp 0.8s ease 0.2s both;
        }

        .hero-title span {
            background: linear-gradient(to right, #fff, #bfdbfe);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-subtitle {
            font-size: clamp(1rem, 2.5vw, 1.25rem);
            color: rgba(255, 255, 255, 0.95);
            margin: 0 auto 2.5rem;
            line-height: 1.8;
            max-width: 700px;
            animation: fadeInUp 0.8s ease 0.4s both;
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
            animation: fadeInUp 0.8s ease 0.6s both;
        }

        .btn-hero-primary {
            background: white;
            color: var(--primary);
            padding: 1rem 2.5rem;
            border-radius: 14px;
            font-weight: 700;
            font-size: 1.05rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-lg);
            border: 2px solid white;
        }

        .btn-hero-primary:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-glow);
        }

        .btn-hero-secondary {
            background: transparent;
            color: white;
            padding: 1rem 2.5rem;
            border-radius: 14px;
            font-weight: 600;
            font-size: 1.05rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            border: 2px solid rgba(255, 255, 255, 0.5);
        }

        .btn-hero-secondary:hover {
            background: rgba(255, 255, 255, 0.15);
            border-color: white;
            transform: translateY(-2px);
        }

        .hero-stats {
            display: flex;
            justify-content: center;
            gap: 2.5rem;
            margin-top: 4rem;
            flex-wrap: wrap;
            animation: fadeInUp 0.8s ease 0.8s both;
        }

        .stat-card {
            text-align: center;
            color: white;
            padding: 1rem 1.5rem;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            min-width: 120px;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-3px);
        }

        .stat-number {
            font-size: 1.75rem;
            font-weight: 800;
            display: block;
            margin-bottom: 0.25rem;
        }

        .stat-label {
            font-size: 0.875rem;
            opacity: 0.9;
        }

        /* Scroll Indicator */
        .scroll-indicator {
            position: absolute;
            bottom: 2rem;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
            color: rgba(255, 255, 255, 0.8);
            animation: bounce 2s infinite;
            cursor: pointer;
            z-index: 10;
        }

        @keyframes bounce {
            0%, 100% { transform: translateX(-50%) translateY(0); }
            50% { transform: translateX(-50%) translateY(10px); }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* ============ SECTION STYLES ============ */
        .section { padding: 5rem 1rem; }

        .section-header {
            text-align: center;
            margin-bottom: 3.5rem;
        }

        .section-title {
            font-size: clamp(1.5rem, 3vw, 2.25rem);
            font-weight: 800;
            color: var(--text-primary);
            margin-bottom: 0.75rem;
            position: relative;
            display: inline-block;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 4px;
            background: var(--primary-gradient);
            border-radius: 2px;
        }

        .section-subtitle {
            color: var(--text-secondary);
            font-size: 1.1rem;
            max-width: 600px;
            margin: 1.5rem auto 0;
            line-height: 1.7;
        }

        /* ============ COURSE CARDS - FIXED LEVEL BADGES ============ */
        .courses-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.75rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        .course-card {
            background: var(--surface);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            display: flex;
            flex-direction: column;
            height: 100%;
            border: 1px solid var(--border);
            position: relative;
        }

        .course-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: var(--primary-gradient);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .course-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-lg), var(--shadow-glow);
            border-color: var(--secondary);
        }

        .course-card:hover::before { opacity: 1; }

        .course-image {
            position: relative;
            height: 180px;
            overflow: hidden;
            background: linear-gradient(135deg, var(--primary-light), var(--primary-dark));
        }

        .course-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .course-card:hover .course-image img { transform: scale(1.08); }

        .course-image-placeholder {
            width: 100%; height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 3rem;
            opacity: 0.8;
        }

        /* ✅ شارات المستوى - منطق محسّن */
        .course-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            padding: 0.35rem 0.875rem;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.3rem;
            z-index: 5;
        }

        [dir="rtl"] .course-badge { right: auto; left: 1rem; }

        .course-badge.beginner {
            background: var(--level-beginner);
            color: white;
        }

        .course-badge.intermediate {
            background: var(--level-intermediate);
            color: white;
        }

        .course-badge.advanced {
            background: var(--level-advanced);
            color: white;
        }

        .course-content {
            padding: 1.25rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .course-title {
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.75rem;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .course-card:hover .course-title { color: var(--primary); }

        .course-description {
            color: var(--text-secondary);
            font-size: 0.925rem;
            line-height: 1.6;
            margin-bottom: 1rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            flex: 1;
        }

        .course-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 1rem;
            border-top: 1px solid var(--border);
            margin-top: auto;
        }

        .course-price {
            font-size: 1.25rem;
            font-weight: 800;
            color: var(--primary);
        }

        .course-duration {
            display: flex;
            align-items: center;
            gap: 0.35rem;
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        .course-actions {
            display: flex;
            gap: 0.5rem;
        }

        .btn-course {
            padding: 0.5rem 1rem;
            border-radius: 10px;
            font-size: 0.85rem;
            font-weight: 500;
            cursor: pointer;
            border: none;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-course-edit { background: var(--primary); color: white; }
        .btn-course-edit:hover { background: var(--primary-dark); }

        .btn-course-delete { background: var(--level-advanced); color: white; }
        .btn-course-delete:hover { background: #dc2626; }

        .view-all-container {
            text-align: center;
            margin-top: 3rem;
        }

        .btn-view-all {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--primary-gradient);
            color: white;
            padding: 0.875rem 2rem;
            border-radius: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: var(--shadow);
        }

        .btn-view-all:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-glow);
        }

        [dir="rtl"] .btn-view-all i { transform: rotate(180deg); }

        /* ============ BLOG SECTION ============ */
        .blog-section { background: var(--surface); }

        .blog-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            max-width: 1000px;
            margin: 0 auto;
        }

        .blog-card {
            background: var(--background);
            border-radius: 16px;
            padding: 1.5rem;
            border-right: 4px solid var(--primary);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        [dir="rtl"] .blog-card {
            border-right: none;
            border-left: 4px solid var(--primary);
        }

        .blog-card:hover {
            transform: translateX(5px);
            box-shadow: var(--shadow);
        }

        [dir="rtl"] .blog-card:hover { transform: translateX(-5px); }

        .blog-date {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            color: var(--text-muted);
            font-size: 0.85rem;
            margin-bottom: 0.75rem;
        }

        .blog-title {
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.75rem;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            transition: color 0.3s ease;
            cursor: pointer;
        }

        .blog-card:hover .blog-title { color: var(--primary); }

        .blog-excerpt {
            color: var(--text-secondary);
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 1rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .blog-link {
            color: var(--primary);
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            transition: gap 0.3s ease;
        }

        .blog-link:hover { gap: 0.6rem; }

        /* ============ BACK TO TOP ============ */
        .back-to-top {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--primary-gradient);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            box-shadow: var(--shadow-lg);
            transition: all 0.3s ease;
            z-index: 100;
            opacity: 0;
            visibility: hidden;
        }

        [dir="rtl"] .back-to-top { right: auto; left: 2rem; }

        .back-to-top.visible {
            opacity: 1;
            visibility: visible;
        }

        .back-to-top:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-glow);
        }

        /* ============ RESPONSIVE ============ */
        @media (max-width: 768px) {
            .hero-section { padding-top: 120px; }
            .hero-buttons { flex-direction: column; align-items: center; }
            .btn-hero-primary, .btn-hero-secondary {
                width: 100%; max-width: 280px; justify-content: center;
            }
            .hero-stats { gap: 1rem; }
            .stat-card { min-width: 100px; padding: 0.75rem 1rem; }
            .stat-number { font-size: 1.4rem; }
            .section { padding: 3rem 1rem; }
            .courses-grid { grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 1.25rem; }
        }

        /* ============ RTL SUPPORT ============ */
        [dir="rtl"] { direction: rtl; text-align: right; }
        [dir="rtl"] .course-meta { flex-direction: row-reverse; }
        [dir="rtl"] .course-actions { flex-direction: row-reverse; }
    </style>
    @endpush

    <!-- Hero Section - FIXED: Direct gradient background -->
    <section class="hero-section">
        <!-- Floating Particles -->
        <div class="particles">
            @for ($i = 0; $i < 10; $i++)
                <div class="particle"></div>
            @endfor
        </div>
        
        <div class="hero-content">
            <h1 class="hero-title">
                {{ __('Welcome to') }} <span>{{ config('app.name') }}</span>
            </h1>
            
            <p class="hero-subtitle">
                {{ __('Learn new skills, take a step in your career, and achieve your goals with our courses guided by experts.') }}
            </p>
            
            <div class="hero-buttons">
                <a href="{{ route('courses.index') }}" class="btn-hero-primary">
                    <i class="fas fa-book-open"></i>
                    {{ __('Browse Courses') }}
                </a>
                <a href="#latest-courses" class="btn-hero-secondary">
                    <i class="fas fa-play-circle"></i>
                    {{ __('Watch Demo') }}
                </a>
            </div>
            
            <div class="hero-stats">
                <div class="stat-card">
                    <span class="stat-number" data-count="{{ $courses->count() }}">0</span>
                    <span class="stat-label">{{ __('Courses') }}</span>
                </div>
                <div class="stat-card">
                    <span class="stat-number" data-count="{{ $usercount }}">0</span>
                    <span class="stat-label">{{ __('Students') }}</span>
                </div>
                <div class="stat-card">
                    <span class="stat-number" data-count="50">0</span>
                    <span class="stat-label">{{ __('Experts') }}</span>
                </div>
            </div>
        </div>
        
        <!-- Scroll Indicator -->
        <a href="#latest-courses" class="scroll-indicator" aria-label="{{ __('Scroll down') }}">
            <i class="fas fa-chevron-down"></i>
            <span>{{ __('Scroll') }}</span>
        </a>
    </section>

    <!-- Featured Courses Section -->
    <section class="section" id="latest-courses">
        <div class="container mx-auto px-4">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">{{ __('Latest Courses') }}</h2>
                <p class="section-subtitle">
                    {{ __('Discover our newest courses designed to help you master in-demand skills') }}
                </p>
            </div>
            
            <div class="courses-grid">
                @foreach ($courses->take(8) as $course)
                <article class="course-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <!-- Course Image -->
                    <div class="course-image">
                        @if($course->thumbnail_url)
                            <img src="{{ Storage::url($course->thumbnail_url) }}" alt="{{ $course->title }}" loading="lazy" onerror="this.parentElement.innerHTML='<div class=\'course-image-placeholder\'><i class=\'fas fa-book\'></i></div>'">
                        @else
                            <div class="course-image-placeholder">
                                <i class="fas fa-book"></i>
                            </div>
                        @endif
                        
                        <!-- ✅ Level Badge - FIXED LOGIC -->
                        @php
                            $level = trim($course->level ?? '');
                            $levelClass = match($level) {
                                'مبتدئ', 'beginner', 'Beginner' => 'beginner',
                                'متوسط', 'intermediate', 'Intermediate' => 'intermediate',
                                'متقدم', 'advanced', 'Advanced' => 'advanced',
                                default => 'beginner'
                            };
                            $levelIcon = match($levelClass) {
                                'beginner' => 'fa-seedling',
                                'intermediate' => 'fa-chart-line',
                                'advanced' => 'fa-rocket',
                                default => 'fa-seedling'
                            };
                            $levelLabel = match($levelClass) {
                                'beginner' => __('Beginner'),
                                'intermediate' => __('Intermediate'),
                                'advanced' => __('Advanced'),
                                default => __('Beginner')
                            };
                        @endphp
                        
                        <span class="course-badge {{ $levelClass }}">
                            <i class="fas {{ $levelIcon }}"></i> {{ $levelLabel }}
                        </span>
                    </div>
                    
                    <!-- Course Content -->
                    <div class="course-content">
                        <h3 class="course-title" onclick="window.location.href='{{ route('courses.show', $course->id) }}'">
                            {{ $course->title }}
                        </h3>
                        
                        <p class="course-description">
                            {{ Str::limit($course->description, 100) }}
                        </p>
                        
                        <div class="course-meta">
                            <div>
                                <span class="course-price">${{ number_format($course->price, 2) }}</span>
                            </div>
                            <div class="course-duration">
                                <i class="far fa-clock"></i>
                                {{ $course->duration_hours }} {{ $course->duration_hours > 1 ? __('hours') : __('hour') }}
                            </div>
                            
                            <!-- Admin Actions -->
                            @auth
                                @if(auth()->user()->is_admin())
                                    <div class="course-actions">
                                        <a href="{{ route('admin.courses.edit', $course->id) }}" class="btn-course btn-course-edit" title="{{ __('Edit') }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.courses.delete', $course->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure?') }}')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn-course btn-course-delete" title="{{ __('Delete') }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            @endauth
                        </div>
                    </div>
                </article>
                @endforeach
            </div>
            
            <!-- View All Button -->
            <div class="view-all-container" data-aos="fade-up">
                <a href="{{ route('courses.index') }}" class="btn-view-all">
                    {{ __('View All Courses') }}
                    <i class="fas fa-arrow-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Latest Blog Posts Section -->
    <section class="section blog-section">
        <div class="container mx-auto px-4">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">{{ __('Latest Posts') }}</h2>
                <p class="section-subtitle">
                    {{ __('Stay updated with educational insights, tips, and industry news') }}
                </p>
            </div>
            
            <div class="blog-grid">
                @foreach ($posts->take(4) as $post)
                <article class="blog-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="blog-date">
                        <i class="far fa-calendar"></i>
                        {{ $post->created_at->format('M d, Y') }}
                    </div>
                    
                    <h3 class="blog-title" onclick="window.location.href='{{ route('posts.show', $post->id) }}'">
                        {{ $post->title }}
                    </h3>
                    
                    <p class="blog-excerpt">
                        {{ Str::limit(strip_tags($post->body), 120) }}
                    </p>
                    
                    <a href="{{ route('posts.show', $post->id) }}" class="blog-link">
                        {{ __('Read More') }}
                        <i class="fas fa-arrow-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}"></i>
                    </a>
                </article>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ✅ CTA Section REMOVED as requested -->

    <!-- Back to Top Button -->
    <a href="#" class="back-to-top" id="backToTop" aria-label="{{ __('Back to top') }}">
        <i class="fas fa-arrow-up"></i>
    </a>

    @push('scripts')
    <!-- AOS Animation Library -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize AOS
            AOS.init({ duration: 700, once: true, offset: 50, easing: 'ease-out' });
            
            // Counter Animation for Stats
            animateCounters();
            
            // Back to Top Button
            setupBackToTop();
            
            // Smooth Scroll for Anchor Links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }
                });
            });
        });
        
        // Animate Counter Numbers
        function animateCounters() {
            const counters = document.querySelectorAll('.stat-number[data-count]');
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const counter = entry.target;
                        const target = +counter.getAttribute('data-count');
                        const duration = 2000;
                        const increment = target / (duration / 16);
                        let current = 0;
                        
                        const updateCounter = () => {
                            current += increment;
                            if (current < target) {
                                counter.textContent = Math.floor(current).toLocaleString('ar-EG');
                                requestAnimationFrame(updateCounter);
                            } else {
                                counter.textContent = target.toLocaleString('ar-EG') + (target >= 1000 ? '+' : '');
                            }
                        };
                        
                        updateCounter();
                        observer.unobserve(counter);
                    }
                });
            }, { threshold: 0.5 });
            
            counters.forEach(counter => observer.observe(counter));
        }
        
        // Back to Top Functionality
        function setupBackToTop() {
            const btn = document.getElementById('backToTop');
            
            window.addEventListener('scroll', () => {
                if (window.pageYOffset > 400) {
                    btn.classList.add('visible');
                } else {
                    btn.classList.remove('visible');
                }
            });
            
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        }
    </script>
    @endpush
</x-app-layout>