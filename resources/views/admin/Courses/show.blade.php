@extends('admin.layouts.app')
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

        .status-active {
            background-color: #dcfce7;
            color: #16a34a;
        }

        .status-inactive {
            background-color: #fee2e2;
            color: #dc2626;
        }

        .modal {
            display: none;
            position: fixed;
            inset: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 50;
        }

        .modal.show {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-input:focus {
            outline: none;
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }
    </style>
@endpush

@section('title')
{{ __('Showing')}}
@endsection
@section('content')
    <main class="flex-1 p-6 md:ml-0">
        @if (session()->has('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif
        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">{{ __('Admin Courses') }}</h1>
                <p class="text-gray-600">{{ __("Add, Edit, Delete Courses") }}</p>
            </div>
            <button id="addCourseBtn"
                class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition flex items-center gap-2">
                <i class="fas fa-plus"></i>
                {{ __('Add New Course') }}
            </button>
        </div>
        <!-- Filters and Search -->
        <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200 mb-6">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <div class="relative">
                        <form action="{{ route('admin.courses.Search') }}" method="get">
                            <input type="text" name="query" placeholder="{{ __('Looking for a course...') }}" class="w-full form-input py-2 text-sm rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                           {{ app()->getLocale() === 'ar' ? 'pr-10 text-right' : 'pl-10 text-left' }}">
                            <i
                                class="fas fa-search absolute {{ app()->getLocale() === 'ar' ? 'right-3' : 'left-3'  }} top-2.5 text-gray-400"></i>

                        </form>
                    </div>
                </div>

            </div>
        </div>

        <!-- Courses Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($courses as $course)
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
                        <span class="status-active p-1 rounded">{{ $course->duration_hours > 10 ? $course->duration_hours . __(' hour') : $course->duration_hours . __(' hours') }}</span>
                    </div>
                    <div class=" text-center  rounded p-1">{{ $course->lessons->count() }} {{__('Of lessons ')}}</div>
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
                                    <button onclick="return confirm('هل أنت متأكد؟')" type="submit" class="text-sm bg-red-600 text-white px-3 py-1.5 rounded-lg hover:bg-red-700 transition">
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


        <!-- Pagination -->
        <div class="flex justify-center mt-8">
            <nav class="flex items-center gap-2">
                {{ $courses->links() }}
            </nav>
        </div>

    </main>
@endsection
<!-- Main Content -->


<!-- Add/Edit Course Modal -->
<div id="courseModal" class="modal">
    <div class="bg-white rounded-xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
        <div class="p-6 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-bold text-gray-800">{{ __("Add New Courses") }}</h2>
                <button id="closeModal" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        @livewire('admin.create-course')
    </div>
</div>
@push('scripts')
    <script>
        // Modal functionality
        const addCourseBtn = document.getElementById('addCourseBtn');
        const courseModal = document.getElementById('courseModal');
        const closeModal = document.getElementById('closeModal');
        const cancelModal = document.getElementById('cancelModal');

        addCourseBtn.addEventListener('click', () => {
            courseModal.classList.add('show');
        });

        closeModal.addEventListener('click', () => {
            courseModal.classList.remove('show');
        });

        cancelModal.addEventListener('click', () => {
            courseModal.classList.remove('show');
        });

        // Close modal when clicking outside
        courseModal.addEventListener('click', (e) => {
            if (e.target === courseModal) {
                courseModal.classList.remove('show');
            }
        });

        // Sidebar toggle for mobile
        document.getElementById('sidebarToggle').addEventListener('click', function () {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('hidden');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function (event) {
            const sidebar = document.getElementById('sidebar');
            const toggleButton = document.getElementById('sidebarToggle');

            if (window.innerWidth < 768 &&
                !sidebar.contains(event.target) &&
                !toggleButton.contains(event.target) &&
                !sidebar.classList.contains('hidden')) {
                sidebar.classList.add('hidden');
            }
        });
    </script>
@endpush