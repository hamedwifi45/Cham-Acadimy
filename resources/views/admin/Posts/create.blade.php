@extends('admin.layouts.app')

@section('title', __('Add New Post'))
@push('styles')
<style>
        @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700&display=swap');
        
        body {
            font-family: 'Tajawal', sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #eef2ff 100%);
        }
        
        .sidebar {
            transition: all 0.3s ease;
            height: calc(100vh - 4rem);
        }
        
        .form-input:focus {
            outline: none;
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }
        
        .editor-container {
            position: relative;
        }
        
        .char-counter {
            position: absolute;
            bottom: 8px;
            left: 12px;
            font-size: 0.75rem;
            color: #64748b;
        }
    </style>
@endpush
@section('content')
    <main class="flex-1 p-6 md:ml-0">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-800">{{ __('Add New Article') }}</h1>
                <p class="text-gray-600 mt-2">{{ __('Create valuable educational content for your platform visitors') }}</p>
            </div>

            <div class="bg-white rounded-2xl shadow-xl overflow-hidden max-w-4xl mx-auto">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-800">{{ __('Article Editor') }}</h2>
                </div>
                
                <div class="p-6">
                    <form action="{{ route('admin.posts.store') }}" method="post" class="space-y-8">
                        @csrf
                        @method('POST')

                        <!-- Post Title -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">{{ __('Post Title *') }}</label>
                            <input 
                                type="text" 
                                name="title"
                                value="{{ old('title') }}"
                                class="form-input w-full px-4 py-3 border @error('title') border-red-500 @else border-gray-300 @enderror rounded-xl text-lg font-medium"
                                placeholder="{{ __('Write an attractive title for the post...') }}"
                                required
                            >
                            @error('title')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Author Selection -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">{{ __('Author *') }}</label>
                            <select 
                                name="auther_id" 
                                class="form-input w-full px-4 py-3 border @error('author_id') border-red-500 @else border-gray-300 @enderror rounded-xl" 
                                required
                            >
                                <option value="">{{ __('Select an author') }}</option>
                                @foreach($authors as $author)
                                    <option value="{{ $author->id }}" {{ old('author_id') == $author->id ? 'selected' : '' }}>
                                        {{ $author->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('author_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Post body -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">{{ __('Post body *') }}</label>
                            <div class="editor-container">
                                <textarea 
                                    rows="12" 
                                    name="body"
                                    class="form-input w-full px-4 py-3 border @error('body') border-red-500 @else border-gray-300 @enderror rounded-xl resize-none"
                                    placeholder="{{ __('Write the post body here...') }}"
                                    required
                                >{{ old('body') }}</textarea>
                            </div>
                            @error('body')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Form Actions -->
                        <div class="flex gap-4 pt-4">
                            <a href="{{ url()->previous() }}" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition">
                                <i class="fas fa-times mr-2"></i>{{ __('Cancel') }}
                            </a>
                            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl hover:from-indigo-700 hover:to-purple-700 transition shadow-lg">
                                <i class="fas fa-paper-plane mr-2"></i>{{ __('Publish Post') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
@endsection