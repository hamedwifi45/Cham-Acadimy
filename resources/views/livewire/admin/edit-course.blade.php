<div>
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
        <form wire:submit.prevent="store" class="space-y-8">
            @if (session()->has('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif
            
            @if (session()->has('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Course Image Upload -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">صورة الغلاف *</label>
                <label for="thumbnail_url"
                    class="upload-area cursor-pointer flex flex-col items-center justify-center p-6 border-2 border-dashed rounded-xl transition-colors {{ $errors->has('thumbnail_url') ? 'border-red-500' : 'border-gray-300 hover:border-indigo-400' }}"
                    id="imageUploadArea">
                    
                    @if ($thumbnail_url)
                        <i class="fas fa-check-circle text-3xl text-green-500 mb-2"></i>
                        <p class="text-gray-600">{{ $thumbnail_url->getClientOriginalName() }}</p>
                        <p class="text-xs text-gray-500 mt-1">تم التحميل</p>
                    @elseif($current_thumbnail)
                        <div class="w-full">
                            <img src="{{ asset('storage/' . $current_thumbnail) }}" alt="صورة الغلاف الحالية" class="w-full max-h-48 object-cover rounded-lg mb-2">
                            <p class="text-sm text-gray-600 text-center">صورة الغلاف الحالية</p>
                        </div>
                    @else
                        <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                        <p class="text-gray-600">انقر لتحميل صورة أو اسحبها هنا</p>
                        <p class="text-xs text-gray-500 mt-1">JPG, PNG حتى 2MB • الأبعاد المثالية: 1200x630 بكسل</p>
                    @endif
                </label>
                <input type="file" id="thumbnail_url" wire:model="thumbnail_url" accept="image/*" class="hidden">
                @error('thumbnail_url') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Course Video Upload -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">مقطع الفيديو الدعائي *</label>
                <label for="video_url"
                    class="upload-area cursor-pointer flex flex-col items-center justify-center p-6 border-2 border-dashed rounded-xl transition-colors {{ $errors->has('video_url') ? 'border-red-500' : 'border-gray-300 hover:border-indigo-400' }}"
                    id="videoUploadArea">
                    
                    @if ($video_url)
                        <i class="fas fa-check-circle text-3xl text-green-500 mb-2"></i>
                        <p class="text-gray-600">{{ $video_url->getClientOriginalName() }}</p>
                        <p class="text-xs text-gray-500 mt-1">تم التحميل</p>
                    @elseif($current_video)
                        <div class="w-full text-center">
                            <i class="fas fa-video text-3xl text-blue-500 mb-2"></i>
                            <p class="text-sm text-gray-600">مقطع الفيديو الحالي موجود</p>
                            <a href="{{ asset('storage/' . $current_video) }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-sm">
                                عرض الفيديو الحالي
                            </a>
                        </div>
                    @else
                        <i class="fas fa-video text-3xl text-gray-400 mb-2"></i>
                        <p class="text-gray-600">انقر لتحميل فيديو أو اسحبه هنا</p>
                        <p class="text-xs text-gray-500 mt-1">MP4, MOV حتى 100MB • المدة المثالية: 1-3 دقائق</p>
                    @endif
                </label>
                <input type="file" id="video_url" wire:model="video_url" accept="video/mp4,video/mov" class="hidden">
                @error('video_url') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Basic Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">السعر (ريال سعودي) *</label>
                    <input type="number" wire:model="price"
                        class="w-full px-3 py-2 border {{ $errors->has('price') ? 'border-red-500' : 'border-gray-300' }} rounded-lg"
                        placeholder="0.00" min="0" step="0.01">
                    @error('price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">المستوى *</label>
                    <select wire:model="level" 
                        class="w-full px-3 py-2 border {{ $errors->has('level') ? 'border-red-500' : 'border-gray-300' }} rounded-lg">
                        <option value="">اختر المستوى</option>
                        @foreach($levels as $value => $label)
                            <option value="{{ $value }}" {{ $level == $value ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('level') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Author -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">الكاتب *</label>
                <select wire:model="author_id"
                    class="w-full px-3 py-2 border {{ $errors->has('author_id') ? 'border-red-500' : 'border-gray-300' }} rounded-lg">
                    <option value="">اختر الكاتب</option>
                    @foreach($authors as $author)
                        <option value="{{ $author->id }}" {{ $author_id == $author->id ? 'selected' : '' }}>{{ $author->name }}</option>
                    @endforeach
                </select>
                @error('author_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- names -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">عنوان الدورة (العربية) *</label>
                    <input type="text" wire:model="name_ar"
                        class="w-full px-3 py-2 border {{ $errors->has('name_ar') ? 'border-red-500' : 'border-gray-300' }} rounded-lg"
                        placeholder="أدخل عنوان الدورة بالعربية">
                    @error('name_ar') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Course name (English) *</label>
                    <input type="text" wire:model="name_en"
                        class="w-full px-3 py-2 border {{ $errors->has('name_en') ? 'border-red-500' : 'border-gray-300' }} rounded-lg"
                        placeholder="Enter course name in English">
                    @error('name_en') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Descriptions -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">الوصف (العربية) *</label>
                    <textarea rows="4" wire:model="description_ar"
                        class="w-full px-3 py-2 border {{ $errors->has('description_ar') ? 'border-red-500' : 'border-gray-300' }} rounded-lg"
                        placeholder="اكتب وصفًا مفصلًا للدورة بالعربية..."></textarea>
                    @error('description_ar') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description (English) *</label>
                    <textarea rows="4" wire:model="description_en"
                        class="w-full px-3 py-2 border {{ $errors->has('description_en') ? 'border-red-500' : 'border-gray-300' }} rounded-lg"
                        placeholder="Write a detailed course description in English..."></textarea>
                    @error('description_en') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex gap-3 pt-4">
                <a href="{{ route('admin.courses.index') }}"
                    class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-100">
                    إلغاء
                </a>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                    حفظ الدورة
                </button>
            </div>
        </form>
    </div>
</div>