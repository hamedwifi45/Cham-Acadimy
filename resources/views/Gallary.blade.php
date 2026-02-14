<x-app-layout>
    @push('styles')
        <style>
            .course-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 50px -20px rgba(59, 130, 246, 0.25);
        }
        .course-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px -15px rgba(0, 0, 0, 0.1);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            height: 100%;
        }
        </style>
    @endpush
    

    <div class="min-h-screen bg-gray-50">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r  from-blue-600 to-indigo-700 flex flex-col items-center justify-center  min-h-screen text-white py-20">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ __('Welcome to Cham Academy') }}</h1>
            <p class="text-xl max-w-2xl mx-auto mb-8 opacity-90">
                {{ __('Learn new skills, take a step in your career, and achieve your goals with our courses guided by experts.') }}
            </p>
            <a href="{{ route('courses.index') }}" 
               class="bg-white text-blue-600 font-semibold px-6 py-3 rounded-lg hover:bg-gray-100 transition">
                {{ __('Browse Courses') }}
            </a>
        </div>
    </div>

    <!-- Featured Courses -->
    <div class="container mx-auto px-4 py-16">
        <h2 class="text-3xl font-bold text-center mb-12">{{ __('Latest Courses') }}</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @foreach ($courses as $course )
            
            <div class="course-card">
                <div class="h-48 bg-gradient-to-r from-blue-400 to-blue-600">
                    <img onclick="window.location.href='{{ route('courses.show', $course->id) }}'" style="cursor: pointer" class=" w-full h-48" src="{{ Storage::url($course->thumbnail_url) }}" alt="{{ $course->title }}">
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-3">
                         @if ($course->level == 'مبتدئ')
                            <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-2 py-1 rounded">{{ __('Beginner') }}</span>
                        @elseif ($course->level == 'متوسط')
                            <span class="bg-green-100 text-green-800 text-xs font-semibold px-2 py-1 rounded">{{ __('Intermediate') }}</span>
                        @elseif ($course->level == 'متقدم')
                            <span class="bg-red-100 text-red-800 text-xs font-semibold px-2 py-1 rounded">{{ __('Advanced') }}</span>
                        @endif
                        <span class="status-active">{{ $course->duration_hours > 10 ? $course->duration_hours . __(' hour') : $course->duration_hours . __(' hours') }}</span>
                    </div>
                    <h3 onclick="window.location.href='{{ route('courses.show', $course->id) }}'" style="cursor: pointer" class="font-bold text-lg text-gray-800 mb-3">{{ $course->title }}</h3>
                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                        {{ $course->description }}
                    </p>
                    <div class="flex justify-between items-center">
                        <span class="font-bold text-indigo-600">{{ $course->price }} $ </span>
                        @auth
                        @if (auth()->user()->is_admin() && auth()->check())
                            <div class="flex gap-2">
                                <button onclick="window.location.href='{{ route('admin.courses.edit', $course->id) }}'" class="text-sm bg-indigo-600 text-white px-3 py-1.5 rounded-lg hover:bg-indigo-700 transition">
                                    {{ __('Edit') }}
                                </button>
                                <form action="{{ route('admin.courses.delete' , $course->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button onclick="return confirm('{{ __('Are you sure?') }}')" type="submit" class="text-sm bg-red-600 text-white px-3 py-1.5 rounded-lg hover:bg-red-700 transition">
                                        {{__('Delete')}}
                                    </button>
                                </form>
                            </div>
                        @endif
                        @endauth
                    </div>
                </div>
            </div>
            @endforeach
        
        
        </div>
    <div class="text-center mt-8">
    <a href="{{ route('courses.index') }}" 
       class="bg-blue-600 text-white font-semibold px-4 py-2 rounded-lg hover:bg-blue-700 transition inline-flex items-center justify-center">
        {{ __('All Courses') }}
    </a>
</div>
    </div>

    <!-- Latest Blog Posts -->
    <div class="bg-white py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">{{ __('Latest Posts') }}</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach ($posts as $post)
                    <div class="{{ app()->getLocale() === 'ar' ? 'border-r-4 border-blue-600 pr-4' : 'border-l-4 border-blue-600 pl-4' }}">
                        <h3 class="font-bold text-xl text-gray-800 mb-2">{{ $post->title }}</h3>
                        <p class="text-gray-600 mb-3">{{ Str::limit($post->body , 60) }}</p>
                        <a href="{{ route('posts.show' , $post->id) }}" class="text-blue-600 hover:underline">{{ __('Read More') }}</a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>


    
</x-app-layout>