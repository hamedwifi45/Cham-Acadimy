<x-app-layout>
    @push('styles')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700&display=swap');
        
        body {
            font-family: 'Tajawal', sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #eef2ff 100%);
        }
        
        .video-container {
            position: relative;
            padding-bottom: 56.25%; /* 16:9 Aspect Ratio */
            height: 0;
            overflow: hidden;
            border-radius: 16px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
        
        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }
        
        .lesson-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        
        .lesson-card:hover {
            transform: translateX(4px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        
        .lesson-card.active {
            border-left: 4px solid #4f46e5;
            background: #f8fafc;
        }
        
        .progress-bar {
            height: 6px;
            background: #e2e8f0;
            border-radius: 3px;
            overflow: hidden;
        }
        
        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #4f46e5, #7c3aed);
            width: {{ $lesson->course->completionPercentage(auth()->user()) }}%;
        }
    </style>
    @endpush

    <!-- Course Navigation -->
    <div class="bg-gradient-to-r from-indigo-600 to-purple-700 text-white py-6">
        <div class="container mx-auto px-4">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <div>
                     @if (session()->has('Erorree'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                    {{ session('Erorr') }}
                </div>
            @endif
                    <h1 class="text-xl font-bold">{{ $lesson->title }}</h1>
                    <p class="text-indigo-200 text-sm">{{ __('Lesson') }} {{ $lesson->order }} {{ __('of') }} {{ $lesson->course->lessons->count() }}</p>
                </div>
                <div class="flex items-center gap-4">
                    <span class="text-indigo-200"><i class="far fa-clock mr-1"></i> {{ $lesson->duration_minutes }} {{  __('minutes') }}</span>
                    
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
       
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Video Player -->
            <div class="lg:w-2/3">
                @livewire('lesson-watcher', ['lesson' => $lesson])
                
                <div class="lesson-card p-6 mb-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">{{ $lesson->title }}</h2>
                    <div class="text-gray-600 leading-relaxed space-y-4">
                        {{ $lesson->content }}
                    </div>
                </div>
                
                @livewire('lessons-comments', ['lesson' => $lesson])
            </div>

            <!-- Sidebar -->
            <div class="lg:w-1/3">
                <!-- Course Progress -->
                <div class="lesson-card p-6 mb-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">{{ __('Course Progress') }}</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">{{ __('Course Progress') }}</span>
                            <span class="font-semibold text-indigo-600">{{ $lesson->course->completionPercentage(auth()->user()) }}%</span>
                        </div>
                        <div class="progress-bar h-2">
                            <div class="progress-fill h-full" style="width: {{ $lesson->course->completionPercentage(auth()->user()) }}%"></div>
                        </div>
                        <div class="text-sm text-gray-500 mt-2">
                            <i class="fas fa-check-circle text-green-500 mr-1"></i>
                            {{ auth()->user()->completedLessonsInCourse($lesson->course->id) }} {{ __('completed of') }} {{ $lesson->course->lessons->count() }} {{ __('Lessons') }}
                        </div>
                    </div>
                </div>

                <!-- Lesson Navigation -->
                <div class="lesson-card p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">{{ __('Course Content') }}</h3>
                    <div class="space-y-2 max-h-96 overflow-y-auto pr-2">
                        @foreach($lesson->course->lessons as $courseLesson)
                            @if($courseLesson->id === $lesson->id)
                                <!-- Current Lesson -->
                                   <div class="lesson-card p-3 flex items-center gap-3 active">
                                    <div class="w-8 h-8 bg-indigo-600 rounded-full flex items-center justify-center">
                                        <i class="fas fa-play text-white text-xs"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium text-indigo-700 text-sm">{{ __('Lesson') . ' ' }} {{ $courseLesson->order }}: {{ $courseLesson->title }}</p>
                                       <p class="text-xs text-indigo-600">{{ $courseLesson->duration_minutes }} {{ __('minutes') }}</p>
                                   </div>
                               </div>
                           @elseif(auth()->user()->isCompletedLessonsInCourse($lesson->course->id, $courseLesson->id))
                                   <!-- Completed Lesson -->
                                   <a href="{{ route('lessons.show', $courseLesson->id) }}" class="lesson-card p-3 flex items-center gap-3">
                                       <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-check text-green-600 text-xs"></i>
                                       </div>
                                   <div>
                                        <p class="font-medium text-gray-800 text-sm">{{ __('Lesson') . ' ' }} {{ $courseLesson->order }}: {{ $courseLesson->title }}</p>
                                        <p class="text-xs text-gray-500">{{ $courseLesson->duration_minutes }} {{ __('minutes') }}</p>
                                    </div>
                                </a>
                            @else
                                <!-- Upcoming Lessons -->
                                <a href="{{ route('lessons.show', $courseLesson->id) }}" class="lesson-card p-3 flex items-center gap-3 opacity-70">
                                    <div class="w-8 h-8 bg-red-200 rounded-full flex items-center justify-center">
                                        <i class="fas fa-times text-red-800 text-xl"></i>

                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-600 text-sm">{{ __('Lesson') . ' ' }} {{ $courseLesson->order }}:
                                            {{ $courseLesson->title }}</p>
                                        <p class="text-xs text-gray-500">{{ $courseLesson->duration_minutes }} {{ __('minutes') }}</p>
                                    </div>
                                </a>
                            @endif
                        @endforeach
</div>

<!-- Navigation Buttons -->
<div class="flex gap-3 mt-6">

    @if($previousLesson)
        <a href="{{ route('lessons.show', $previousLesson) }}"
            class="flex-1 bg-gray-100 text-gray-700 py-2 rounded-lg hover:bg-gray-200 transition 
                   flex items-center text-sm justify-center whitespace-nowrap min-w-0">
            @if (app()->getLocale() === 'ar')
            <i class="fas fa-arrow-right ml-2"></i>
            @else
            <i class="fas fa-arrow-left mr-2"></i>
            @endif
            <span class="truncate">{{ __('Previous Lesson') }}</span>
        </a>
    @else
        <button disabled 
                class="flex-1 bg-gray-100 text-sm text-gray-400 py-2 rounded-lg cursor-not-allowed transition 
                       flex items-center justify-center whitespace-nowrap min-w-0">
            <span class="truncate">{{ __('Previous Lesson') }}</span>
        </button>
    @endif

    @if($nextLesson)
        <a href="{{ route('lessons.show', $nextLesson) }}"
            class="flex-1 bg-indigo-600 text-sm text-white py-2 rounded-lg hover:bg-indigo-700 transition 
                   flex items-center justify-center whitespace-nowrap min-w-0">
            <span class="truncate">{{ __('Next Lesson') }}</span>
            @if (app()->getLocale() === 'ar')
            <i class="fas fa-arrow-left mr-2"></i>
            @else
            <i class="fas fa-arrow-right ml-2"></i>
            @endif
        </a>
    @else
        <button disabled 
                class="flex-1 bg-gray-300 text-sm text-gray-500 py-2 rounded-lg cursor-not-allowed 
                       flex items-center justify-center whitespace-nowrap min-w-0">
            <span class="truncate">{{ __('Next Lesson') }}</span>
        </button>
    @endif
</div>
</div>
</div>
</div>
    </div>

</x-app-layout>