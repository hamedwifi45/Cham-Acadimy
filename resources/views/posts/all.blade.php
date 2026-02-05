<x-app-layout>
    @push('styles')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700&display=swap');
        
        body {
            font-family: 'Tajawal', sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #eef2ff 100%);
        }
        
        .blog-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px -15px rgba(0, 0, 0, 0.1);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            height: 100%;
        }
        
        .blog-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 50px -20px rgba(59, 130, 246, 0.25);
        }
        
        .post-content {
            line-height: 1.7;
            color: #475569;
            font-size: 0.95rem;
        }
        
        .date-tag {
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            color: white;
            padding: 0.35rem 1rem;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-block;
        }
        
        .gradient-border {
            position: relative;
            padding: 2px;
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            border-radius: 18px;
            margin-bottom: 1.5rem;
        }
        
        .gradient-border > div {
            background: white;
            border-radius: 16px;
            padding: 2rem;
        }
        
        .read-more-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: #4f46e5;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            padding: 0.5rem 0;
        }
        
        .read-more-btn:hover {
            color: #3b82f6;
            transform: translateX(5px);
        }
        
        .hero-container {
            background: linear-gradient(135deg, #1e40af 0%, #4f46e5 100%);
            clip-path: polygon(0 0, 100% 0, 100% 85%, 0 100%);
            padding: 80px 0 60px;
        }
    </style>
    @endpush
    <!-- Hero Section -->
    <div class="hero-container">
        <div class "container mx-2 px-4 text-center">
            <h1 class="text-4xl mx-8 md:text-5xl font-bold text-white mb-4">{{ __('Post') }}</h1>
            <p class="text-xl max-w-2xl mx-auto text-indigo-100">{{ __('Ideas, tips, and the latest news in the world of education and technology') }}</p>
        </div>
    </div>

    <!-- Blog Posts -->
    <div class="container mx-auto px-4 py-16 -mt-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            
            @forelse ($posts as $post )
            
            <div class="blog-card">
                <div class="gradient-border">
                    <div>
                        <div class="flex justify-between items-start mb-4">
                            <h2 class="text-xl font-bold text-gray-800 leading-tight">{{ $post->title }}</h2>
                            <span class="date-tag">{{ $post->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="post-content mb-5">
                            <p>{{ Str::limit($post->body, 150) }}</p>
                        </div>
                        <a href="{{ route('posts.show', $post->id) }}" class="read-more-btn"> 
                            {{__('Read more')}}
                            <i class="fas fa-arrow-left text-xs"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            @empty
            <h2 class="text-center  text-gray-500 col-span-3">{{ __('I,m sorry, Uncle Hajj, but the owner of the site is bored and doesn,t post anything') }}</h2>
            @endforelse

            
        </div>

        <!-- Load More Button -->
        <div class="text-center mt-16">
            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>