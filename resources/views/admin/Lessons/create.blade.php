@extends('admin.layouts.app')

@section('title', 'إضافة درس جديد')

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
        
        .video-preview {
            position: relative;
            padding-bottom: 56.25%; /* 16:9 Aspect Ratio */
            height: 0;
            overflow: hidden;
            border-radius: 12px;
            margin-top: 1rem;
        }
        
        .video-preview video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
@endpush

@section('content')
<div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800">{{ __('Add New Lesson') }}</h1>
        <p class="text-gray-600">{{ __('Fill in the following information to create a new tutorial') }}</p>
    </div>

    <livewire:admin.create-lesson />
@endsection