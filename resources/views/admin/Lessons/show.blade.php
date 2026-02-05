@extends('admin.layouts.app')
@push('styles')
    <style>
        .lesson-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border: 1px solid #e2e8f0;
        }
        
        .lesson-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
            border-color: #cbd5e1;
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
                <h1 class="text-2xl font-bold text-gray-800">{{ __('Admin Lessons') }}</h1>
                <p class="text-gray-600">{{ __("Add, Edit, Delete Lessons") }}</p>
            </div>
            <button id="addlessonBtn"
                class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition flex items-center gap-2">
                <i class="fas fa-plus"></i>
                {{ __('Add New Lesson') }}
            </button>
        </div>
        <!-- Filters and Search -->
        <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200 mb-6">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <div class="relative">
                        <form action="{{ route('admin.lessons.Search') }}" method="get">
                            <input type="text" value="{{ $search }}" name="query" placeholder="{{ __('Looking for a lesson...') }}" class="w-full form-input py-2 text-sm rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                           {{ app()->getLocale() === 'ar' ? 'pr-10 text-right' : 'pl-10 text-left' }}">
                           <button type="submit">
                               <i class="fas fa-search absolute {{ app()->getLocale() === 'ar' ? 'right-3' : 'left-3'  }} top-2.5 text-gray-400"></i>
                            </button> 

                        </form>
                    </div>
                </div>

            </div>
        </div>

        <!-- lessons Grid -->
        <div class="space-y-4">
            @foreach ($lessons as $lesson)
                <div class="lesson-card">
                    <div class="p-4">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-indigo-400 to-indigo-600 rounded-lg flex items-center justify-center text-white">
                                <i class="fas fa-graduation-cap text-white text-xl"></i>
                            </div>
                            <div class="flex-1">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="font-bold text-gray-800 text-lg">{{ $lesson->title }}</h3>
                                    <span class="text-sm text-gray-500">{{ $lesson->duration_minutes }} {{ __('minutes') }}</span>
                                </div>
                                <p class="text-gray-600 text-sm mb-2">
                                    {{ Str::limit($lesson->content, 60) }}
                                </p>
                                <div class="flex justify-between items-center">
                                    <span class="text-xs bg-indigo-100 text-indigo-800 px-2 py-1 rounded">{{ $lesson->course->title }}</span>
                                    <div class="flex gap-2">
                                        <button onclick="window.location.href='{{ route('admin.lessons.edit', $lesson->id) }}'" class="text-sm bg-indigo-600 text-white px-3 py-1 rounded-lg hover:bg-indigo-700 transition">
                                            {{ __('Edit') }}
                                        </button>
                                        <form action="{{ route('admin.lessons.delete', $lesson->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                            <button class="text-sm bg-red-600 text-white px-3 py-1 rounded-lg hover:bg-red-700 transition">
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
        </div>


        <!-- Pagination -->
        <div class="flex justify-center mt-8">
            <nav class="flex items-center gap-2">
                {{ $lessons->links() }}
            </nav>
        </div>

    </main>
@endsection
<!-- Main Content -->


<!-- Add/Edit lesson Modal -->
<div id="lessonModal" class="modal">
    <div class="bg-white rounded-xl w-full p-2 max-w-2xl max-h-[90vh] overflow-y-auto">
        <div class="p-6 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-bold text-gray-800">{{ __("Add New Lessons") }}</h2>
                <button id="closeModal" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        @livewire('admin.create-lesson')
    </div>
</div>
@push('scripts')
    <script>
        // Modal functionality
        const addlessonBtn = document.getElementById('addlessonBtn');
        const lessonModal = document.getElementById('lessonModal');
        const closeModal = document.getElementById('closeModal');
        const cancelModal = document.getElementById('cancelModal');

        addlessonBtn.addEventListener('click', () => {
            lessonModal.classList.add('show');
        });

        closeModal.addEventListener('click', () => {
            lessonModal.classList.remove('show');
        });

        cancelModal.addEventListener('click', () => {
            lessonModal.classList.remove('show');
        });

        // Close modal when clicking outside
        lessonModal.addEventListener('click', (e) => {
            if (e.target === lessonModal) {
                lessonModal.classList.remove('show');
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