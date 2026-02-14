@extends('admin.layouts.app')

@section('title', __('Admin Dashboard'))



@section('content')
    <!-- Welcome Section -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800">{{ __('Welcome Back!') . ' ' . auth()->user()->name }}</h1>
        <p class="text-gray-600">{{ __('This is an overview of your platform today') }}</p>
    </div>


    <!-- Quick Actions -->
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 mb-8">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">{{ __('Quick Actions') }}</h3>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
            <a href="{{ route('admin.courses.create') }}"
                class="quick-action-btn bg-blue-50 hover:bg-blue-100 p-4 rounded-lg text-center">
                <div class="w-12 h-12 bg-blue-200 rounded-full flex items-center justify-center mx-auto mb-2">
                    <i class="fas fa-book-open text-blue-700"></i>
                </div>
                <p class="text-sm font-medium text-gray-800">{{ __('Add Course') }}</p>
            </a>

            <a href="{{ route('admin.lessons.create') }}"
                class="quick-action-btn bg-orange-50 hover:bg-orange-100 p-4 rounded-lg text-center">
                <div class="w-12 h-12 bg-orange-200 rounded-full flex items-center justify-center mx-auto mb-2">
                    <i class="fas fa-video text-orange-700"></i>
                </div>
                <p class="text-sm font-medium text-gray-800">{{ __('Add Lesson') }}</p>
            </a>

            <a href="{{ route('admin.posts.create') }}"
                class="quick-action-btn bg-purple-50 hover:bg-purple-100 p-4 rounded-lg text-center">
                <div class="w-12 h-12 bg-purple-200 rounded-full flex items-center justify-center mx-auto mb-2">
                    <i class="fas fa-file-alt text-purple-700"></i>
                </div>
                <p class="text-sm font-medium text-gray-800">{{ __('Add Post') }}</p>
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Users -->
        <div class="stat-card bg-white p-6 rounded-xl shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">{{ __('Total Users') }}</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $usercount }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-200 rounded-lg flex items-center justify-center">
                    <i class="fas fa-user-friends text-blue-700"></i>
                </div>
            </div>
            {{-- خطة مستقبلية --}}
            {{-- <div class="mt-4">
                <span class="text-green-600 text-sm font-medium">
                    <i class="fas fa-arrow-up mr-1"></i> 18% {{ __('This month') }}
                </span>
            </div> --}}
        </div>

        <!-- Total Courses -->
        <div class="stat-card bg-white p-6 rounded-xl shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">{{ __('Total Courses') }}</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $coursecount }}</p>
                </div>
                <div class="w-12 h-12 bg-green-200 rounded-lg flex items-center justify-center">
                    <i class="fas fa-graduation-cap text-green-700"></i>
                </div>
            </div>
            {{-- خطة مستقبلية --}}
            {{-- <div class="mt-4">
                <span class="text-green-600 text-sm font-medium">
                    <i class="fas fa-arrow-up mr-1"></i> 6 {{ __('New courses') }}
                </span>
            </div> --}}
        </div>

        <!-- Total Post -->
        <div class="stat-card bg-white p-6 rounded-xl shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">{{ __('Total Posts') }}</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $postcount }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-200 rounded-lg flex items-center justify-center">
                    <i class="fas fa-file-alt text-purple-700"></i>
                </div>
            </div>
            {{-- خطة مستقبلية --}}
            {{-- <div class="mt-4">
                <span class="text-green-600 text-sm font-medium">
                    <i class="fas fa-arrow-up mr-1"></i> 12% {{ __('This month') }}
                </span>
            </div> --}}
        </div>

        <!-- Total Lessons -->
        <div class="stat-card bg-white p-6 rounded-xl shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">{{ __('Total Lessons') }}</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $lessonscount }}</p>
                </div>
                <div class="w-12 h-12 bg-orange-200 rounded-lg flex items-center justify-center">
                    <i class="fas fa-chalkboard-teacher text-orange-700"></i>
                </div>
            </div>
            {{-- خطة مستقبلية --}}
            {{-- <div class="mt-4">
                <span class="text-green-600 text-sm font-medium">
                    <i class="fas fa-arrow-up mr-1"></i> 5% {{ __('This week') }}
                </span>
            </div> --}}
        </div>
    </div>

    <!-- Recent Activity and Notifications -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Recent Activity -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">{{ __("New Users") }}</h3>
            <div class="space-y-4 max-h-80 overflow-y-auto pr-2">
                @foreach ($UserLatest as $us)
                    <div class="activity-item p-3 rounded-lg">
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                <img class="size-8 rounded-full object-cover" src="{{ $us->profile_photo_url }}"
                                    alt="{{ $us->name }}" />
                            </div>

                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-800"> {{ __('New User') . ' : ' . $us->name }}</p>
                                <p class="text-sm text-gray-600">{{ __('Email') . " : " . $us->email }}</p>
                                <p class="text-xs text-gray-400 mt-1">{{ $us->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach



            </div>
        </div>

        <!-- Recent Notifications -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">{{__('Latest purchases')}}</h3>
            <div class="space-y-4 max-h-80 overflow-y-auto pr-2">
                @forelse($latestPurchases as $purchase)
                    <div class="notification-item p-3 rounded-lg bg-blue-50 border border-blue-200">
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-shopping-cart text-blue-600 text-xs"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-800">
                                    {{ $purchase->user->name ?? __('Deleted user') }}
                                </p>
                                <p class="text-sm text-gray-600">
                                    {{__('Bought a course')}} "<strong>{{ $purchase->course->name_ar ?? __('Deleted course') }}</strong>"
                                </p>
                                <p class="text-xs text-gray-500 mt-1">
                                    {{ $purchase->created_at->diffForHumans() }}
                                </p>
                            </div>
                            <div class="text-right">
                                <span class="text-sm font-bold text-indigo-600">
                                    {{ $purchase->amount }} $
                                </span>
                                @if($purchase->status == 'completed')
                                    <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded-full ml-2">
                                        {{__('complete')}}
                                    </span>
                                @elseif($purchase->status == 'failed')
                                    <span class="text-xs bg-red-100 text-red-800 px-2 py-1 rounded-full ml-2">
                                        {{__('Failed')}}
                                    </span>
                                @else
                                    <span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full ml-2">
                                        {{__('On hold')}}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8 text-gray-500">
                        <i class="fas fa-shopping-cart text-2xl opacity-50 mb-2"></i>
                        <p>{{__('There are no recent purchases')}}</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Recent Content -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Courses -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-800">{{ __('Recent Courses') }}</h3>
                <a href="{{ route('admin.courses.index') }}"
                    class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">{{ __('Show All') }}</a>
            </div>
            <div class="space-y-4">
                @foreach ($courseLatest as $cl)
                    <div class="flex items-center gap-3 p-3 hover:bg-gray-50 rounded-lg">
                        <div class="w-16 h-10 bg-gradient-to-r from-blue-400 to-blue-600 rounded-lg"><img class="h-full w-full"
                                src="{{ Storage::url($cl->thumbnail_url) }}"></div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-800">{{ $cl->title }}</p>
                            <p class="text-xs text-gray-500">{{ $cl->lessons->count() }} {{ __("lessons ") }} • {{ $cl->price }}
                                $</p>
                        </div>
                        {{-- <span class="status-badge status-active">نشط</span> --}}
                    </div>

                @endforeach


            </div>
        </div>

        <!-- Recent Blog Posts -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-800">{{ __("Recent Posts") }}</h3>
                <a href="{{ route('admin.posts.index') }}"
                    class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">{{ __("Show All") }}</a>
            </div>
            <div class="space-y-4">
                @foreach ($PostLatest as $pl)
                    <div class="flex items-center gap-3 p-3 hover:bg-gray-50 rounded-lg">
                        <div
                            class="w-10 h-10 bg-gradient-to-r from-purple-400 to-purple-600 rounded-lg flex items-center justify-center text-white">
                            <i class="fas fa-pen"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-800">{{ $pl->title }}</p>
                            <p class="text-xs text-gray-500"> {{ $pl->created_at->format('d F Y') }}</p>
                        </div>
                        {{-- <span class="status-badge status-active">منشور</span> --}}
                    </div>

                @endforeach


            </div>
        </div>
    </div>
@endsection