<div>
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
        <form wire:submit.prevent="store" class="space-y-8">
            @if (session()->has('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Course Image Upload -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">{{ __("Cover Image") }} *</label>
                <label for="thumbnail_url"
                    class="upload-area cursor-pointer flex flex-col items-center justify-center p-6 border-2 border-dashed rounded-xl transition-colors {{ $errors->has('thumbnail_url') ? 'border-red-500' : 'border-gray-300 hover:border-indigo-400' }}"
                    id="imageUploadArea">
                    @if ($thumbnail_url)
                        <i class="fas fa-check-circle text-3xl text-green-500 mb-2"></i>
                        <p class="text-gray-600">{{ $thumbnail_url->getClientOriginalName() }}</p>
                        <p class="text-xs text-gray-500 mt-1">{{ __("Uploaded") }}</p>
                    @else
                        <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                        <p class="text-gray-600">{{ __("Click to upload image or drag it here") }}</p>
                        <p class="text-xs text-gray-500 mt-1">{{ __("JPG, PNG up to 2MB • Ideal size: 1200x630 px") }}</p>
                    @endif
                </label>
                <input type="file" id="thumbnail_url" wire:model="thumbnail_url" accept="image/*" class="hidden">
                @error('thumbnail_url') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Course Video Upload -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">{{ __("Promotional Video") }} *</label>
                <label for="video_url"
                    class="upload-area cursor-pointer flex flex-col items-center justify-center p-6 border-2 border-dashed rounded-xl transition-colors {{ $errors->has('video_url') ? 'border-red-500' : 'border-gray-300 hover:border-indigo-400' }}"
                    id="videoUploadArea">
                    @if ($video_url)
                        <i class="fas fa-check-circle text-3xl text-green-500 mb-2"></i>
                        <p class="text-gray-600">{{ $video_url->getClientOriginalName() }}</p>
                        <p class="text-xs text-gray-500 mt-1">{{ __("Uploaded") }}</p>
                    @else
                        <i class="fas fa-video text-3xl text-gray-400 mb-2"></i>
                        <p class="text-gray-600">{{ __("Click to upload video or drag it here") }}</p>
                        <p class="text-xs text-gray-500 mt-1">{{ __("MP4, MOV up to 100MB • Ideal length: 1–3 minutes") }}</p>
                    @endif
                </label>
                <input type="file" id="video_url" wire:model="video_url" accept="video/*" class="hidden">
                @error('video_url') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Basic Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">{{ __("Price (USD)") }} *</label>
                    <input type="number" wire:model="price"
                        class="w-full px-3 py-2 border {{ $errors->has('price') ? 'border-red-500' : 'border-gray-300' }} rounded-lg"
                        placeholder="0.00" min="0" step="0.01">
                    @error('price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">{{ __("Level") }} *</label>
                    <select wire:model="level"
                        class="w-full px-8 py-2 border {{ $errors->has('level') ? 'border-red-500' : 'border-gray-300' }} rounded-lg">
                        <option value="">{{ __("Select level") }}</option>
                        @foreach($levels as $value => $label)
                            <option value="{{ $value }}">{{ __($label) }}</option>
                        @endforeach
                    </select>
                    @error('level') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Author -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">{{ __("Author") }} *</label>
                <select wire:model="author_id"
                    class="w-full px-8 py-2 border {{ $errors->has('author_id') ? 'border-red-500' : 'border-gray-300' }} rounded-lg">
                    <option value="">{{ __("Select author") }}</option>
                    @foreach($authors as $author)
                        <option value="{{ $author->id }}">{{ $author->name }}</option>
                    @endforeach
                </select>
                @error('author_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- names -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">{{ __("Course Title (Arabic)") }} *</label>
                    <input type="text" wire:model="name_ar"
                        class="w-full px-3 py-2 border {{ $errors->has('name_ar') ? 'border-red-500' : 'border-gray-300' }} rounded-lg"
                        placeholder="{{ __("Enter course title in Arabic") }}" required>
                    @error('name_ar') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">{{ __("Course Title (English)") }} *</label>
                    <input type="text" wire:model="name_en"
                        class="w-full px-3 py-2 border {{ $errors->has('name_en') ? 'border-red-500' : 'border-gray-300' }} rounded-lg"
                        placeholder="{{ __("Enter course title in English") }}" required>
                    @error('name_en') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Descriptions -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">{{ __("Description (Arabic)") }} *</label>
                    <textarea rows="4" wire:model="description_ar"
                        class="w-full px-3 py-2 border {{ $errors->has('description_ar') ? 'border-red-500' : 'border-gray-300' }} rounded-lg"
                        placeholder="{{ __("Write a detailed description in Arabic") }}" required></textarea>
                    @error('description_ar') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">{{ __("Description (English)") }} *</label>
                    <textarea rows="4" wire:model="description_en"
                        class="w-full px-3 py-2 border {{ $errors->has('description_en') ? 'border-red-500' : 'border-gray-300' }} rounded-lg"
                        placeholder="{{ __("Write a detailed description in English") }}" required></textarea>
                    @error('description_en') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex gap-3 pt-4">
                <a href="{{ route('admin.courses.index') }}"
                    class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-100">
                    {{ __("Cancel") }}
                </a>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                    {{ __("Save Course") }}
                </button>
            </div>
        </form>
    </div>
</div>
