<div class="bg-white">
    <form wire:submit.prevent="save" class="p-6 space-y-6">
        <!-- Photo Upload -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('Author Photo') }}</label>
            <div 
                class="upload-area border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-indigo-400 transition cursor-pointer"
                x-on:click="$refs.photoInput.click()"
            >
                @if($profile_photo_url)
                    <div class="mb-2">
                        <img src="{{ $profile_photo_url->temporaryUrl() }}" 
                             alt="{{ __('Image Preview') }}" 
                             class="w-24 h-24 object-cover rounded-full mx-auto">
                    </div>
                    <p class="text-gray-600 text-sm">{{ $profile_photo_url->getClientOriginalName() }}</p>
                @else
                    <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                    <p class="text-gray-600">{{ __('Click to upload an image or drag it here') }}</p>
                    <p class="text-xs text-gray-500 mt-1">{{ __('JPG, PNG up to 2MB • Ideal dimensions: 400x400 pixels') }}</p>
                @endif
                <input 
                    type="file" 
                    wire:model="profile_photo_url"
                    x-ref="photoInput"
                    accept="image/*" 
                    class="hidden"
                >
            </div>
            @error('profile_photo_url') 
                <span class="text-red-500 text-sm">{{ $message }}</span> 
            @enderror
        </div>
        
        <!-- Basic Info -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('Full Name *') }}</label>
                <input 
                    type="text" 
                    wire:model="name"
                    class="w-full px-3 py-2 border {{ $errors->has('name') ? 'border-red-500' : 'border-gray-300' }} rounded-lg"
                    placeholder="{{ __('Enter the author\'s full name') }}"
                >
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('Field of Work *') }}</label>
                <input 
                    type="text" 
                    wire:model="area_work"
                    class="w-full px-3 py-2 border {{ $errors->has('area_work') ? 'border-red-500' : 'border-gray-300' }} rounded-lg"
                    placeholder="{{ __('Example: Web development, Graphic design') }}"
                >
                @error('area_work') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>
        
        <!-- Contact Info -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('Email Address *') }}</label>
            <input 
                type="email" 
                wire:model="email"
                class="w-full px-3 py-2 border {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }} rounded-lg"
                placeholder="example@email.com"
            >
            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        
        <!-- Bio -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('Biography *') }}</label>
            <textarea 
                rows="4" 
                wire:model="bio"
                class="w-full px-3 py-2 border {{ $errors->has('bio') ? 'border-red-500' : 'border-gray-300' }} rounded-lg"
                placeholder="{{ __('Write a short biography about the author...') }}"
            ></textarea>
            @error('bio') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        
        <!-- Buttons -->
        <div class="flex gap-3 pt-4">
            
            <button 
                type="submit" 
                class="flex-1 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                {{ __('Save Author') }}
            </button>
        </div>
    </form>
</div>