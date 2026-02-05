<x-app-layout>
    @push('styles')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700&display=swap');
        
        body {
            font-family: 'Tajawal', sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #eef2ff 100%);
        }
        
        .article-content {
            line-height: 1.8;
            color: #334155;
            font-size: 1.125rem;
        }
        
        .article-content h2 {
            font-size: 1.5rem;
            margin-top: 2rem;
            margin-bottom: 1rem;
            color: #1e40af;
            font-weight: 700;
        }
        
        .article-content p {
            margin-bottom: 1.25rem;
        }
        
        .article-content ul, .article-content ol {
            margin-bottom: 1.25rem;
            padding-right: 1.5rem;
        }
        
        .article-content li {
            margin-bottom: 0.5rem;
        }
        
        .auther-card {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        
        .share-buttons a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #f1f5f9;
            color: #4f46e5;
            transition: all 0.3s ease;
        }
        
        .share-buttons a:hover {
            background: #4f46e5;
            color: white;
            transform: translateY(-2px);
        }
    </style>
    @endpush
        <div class="bg-gradient-to-r from-indigo-600 to-purple-700 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">
                <div class="flex flex-wrap justify-center gap-4 mb-4 text-indigo-200 text-sm">
                    <span><i class="far fa-calendar mr-1"></i>{{ $post->created_at->format('d F Y') }}</span>
                    
                </div>
                <h1 class="text-2xl md:text-3xl font-bold">{{ $post->title }}</h1>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-12">
        <div class="max-w-4xl mx-auto">
            <!-- Article Content -->
            <article class="article-content prose prose-lg">
                {!! $post->body !!}
            </article>

            <!-- Share Section -->
            <div class="mt-12 pt-8 border-t border-gray-200">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    
                    <div class="text-sm text-gray-500">
                        <i class="far fa-clock mr-2"></i>{{ $post->created_at->diffForHumans() }}
                    </div>
                </div>
            </div>

            <!-- auther Card -->
            <div class="mt-12">
                <h3 class="font-bold text-gray-800 mb-4">عن الكاتب</h3>
                <div class="auther-card">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-white text-xl font-bold">
                            <img src="{{ asset('storage/' . $post->auther->profile_photo_url) }}" alt="{{ $post->auther->name }}" class="w-16 h-16 rounded-full object-cover"> 
                        </div>
                        <div>
                            <h4 class="font-bold text-lg text-gray-800">{{ $post->auther->name }}</h4>
                            <p class="text-gray-600">{{ $post->auther->bio }}</p>
                            
                        </div>
                    </div>
                </div>
            </div>

            <livewire:post-comments :post="$post" />
        </div>
    </div>

</x-app-layout>