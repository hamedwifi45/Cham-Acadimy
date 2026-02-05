<div>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">{{ __("Edit Lesson") }}: {{ $title }}</h1>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
        <form wire:submit.prevent="store" class="space-y-8">
            @if (session()->has('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Course -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">{{ __("Course") }} *</label>
                <select wire:model="course_id" class="w-full px-3 py-2 border rounded-lg">
                    <option value="">{{ __("Select Course") }}</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->name_ar }}</option>
                    @endforeach
                </select>
                @error('course_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Video Upload -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">{{ __("Lesson Video") }} *</label>
                <label for="video_url_input"
                    class="upload-area cursor-pointer flex flex-col items-center justify-center p-6 border-2 border-dashed rounded-xl transition-colors {{ $errors->has('video_url') ? 'border-red-500' : 'border-gray-300 hover:border-indigo-400' }}">
                    
                    @if ($video_url)
                        <i class="fas fa-check-circle text-3xl text-green-500 mb-2"></i>
                        <p class="text-gray-600">{{ $video_url->getClientOriginalName() }}</p>
                    @elseif($current_video)
                        <i class="fas fa-video text-3xl text-blue-500 mb-2"></i>
                        <p class="text-sm text-gray-600">{{ __("Current video exists") }}</p>
                        <a href="{{ asset('storage/' . $current_video) }}" target="_blank" class="text-blue-600 text-sm">{{ __("View") }}</a>
                    @else
                        <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                        <p class="text-gray-600">{{ __("Click to upload video") }}</p>
                        <p class="text-xs text-gray-500">{{ __("MP4, MOV up to 500MB") }}</p>
                    @endif
                </label>
                <input type="file" id="video_url_input" wire:model="video_url" accept="video/mp4,video/mov" class="hidden">
                @error('video_url') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                @if ($duration_minutes > 0)
                    <div class="mt-2 text-sm text-gray-600">
                        <i class="fas fa-clock mr-1"></i>
                        {{ __("Duration") }}: {{ $duration_minutes }} {{ $duration_minutes == 1 ? __("minute") : __("minutes") }}
                    </div>
                @endif
            </div>

            <!-- Order -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">{{ __("Lesson Order") }} *</label>
                <input type="number" min="1" wire:model="order" class="w-full px-3 py-2 border rounded-lg">
                @error('order') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Title -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">{{ __("Lesson Title") }} *</label>
                <input type="text" wire:model="title" class="w-full px-3 py-2 border rounded-lg">
                @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Content -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">{{ __("Lesson Content (Optional)") }}</label>
                <textarea wire:model="content" rows="4" class="w-full px-3 py-2 border rounded-lg"></textarea>
            </div>

            <!-- Actions -->
            <div class="flex gap-3 pt-4">
                <a href="{{ route('admin.lessons.index') }}" class="px-4 py-2 border rounded-lg hover:bg-gray-100">
                    {{ __("Cancel") }}
                </a>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                    {{ __("Update Lesson") }}
                </button>
            </div>
        </form>
    </div>
</div>


    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const videoInput = document.getElementById('video_url_input');
            if (!videoInput) return;

            videoInput.addEventListener('change', function () {
                if (this.files && this.files[0]) {
                    const video = document.createElement('video');
                    video.preload = 'metadata';
                    video.onloadedmetadata = function () {
                        const minutes = Math.ceil((video.duration / 60) - 1.5);
                        Livewire.dispatch('videoDurationDetected', { minutes: minutes });
                        URL.revokeObjectURL(video.src);
                    };
                    video.src = URL.createObjectURL(this.files[0]);
                }
            });
        });
    </script>
    @endpush
</div>