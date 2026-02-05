@extends('admin.layouts.app')

@section('title')
    {{ __('users') }}
@endsection
@push('styles')
<style>
    .user-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border: 1px solid #e2e8f0;
        }
        
        .user-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
            border-color: #cbd5e1;
        }
        
        .role-admin {
            background-color: #dbeafe;
            color: #1d4ed8;
        }
        
        .role-instructor {
            background-color: #dcfce7;
            color: #16a34a;
        }
        
        .role-student {
            background-color: #fef3c7;
            color: #d97706;
        }
        
        .status-active {
            background-color: #dcfce7;
            color: #16a34a;
        }
        
        .status-inactive {
            background-color: #fee2e2;
            color: #dc2626;
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
            <!-- Header Section -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">{{ __('Users management')}}</h1>
                    <p class="text-gray-600">{{__('View and delete all user accounts on the platform')}}</p>
                </div>
            </div>

            <!-- Filters and Search -->
            <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200 mb-6">
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <div class="relative">
                            <form action="{{ route('admin.users.search') }}" method="post">
                                @csrf
                                <input 
                                    type="text" 
                                    name="query"
                                    value="{{ $sreach }}"
                                    placeholder="{{ __('Find a user...')}}" 
                                    class="form-input w-full px-4 py-2 border border-gray-300 rounded-lg pl-10"
                                >
                                <button type="submit" class="absolute left-3 top-2.5 text-gray-400"><i class="fas fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Users List -->
            <div class="space-y-4">
                @foreach ($users as $user)
                    <div class="user-card">
                        <div class="p-4">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-lg"><img src="{{ $user->profile_photo_url  }}" alt="Avatar" class="w-full h-full rounded-full object-cover"></div>
                                <div class="flex-1">
                                    <div class="flex justify-between items-start mb-1">
                                        <h3 class="font-bold text-gray-800 text-lg">{{ $user->name }}</h3>
                                    </div>
                                    <p class="text-gray-600 text-sm mb-2">{{ $user->email }}</p>
                                    <div class="flex justify-between items-center">
                                        <span class="role-admin text-xs font-medium px-2 py-1 rounded-full">{{ $user->admin_level > 0 ? __('boss') : __('Regular user') }}</span>
                                        <div class="flex gap-2">
                                            
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="post">
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
                {{ $users->links() }}
                </nav>
            </div>
        </main>
@endsection