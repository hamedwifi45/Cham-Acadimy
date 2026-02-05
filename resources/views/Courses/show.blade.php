<x-app-layout>
    @push('styles')
        <style>
            /* RTL Styles for Arabic */
            [dir="rtl"] {
                direction: rtl;
                text-align: right;
            }

            /* LTR Styles for English */
            [dir="ltr"] {
                direction: ltr;
                text-align: left;
            }

            .lessons-container.collapsed {
                max-height: 240px;
                overflow: hidden;
            }

            .lessons-container.expanded {
                max-height: 1000px;
                transition: max-height 0.5s ease-in-out;
            }

            /* Custom scrollbar */
            .lessons-container::-webkit-scrollbar {
                width: 6px;
            }

            .lessons-container::-webkit-scrollbar-track {
                background: #f1f1f1;
                border-radius: 3px;
            }

            .lessons-container::-webkit-scrollbar-thumb {
                background: #cbd5e1;
                border-radius: 3px;
            }

            .lessons-container::-webkit-scrollbar-thumb:hover {
                background: #a0aec0;
            }

            .expand-button {
                transition: transform 0.3s ease;
            }

            .expand-button.expanded {
                transform: rotate(180deg);
            }

            .video-container {
                position: relative;
                width: 100%;
                max-width: 800px;
                margin: 0 auto;
                background: #000;
                border-radius: 12px;
                overflow: hidden;
            }

            .video-player {
                width: 100%;
                display: block;
            }

            .video-controls {
                position: absolute;
                bottom: 0;
                left: 0;
                right: 0;
                background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
                padding: 12px;
                transform: translateY(100%);
                transition: transform 0.3s ease;
            }

            .video-container:hover .video-controls,
            .video-controls.show {
                transform: translateY(0);
            }

            /* Fix for progress bar direction - LTR within RTL context */
            .progress-container {
                width: 100%;
                height: 5px;
                background: rgba(255, 255, 255, 0.3);
                border-radius: 5px;
                cursor: pointer;
                margin-bottom: 12px;
                position: relative;
                direction: ltr; /* Force LTR direction for progress bar */
                text-align: left; /* Ensure alignment is left */
            }

            .progress-bar {
                height: 100%;
                background: #4f46e5;
                border-radius: 5px;
                width: 0%;
                transition: width 0.1s linear;
                float: left; /* Ensure it starts from left */
            }

            .controls-row {
                display: flex;
                align-items: center;
                gap: 12px;
            }

            .control-btn {
                background: none;
                border: none;
                color: white;
                cursor: pointer;
                font-size: 16px;
                width: 36px;
                height: 36px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: background 0.2s ease;
            }

            .control-btn:hover {
                background: rgba(255, 255, 255, 0.2);
            }

            .time-display {
                color: white;
                font-size: 12px;
                min-width: 80px;
                text-align: center;
            }

            /* Fix for volume slider direction */
            .volume-container {
                display: flex;
                align-items: center;
                gap: 8px;
                min-width: 100px;
            }

            .volume-slider {
                width: 60px;
                height: 4px;
                background: rgba(255, 255, 255, 0.3);
                border-radius: 2px;
                cursor: pointer;
                position: relative;
                direction: ltr; /* Force LTR direction for volume slider */
            }

            .volume-level {
                height: 100%;
                background: white;
                border-radius: 2px;
                width: 80%;
                float: left;
            }

            .playback-speed {
                color: white;
                font-size: 12px;
                min-width: 40px;
                text-align: center;
                cursor: pointer;
                padding: 4px 8px;
                border-radius: 4px;
                transition: background 0.2s ease;
            }

            .playback-speed:hover {
                background: rgba(255, 255, 255, 0.2);
            }

            .fullscreen-btn {
                margin-left: auto;
            }

            /* RTL adjustments */
            [dir="rtl"] .fullscreen-btn {
                margin-left: 0;
                margin-right: auto;
            }

            [dir="rtl"] .controls-row {
                flex-direction: row-reverse;
            }

            [dir="rtl"] .time-display {
                text-align: center;
            }

            .video-title {
                text-align: center;
                margin: 24px 0 16px;
                color: #1e293b;
                font-weight: 700;
            }

            .lesson-info {
                max-width: 800px;
                margin: 0 auto 24px;
                padding: 0 16px;
            }

            .lesson-description {
                color: #64748b;
                line-height: 1.6;
                text-align: center;
            }
        </style>
    @endpush

    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white py-16">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-3xl md:text-4xl font-bold mb-4">{{ __('learn') . $course->title }}</h1>
            <p class="text-lg max-w-2xl mx-auto opacity-90">
                {{ __('Learn and persevere in learning so that you may build a bright future that you can be proud of before everyone and in which you can support those you love.') }}
            </p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-12">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Video Player -->
            <div class="lg:w-2/3">
                <div class="relative bg-black rounded-xl overflow-hidden aspect-video mb-6">
                    @if($course->video_url)
                        <div class="video-container" id="videoContainer">
                            <video class="video-player" id="videoPlayer"
                                poster="{{ asset('storage/' . $course->thumbnail_url) }}">
                                <source src="{{ asset('storage/' . $course->video_url) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>

                            <div class="video-controls" id="videoControls">
                                <div class="progress-container" id="progressContainer">
                                    <div class="progress-bar" id="progressBar"></div>
                                </div>

                                <div class="controls-row">
                                    <button class="control-btn" id="playPauseBtn">
                                        <i class="fas fa-play"></i>
                                    </button>

                                    <div class="time-display" id="timeDisplay">0:00 / 0:00</div>

                                    <div class="volume-container">
                                        <i class="fas fa-volume-up text-white"></i>
                                        <div class="volume-slider" id="volumeSlider">
                                            <div class="volume-level" id="volumeLevel"></div>
                                        </div>
                                    </div>

                                    <div class="playback-speed" id="playbackSpeed">1x</div>

                                    <button class="control-btn fullscreen-btn" id="fullscreenBtn">
                                        <i class="fas fa-expand"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="w-full h-full flex items-center justify-center text-white">
                            <i class="fas fa-play-circle text-6xl opacity-70"></i>
                        </div>
                    @endif
                </div>

                <!-- Course Description -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">{{ __('About course') }}</h2>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        {{ $course->description }}
                    </p>
                    <p class="text-gray-600 leading-relaxed">
                        {{ __('course contains') }} {{ $course->lessons->count() }} {{ __('practical lessons') }}
                    </p>
                </div>

                <!-- Curriculum -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">{{ __('course content') }}</h2>
                    <div id="lessonsContainer" class="lessons-container collapsed">
                        <div class="space-y-3">
                            @forelse ($course->lessons as $lesson)
                                <a href="{{ route('lessons.show', $lesson->id) }}" class="block">
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                        <span class="font-medium">{{ __('lesson') . $lesson->order . ': ' . $lesson->title }}</span>
                                        <span class="text-gray-500 text-sm">{{ $lesson->duration_minutes . ' ' . __('minute') }}</span>
                                    </div>
                                </a>
                            @empty
                                <p class="text-gray-600">{{ __('no lessons available') }}</p>
                            @endforelse
                        </div>
                    </div>
                    @if ($course->lessons->count() != 0)
                        <div class="flex justify-center mt-4">
                            <button id="toggleButton"
                                class="expand-button w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center hover:bg-blue-700 transition">
                                <i class="fas fa-chevron-down"></i>
                            </button>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:w-1/3">
                <!-- Course Info Card -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-6 sticky top-6">
                    <div class="text-center mb-6">
                        <div class="text-3xl font-bold text-blue-600 mb-2">${{ $course->price }}</div>
                    </div>

                    <button onclick="window.location.href='{{ route('credit.checkout', $course->id) }}'"
                        class="w-full bg-blue-600 text-white font-semibold py-3 rounded-lg hover:bg-blue-700 transition mb-4">
                        {{ __('subscribe now') }}
                    </button>

                    <div class="flex items-center justify-center space-x-2 space-x-reverse mb-4">
                        <i class="mx-2 fas fa-check-circle text-green-500"></i>
                        <span class="text-sm text-gray-600">{{ __('no refund currently') }}</span>
                    </div>

                    <div class="border-t pt-4">
                        <div class="flex items-center mb-3">
                            <i class="fas fa-user text-gray-500 mx-2"></i>
                            <span class="text-gray-600">{{ __('Coach : ') }}{{ $course->author->name }}</span>
                        </div>
                        <div class="flex items-center mb-3">
                            <i class="fas fa-clock text-gray-500 mx-2"></i>
                            <span class="text-gray-600">{{ __( 'duration : ') }}{{ $course->duration_hours }} {{ __('hour') }}</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-graduation-cap text-gray-500 mx-2"></i>
                            <span class="text-gray-600">{{ __('level : ') }} {{ $course->level }}</span>
                        </div>
                    </div>
                </div>

                <!-- Instructor Card -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">{{ __('About Coach') }}</h3>
                    <div class="flex items-center mb-3">
                        <div class="w-12 h-12 bg-gray-300 rounded-full mx-3">
                            <img src="{{ asset('storage/' . $course->author->profile_photo_url) }}"
                                alt="{{ $course->author->name }}" class="w-full h-full object-cover rounded-full">
                        </div>
                        <div>
                            <div class="font-semibold">{{ $course->author->name }}</div>
                            <div class="text-sm text-gray-500">{{ $course->author->area_work }}</div>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm">{{ $course->author->bio }}.</p>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const toggleButton = document.getElementById('toggleButton');
                const lessonsContainer = document.getElementById('lessonsContainer');

                toggleButton.addEventListener('click', function () {
                    if (lessonsContainer.classList.contains('collapsed')) {
                        lessonsContainer.classList.remove('collapsed');
                        lessonsContainer.classList.add('expanded');
                        toggleButton.classList.add('expanded');
                    } else {
                        lessonsContainer.classList.remove('expanded');
                        lessonsContainer.classList.add('collapsed');
                        toggleButton.classList.remove('expanded');
                    }
                });
            });

            document.addEventListener('DOMContentLoaded', function () {
                const video = document.getElementById('videoPlayer');
                const playPauseBtn = document.getElementById('playPauseBtn');
                const progressBar = document.getElementById('progressBar');
                const progressContainer = document.getElementById('progressContainer');
                const timeDisplay = document.getElementById('timeDisplay');
                const volumeSlider = document.getElementById('volumeSlider');
                const volumeLevel = document.getElementById('volumeLevel');
                const playbackSpeed = document.getElementById('playbackSpeed');
                const fullscreenBtn = document.getElementById('fullscreenBtn');
                const videoContainer = document.getElementById('videoContainer');
                const videoControls = document.getElementById('videoControls');

                // Play/Pause functionality
                playPauseBtn.addEventListener('click', togglePlayPause);
                video.addEventListener('click', togglePlayPause);

                function togglePlayPause() {
                    if (video.paused) {
                        video.play();
                        playPauseBtn.innerHTML = '<i class="fas fa-pause"></i>';
                    } else {
                        video.pause();
                        playPauseBtn.innerHTML = '<i class="fas fa-play"></i>';
                    }
                }

                // Update progress bar and time display
                video.addEventListener('timeupdate', updateProgress);
                video.addEventListener('loadedmetadata', updateProgress);

                function updateProgress() {
                    const percent = (video.currentTime / video.duration) * 100;
                    progressBar.style.width = `${percent}%`;

                    const currentMinutes = Math.floor(video.currentTime / 60);
                    const currentSeconds = Math.floor(video.currentTime % 60);
                    const durationMinutes = Math.floor(video.duration / 60);
                    const durationSeconds = Math.floor(video.duration % 60);

                    const currentTimeStr = `${currentMinutes}:${currentSeconds.toString().padStart(2, '0')}`;
                    const durationStr = `${durationMinutes}:${durationSeconds.toString().padStart(2, '0')}`;

                    timeDisplay.textContent = `${currentTimeStr} / ${durationStr}`;
                }

                // Seek functionality - FIXED with proper LTR calculation
                progressContainer.addEventListener('click', seek);

                function seek(e) {
                    const rect = progressContainer.getBoundingClientRect();
                    const clickX = e.clientX - rect.left;
                    const width = rect.width;
                    const duration = video.duration;
                    // Ensure we don't get negative or >100% values
                    const percentage = Math.max(0, Math.min(100, (clickX / width) * 100));
                    video.currentTime = (percentage / 100) * duration;
                }

                // Volume control - FIXED with proper LTR calculation
                volumeSlider.addEventListener('click', setVolume);

                function setVolume(e) {
                    const rect = volumeSlider.getBoundingClientRect();
                    const clickX = e.clientX - rect.left;
                    const width = rect.width;
                    let volume = clickX / width;
                    volume = Math.max(0, Math.min(1, volume)); // Clamp between 0 and 1
                    video.volume = volume;
                    volumeLevel.style.width = `${volume * 100}%`;
                }

                // Initialize volume
                video.volume = 0.8;
                volumeLevel.style.width = '80%';

                // Playback speed
                let speeds = [0.5, 0.75, 1, 1.25, 1.5, 2];
                let currentSpeedIndex = 2; // 1x

                playbackSpeed.addEventListener('click', changePlaybackSpeed);

                function changePlaybackSpeed() {
                    currentSpeedIndex = (currentSpeedIndex + 1) % speeds.length;
                    const speed = speeds[currentSpeedIndex];
                    video.playbackRate = speed;
                    playbackSpeed.textContent = speed + 'x';
                }

                // Fullscreen functionality
                fullscreenBtn.addEventListener('click', toggleFullscreen);

                function toggleFullscreen() {
                    if (!document.fullscreenElement) {
                        if (videoContainer.requestFullscreen) {
                            videoContainer.requestFullscreen();
                        } else if (videoContainer.webkitRequestFullscreen) { // Safari
                            videoContainer.webkitRequestFullscreen();
                        } else if (videoContainer.msRequestFullscreen) { // IE11
                            videoContainer.msRequestFullscreen();
                        }
                        fullscreenBtn.innerHTML = '<i class="fas fa-compress"></i>';
                    } else {
                        if (document.exitFullscreen) {
                            document.exitFullscreen();
                        } else if (document.webkitExitFullscreen) { // Safari
                            document.webkitExitFullscreen();
                        } else if (document.msExitFullscreen) { // IE11
                            document.msExitFullscreen();
                        }
                        fullscreenBtn.innerHTML = '<i class="fas fa-expand"></i>';
                    }
                }

                // Show/hide controls on hover
                let hideControlsTimeout;

                function showControls() {
                    videoControls.classList.add('show');
                    resetHideControlsTimer();
                }

                function hideControls() {
                    if (!video.paused) {
                        videoControls.classList.remove('show');
                    }
                }

                function resetHideControlsTimer() {
                    clearTimeout(hideControlsTimeout);
                    hideControlsTimeout = setTimeout(hideControls, 3000);
                }

                // Event listeners for hover
                videoContainer.addEventListener('mouseenter', showControls);
                videoContainer.addEventListener('mouseleave', function () {
                    resetHideControlsTimer();
                });

                // Reset timer on any activity within the container
                videoContainer.addEventListener('mousemove', resetHideControlsTimer);
                videoContainer.addEventListener('click', resetHideControlsTimer);

                // Keyboard shortcuts
                document.addEventListener('keydown', function (e) {
                    switch (e.key) {
                        case ' ':
                            e.preventDefault();
                            togglePlayPause();
                            break;
                        case 'ArrowRight':
                            video.currentTime += 10;
                            break;
                        case 'ArrowLeft':
                            video.currentTime -= 10;
                            break;
                        case 'ArrowUp':
                            video.volume = Math.min(1, video.volume + 0.1);
                            volumeLevel.style.width = `${video.volume * 100}%`;
                            break;
                        case 'ArrowDown':
                            video.volume = Math.max(0, video.volume - 0.1);
                            volumeLevel.style.width = `${video.volume * 100}%`;
                            break;
                        case 'f':
                            toggleFullscreen();
                            break;
                    }
                });

                // Initialize controls visibility
                video.addEventListener('play', showControls);
                video.addEventListener('pause', showControls);

                // Handle video errors
                video.addEventListener('error', function () {
                    console.error('Error loading video');
                });
            });
        </script>
    @endpush
</x-app-layout>