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
            
            /* Supporting Colors */
            --secondary: #60a5fa;
            --accent: #93c5fd;
            --background: #f8fafc;
            --surface: #ffffff;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --text-muted: #94a3b8;
            --border: #e2e8f0;
            
            /* Shadows */
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.1);
            --shadow-lg: 0 10px 25px -5px rgba(37, 99, 235, 0.15);
            --shadow-hover: 0 20px 40px -10px rgba(37, 99, 235, 0.25);
        }

        * {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Tajawal', sans-serif;
            background: var(--background);
            color: var(--text-primary);
            line-height: 1.6;
        }

        /* Hero Section - Clean Blue */
        .hero-section {
            background: var(--primary-gradient);
            position: relative;
            padding: 80px 0 100px;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 80%, rgba(255,255,255,0.15) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255,255,255,0.1) 0%, transparent 50%);
            pointer-events: none;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
            max-width: 700px;
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
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 1.5rem;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .hero-title {
            font-size: clamp(2rem, 5vw, 2.75rem);
            font-weight: 800;
            color: white;
            margin-bottom: 1rem;
            line-height: 1.3;
        }

        .hero-subtitle {
            font-size: clamp(1rem, 2.5vw, 1.125rem);
            color: rgba(255, 255, 255, 0.95);
            margin-bottom: 2rem;
            line-height: 1.7;
        }

        .hero-stats {
            display: flex;
            justify-content: center;
            gap: 2.5rem;
            flex-wrap: wrap;
        }

        .stat-item {
            text-align: center;
            color: white;
        }

        .stat-number {
            font-size: 1.5rem;
            font-weight: 700;
            display: block;
            margin-bottom: 0.25rem;
        }

        .stat-label {
            font-size: 0.875rem;
            opacity: 0.9;
        }

        /* Search Bar - Clean Blue */
        .search-container {
            max-width: 650px;
            margin: -35px auto 3rem;
            position: relative;
            z-index: 10;
            padding: 0 1rem;
        }

        .search-box {
            background: var(--surface);
            border-radius: 16px;
            padding: 0.75rem;
            box-shadow: var(--shadow-lg);
            display: flex;
            gap: 0.5rem;
            border: 2px solid var(--border);
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .search-box:focus-within {
            border-color: var(--primary);
            box-shadow: var(--shadow-hover);
        }

        .search-input {
            flex: 1;
            padding: 0.875rem 1.25rem;
            border: none;
            border-radius: 12px;
            font-family: inherit;
            font-size: 0.95rem;
            background: transparent;
            color: var(--text-primary);
            transition: all 0.3s ease;
        }

        .search-input::placeholder {
            color: var(--text-muted);
        }

        .search-input:focus {
            outline: none;
        }

        .search-btn {
            background: var(--primary);
            color: white;
            padding: 0.875rem 1.5rem;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .search-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
        }

        .search-btn:active {
            transform: translateY(0);
        }

        /* Blog Cards - Clean Academic Style */
        .posts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
            gap: 1.5rem;
            padding: 0 1rem;
        }

        .blog-card {
            background: var(--surface);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
            height: 100%;
            border: 1px solid var(--border);
            position: relative;
        }

        .blog-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-hover);
            border-color: var(--secondary);
        }

        .blog-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--primary-gradient);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .blog-card:hover::before {
            opacity: 1;
        }

        .card-content {
            padding: 1.5rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .card-date {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            color: var(--text-muted);
            font-size: 0.875rem;
            margin-bottom: 1rem;
            padding: 0.35rem 0.75rem;
            background: #eff6ff;
            border-radius: 6px;
            width: fit-content;
        }

        .card-date i {
            color: var(--primary);
            font-size: 0.8rem;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.875rem;
            line-height: 1.45;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            transition: color 0.3s ease;
        }

        .blog-card:hover .card-title {
            color: var(--primary);
        }

        .card-title a {
            color: inherit;
            text-decoration: none;
        }

        .card-excerpt {
            color: var(--text-secondary);
            font-size: 0.975rem;
            line-height: 1.7;
            margin-bottom: 1.5rem;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            flex: 1;
        }

        .card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1rem;
            border-top: 1px solid var(--border);
            margin-top: auto;
        }

        .read-more {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--primary);
            font-weight: 600;
            font-size: 0.925rem;
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            padding-bottom: 2px;
        }

        .read-more::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary);
            transition: width 0.3s ease;
        }

        .read-more:hover {
            gap: 0.75rem;
        }

        .read-more:hover::after {
            width: 100%;
        }

        .read-time {
            display: flex;
            align-items: center;
            gap: 0.35rem;
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        .read-time i {
            color: var(--secondary);
        }

        /* Empty State - Blue Theme */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            grid-column: 1 / -1;
        }

        .empty-icon {
            width: 100px;
            height: 100px;
            margin: 0 auto 1.5rem;
            background: #eff6ff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            color: var(--primary);
            border: 3px dashed var(--accent);
        }

        .empty-title {
            font-size: 1.375rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.75rem;
        }

        .empty-text {
            color: var(--text-secondary);
            margin-bottom: 1.75rem;
            max-width: 420px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.6;
        }

        .empty-cta {
            background: var(--primary);
            color: white;
            padding: 0.75rem 1.75rem;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            box-shadow: var(--shadow);
            border: none;
            cursor: pointer;
            font-size: 0.95rem;
        }

        .empty-cta:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: var(--shadow-hover);
        }

        /* Pagination - Blue Style */
        .pagination-container {
            display: flex;
            justify-content: center;
            margin: 4rem 0 2rem;
            padding: 0 1rem;
        }

        .pagination {
            display: flex;
            gap: 0.375rem;
            list-style: none;
            padding: 0;
            margin: 0;
            flex-wrap: wrap;
            justify-content: center;
        }

        .page-item .page-link {
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 42px;
            height: 42px;
            padding: 0 0.875rem;
            border-radius: 12px;
            background: var(--surface);
            border: 2px solid var(--border);
            color: var(--text-primary);
            font-weight: 500;
            font-size: 0.925rem;
            text-decoration: none;
            transition: all 0.25s ease;
        }

        .page-item.active .page-link {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
            box-shadow: var(--shadow);
        }

        .page-item:not(.disabled):not(.active) .page-link:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: #eff6ff;
        }

        .page-item.disabled .page-link {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Newsletter - Clean Blue */
        .newsletter-section {
            background: var(--surface);
            border-radius: 20px;
            padding: 2.25rem 2rem;
            margin: 4rem 1rem 2rem;
            box-shadow: var(--shadow-lg);
            text-align: center;
            border: 1px solid var(--border);
        }

        .newsletter-icon {
            width: 64px;
            height: 64px;
            background: #eff6ff;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.25rem;
            font-size: 1.5rem;
            color: var(--primary);
            border: 2px solid var(--accent);
        }

        .newsletter-title {
            font-size: 1.375rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .newsletter-text {
            color: var(--text-secondary);
            margin-bottom: 1.5rem;
            max-width: 480px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.6;
        }

        .newsletter-form {
            display: flex;
            gap: 0.625rem;
            max-width: 420px;
            margin: 0 auto;
            flex-wrap: wrap;
            justify-content: center;
        }

        .newsletter-input {
            flex: 1;
            min-width: 200px;
            padding: 0.875rem 1.25rem;
            border: 2px solid var(--border);
            border-radius: 12px;
            font-family: inherit;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background: var(--surface);
        }

        .newsletter-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }

        .newsletter-btn {
            background: var(--primary);
            color: white;
            padding: 0.875rem 1.5rem;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.95rem;
        }

        .newsletter-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
        }

        /* Loading State */
        .loading-text {
            text-align: center;
            padding: 3rem;
            color: var(--text-secondary);
            grid-column: 1 / -1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
        }

        .spinner {
            width: 24px;
            height: 24px;
            border: 3px solid var(--border);
            border-top-color: var(--primary);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-section {
                padding: 60px 0 80px;
            }
            
            .hero-stats {
                gap: 1.5rem;
            }
            
            .stat-number {
                font-size: 1.25rem;
            }
            
            .search-container {
                margin: -25px auto 2rem;
            }
            
            .search-box {
                flex-direction: column;
            }
            
            .search-btn {
                width: 100%;
                justify-content: center;
            }
            
            .posts-grid {
                grid-template-columns: 1fr;
                gap: 1.25rem;
            }
            
            .card-title {
                font-size: 1.15rem;
            }
            
            .newsletter-section {
                margin: 3rem 0.75rem 1rem;
                padding: 2rem 1.5rem;
            }
            
            .newsletter-form {
                flex-direction: column;
            }
            
            .newsletter-btn {
                width: 100%;
                justify-content: center;
            }
        }

        /* RTL Support */
        [dir="rtl"] {
            direction: rtl;
            text-align: right;
        }
        
        [dir="rtl"] .read-more i {
            transform: rotate(180deg);
        }
        
        [dir="rtl"] .pagination {
            flex-direction: row-reverse;
        }
        
        [dir="rtl"] .card-footer {
            flex-direction: row-reverse;
        }
    </style>
    @endpush

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container mx-auto px-4" data-aos="fade-down" data-aos-duration="700">
            <div class="hero-content">
                <h1 class="hero-title">{{ __('Educational Blog') }}</h1>
                <p class="hero-subtitle">
                    {{ __('Ideas, tips, and the latest news in the world of education and technology') }}
                </p>
                
                <div class="hero-stats">
                    <div class="stat-item" data-aos="fade-up" data-aos-delay="100">
                        <span class="stat-number">{{ $posts->total() ?? 0 }}</span>
                        <span class="stat-label">{{ __('Article') }}{{ $posts->total() != 1 ? 's' : '' }}</span>
                    </div>
                    <div class="stat-item" data-aos="fade-up" data-aos-delay="200">
                        <span class="stat-number">∞</span>
                        <span class="stat-label">{{ __('Knowledge') }}</span>
                    </div>
                    <div class="stat-item" data-aos="fade-up" data-aos-delay="300">
                        <span class="stat-number">24/7</span>
                        <span class="stat-label">{{ __('Access') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Search Bar -->
    <div class="search-container" data-aos="fade-up" data-aos-delay="200">
        <div class="search-box">
            <input type="text" 
                   class="search-input" 
                   placeholder="{{ __('Search articles...') }}"
                   id="searchInput"
                   aria-label="{{ __('Search articles') }}">
            <button class="search-btn" onclick="filterPosts()" aria-label="{{ __('Search') }}">
                <i class="fas fa-search"></i>
                <span>{{ __('Search') }}</span>
            </button>
        </div>
    </div>

    <!-- Blog Posts Grid -->
    <div class="container mx-auto px-4 py-4">
        <div class="posts-grid">
            @forelse ($posts as $post)
            <article class="blog-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                <div class="card-content">
                    <!-- Date Badge -->
                    <span class="card-date">
                        <i class="far fa-calendar"></i>
                        {{ $post->created_at->format('Y-m-d') }}
                    </span>

                    <!-- Title -->
                    <h2 class="card-title">
                        <a href="{{ route('posts.show', $post->id) }}">
                            {{ $post->title }}
                        </a>
                    </h2>

                    <!-- Excerpt -->
                    <p class="card-excerpt">
                        {{ Str::limit(strip_tags($post->body), 160) }}
                    </p>

                    <!-- Footer -->
                    <div class="card-footer">
                        <a href="{{ route('posts.show', $post->id) }}" class="read-more">
                            {{ __('Read More') }}
                            <i class="fas fa-arrow-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}"></i>
                        </a>
                        <span class="read-time">
                            <i class="far fa-clock"></i>
                            {{ ceil(str_word_count(strip_tags($post->body)) / 200) }} {{ __('min') }}
                        </span>
                    </div>
                </div>
            </article>
            @empty
            <!-- Empty State -->
            <div class="empty-state" data-aos="zoom-in">
                <div class="empty-icon">
                    <i class="fas fa-book-reader"></i>
                </div>
                <h3 class="empty-title">{{ __('No Articles Yet') }}</h3>
                <p class="empty-text">
                    {{ __('We are preparing valuable educational content for you. Stay tuned!') }}
                </p>
                <button class="empty-cta" onclick="window.scrollTo({top: 0, behavior: 'smooth'})">
                    <i class="fas fa-sync-alt"></i>
                    {{ __('Refresh Page') }}
                </button>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($posts->hasPages())
        <nav class="pagination-container" data-aos="fade-up">
            <ul class="pagination">
                {{-- Previous Page Link --}}
                @if ($posts->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link" aria-label="{{ __('Previous') }}">
                            <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}"></i>
                        </span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $posts->previousPageUrl() }}" rel="prev" aria-label="{{ __('Previous') }}">
                            <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}"></i>
                        </a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($posts->getUrlRange(1, $posts->lastPage()) as $page => $url)
                    @if ($page == $posts->currentPage())
                        <li class="page-item active" aria-current="page">
                            <span class="page-link">{{ $page }}</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($posts->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $posts->nextPageUrl() }}" rel="next" aria-label="{{ __('Next') }}">
                            <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }}"></i>
                        </a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link" aria-label="{{ __('Next') }}">
                            <i class="fas fa-chevron-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }}"></i>
                        </span>
                    </li>
                @endif
            </ul>
        </nav>
        @endif
    </div>

    <!-- Newsletter Section -->
    <div class="container mx-auto px-4" id="newsletter" data-aos="fade-up">
        <div class="newsletter-section">
            <div class="newsletter-icon">
                <i class="fas fa-bell"></i>
            </div>
            <h3 class="newsletter-title">{{ __('Get Notified') }}</h3>
            <p class="newsletter-text">
                {{ __('Subscribe to receive notifications when new educational articles are published.') }}
            </p>
            <form class="newsletter-form" onsubmit="subscribeNewsletter(event)">
                <input type="email" 
                       class="newsletter-input" 
                       placeholder="{{ __('Your email address') }}"
                       required
                       aria-label="{{ __('Email address') }}">
                <button type="submit" class="newsletter-btn">
                    <i class="fas fa-paper-plane"></i>
                    {{ __('Subscribe') }}
                </button>
            </form>
        </div>
    </div>

    @push('scripts')
    <!-- AOS Animation Library -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize AOS Animations
            AOS.init({
                duration: 500,
                once: true,
                offset: 30,
                easing: 'ease-out'
            });

            // Search Functionality with Debounce
            const searchInput = document.getElementById('searchInput');
            if (searchInput) {
                searchInput.addEventListener('input', debounce(function(e) {
                    const query = e.target.value.toLowerCase().trim();
                    filterPostsBySearch(query);
                }, 300));

                // Allow Enter key to trigger search
                searchInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        filterPostsBySearch(this.value.toLowerCase().trim());
                    }
                });
            }
        });

        // Filter Posts by Search Query
        function filterPostsBySearch(query) {
            const cards = document.querySelectorAll('.blog-card');
            let visibleCount = 0;

            cards.forEach(card => {
                const title = card.querySelector('.card-title')?.textContent.toLowerCase() || '';
                const excerpt = card.querySelector('.card-excerpt')?.textContent.toLowerCase() || '';
                
                const matches = !query || title.includes(query) || excerpt.includes(query);
                card.style.display = matches ? 'flex' : 'none';
                
                if (matches) visibleCount++;
            });

            // Show/hide empty state if needed
            const emptyState = document.querySelector('.empty-state');
            if (emptyState && cards.length > 0) {
                emptyState.style.display = visibleCount === 0 ? 'block' : 'none';
            }
        }

        // Global search function for button click
        function filterPosts() {
            const query = document.getElementById('searchInput')?.value.toLowerCase().trim() || '';
            filterPostsBySearch(query);
        }

        // Newsletter Subscription Handler
        function subscribeNewsletter(e) {
            e.preventDefault();
            const form = e.target;
            const email = form.querySelector('input[type="email"]').value;
            const btn = form.querySelector('button');
            const originalContent = btn.innerHTML;

            // Validate email
            if (!isValidEmail(email)) {
                showNotification('{{ __('Please enter a valid email address') }}', 'error');
                return;
            }

            // Show loading state
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> {{ __("Subscribing...") }}';
            btn.disabled = true;

            // Simulate API request
            setTimeout(() => {
                btn.innerHTML = '<i class="fas fa-check"></i> {{ __("Subscribed!") }}';
                btn.style.background = '#10b981';
                
                showNotification('{{ __("Thank you for subscribing!") }}', 'success');
                
                // Reset form after delay
                setTimeout(() => {
                    form.reset();
                    btn.innerHTML = originalContent;
                    btn.style.background = '';
                    btn.disabled = false;
                }, 2500);
            }, 1200);
        }

        // Email Validation
        function isValidEmail(email) {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
        }

        // Simple Notification System
        function showNotification(message, type = 'info') {
            // Remove existing notifications
            const existing = document.querySelector('.blog-notification');
            if (existing) existing.remove();

            // Create notification element
            const notification = document.createElement('div');
            notification.className = `blog-notification fixed top-4 left-1/2 -translate-x-1/2 z-50 px-6 py-3 rounded-xl shadow-lg flex items-center gap-3 animate-fade-in ${
                type === 'success' ? 'bg-green-50 text-green-800 border border-green-200' :
                type === 'error' ? 'bg-red-50 text-red-800 border border-red-200' :
                'bg-blue-50 text-blue-800 border border-blue-200'
            }`;
            
            const icon = type === 'success' ? 'fa-check-circle' : 
                        type === 'error' ? 'fa-exclamation-circle' : 
                        'fa-info-circle';
            
            notification.innerHTML = `
                <i class="fas ${icon}"></i>
                <span class="font-medium">${message}</span>
            `;
            
            document.body.appendChild(notification);

            // Auto remove after 4 seconds
            setTimeout(() => {
                notification.style.opacity = '0';
                notification.style.transform = 'translateY(-10px)';
                notification.style.transition = 'all 0.3s ease';
                setTimeout(() => notification.remove(), 300);
            }, 4000);
        }

        // Debounce Utility
        function debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }

        // Add CSS for notification animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fade-in {
                from { opacity: 0; transform: translate(-50%, -10px); }
                to { opacity: 1; transform: translate(-50%, 0); }
            }
            .animate-fade-in {
                animation: fade-in 0.3s ease forwards;
            }
        `;
        document.head.appendChild(style);
    </script>
    @endpush
</x-app-layout>