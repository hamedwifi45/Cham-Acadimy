@extends('admin.layouts.app')
@section('title', 'إضافة دورة جديدة')

@push('styles')
<style>
        @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700&display=swap');
        
        body {
            font-family: 'Tajawal', sans-serif;
            background-color: #f8fafc;
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
        
        .language-tabs {
            display: flex;
            border-bottom: 1px solid #e2e8f0;
            margin-bottom: 1.5rem;
        }
        
        .language-tab {
            padding: 12px 24px;
            font-weight: 500;
            color: #64748b;
            cursor: pointer;
            transition: all 0.2s ease;
            border-bottom: 3px solid transparent;
        }
        
        .language-tab.active {
            color: #4f46e5;
            border-bottom-color: #4f46e5;
        }
        
        .language-content {
            display: none;
        }
        
        .language-content.active {
            display: block;
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

@section('content')
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800">{{  __("Add New Course") }}</h1>
        <p class="text-gray-600">{{ __("Fill in the following information to create a new course") }}</p>
    </div>
    @livewire('admin.create-course')
@endsection


@push('scripts')
<script>
        // Drag & Drop للصور
        const imageArea = document.getElementById('imageUploadArea');
        const imageInput = document.getElementById('thumbnail_url');

        imageArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            imageArea.classList.add('border-indigo-500', 'bg-indigo-50');
        });

        imageArea.addEventListener('dragleave', () => {
            imageArea.classList.remove('border-indigo-500', 'bg-indigo-50');
        });

        imageArea.addEventListener('drop', (e) => {
            e.preventDefault();
            imageArea.classList.remove('border-indigo-500', 'bg-indigo-50');
            if (e.dataTransfer.files.length) {
                imageInput.files = e.dataTransfer.files;
                imageInput.dispatchEvent(new Event('change', { bubbles: true }));
            }
        });

        // Drag & Drop للفيديو
        const videoArea = document.getElementById('videoUploadArea');
        const videoInput = document.getElementById('video_url');

        videoArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            videoArea.classList.add('border-indigo-500', 'bg-indigo-50');
        });

        videoArea.addEventListener('dragleave', () => {
            videoArea.classList.remove('border-indigo-500', 'bg-indigo-50');
        });

        videoArea.addEventListener('drop', (e) => {
            e.preventDefault();
            videoArea.classList.remove('border-indigo-500', 'bg-indigo-50');
            if (e.dataTransfer.files.length) {
                videoInput.files = e.dataTransfer.files;
                videoInput.dispatchEvent(new Event('change', { bubbles: true }));
            }
        });
    </script>
@endpush