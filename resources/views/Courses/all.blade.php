<x-app-layout>
@push('styles')
<style>
        .course-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .course-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .filter-button.active {
            background-color: #3b82f6;
            color: white;
        }
    </style>
@endpush

<div class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white py-16">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-3xl md:text-4xl font-bold mb-4">{{ __('All Courses') }}</h1>
            <p class="text-lg max-w-2xl mx-auto opacity-90">{{ __('Discover our diverse courses designed to help you develop your skills and achieve your professional goals') }}</p>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">


        <!-- Courses Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
             @foreach ($courses as $course )
            <div class="course-card bg-white rounded-lg shadow-md overflow-hidden">
                <div class="h-48 bg-gradient-to-r from-blue-400 to-blue-600 flex items-center justify-center">
                    <img class=" w-full h-48" src="{{ asset('storage/' . $course->thumbnail_url) }}" alt="{{ $course->title }}">
                </div>
                <div class="p-5">
                    <div class="flex items-center mb-2">
                        @if ($course->level == 'مبتدئ')
                            <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-2 py-1 rounded">{{ __('Beginner') }}</span>
                        @elseif ($course->level == 'متوسط')
                            <span class="bg-green-100 text-green-800 text-xs font-semibold px-2 py-1 rounded">{{ __('Intermediate') }}</span>
                        @elseif ($course->level == 'متقدم')
                            <span class="bg-red-100 text-red-800 text-xs font-semibold px-2 py-1 rounded">{{ __('Advanced') }}</span>
                        @endif
                        <span class="text-gray-500 text-sm mx-2">{{ $course->duration_hours > 10 ? $course->duration_hours . __(' hour') : $course->duration_hours . __(' hours') }}</span>
                    </div>
                    <h3 class="font-bold text-lg text-gray-800 mb-2">{{ $course->title }}</h3>
                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $course->description }}</p>
                    <div class="flex justify-between items-center">
                        <span class="font-bold text-blue-600">{{ $course->price }}</span>
                        <a href="{{ route('courses.show', $course->id) }}" class="text-blue-600 hover:text-blue-800 font-medium">{{ __('View Course') }}</a>
                    </div>
                </div>
            </div>
            
            @endforeach
        </div>
        <!-- Load More Button -->
        <div class="text-center mt-12">
               {{ $courses->links() }}
            
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8 mt-12">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; 2026 أكاديمية شام. جميع الحقوق محفوظة.</p>
        </div>
    </footer>


</x-app-layout>