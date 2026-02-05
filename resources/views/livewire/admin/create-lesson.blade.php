<div>
    
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
        <form wire:submit.prevent="store" class="space-y-8">
            @if (session()->has('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Course Selection -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">{{ __("Course") }} *</label>
                <select wire:model="course_id"
                    class="w-full px-9 py-2 border {{ $errors->has('course_id') ? 'border-red-500' : 'border-gray-300' }} rounded-lg">
                    <option value="">{{ __("Select Course") }}</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->name_ar }}</option>
                    @endforeach
                </select>
                @error('course_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Lesson Video Upload -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">{{ __("Lesson Video") }} *</label>
                <label for="video_url_input"
                    class="upload-area cursor-pointer flex flex-col items-center justify-center p-6 border-2 border-dashed rounded-xl transition-colors {{ $errors->has('video_url') ? 'border-red-500' : 'border-gray-300 hover:border-indigo-400' }}"
                    id="videoUploadArea">
                    @if ($video_url)
                        <i class="fas fa-check-circle text-3xl text-green-500 mb-2"></i>
                        <p class="text-gray-600">{{ $video_url->getClientOriginalName() }}</p>
                        <p class="text-xs text-gray-500 mt-1">{{ __("Uploaded") }}</p>
                    @else
                        <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                        <p class="text-gray-600">{{ __("Click to upload video or drag it here") }}</p>
                        <p class="text-xs text-gray-500 mt-1">{{ __("MP4, MOV up to 500MB • Ideal length: 5–20 minutes") }}</p>
                    @endif
                </label>
                <input type="file" id="video_url_input" wire:model="video_url" accept="video/*" class="hidden">

                <!-- Video Preview -->
                <div id="videoPreview" class="mt-4 hidden" wire:ignore>
                    <video controls class="w-full rounded-lg"></video>
                </div>

                <!-- Duration Display -->
                <div id="durationDisplay" class="mt-2 text-sm text-gray-600 hidden">
                    <i class="fas fa-clock mr-1"></i>
                    <span id="durationText">{{ __("0 minutes") }}</span>
                </div>
            </div>

            <!-- Lesson Order -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">{{ __("Lesson Order") }} *</label>
                <input type="number" wire:model="order"
                    class="w-full px-3 py-2 border {{ $errors->has('order') ? 'border-red-500' : 'border-gray-300' }} rounded-lg"
                    placeholder="1" min="1">
                <p class="text-xs text-gray-500 mt-1">{{ __("Lesson will be displayed based on this order in the course") }}</p>
                @error('order') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Lesson Title -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">{{ __("Lesson Title") }} *</label>
                <input type="text" wire:model="title"
                    class="w-full px-3 py-2 border {{ $errors->has('title') ? 'border-red-500' : 'border-gray-300' }} rounded-lg"
                    placeholder="{{ __("Enter lesson title") }}">
                @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Lesson Content -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">{{ __("Lesson Content") }}</label>
                <textarea rows="6" wire:model="content"
                    class="w-full px-3 py-2 border {{ $errors->has('content') ? 'border-red-500' : 'border-gray-300' }} rounded-lg"
                    placeholder="{{ __("Write lesson content here (optional)...") }}"></textarea>
                <p class="text-xs text-gray-500 mt-1">{{ __("You can add explanations or extra notes for the lesson") }}</p>
            </div>

            <!-- Form Actions -->
            <div class="flex gap-3 pt-4">
                <a href="{{ route('admin.lessons.index') }}"
                    class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-100">
                    {{ __("Cancel") }}
                </a>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                    {{ __("Save Lesson") }}
                </button>
            </div>
        </form>
    </div>
</div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const videoInput = document.getElementById('video_url_input');
                const videoPreview = document.getElementById('videoPreview');
                const videoElement = videoPreview.querySelector('video');
                const durationDisplay = document.getElementById('durationDisplay');
                const durationText = document.getElementById('durationText');

                if (!videoInput) return;

                videoInput.addEventListener('change', function (e) {
                    if (this.files && this.files[0]) {
                        const file = this.files[0];
                        const videoURL = URL.createObjectURL(file);

                        // عرض الفيديو
                        videoElement.src = videoURL;
                        videoPreview.classList.remove('hidden');

                        // حساب المدة
                        videoElement.onloadedmetadata = function () {
                            const totalSeconds = Math.floor(videoElement.duration);
                            const minutes = Math.ceil((totalSeconds / 60) - 1.5);
                            durationText.textContent = `${minutes} ${minutes === 1 ? 'دقيقة' : 'دقائق'}`;
                            durationDisplay.classList.remove('hidden');

                            // إرسال المدة إلى Livewire
                            Livewire.dispatch('videoDurationDetected', { minutes: minutes });
                        };
                    }
                });

                // Drag & Drop (لا حاجة لإعادة تعيين input.files يدويًا)
                const uploadArea = document.getElementById('videoUploadArea');
                if (uploadArea) {
                    uploadArea.addEventListener('dragover', (e) => {
                        e.preventDefault();
                        uploadArea.classList.add('border-indigo-500', 'bg-indigo-50');
                    });

                    uploadArea.addEventListener('dragleave', () => {
                        uploadArea.classList.remove('border-indigo-500', 'bg-indigo-50');
                    });

                    uploadArea.addEventListener('drop', (e) => {
                        e.preventDefault();
                        uploadArea.classList.remove('border-indigo-500', 'bg-indigo-50');
                        if (e.dataTransfer.files.length) {
                            // ⚠️ لا تفعل هذا:
                            // videoInput.files = e.dataTransfer.files;
                            // videoInput.dispatchEvent(new Event('change'));

                            // ✅ دع Livewire يتعامل معه تلقائيًا عبر wire:model
                            // فقط قم بتشغيل الحدث الطبيعي
                            const event = new Event('drop', { bubbles: true });
                            videoInput.dispatchEvent(event);
                        }
                    });
                }
            });
        </script>
    @endpush
</div>