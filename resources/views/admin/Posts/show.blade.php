@extends('admin.layouts.app')


@push('styles')
<style>
        .post-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border: 1px solid #e2e8f0;
        }
        
        .post-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
            border-color: #cbd5e1;
        }
        
        .status-published {
            background-color: #dcfce7;
            color: #16a34a;
        }
        
        .status-draft {
            background-color: #fef3c7;
            color: #d97706;
        }
      </style>  
@endpush

@section('content')
<main class="flex-1 p-6 md:ml-0">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">{{ __('Blog Management') }}</h1>
                    <p class="text-gray-600">{{ __('Create and edit educational posts for your site') }}</p>
                </div>
                <button onclick="window.location.href='{{ route('admin.posts.create') }}'" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition flex items-center gap-2">
                    <i class="fas fa-plus"></i>
                    {{ __('Add New Post') }}            
                </button>
            </div>

            <form action="{{ route('admin.posts.search') }}" method="post">
                @csrf
                <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200 mb-6">
                    <div class="flex flex-col md:flex-row gap-4">
                        <div class="flex-1">
                            <div class="relative">
                                <input 
                                name="query"
                                type="text" 
                                placeholder="{{ __('Search for a post...') }}" 
                                class="form-input w-full px-4 py-2 border border-gray-300 rounded-lg pl-10"
                                >
                                <button type="submit">    
                                    <i class="fas fa-search absolute left-3 top-2.5 text-gray-400"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <!-- Posts List -->
            <div class="space-y-4">
                @foreach ($posts as $post )
                
                <div class="post-card">
                    <div class="p-4">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-purple-400 to-purple-600 rounded-lg flex items-center justify-center text-white">
                                <i class="fas fa-pen"></i>
                            </div>
                            <div class="flex-1">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="font-bold text-gray-800 text-lg">{{ $post->title }}</h3>
                                        <span class="status-published text-xs font-medium px-2 py-1 rounded-full">{{ __('Published') }}</span>
                                </div>
                                <p class="text-gray-600 text-sm mb-3 line-clamp-2">
                                    {{ Str::limit($post->content, 150) }}
                                </p>
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center gap-3">
                                        <span class="text-xs text-gray-500">{{ $post->author }}</span>
                                        <span class="text-xs text-gray-500">{{ $post->created_at->format('d M Y') }}</span>
                                    </div>
                                    <div class="flex gap-2">
                                        <button onclick="window.location.href='{{ route('admin.posts.edit', $post->id) }}'" class="text-sm bg-indigo-600 text-white px-3 py-1 rounded-lg hover:bg-indigo-700 transition">
                                           {{ __('Edit') }}
                                        </button>
                                        <form action="{{ route('admin.posts.delete', $post->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-sm bg-red-600 text-white px-3 py-1 rounded-lg hover:bg-red-700 transition">
                                               {{ __('Delete') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- Post Card 1 -->
            </div>

            <!-- Pagination -->
            <div class="flex justify-center mt-8">
                <nav class="flex items-center gap-2">
                    {{ $posts->links() }}
                </nav>
            </div>
        </main>


        
@endsection


