<div class="relative w-full">
    <div class="relative">
        <input
            type="text"
            wire:model.live="query"
            placeholder="{{ __('Looking for a course...') }}"
            class="w-full md:w-64 px-4 py-2 text-sm rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                   {{ app()->getLocale() === 'ar' ? 'pr-10 text-right' : 'pl-10 text-left' }}"
        >
        <button type="submit" class="absolute inset-y-0 {{ app()->getLocale() === 'ar' ? 'left-3' : 'right-3' }} flex items-center text-gray-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </button>
    </div>

    @if(strlen($query) > 1 && (count($courses) > 0 || count($posts) > 0))
        <div class="absolute z-10 mt-1 w-full bg-white shadow-lg rounded-lg border border-gray-200 max-h-80 overflow-y-auto">
            
            @if(count($courses) > 0)
                <div class="px-4 py-2 bg-gray-50 border-b border-gray-200">
                    <h3 class="text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        {{ __('Courses') }}
                    </h3>
                </div>
                @foreach($courses as $course)
                    <a href="{{ route('courses.show', $course->id) }}" 
                       class="block px-4 py-3 hover:bg-blue-50 transition-colors duration-150
                              {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                        <div class="font-medium text-gray-900">{{ $course->title }}</div>
                        <div class="text-sm text-gray-600 line-clamp-1">{{ $course->description }}</div>
                        <div class="flex items-center justify-between mt-1">
                            <span class="text-blue-600 font-bold">{{ $course->price }} $</span>
                            @if ($course->level == 'مبتدئ')
                                <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-0.5 rounded">{{ __('Beginner') }}</span>
                            @elseif ($course->level == 'متوسط')
                                <span class="bg-green-100 text-green-800 text-xs px-2 py-0.5 rounded">{{ __('Intermediate') }}</span>
                            @elseif ($course->level == 'متقدم')
                                <span class="bg-red-100 text-red-800 text-xs px-2 py-0.5 rounded">{{ __('Advanced') }}</span>
                            @endif
                        </div>
                    </a>
                @endforeach
            @endif

            <!-- نتائج المقالات -->
            @if(count($posts) > 0)
                <div class="px-4 py-2 bg-gray-50 border-b border-gray-200 mt-2">
                    <h3 class="text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        {{ __('Articles') }}
                    </h3>
                </div>
                @foreach($posts as $post)
                    <a href="{{ route('posts.show', $post->id) }}" 
                       class="block px-4 py-3 hover:bg-blue-50 transition-colors duration-150
                              {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                        <div class="font-medium text-gray-900">{{ $post->title }}</div>
                        <div class="text-sm text-gray-600 line-clamp-1">{{ $post->description }}</div>
                        <div class="flex items-center justify-between mt-1">
                            <span class="text-gray-500 text-xs">
                                {{ \Carbon\Carbon::parse($post->created_at)->format('d M Y') }}
                            </span>
                        </div>
                    </a>
                @endforeach
            @endif
        </div>
    @endif

    <!-- رسالة عندما لا توجد نتائج -->
    @if(strlen($query) > 1 && count($courses) == 0 && count($posts) == 0)
        <div class="absolute z-10 mt-1 w-full bg-white shadow-lg rounded-lg border border-gray-200 py-3 px-4">
            <p class="text-gray-500 text-sm">{{ __('No results found matching your search.') }}</p>
        </div>
    @endif
</div>