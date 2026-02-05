<div class="video-container mb-6">
    @if($lesson->video_url)
        <div class="relative bg-black rounded-lg overflow-hidden" style="padding-top: 56.25%;"> <!-- نسبة 16:9 -->
            <video 
                id="lessonVideo"
                controls
                class="absolute top-0 left-0 w-full h-full object-contain"
            >
                <source 
                    src="{{ Storage::url($lesson->video_url) }}" 
                    type="video/mp4"
                >
                Your browser does not support the video tag.
            </video>
        </div>

        <!-- مؤشر حالة المشاهدة -->
        @if(auth()->check())
            <div class="mt-3 flex items-center gap-2 text-sm">
                @if($watched)
                    <span class="text-green-600 font-medium">
                        <i class="fas fa-check-circle"></i> {{ __('Lesson Completed') }}
                    </span>
                @else
                    <span class="text-gray-500">
                        <i class="fas fa-clock"></i> {{ __('Watching...') }}
                    </span>
                @endif
            </div>
        @endif
    @else
        <div class="w-full h-64 flex items-center justify-center text-gray-600 bg-gray-100 rounded-lg">
            <i class="fas fa-play-circle text-6xl opacity-70"></i>
        </div>
    @endif
</div>
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const video = document.getElementById('lessonVideo');
    if (!video || {{ $watched ? 'true' : 'false' }}) return;

    const duration = {{ $duration }};
    // حساب عتبة الإكمال: آخر 20 ثانية أو 10 ثوانٍ كحد أدنى
    const threshold = Math.max(10, duration - 20);
    let completionSent = false;

    video.addEventListener('timeupdate', function() {
        if (completionSent) return;
        
        const currentTime = Math.floor(video.currentTime);
        
        // التحقق من الوصول إلى عتبة الإكمال
        if (currentTime >= threshold && duration > 0) {
            completionSent = true;
            @this.call('markAsWatchedBy');
        }
    });

    // التعامل مع إنهاء الفيديو
    video.addEventListener('ended', function() {
        if (!completionSent) {
            completionSent = true;
            @this.call('markAsWatchedBy');
        }
    });
});
</script>
@endpush