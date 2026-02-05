@extends('admin.layouts.app')

@push('styles')
    <style>
        .purchase-detail-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
        }

        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 50px;
            font-size: 0.875rem;
            font-weight: 600;
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

        .form-input:focus {
            outline: none;
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }
    </style>
@endpush

@section('content')
    <main class="flex-1 p-6 md:ml-0">
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-gray-800">{{ __('Purchase Details') }}</h1>
                <p class="text-gray-600">{{ __('View and edit purchase status') }}</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- User Information -->
                <div class="purchase-detail-card">
                    <div class="p-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-6">{{ __('User Information') }}</h2>
                        
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-16 h-16 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-xl">
                                <img class="w-16 h-16 rounded-full" src="{{ Auth::user()->profile_photo_url }}">
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-800">{{ $user->name }}</h3>
                                <p class="text-gray-600">{{ $user->email }}</p>
                            </div>
                        </div>
                        
                        <div class="space-y-4">
                            <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                                <span class="text-gray-600">{{ __('Transaction ID') }}</span>
                                <span class="font-medium text-gray-800">{{ $puraches->payment_id }}</span>
                            </div>
                            
                            
                            <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                                <span class="text-gray-600">{{ __('Payment Method') }}</span>
                                <span class="payment-stripe">
                                    <i class="fab fa-stripe"></i> Stripe
                                </span>
                            </div>
                            
                            <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                                <span class="text-gray-600">{{ __('Purchase Date') }}</span>
                                <span class="font-medium text-gray-800">{{ $puraches->created_at->diffForHumans() }}</span>
                            </div>
                            
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">{{ __('Current Status') }}</span>
                                <span class="status-completed status-badge">{{ $puraches->status }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Course Information -->
                <div class="purchase-detail-card">
                    <div class="p-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-6">{{ __('Course Information') }}</h2>
                        
                        <div class="mb-6">
                                <img class="rounded-lg mx-auto h-48"  src="{{ Storage::url($course->thumbnail_url) }}" alt="" srcset="">
                    
                            <h3 class="text-lg font-bold text-gray-800 mb-2">{{ $course->name }}</h3>
                            <p class="text-gray-600 mb-4">
                                {{ Str::limit($course->content , 100) }}
                            </p>
                        </div>
                        
                        <div class="space-y-4">
                            <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                                <span class="text-gray-600">{{ __('Number of Lessons') }}</span>
                                <span class="font-medium text-gray-800">{{$course->lessons->count()}}</span>
                            </div>
                            
                            <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                                <span class="text-gray-600">{{ __('Approximate Duration') }}</span>
                                <span class="font-medium text-gray-800">{{ $course->duration_hours }}</span>
                            </div>
                            
                            <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                                <span class="text-gray-600">{{ __('Level') }}</span>
                                <span class="font-medium text-gray-800">{{ $course->level }}</span>
                            </div>
                            
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">{{ __('Price') }}</span>
                                <span class="text-2xl font-bold text-indigo-600">{{ $course->price }} $</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Update Status Section -->
            <div class="purchase-detail-card mt-8">
                <div class="p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">{{ __('Update Purchase Status') }}</h2>
                    <p class="text-gray-600 mb-6">{{ __('You can modify the purchase status as needed') }}</p>
                    
                    <form action="{{ route('admin.puraches.update' , $puraches->id) }}" method="post" class="space-y-6">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('New Status *') }}</label>
                            <select name="status" class=" form-input w-full px-8 py-2 border border-gray-300 rounded-lg" required>
                                <option value="pending"{{ $puraches->status == 'pending' ? 'selected' : '' }}>{{ __('Pending') }}</option>
                                <option value="completed" {{ $puraches->status == 'completed' ? 'selected' : '' }} >{{ __('Completed') }}</option>
                                <option value="failed" {{ $puraches->status == 'failed' ? 'selected' : '' }} >{{ __('Failed') }}</option>
                            </select>
                        </div>

                        
                        <div class="flex gap-3 pt-4">
                            <button onclick="window.location.href='{{ route('admin.puraches.index') }}'" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                                <i class="fas fa-times mr-2"></i>{{ __('Cancel') }}
                            </button>
                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                                <i class="fas fa-save mr-2"></i>{{ __('Update Status') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
@endsection