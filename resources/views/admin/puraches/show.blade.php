@extends('admin.layouts.app')
@section('title')
  {{ __('Sales') }}
@endsection
@push('styles')
<style>
    .purchase-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        border: 1px solid #e2e8f0;
    }
    
    .purchase-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        border-color: #cbd5e1;
    }
    
    .status-completed {
        background-color: #dcfce7;
        color: #16a34a;
    }
    
    .status-pending {
        background-color: #fef3c7;
        color: #d97706;
    }
    
    .status-rejected {
        background-color: #fee2e2;
        color: #dc2626;
    }
    
    .status-failed {
        background-color: #fee2e2;
        color: #dc2626;
    }
    
    .payment-stripe {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.25rem 0.75rem;
        border-radius: 50px;
        background-color: #f1f5f9;
        color: #3b82f6;
        font-size: 0.875rem;
        font-weight: 600;
    }
    
    .filter-active {
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
        border-color: #3b82f6;
    }
</style>
@endpush

@section('content')
    <main class="flex-1 p-6 md:ml-0">
        @if (session()->has('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif
        
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800">{{ __('Purchases Management') }}</h1>
            <p class="text-gray-600">{{ __('View and analyze all purchase operations across the platform') }}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">{{ __('Total Revenue') }}</p>
                        <p class="text-2xl font-bold text-gray-800">{{ number_format($totalRevenue, 2) }} $</p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-chart-line text-purple-600"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">{{ __('Total Purchases') }}</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $totalPurchases }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-shopping-cart text-blue-600"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">{{ __('Completed Purchases') }}</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $completedPurchases }}</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-check-circle text-green-600"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">{{ __('Failed Purchases') }}</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $failedPurchases }}</p>
                    </div>
                    <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-times-circle text-red-600"></i>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('admin.puraches.search') }}" method="GET" class="mb-6">
            @csrf
            <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            {{ __('Search By') }}
                        </label>
                        <select name="search_by" class="form-select w-full px-9 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="payment_id" {{ request('search_by', 'payment_id') === 'payment_id' ? 'selected' : '' }}>
                                {{ __('Transaction ID') }}
                            </option>
                            <option value="user" {{ request('search_by') === 'user' ? 'selected' : '' }}>
                                {{ __('Username') }}
                            </option>
                            <option value="course" {{ request('search_by') === 'course' ? 'selected' : '' }}>
                                {{ __('Course Name') }}
                            </option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            {{ __('Keyword') }}
                        </label>
                        <div class="relative">
                            <input 
                                type="text" 
                                name="query"
                                placeholder="{{ __('Search...') }}" 
                                class="form-input w-full px-4 py-2 border border-gray-300 rounded-lg pl-10 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                value="{{ request('query') }}"
                            >
                            <i class="fas fa-search absolute left-3 top-2.5 text-gray-400"></i>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            {{ __('Status') }}
                        </label>
                        <select name="status" class="form-select w-full px-9 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="all" {{ request('status', 'all') === 'all' ? 'selected' : '' }}>
                                {{ __('All') }}
                            </option>
                            <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>
                                {{ __('Completed') }}
                            </option>
                            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>
                                {{ __('Pending') }}
                            </option>
                            <option value="failed" {{ request('status') === 'failed' ? 'selected' : '' }}>
                                {{ __('Failed') }}
                            </option>
                        </select>
                    </div>

                    <div class="flex items-end space-x-2 rtl:space-x-reverse">
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition flex items-center">
                            <i class="fas fa-search mx-2"></i>
                            {{ __('Search') }}
                        </button>
                        <a href="{{ route('admin.puraches.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition flex items-center">
                            <i class="fas fa-redo mx-2"></i>
                            {{ __('Reset') }}
                        </a>
                    </div>
                </div>
            </div>
        </form>

        @if(request('query') || request('status') !== 'all' || request('search_by') !== 'payment_id')
            <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-6">
                <div class="flex flex-wrap items-center gap-3">
                    <span class="text-sm font-medium text-blue-800">
                        <i class="fas fa-filter ml-2"></i>
                        {{ __('Active Filters:') }}
                    </span>
                    
                    @if(request('search_by') === 'payment_id')
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">
                            {{ __('Transaction ID:') }} {{ request('query') }}
                        </span>
                    @elseif(request('search_by') === 'user')
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">
                            {{ __('User:') }} {{ request('query') }}
                        </span>
                    @elseif(request('search_by') === 'course')
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">
                            {{ __('Course:') }} {{ request('query') }}
                        </span>
                    @endif
                    
                    @if(request('status') !== 'all')
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">
                            {{ __('Status:') }} 
                            @if(request('status') === 'completed'){{ __('Completed') }}
                            @elseif(request('status') === 'pending'){{ __('Pending') }}
                            @elseif(request('status') === 'failed'){{ __('Failed') }}
                            @endif
                        </span>
                    @endif
                    
                    <a href="{{ route('admin.puraches.index') }}" class="text-xs text-blue-600 hover:text-blue-800">
                        <i class="fas fa-times ml-1"></i>{{ __('Clear All') }}
                    </a>
                </div>
            </div>
        @endif

        <div class="space-y-4">
            @forelse ($purchases as $pur)
                <div class="purchase-card">
                    <div class="p-4">
                        <div class="flex items-start gap-4">
                            @if ($pur->status == 'completed')
                                <div class="w-12 h-12 bg-gradient-to-r from-green-400 to-green-600 rounded-lg flex items-center justify-center text-white">
                                    <i class="fas fa-check"></i>
                                </div>
                            @elseif($pur->status == 'failed')
                                <div class="w-12 h-12 bg-gradient-to-r from-red-400 to-red-600 rounded-lg flex items-center justify-center text-white">
                                    <i class="fas fa-times"></i>
                                </div>
                            @else
                                <div class="w-12 h-12 bg-gradient-to-r from-yellow-400 to-yellow-600 rounded-lg flex items-center justify-center text-white">
                                    <i class="fas fa-clock"></i>
                                </div>
                            @endif

                            <div class="flex-1">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <h3 class="font-bold text-gray-800 text-lg">
                                            {{ Str::limit($pur->payment_id, 25) }}
                                        </h3>
                                        <p class="text-xs text-gray-500 mt-1">
                                            <i class="fas fa-calendar-alt ml-1"></i>
                                            {{ $pur->created_at->format('Y-m-d H:i') }}
                                        </p>
                                    </div>                              
                                    @if ($pur->status == 'completed')
                                        <span class="status-completed text-xs font-medium px-3 py-1 rounded-full">
                                            <i class="fas fa-check ml-1"></i>{{ __('Completed') }}
                                        </span>
                                    @elseif($pur->status == 'failed')
                                        <span class="status-failed text-xs font-medium px-3 py-1 rounded-full">
                                            <i class="fas fa-times ml-1"></i>{{ __('Failed') }}
                                        </span>
                                    @else
                                        <span class="status-pending text-xs font-medium px-3 py-1 rounded-full">
                                            <i class="fas fa-clock ml-1"></i>{{ __('Pending') }}
                                        </span>
                                    @endif
                                </div>

                                <div class="bg-gray-50 p-3 rounded-lg mb-3">
                                    <p class="text-gray-700 text-sm mb-1">
                                        <i class="fas fa-user ml-1 text-blue-600"></i>
                                        <strong>{{ $pur->user->name }}</strong> 
                                        <span class="text-gray-500">({{ $pur->user->email }})</span>
                                    </p>
                                    <p class="text-gray-700 text-sm">
                                        <i class="fas fa-book ml-1 text-purple-600"></i>
                                        <strong>{{ $pur->course->name_ar }}</strong>
                                        @if($pur->course->name_en)
                                            <span class="text-gray-500">/ {{ $pur->course->name_en }}</span>
                                        @endif
                                    </p>
                                </div>

                                <div class="flex justify-between items-center">
                                    <div class="flex items-center gap-4">
                                        <span class="text-lg font-bold text-indigo-600">
                                            <i class="fas fa-dollar-sign ml-1"></i>
                                            {{ number_format($pur->amount, 2) }}
                                        </span>
                                        <span class="payment-stripe">
                                            <i class="fab fa-stripe"></i> Stripe
                                        </span>
                                        <span class="text-xs text-gray-500">
                                            <i class="fas fa-clock ml-1"></i>
                                            {{ $pur->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                    
                                    <div class="flex gap-2">
                                        {{-- <a href="{{ route('admin.authers.edit', $pur->id) }}" 
                                           class="text-sm bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition flex items-center">
                                            <i class="fas fa-eye ml-1"></i>
                                            {{ __('View') }}
                                        </a> --}}
                                        {{-- مستقبلاً وليس الان --}}
                                        <a href="{{ route('admin.puraches.edit', $pur->id) }}" 
                                           class="text-sm bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition flex items-center">
                                            <i class="fas fa-edit ml-1"></i>
                                            {{ __('Edit') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
                    <div class="mx-auto w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-shopping-cart text-gray-400 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">
                        {{ __('No Purchases') }}
                    </h3>
                    <p class="text-gray-600 mb-6">
                        @if(request('query') || request('status') !== 'all')
                            {{ __('No purchases match the specified search criteria.') }}
                        @else
                            {{ __('No purchases have been recorded yet.') }}
                        @endif
                    </p>
                    
                    @if(request('query') || request('status') !== 'all')
                        <a href="{{ route('admin.puraches.index') }}" 
                           class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                            <i class="fas fa-redo ml-2"></i>
                            {{ __('View All Purchases') }}
                        </a>
                    @endif
                </div>
            @endforelse
        </div>

        @if($purchases->hasPages())
            <div class="flex justify-center mt-8">
                <nav class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
                    {{ $purchases->appends(request()->query())->links() }}
                </nav>
            </div>
        @endif
    </main>
@endsection