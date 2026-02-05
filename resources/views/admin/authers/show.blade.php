@extends('admin.layouts.app')

@push('styles')
<style>
        .author-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border: 1px solid #e2e8f0;
        }
        
        .author-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
            border-color: #cbd5e1;
        }
        
        .upload-area {
            border: 2px dashed #cbd5e1;
            border-radius: 12px;
            padding: 24px;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .upload-area:hover {
            border-color: #4f46e5;
            background-color: #f8fafc;
        }
        
        .upload-area.dragover {
            border-color: #4f46e5;
            background-color: #f0f4ff;
        }
    </style>
@endpush

@section('title')
    {{ __('Authors Management') }}
@endsection
@section('content')
    <main class="flex-1 p-6 md:ml-0">
            <!-- Header Section -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">{{ __('Authors Management') }}</h1>
                    <p class="text-gray-600">{{ __('Add and edit content writers on your platform') }}</p>
                </div>
                <button id="addAuthorBtn" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition flex items-center gap-2">
                    <i class="fas fa-plus"></i>
                    {{ __('Add New Author') }}
                </button>
            </div>

            <!-- Filters and Search -->
            <form action="{{ route('admin.authers.search') }}" method="post">
                @csrf
                <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200 mb-6">
                    <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <div class="relative">
                            <input 
                                name="query"
                                type="text" 
                                placeholder="{{ __('Search for an author...') }}" 
                                class="form-input w-full px-4 py-2 border border-gray-300 rounded-lg pl-10"
                            >
                            <button type="submit">
                                <i class="fas fa-search absolute left-3 top-2.5 text-gray-400"></i>
                            </button>
                        </div>
                    </div>
                    
                </div>
            </div>
            </form>
            
            <!-- Authors Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($authers as $auther )
                    <div class="author-card">
                        <div class="p-4 text-center">
                            <div class="w-20 h-20 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-xl mx-auto mb-4">
                            <img src="{{ Storage::url($auther->profile_photo_url) }}" class="w-20 h-20 rounded-full" alt="" srcset="">
                            </div>
                            <h3 class="font-bold text-gray-800 text-lg mb-2">{{ $auther->name }}</h3>
                            <p class="text-sm text-gray-600 mb-3">{{ $auther->area_work }}</p>
                            <p class="text-xs text-gray-500 mb-4 line-clamp-2">
                                {{ $auther->bio }}
                            </p>
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('admin.authers.edit', $auther->id) }}" 
                                class="text-sm bg-indigo-600 text-white px-3 py-1 rounded-lg hover:bg-indigo-700 transition">
                                    {{ __('Edit') }}
                                </a>
                                
                                <form method="POST" action="{{ route('admin.authers.destroy', $auther->id) }}" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            onclick="return confirm('{{ __('Are you sure you want to delete this author?') }}')"
                                            class="text-sm bg-red-600 text-white px-3 py-1 rounded-lg hover:bg-red-700 transition w-full">
                                        {{ __('Delete') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            

               
            </div>

            <!-- Pagination -->
            <div class="flex justify-center mt-8">
                <nav class="flex items-center gap-2">
                    {{ $authers->links() }}
                </nav>
            </div>
    </main>
    <div id="authorModal" class="modal hidden fixed inset-0 bg-white bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-800">{{ __('Add New Author') }}</h2>
                    <button id="closeModal" class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        @livewire('admin.auther-create')
        </div>
    </div>
@endsection

@push('scripts')
<script>
        const addAuthorBtn = document.getElementById('addAuthorBtn');
        const authorModal = document.getElementById('authorModal');
        const closeModal = document.getElementById('closeModal');
        const cancelModal = document.getElementById('cancelModal');
        addAuthorBtn.addEventListener('click', () => {
            authorModal.classList.remove('hidden');
        });
        
        closeModal.addEventListener('click', () => {
            authorModal.classList.add('hidden');
        });
        
        cancelModal.addEventListener('click', () => {
            authorModal.classList.add('hidden');
        });
        
        // Close modal when clicking outside
        authorModal.addEventListener('click', (e) => {
            if (e.target === authorModal) {
                authorModal.classList.add('hidden');
            }
        });
</script>
@endpush