@extends('admin.layouts.app')

@push('styles')
<style>
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
    {{ __('Authors Editing') }}
@endsection

@section('content')
    <main class="flex-1 p-6 md:ml-0">
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800">{{ __('Edit Author') }}</h1>
            <p class="text-gray-600">{{ __('Update the author\'s information and personal data') }}</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 max-w-4xl mx-auto">
            <form action="{{ route('admin.authers.update', $auther->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')
                <!-- Photo Upload -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('Author Photo') }}</label>
                    <div class="upload-area" id="photoUploadArea">
                        <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                        <p class="text-gray-600">{{ __('Click to upload an image or drag it here') }}</p>
                        <p class="text-xs text-gray-500 mt-1">{{ __('JPG, PNG up to 2MB • Ideal dimensions: 400x400 pixels') }}</p>
                        <input type="file" id="authorPhoto" name="profile_photo_url" accept="image/*" class="hidden">
                    </div>
                    @error('profile_photo_url')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                    
                    <!-- Current Photo Preview -->
                    <div class="mt-4 flex justify-center">
                        @if($auther->profile_photo_url && $auther->profile_photo_url !== 'authers_photo/test.jpg')
                            <img src="{{ asset('storage/' . $auther->profile_photo_url) }}" 
                                 alt="{{ $auther->name }}" 
                                 class="w-32 h-32 rounded-full object-cover border-2 border-gray-200">
                        @else
                            <div class="w-32 h-32 rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 flex items-center justify-center text-white text-2xl font-bold">
                                {{ substr($auther->name, 0, 2) }}
                            </div>
                        @endif
                    </div>
                </div>
                
                <!-- Basic Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('Full Name *') }}</label>
                        <input 
                            type="text" 
                            name="name"
                            value="{{ old('name', $auther->name) }}"
                            class="w-full px-3 py-2 border {{ $errors->has('name') ? 'border-red-500' : 'border-gray-300' }} rounded-lg"
                            required
                        >
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('Field of Work *') }}</label>
                        <input 
                            type="text" 
                            name="area_work"
                            value="{{ old('area_work', $auther->area_work) }}"
                            class="w-full px-3 py-2 border {{ $errors->has('area_work') ? 'border-red-500' : 'border-gray-300' }} rounded-lg"
                            required
                        >
                        @error('area_work')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                
                <!-- Contact Info -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('Email Address *') }}</label>
                    <input 
                        type="email" 
                        name="email"
                        value="{{ old('email', $auther->email) }}"
                        class="w-full px-3 py-2 border {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }} rounded-lg"
                        required
                    >
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                
                <!-- Bio -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('Biography *') }}</label>
                    <textarea 
                        rows="5" 
                        name="bio"
                        class="w-full px-3 py-2 border {{ $errors->has('bio') ? 'border-red-500' : 'border-gray-300' }} rounded-lg"
                    >{{ old('bio', $auther->bio) }}</textarea>
                    @error('bio')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                
                <!-- Associated Content -->
                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">{{ __('Associated Content') }}</h3>
                    
                    <div class="space-y-3">
                        <div class="p-3 bg-blue-50 rounded-lg">
                            <p class="font-medium text-gray-800">{{ __('Courses taught:') }}</p>
                            <ul class="list-disc list-inside text-sm text-gray-600 mt-1">
                                @foreach($auther->courses as $course)
                                    <li>{{ $course->name_ar }}</li>
                                @endforeach
                                @if($auther->courses->count() == 0)
                                    <li>{{ __('No associated courses') }}</li>
                                @endif
                            </ul>
                        </div>
                        
                        <div class="p-3 bg-green-50 rounded-lg">
                            <p class="font-medium text-gray-800">{{ __('Blog Articles:') }}</p>
                            <ul class="list-disc list-inside text-sm text-gray-600 mt-1">
                                @foreach($auther->posts as $post)
                                    <li>{{ $post->title }}</li>
                                @endforeach
                                @if($auther->posts->count() == 0)
                                    <li>{{ __('No associated articles') }}</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    
                    <p class="text-sm text-gray-500 mt-3">
                        {{ __('When editing the author\'s information, all associated content will be updated automatically.') }}
                    </p>
                </div>
                
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pt-4">
                    <div class="flex gap-3">
                        <a href="{{ route('admin.authers.index') }}" 
                           class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                            <i class="fas fa-times ml-2"></i>{{ __('Cancel') }}
                        </a>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                            <i class="fas fa-save ml-2"></i>{{ __('Save Changes') }}
                        </button>
                    </div>
                    
                </div>
            </form>
            <form action="{{ route('admin.authers.destroy', $auther->id) }}" method="POST" class="inline ">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        onclick="return confirm('{{ __('Are you sure you want to delete this author? All associated data will be deleted.') }}')"
                        class="px-4 py-2 mt-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                    <i class="fas fa-trash ml-2"></i>{{ __('Delete Author') }}
                </button>
            </form>
        </div>
    </main>
@endsection

@push('scripts')
<script>
    const photoUploadArea = document.getElementById('photoUploadArea');
    const authorPhoto = document.getElementById('authorPhoto');
    
    photoUploadArea.addEventListener('click', () => authorPhoto.click());
    
    authorPhoto.addEventListener('change', function(e) {
        if (this.files && this.files[0]) {
            const fileName = this.files[0].name;
            photoUploadArea.innerHTML = `
                <i class="fas fa-check-circle text-3xl text-green-500 mb-2"></i>
                <p class="text-gray-600">${fileName}</p>
                <p class="text-xs text-gray-500 mt-1">{{__("Downloaded successfully")}}</p>
                <input type="file" id="authorPhoto" name="profile_photo_url" accept="image/*" class="hidden">
            `;
            document.getElementById('authorPhoto').addEventListener('change', handlePhotoChange);
        }
    });
    
    function handlePhotoChange(e) {
        if (this.files && this.files[0]) {
            const fileName = this.files[0].name;
            photoUploadArea.innerHTML = `
                <i class="fas fa-check-circle text-3xl text-green-500 mb-2"></i>
                <p class="text-gray-600">${fileName}</p>
                <p class="text-xs text-gray-500 mt-1">{{__("Downloaded successfully")}}</p>
                <input type="file" id="authorPhoto" name="profile_photo_url" accept="image/*" class="hidden">
            `;
            document.getElementById('authorPhoto').addEventListener('change', handlePhotoChange);
        }
    }
    
    // Drag and drop functionality
    photoUploadArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        photoUploadArea.classList.add('dragover');
    });
    
    photoUploadArea.addEventListener('dragleave', () => {
        photoUploadArea.classList.remove('dragover');
    });
    
    photoUploadArea.addEventListener('drop', (e) => {
        e.preventDefault();
        photoUploadArea.classList.remove('dragover');
        if (e.dataTransfer.files.length > 0) {
            const input = photoUploadArea.querySelector('input[type="file"]');
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(e.dataTransfer.files[0]);
            input.files = dataTransfer.files;
            
            // Trigger change event
            const event = new Event('change', { bubbles: true });
            input.dispatchEvent(event);
        }
    });
</script>
@endpush