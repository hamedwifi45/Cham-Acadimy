@extends('admin.layouts.app')

@section('title', __('Add New Post'))
@push('styles')
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800&display=swap" rel="stylesheet">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root {
        /* Brand Blue Colors */
        --primary: #2563eb;
        --primary-light: #3b82f6;
        --primary-dark: #1d4ed8;
        --primary-gradient: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        
        /* Supporting Colors */
        --secondary: #60a5fa;
        --accent: #93c5fd;
        --background: #f8fafc;
        --surface: #ffffff;
        --text-primary: #1e293b;
        --text-secondary: #64748b;
        --text-muted: #94a3b8;
        --border: #e2e8f0;
        --danger: #ef4444;
        --success: #10b981;
        --warning: #f59e0b;
        
        /* Editor Specific */
        --toolbar-bg: #f8fafc;
        --toolbar-border: #e2e8f0;
        --preview-bg: #ffffff;
        --code-bg: #f1f5f9;
        
        /* Shadows */
        --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        --shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.1);
        --shadow-lg: 0 10px 25px -5px rgba(37, 99, 235, 0.15);
    }

    body {
        font-family: 'Tajawal', sans-serif;
        background: var(--background);
        color: var(--text-primary);
    }

    /* Page Header */
    .page-header {
        margin-bottom: 2rem;
    }

    .page-title {
        font-size: 1.75rem;
        font-weight: 800;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
    }

    .page-subtitle {
        color: var(--text-secondary);
        font-size: 1rem;
    }

    /* Editor Card */
    .editor-card {
        background: var(--surface);
        border-radius: 20px;
        box-shadow: var(--shadow-lg);
        border: 1px solid var(--border);
        overflow: hidden;
        max-width: 1400px;
        margin: 0 auto;
    }

    .editor-header {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid var(--border);
        background: var(--toolbar-bg);
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .editor-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--text-primary);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .editor-title i {
        color: var(--primary);
    }

    /* View Toggle Buttons */
    .view-toggle {
        display: flex;
        background: var(--surface);
        border-radius: 12px;
        padding: 0.25rem;
        border: 1px solid var(--border);
    }

    .view-btn {
        padding: 0.5rem 1rem;
        border: none;
        background: transparent;
        color: var(--text-secondary);
        font-size: 0.875rem;
        font-weight: 500;
        border-radius: 10px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.4rem;
        transition: all 0.2s ease;
    }

    .view-btn.active {
        background: var(--primary);
        color: white;
        box-shadow: var(--shadow-sm);
    }

    .view-btn:hover:not(.active) {
        color: var(--primary);
        background: #eff6ff;
    }

    /* Form Styles */
    .form-section {
        padding: 1.5rem;
        border-bottom: 1px solid var(--border);
    }

    .form-section:last-child {
        border-bottom: none;
    }

    .form-label {
        display: block;
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
    }

    .form-label .required {
        color: var(--danger);
        margin-right: 0.25rem;
    }

    [dir="rtl"] .form-label .required {
        margin-right: 0;
        margin-left: 0.25rem;
    }

    .form-input,
    .form-select,
    .form-textarea {
        width: 100%;
        padding: 0.875rem 1.25rem;
        border: 2px solid var(--border);
        border-radius: 12px;
        font-family: inherit;
        font-size: 0.95rem;
        background: var(--surface);
        color: var(--text-primary);
        transition: all 0.3s ease;
    }

    .form-input:focus,
    .form-select:focus,
    .form-textarea:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
    }

    .form-input.error,
    .form-select.error,
    .form-textarea.error {
        border-color: var(--danger);
    }

    .form-error {
        color: var(--danger);
        font-size: 0.85rem;
        margin-top: 0.375rem;
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    .form-error i {
        font-size: 0.8rem;
    }

    /* ============ EDITOR TOOLBAR ============ */
    .editor-wrapper {
        position: relative;
    }

    .editor-toolbar {
        display: flex;
        flex-wrap: wrap;
        gap: 0.25rem;
        padding: 0.75rem;
        background: var(--toolbar-bg);
        border: 2px solid var(--border);
        border-bottom: none;
        border-radius: 12px 12px 0 0;
        align-items: center;
    }

    .toolbar-group {
        display: flex;
        gap: 0.25rem;
        padding: 0 0.5rem;
        border-right: 1px solid var(--toolbar-border);
    }

    [dir="rtl"] .toolbar-group {
        border-right: none;
        border-left: 1px solid var(--toolbar-border);
    }

    .toolbar-group:last-child {
        border: none;
    }

    .toolbar-btn {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        background: transparent;
        color: var(--text-secondary);
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.2s ease;
        font-size: 0.9rem;
        position: relative;
    }

    .toolbar-btn:hover {
        background: #eff6ff;
        color: var(--primary);
    }

    .toolbar-btn:active {
        transform: scale(0.95);
    }

    .toolbar-btn.active {
        background: var(--primary);
        color: white;
    }

    .toolbar-btn i {
        pointer-events: none;
    }

    /* Tooltip for toolbar buttons */
    .toolbar-btn[data-tooltip]:hover::after {
        content: attr(data-tooltip);
        position: absolute;
        bottom: 100%;
        left: 50%;
        transform: translateX(-50%) translateY(-8px);
        background: var(--text-primary);
        color: white;
        padding: 0.375rem 0.75rem;
        border-radius: 8px;
        font-size: 0.75rem;
        font-weight: 500;
        white-space: nowrap;
        z-index: 100;
        box-shadow: var(--shadow);
    }

    .toolbar-btn[data-tooltip]:hover::before {
        content: '';
        position: absolute;
        bottom: 100%;
        left: 50%;
        transform: translateX(-50%) translateY(-2px);
        border: 6px solid transparent;
        border-top-color: var(--text-primary);
        z-index: 100;
    }

    /* ============ EDITOR TEXTAREA ============ */
    .editor-textarea {
        width: 100%;
        min-height: 400px;
        padding: 1.25rem;
        border: 2px solid var(--border);
        border-radius: 0 0 12px 12px;
        font-family: inherit;
        font-size: 1.05rem;
        line-height: 1.8;
        background: var(--surface);
        color: var(--text-primary);
        resize: vertical;
        transition: border-color 0.3s ease;
    }

    .editor-textarea:focus {
        outline: none;
        border-color: var(--primary);
    }

    /* ============ LIVE PREVIEW ============ */
    .preview-pane {
        display: none;
        min-height: 400px;
        padding: 1.5rem;
        border: 2px solid var(--border);
        border-radius: 12px;
        background: var(--preview-bg);
        overflow-y: auto;
        max-height: 600px;
    }

    .preview-pane.active {
        display: block;
    }

    .preview-content {
        font-size: 1.05rem;
        line-height: 1.9;
        color: var(--text-secondary);
    }

    .preview-content h2 {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-primary);
        margin: 2rem 0 1rem;
        padding-bottom: 0.75rem;
        border-bottom: 3px solid var(--accent);
        display: inline-block;
    }

    .preview-content h3 {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--text-primary);
        margin: 1.75rem 0 0.875rem;
    }

    .preview-content p {
        margin: 0 0 1.25rem;
        text-align: justify;
    }

    .preview-content strong {
        color: var(--text-primary);
        font-weight: 700;
    }

    .preview-content em {
        color: var(--primary-dark);
        font-style: italic;
    }

    .preview-content a {
        color: var(--primary);
        text-decoration: none;
        border-bottom: 2px solid transparent;
        transition: border-color 0.2s ease;
    }

    .preview-content a:hover {
        border-bottom-color: var(--primary);
    }

    /* Preview Lists */
    .preview-content ul {
        margin: 1rem 0;
        padding: 0;
        list-style: none;
    }

    .preview-content ul li {
        margin: 0.5rem 0;
        padding: 0.25rem 0 0.25rem 1.75rem;
        position: relative;
        line-height: 1.7;
    }

    .preview-content ul li::before {
        content: '•';
        color: var(--primary);
        font-weight: bold;
        font-size: 1.3rem;
        position: absolute;
        left: 0;
        top: 0;
    }

    [dir="rtl"] .preview-content ul li {
        padding: 0.25rem 1.75rem 0.25rem 0;
    }

    [dir="rtl"] .preview-content ul li::before {
        left: auto;
        right: 0;
    }

    .preview-content ol {
        margin: 1rem 0;
        padding: 0;
        list-style: none;
        counter-reset: item;
    }

    .preview-content ol li {
        margin: 0.5rem 0;
        padding: 0.25rem 0 0.25rem 2rem;
        position: relative;
        counter-increment: item;
    }

    .preview-content ol li::before {
        content: counter(item) ".";
        color: var(--primary);
        font-weight: 700;
        position: absolute;
        left: 0;
        top: 0;
        min-width: 1.5rem;
    }

    [dir="rtl"] .preview-content ol li {
        padding: 0.25rem 2rem 0.25rem 0;
    }

    [dir="rtl"] .preview-content ol li::before {
        left: auto;
        right: 0;
    }

    /* Preview Images */
    .preview-content img {
        max-width: 100%;
        height: auto;
        border-radius: 12px;
        margin: 1.5rem auto;
        display: block;
        box-shadow: var(--shadow);
        border: 3px solid white;
    }

    .preview-content .image-caption {
        text-align: center;
        font-size: 0.9rem;
        color: var(--text-muted);
        margin-top: -1rem;
        margin-bottom: 1.5rem;
        font-style: italic;
    }

    /* Preview Code */
    .preview-content pre {
        background: var(--code-bg);
        border-radius: 10px;
        padding: 1rem;
        margin: 1.25rem 0;
        overflow-x: auto;
        direction: ltr;
        text-align: left;
        border: 1px solid var(--border);
    }

    .preview-content code {
        background: var(--code-bg);
        color: var(--text-primary);
        padding: 0.2rem 0.5rem;
        border-radius: 5px;
        font-family: 'Fira Code', monospace;
        font-size: 0.9em;
    }

    /* Preview Tables */
    .preview-content table {
        width: 100%;
        border-collapse: collapse;
        margin: 1.25rem 0;
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
    }

    .preview-content thead {
        background: #eff6ff;
    }

    .preview-content th {
        padding: 0.875rem 1rem;
        text-align: right;
        font-weight: 600;
        color: var(--text-primary);
        border-bottom: 2px solid var(--border);
    }

    [dir="rtl"] .preview-content th {
        text-align: left;
    }

    .preview-content td {
        padding: 0.75rem 1rem;
        border-bottom: 1px solid var(--border);
    }

    /* Preview Blockquotes */
    .preview-content blockquote {
        margin: 1.25rem 0;
        padding: 1rem 1.25rem;
        border-right: 4px solid var(--primary);
        background: #eff6ff;
        border-radius: 0 10px 10px 0;
        font-style: italic;
    }

    [dir="rtl"] .preview-content blockquote {
        border-right: none;
        border-left: 4px solid var(--primary);
        border-radius: 10px 0 0 10px;
    }

    /* Preview HR */
    .preview-content hr {
        border: none;
        height: 2px;
        background: var(--primary-gradient);
        margin: 2rem 0;
        border-radius: 2px;
    }

    /* ============ STATS BAR ============ */
    .editor-stats {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.75rem 1rem;
        background: var(--toolbar-bg);
        border: 2px solid var(--border);
        border-top: none;
        border-radius: 0 0 12px 12px;
        font-size: 0.85rem;
        color: var(--text-muted);
    }

    .stats-left {
        display: flex;
        gap: 1.5rem;
    }

    .stat-item {
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }

    .stat-item i {
        color: var(--secondary);
    }

    .stat-value {
        font-weight: 600;
        color: var(--text-primary);
    }

    .auto-save {
        display: flex;
        align-items: center;
        gap: 0.4rem;
        color: var(--success);
    }

    .auto-save.saving {
        color: var(--warning);
    }

    .auto-save-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: currentColor;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.4; }
    }

    /* ============ HELP MODAL ============ */
    .help-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1000;
        align-items: center;
        justify-content: center;
        padding: 1rem;
    }

    .help-modal.active {
        display: flex;
    }

    .help-content {
        background: var(--surface);
        border-radius: 20px;
        max-width: 700px;
        width: 100%;
        max-height: 80vh;
        overflow-y: auto;
        box-shadow: var(--shadow-lg);
    }

    .help-header {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .help-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--text-primary);
    }

    .help-close {
        width: 36px;
        height: 36px;
        border: none;
        background: #f1f5f9;
        border-radius: 10px;
        color: var(--text-secondary);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
    }

    .help-close:hover {
        background: var(--danger);
        color: white;
    }

    .help-body {
        padding: 1.5rem;
    }

    .help-section {
        margin-bottom: 1.5rem;
    }

    .help-section:last-child {
        margin-bottom: 0;
    }

    .help-section-title {
        font-size: 1rem;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .help-section-title i {
        color: var(--primary);
    }

    .help-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 0.75rem;
    }

    .help-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 0.75rem;
        background: var(--background);
        border-radius: 8px;
        font-size: 0.9rem;
    }

    .help-syntax {
        font-family: 'Fira Code', monospace;
        background: var(--code-bg);
        padding: 0.2rem 0.5rem;
        border-radius: 5px;
        color: var(--primary-dark);
        font-size: 0.85rem;
    }

    .help-example {
        color: var(--text-secondary);
        font-size: 0.85rem;
    }

    /* ============ FORM ACTIONS ============ */
    .form-actions {
        padding: 1.25rem 1.5rem;
        border-top: 1px solid var(--border);
        background: var(--toolbar-bg);
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .btn {
        padding: 0.875rem 1.75rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.95rem;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        border: none;
        text-decoration: none;
    }

    .btn-secondary {
        background: white;
        color: var(--text-primary);
        border: 2px solid var(--border);
    }

    .btn-secondary:hover {
        background: #f8fafc;
        border-color: var(--primary);
        color: var(--primary);
    }

    .btn-primary {
        background: var(--primary-gradient);
        color: white;
        box-shadow: var(--shadow);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
    }

    .btn-primary:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
    }

    .btn i {
        font-size: 0.9rem;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .editor-card {
            margin: 0 1rem;
        }
        
        .editor-toolbar {
            justify-content: center;
        }
        
        .toolbar-group {
            border: none;
            padding: 0;
        }
    }

    @media (max-width: 768px) {
        .page-title {
            font-size: 1.5rem;
        }
        
        .editor-header {
            flex-direction: column;
            align-items: stretch;
        }
        
        .view-toggle {
            justify-content: center;
        }
        
        .form-actions {
            flex-direction: column-reverse;
        }
        
        .btn {
            width: 100%;
            justify-content: center;
        }
        
        .editor-textarea,
        .preview-pane {
            min-height: 300px;
        }
    }

    /* RTL Support */
    [dir="rtl"] {
        direction: rtl;
        text-align: right;
    }

    [dir="rtl"] .toolbar-btn[data-tooltip]:hover::after {
        transform: translateX(50%) translateY(-8px);
    }

    [dir="rtl"] .stats-left {
        flex-direction: row-reverse;
    }
</style>
@endpush

@section('content')
<main class="flex-1 p-4 md:p-6">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">{{ __('Add New Article') }}</h1>
        <p class="page-subtitle">{{ __('Create valuable educational content for your platform visitors') }}</p>
    </div>

    <!-- Editor Card -->
    <div class="editor-card">
        <!-- Editor Header -->
        <div class="editor-header">
            <div class="editor-title">
                <i class="fas fa-pen-to-square"></i>
                {{ __('Article Editor') }}
            </div>
            
            <!-- View Toggle -->
            <div class="view-toggle">
                <button type="button" class="view-btn active" data-view="edit" onclick="toggleView('edit')">
                    <i class="fas fa-edit"></i>
                    {{ __('Edit') }}
                </button>
                <button type="button" class="view-btn" data-view="preview" onclick="toggleView('preview')">
                    <i class="fas fa-eye"></i>
                    {{ __('Preview') }}
                </button>
            </div>
        </div>

        <form action="{{ route('admin.posts.store') }}" method="post" id="postForm">
            @csrf

            <!-- Post Title -->
            <div class="form-section">
                <label class="form-label">
                    <span class="required">*</span> {{ __('Post Title') }}
                </label>
                <input 
                    type="text" 
                    name="title"
                    id="postTitle"
                    value="{{ old('title') }}"
                    class="form-input @error('title') error @enderror"
                    placeholder="{{ __('Write an attractive title for the post...') }}"
                    required
                    oninput="updatePreview()"
                >
                @error('title')
                    <p class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                @enderror
            </div>

            <!-- Author Selection -->
            <div class="form-section">
                <label class="form-label">
                    <span class="required">*</span> {{ __('Author') }}
                </label>
                <select 
                    name="auther_id" 
                    class="form-select @error('author_id') error @enderror"
                    required
                >
                    <option value="">{{ __('Select an author') }}</option>
                    @foreach($authors as $author)
                        <option value="{{ $author->id }}" {{ old('author_id') == $author->id ? 'selected' : '' }}>
                            {{ $author->name }}
                        </option>
                    @endforeach
                </select>
                @error('author_id')
                    <p class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                @enderror
            </div>

            <!-- Post Body Editor -->
            <div class="form-section">
                <label class="form-label">
                    <span class="required">*</span> {{ __('Post Content') }}
                </label>
                
                <div class="editor-wrapper">
                    <!-- Toolbar -->
                    <div class="editor-toolbar">
                        <!-- Text Formatting -->
                        <div class="toolbar-group">
                            <button type="button" class="toolbar-btn" onclick="insertMarkdown('**', '**')" data-tooltip="{{ __('Toolbar Buttons.Bold') }}">
                                <i class="fas fa-bold"></i>
                            </button>
                            <button type="button" class="toolbar-btn" onclick="insertMarkdown('*', '*')" data-tooltip="{{ __('Toolbar Buttons.Italic') }}">
                                <i class="fas fa-italic"></i>
                            </button>
                        </div>

                        <!-- Headings -->
                        <div class="toolbar-group">
                            <button type="button" class="toolbar-btn" onclick="insertMarkdown('## ', '')" data-tooltip="{{ __('Toolbar Buttons.Heading 2') }}">
                                <i class="fas fa-heading"></i><span class="text-xs">2</span>
                            </button>
                            <button type="button" class="toolbar-btn" onclick="insertMarkdown('### ', '')" data-tooltip="{{ __('Toolbar Buttons.Heading 3') }}">
                                <i class="fas fa-heading"></i><span class="text-xs">3</span>
                            </button>
                        </div>

                        <!-- Lists -->
                        <div class="toolbar-group">
                            <button type="button" class="toolbar-btn" onclick="insertList('ul')" data-tooltip="{{ __('Toolbar Buttons.Bullet List') }}">
                                <i class="fas fa-list-ul"></i>
                            </button>
                            <button type="button" class="toolbar-btn" onclick="insertList('ol')" data-tooltip="{{ __('Toolbar Buttons.Numbered List') }}">
                                <i class="fas fa-list-ol"></i>
                            </button>
                        </div>

                        <!-- Media & Links -->
                        <div class="toolbar-group">
                            <button type="button" class="toolbar-btn" onclick="insertImage()" data-tooltip="{{ __('Toolbar Buttons.Insert Image') }}">
                                <i class="fas fa-image"></i>
                            </button>
                            <button type="button" class="toolbar-btn" onclick="insertLink()" data-tooltip="{{ __('Toolbar Buttons.Insert Link') }}">
                                <i class="fas fa-link"></i>
                            </button>
                        </div>

                        <!-- Code & Quote -->
                        <div class="toolbar-group">
                            <button type="button" class="toolbar-btn" onclick="insertMarkdown('`', '`')" data-tooltip="{{ __('Toolbar Buttons.Inline Code') }}">
                                <i class="fas fa-code"></i>
                            </button>
                            <button type="button" class="toolbar-btn" onclick="insertMarkdown('> ', '')" data-tooltip="{{ __('Toolbar Buttons.Blockquote') }}">
                                <i class="fas fa-quote-right"></i>
                            </button>
                        </div>

                        <!-- Table & HR -->
                        <div class="toolbar-group">
                            <button type="button" class="toolbar-btn" onclick="insertTable()" data-tooltip="{{ __('Toolbar Buttons.Insert Table') }}">
                                <i class="fas fa-table"></i>
                            </button>
                            <button type="button" class="toolbar-btn" onclick="insertMarkdown('\n---\n', '')" data-tooltip="{{ __('Toolbar Buttons.Horizontal Line') }}">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>

                        <!-- Help -->
                        <div class="toolbar-group" style="margin-right: auto;">
                            <button type="button" class="toolbar-btn" onclick="openHelp()" data-tooltip="{{ __('Toolbar Buttons.Formatting Guide') }}">
                                <i class="fas fa-question-circle"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Editor/Preview Area -->
                    <textarea 
                        id="postBody"
                        name="body"
                        class="editor-textarea @error('body') error @enderror"
                        placeholder="{{ __('Write your content here using markdown syntax...') }}"
                        required
                        oninput="updatePreview(); updateStats();"
                    >{{ old('body') }}</textarea>

                    <!-- Live Preview -->
                    <div id="previewPane" class="preview-pane">
                        <div id="previewContent" class="preview-content"></div>
                    </div>

                    <!-- Stats Bar -->
                    <div class="editor-stats">
                        <div class="stats-left">
                            <span class="stat-item">
                                <i class="fas fa-font"></i>
                                <span class="stat-value" id="wordCount">0</span> {{ __('Stats.words') }}
                            </span>
                            <span class="stat-item">
                                <i class="fas fa-clock"></i>
                                <span class="stat-value" id="charCount">0</span> {{ __('Stats.characters') }}
                            </span>
                            <span class="stat-item">
                                <i class="fas fa-stopwatch"></i>
                                <span class="stat-value" id="readTime">1</span> {{ __('Stats.min read') }}
                            </span>
                        </div>
                        <div class="auto-save" id="autoSaveStatus">
                            <span class="auto-save-dot"></span>
                            <span>{{ __('Auto-saved') }}</span>
                        </div>
                    </div>
                </div>

                @error('body')
                    <p class="form-error" style="margin-top: 0.5rem;">
                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> {{ __('Cancel') }}
                </a>
                <button type="submit" class="btn btn-primary" id="submitBtn">
                    <i class="fas fa-paper-plane"></i> {{ __('Publish Post') }}
                </button>
            </div>
        </form>
    </div>

    <!-- Help Modal -->
    <div class="help-modal" id="helpModal">
        <div class="help-content">
            <div class="help-header">
                <h3 class="help-title">
                    <i class="fas fa-book"></i>
                    {{ __('Formatting Guide.title') }}
                </h3>
                <button class="help-close" onclick="closeHelp()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="help-body">
                <!-- Bold & Italic -->
                <div class="help-section">
                    <h4 class="help-section-title">
                        <i class="fas fa-text-height"></i>
                        {{ __('Formatting Guide.Text Formatting') }}
                    </h4>
                    <div class="help-grid">
                        <div class="help-item">
                            <span class="help-syntax">**text**</span>
                            <span class="help-example">→ <strong>bold</strong></span>
                        </div>
                        <div class="help-item">
                            <span class="help-syntax">*text*</span>
                            <span class="help-example">→ <em>italic</em></span>
                        </div>
                        <div class="help-item">
                            <span class="help-syntax">`code`</span>
                            <span class="help-example">→ <code>inline code</code></span>
                        </div>
                        <div class="help-item">
                            <span class="help-syntax">[text](url)</span>
                            <span class="help-example">→ link</span>
                        </div>
                    </div>
                </div>

                <!-- Headings -->
                <div class="help-section">
                    <h4 class="help-section-title">
                        <i class="fas fa-heading"></i>
                        {{ __('Formatting Guide.Headings') }}
                    </h4>
                    <div class="help-grid">
                        <div class="help-item">
                            <span class="help-syntax">## Title</span>
                            <span class="help-example">→ Heading 2</span>
                        </div>
                        <div class="help-item">
                            <span class="help-syntax">### Title</span>
                            <span class="help-example">→ Heading 3</span>
                        </div>
                    </div>
                </div>

                <!-- Lists -->
                <div class="help-section">
                    <h4 class="help-section-title">
                        <i class="fas fa-list"></i>
                        {{ __('Formatting Guide.Lists') }}
                    </h4>
                    <div class="help-grid">
                        <div class="help-item">
                            <span class="help-syntax">- Item</span>
                            <span class="help-example">→ • Bullet</span>
                        </div>
                        <div class="help-item">
                            <span class="help-syntax">1. Item</span>
                            <span class="help-example">→ 1. Numbered</span>
                        </div>
                    </div>
                </div>

                <!-- Media -->
                <div class="help-section">
                    <h4 class="help-section-title">
                        <i class="fas fa-image"></i>
                        {{ __('Formatting Guide.Images & Media') }}
                    </h4>
                    <div class="help-grid">
                        <div class="help-item">
                            <span class="help-syntax">[img:url]</span>
                            <span class="help-example">→ Image</span>
                        </div>
                        <div class="help-item">
                            <span class="help-syntax">[img:url|caption]</span>
                            <span class="help-example">→ Image + caption</span>
                        </div>
                        <div class="help-item">
                            <span class="help-syntax">```code```</span>
                            <span class="help-example">→ Code block</span>
                        </div>
                    </div>
                </div>

                <!-- Tables & More -->
                <div class="help-section">
                    <h4 class="help-section-title">
                        <i class="fas fa-table"></i>
                        {{ __('Formatting Guide.Tables & More') }}
                    </h4>
                    <div class="help-grid">
                        <div class="help-item">
                            <span class="help-syntax">| A | B |</span>
                            <span class="help-example">→ Table</span>
                        </div>
                        <div class="help-item">
                            <span class="help-syntax">&gt; Quote</span>
                            <span class="help-example">→ Blockquote</span>
                        </div>
                        <div class="help-item">
                            <span class="help-syntax">---</span>
                            <span class="help-example">→ Horizontal line</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script>
(function() {
    'use strict';
    
    // ===== Global State =====
    window.editorState = {
        currentView: 'edit',
        textarea: null,
        previewContent: null,
        autoSaveTimer: null
    };

    // ===== Translation Helper =====
    window.__ = function(key, params = {}) {
        const translations = @json(__('*.json'));
        const keys = key.split('.');
        let result = translations;
        
        for (const k of keys) {
            if (result && typeof result === 'object' && k in result) {
                result = result[k];
            } else {
                return key;
            }
        }
        
        if (typeof result === 'string') {
            for (const [param, value] of Object.entries(params)) {
                result = result.replace(`:${param}`, value);
            }
        }
        
        return result || key;
    };

    // ===== Initialize =====
    function initEditor() {
        const textarea = document.getElementById('postBody');
        const previewContent = document.getElementById('previewContent');
        
        if (!textarea || !previewContent) {
            console.warn('Editor elements not found');
            return;
        }
        
        window.editorState.textarea = textarea;
        window.editorState.previewContent = previewContent;
        
        updateStats();
        updatePreview();
        setupAutoSave();
        setupKeyboardShortcuts();
        
        console.log('✅ Editor initialized');
    }

    // ===== View Toggle =====
    window.toggleView = function(view) {
        if (!window.editorState.textarea) {
            initEditor();
            if (!window.editorState.textarea) return;
        }
        
        window.editorState.currentView = view;
        
        document.querySelectorAll('.view-btn').forEach(btn => {
            btn.classList.toggle('active', btn.dataset.view === view);
        });
        
        const editorWrapper = window.editorState.textarea.closest('.editor-wrapper');
        const previewPane = document.getElementById('previewPane');
        
        if (!editorWrapper || !previewPane) return;
        
        if (view === 'edit') {
            window.editorState.textarea.style.display = 'block';
            document.querySelector('.editor-stats').style.display = 'flex';
            previewPane.classList.remove('active');
        } else {
            window.editorState.textarea.style.display = 'none';
            document.querySelector('.editor-stats').style.display = 'none';
            previewPane.classList.add('active');
            updatePreview();
        }
    };

    // ===== Insert Markdown at Cursor =====
    window.insertMarkdown = function(prefix, suffix) {
        const ta = window.editorState.textarea;
        if (!ta) { initEditor(); return; }
        
        ta.focus();
        
        const start = ta.selectionStart;
        const end = ta.selectionEnd;
        const selected = ta.value.substring(start, end);
        const newText = prefix + selected + suffix;
        
        ta.value = ta.value.substring(0, start) + newText + ta.value.substring(end);
        
        const newCursorPos = start + prefix.length + selected.length;
        ta.setSelectionRange(newCursorPos, newCursorPos);
        
        ta.dispatchEvent(new Event('input', { bubbles: true }));
        setTimeout(() => ta.focus(), 10);
    };

    // ===== Insert List =====
    window.insertList = function(type) {
        const ta = window.editorState.textarea;
        if (!ta) { initEditor(); return; }
        
        ta.focus();
        
        const start = ta.selectionStart;
        const value = ta.value;
        
        const lineStart = value.lastIndexOf('\n', start - 1) + 1;
        const lineEnd = value.indexOf('\n', start);
        const selectedText = value.substring(lineStart, lineEnd === -1 ? value.length : lineEnd);
        
        const lines = selectedText.split('\n').filter(l => l.trim());
        const prefix = type === 'ul' ? '- ' : '1. ';
        
        let newList;
        if (lines.length > 0) {
            newList = lines.map((line, i) => {
                return type === 'ol' ? `${i + 1}. ${line.trim()}` : `- ${line.trim()}`;
            }).join('\n');
        } else {
            newList = prefix;
        }
        
        ta.value = value.substring(0, lineStart) + newList + '\n' + value.substring(lineEnd === -1 ? value.length : lineEnd);
        
        const newCursorPos = lineStart + newList.length + 1;
        ta.setSelectionRange(newCursorPos, newCursorPos);
        
        ta.dispatchEvent(new Event('input', { bubbles: true }));
        setTimeout(() => ta.focus(), 10);
    };

    // ===== Insert Image =====
    window.insertImage = function() {
        const ta = window.editorState.textarea;
        if (!ta) { initEditor(); return; }
        
        ta.focus();
        
        const url = prompt(
            `${__('Prompts.Enter image URL:')}\n${__('Prompts.Example: https://example.com/image.jpg')}`, 
            'https://'
        );
        if (!url || url === 'https://') return;
        
        const caption = prompt(__('Prompts.Enter caption (optional):'), '');
        const markdown = caption 
            ? `\n[img:${url}|${caption}]\n` 
            : `\n[img:${url}]\n`;
        
        insertAtCursor(markdown);
    };

    // ===== Insert Link =====
    window.insertLink = function() {
        const ta = window.editorState.textarea;
        if (!ta) { initEditor(); return; }
        
        ta.focus();
        
        const text = prompt(__('Prompts.Link text:'), __('Click here'));
        if (!text) return;
        
        const url = prompt(`${__('Prompts.Enter URL:')}\nhttps://`, 'https://');
        if (!url || url === 'https://') return;
        
        insertAtCursor(`[${text}](${url})`);
    };

    // ===== Insert Table =====
    window.insertTable = function() {
        const table = `

| ${__('Table Headers.Header 1')} | ${__('Table Headers.Header 2')} | ${__('Table Headers.Header 3')} |
|----------------|----------------|----------------|
| ${__('Table Headers.Row 1, Col 1')} | ${__('Table Headers.Row 1, Col 2')} | ${__('Table Headers.Row 1, Col 3')} |
| ${__('Table Headers.Row 2, Col 1')} | ${__('Table Headers.Row 2, Col 2')} | ${__('Table Headers.Row 2, Col 3')} |

`;
        insertAtCursor(table);
    };

    // ===== Helper: Insert at Cursor =====
    function insertAtCursor(text) {
        const ta = window.editorState.textarea;
        if (!ta) return;
        
        const start = ta.selectionStart;
        const end = ta.selectionEnd;
        
        ta.value = ta.value.substring(0, start) + text + ta.value.substring(end);
        
        const newCursorPos = start + text.length;
        ta.setSelectionRange(newCursorPos, newCursorPos);
        
        ta.dispatchEvent(new Event('input', { bubbles: true }));
        setTimeout(() => ta.focus(), 10);
    }

    // ===== Live Preview Parser =====
    window.updatePreview = function() {
        const ta = window.editorState.textarea;
        const preview = window.editorState.previewContent;
        if (!ta || !preview) return;
        
        const raw = ta.value || '';
        preview.innerHTML = parseMarkdown(raw);
    };

    function parseMarkdown(text) {
        if (!text) return '<p class="text-muted">' + __('Preview Messages.Write something to preview...') + '</p>';
        
        let html = text;
        
        // Escape HTML
        html = html.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
        
        // Images
        html = html.replace(/\[img:([^\]|]+)(?:\|([^\]]+))?\]/g, (match, url, caption) => {
            const cleanUrl = url.trim();
            const cleanCaption = caption ? caption.trim() : '';
            return `<figure style="text-align:center;margin:1.5rem auto;max-width:100%">
                <img src="${cleanUrl}" alt="${cleanCaption}" style="max-width:100%;height:auto;border-radius:12px;box-shadow:0 4px 6px -1px rgba(0,0,0,0.1);border:3px solid white" onerror="this.parentElement.innerHTML='<p style=\'color:#ef4444\'>❌ ${__('Preview Messages.Failed to load image')}</p>'">
                ${cleanCaption ? `<figcaption style="font-size:0.9rem;color:#64748b;font-style:italic;margin-top:0.5rem">${cleanCaption}</figcaption>` : ''}
            </figure>`;
        });
        
        // Links
        html = html.replace(/\[([^\]]+)\]\(([^)]+)\)/g, '<a href="$2" target="_blank" rel="noopener" style="color:#2563eb;text-decoration:none;border-bottom:2px solid transparent">$1</a>');
        
        // Bold/Italic
        html = html.replace(/\*\*([^*]+)\*\*/g, '<strong style="color:#1e293b;font-weight:700">$1</strong>');
        html = html.replace(/\*([^*]+)\*/g, '<em style="color:#1d4ed8;font-style:italic">$1</em>');
        html = html.replace(/`([^`]+)`/g, '<code style="background:#f1f5f9;padding:0.2rem 0.5rem;border-radius:5px;font-family:monospace;font-size:0.9em">$1</code>');
        html = html.replace(/```([\s\S]*?)```/g, '<pre style="background:#f1f5f9;padding:1rem;border-radius:10px;overflow-x:auto;margin:1rem 0"><code style="font-family:monospace;font-size:0.9em;line-height:1.6">$1</code></pre>');
        
        // Blockquotes
        html = html.replace(/^&gt; (.+)$/gm, '<blockquote style="margin:1.25rem 0;padding:1rem 1.25rem;border-right:4px solid #2563eb;background:#eff6ff;border-radius:0 10px 10px 0;font-style:italic"><p style="margin:0">$1</p></blockquote>');
        
        // Headings
        html = html.replace(/^## (.+)$/gm, '<h2 style="font-size:1.5rem;font-weight:700;color:#1e293b;margin:2rem 0 1rem;padding-bottom:0.75rem;border-bottom:3px solid #93c5fd;display:inline-block">$1</h2>');
        html = html.replace(/^### (.+)$/gm, '<h3 style="font-size:1.25rem;font-weight:600;color:#1e293b;margin:1.75rem 0 0.875rem">$1</h3>');
        
        // HR
        html = html.replace(/^(-{3,}|\*{3,})$/gm, '<hr style="border:none;height:2px;background:linear-gradient(135deg,#2563eb,#1d4ed8);margin:2rem 0;border-radius:2px">');
        
        // Tables
        html = parseTables(html);
        
        // Lists
        html = parseUnorderedLists(html);
        html = parseOrderedLists(html);
        
        // Paragraphs
        html = parseParagraphs(html);
        
        return html;
    }

    function parseTables(html) {
        const lines = html.split('\n');
        let result = [], inTable = false, rows = [];
        
        for (let line of lines) {
            const trimmed = line.trim();
            if (trimmed.startsWith('|') && trimmed.endsWith('|')) {
                if (!inTable) { inTable = true; rows = []; }
                if (!trimmed.match(/^\|[ -:|]+\|$/)) {
                    const cells = trimmed.split('|').slice(1,-1).map(c => `<td style="padding:0.75rem 1rem;border-bottom:1px solid #e2e8f0">${c.trim()}</td>`).join('');
                    rows.push(`<tr>${cells}</tr>`);
                }
            } else {
                if (inTable && rows.length > 0) {
                    const header = rows.shift().replace(/<td>/g, '<th style="padding:0.875rem 1rem;text-align:right;font-weight:600;color:#1e293b;border-bottom:2px solid #bfdbfe;background:#eff6ff">').replace(/<\/td>/g, '</th>');
                    result.push(`<table style="width:100%;border-collapse:collapse;margin:1.25rem 0;background:white;border-radius:10px;overflow:hidden"><thead>${header}</thead><tbody>${rows.join('')}</tbody></table>`);
                    inTable = false; rows = [];
                }
                result.push(line);
            }
        }
        if (inTable && rows.length > 0) {
            const header = rows.shift().replace(/<td>/g, '<th style="padding:0.875rem 1rem;text-align:right;font-weight:600;color:#1e293b;border-bottom:2px solid #bfdbfe;background:#eff6ff">').replace(/<\/td>/g, '</th>');
            result.push(`<table style="width:100%;border-collapse:collapse;margin:1.25rem 0;background:white;border-radius:10px;overflow:hidden"><thead>${header}</thead><tbody>${rows.join('')}</tbody></table>`);
        }
        return result.join('\n');
    }

    function parseUnorderedLists(html) {
        const lines = html.split('\n');
        let result = [], inList = false;
        
        for (let line of lines) {
            const trimmed = line.trim();
            if (trimmed.match(/^[\-\*]\s+.+$/)) {
                if (!inList) { result.push('<ul style="margin:1rem 0;padding:0;list-style:none">'); inList = true; }
                const content = trimmed.replace(/^[\-\*]\s+/, '');
                result.push(`<li style="margin:0.5rem 0;padding:0.25rem 0 0.25rem 1.75rem;position:relative;line-height:1.7"><span style="position:absolute;right:0;color:#2563eb;font-weight:bold;font-size:1.2rem">•</span>${content}</li>`);
            } else {
                if (inList) { result.push('</ul>'); inList = false; }
                result.push(line);
            }
        }
        if (inList) result.push('</ul>');
        return result.join('\n');
    }

    function parseOrderedLists(html) {
        const lines = html.split('\n');
        let result = [], inList = false, counter = 1;
        
        for (let line of lines) {
            const trimmed = line.trim();
            if (trimmed.match(/^\d+\.\s+.+$/)) {
                if (!inList) { result.push('<ol style="margin:1rem 0;padding:0;list-style:none;counter-reset:item">'); inList = true; counter = 1; }
                const content = trimmed.replace(/^\d+\.\s+/, '');
                result.push(`<li style="margin:0.5rem 0;padding:0.25rem 0 0.25rem 2rem;position:relative;counter-increment:item;line-height:1.7"><span style="position:absolute;right:0;color:#2563eb;font-weight:700;min-width:1.5rem">${counter++}.</span>${content}</li>`);
            } else {
                if (inList) { result.push('</ol>'); inList = false; }
                result.push(line);
            }
        }
        if (inList) result.push('</ol>');
        return result.join('\n');
    }

    function parseParagraphs(html) {
        return html.split(/(<\/?(?:h[2-6]|ul|ol|li|table|thead|tbody|tr|th|td|blockquote|pre|hr|figure|figcaption|code)[^>]*>)/i)
            .map(block => {
                const trimmed = block.trim();
                if (!trimmed || trimmed.startsWith('<')) return block;
                return `<p style="margin:0 0 1.25rem;text-align:justify;line-height:1.8;color:#64748b">${trimmed}</p>`;
            }).join('');
    }

    // ===== Stats Update =====
    window.updateStats = function() {
        const ta = window.editorState.textarea;
        if (!ta) return;
        
        const text = ta.value || '';
        const words = (text.match(/[\u0600-\u06FF\w]+/g) || []).length;
        const chars = text.length;
        const readTime = Math.max(1, Math.ceil(words / 200));
        
        const wordEl = document.getElementById('wordCount');
        const charEl = document.getElementById('charCount');
        const timeEl = document.getElementById('readTime');
        
        if (wordEl) wordEl.textContent = words.toLocaleString('ar-EG');
        if (charEl) charEl.textContent = chars.toLocaleString('ar-EG');
        if (timeEl) timeEl.textContent = readTime;
    };

    // ===== Auto Save Indicator =====
    function setupAutoSave() {
        const ta = window.editorState.textarea;
        const status = document.getElementById('autoSaveStatus');
        if (!ta || !status) return;
        
        const statusText = status.querySelector('span:last-child');
        const originalText = statusText?.textContent || __('Auto-saved');
        
        ta.addEventListener('input', () => {
            if (status.classList.contains('saving')) return;
            
            status.classList.add('saving');
            if (statusText) statusText.textContent = __('Saving...');
            
            clearTimeout(window.editorState.autoSaveTimer);
            window.editorState.autoSaveTimer = setTimeout(() => {
                status.classList.remove('saving');
                if (statusText) statusText.textContent = originalText;
            }, 1000);
        });
    }

    // ===== Keyboard Shortcuts =====
    function setupKeyboardShortcuts() {
        document.addEventListener('keydown', (e) => {
            const ta = window.editorState.textarea;
            if (!ta) return;
            if (document.activeElement !== ta) return;
            
            if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 'b') {
                e.preventDefault();
                insertMarkdown('**', '**');
            }
            if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 'i') {
                e.preventDefault();
                insertMarkdown('*', '*');
            }
            if ((e.ctrlKey || e.metaKey) && e.key === 'Enter') {
                e.preventDefault();
                const form = document.getElementById('postForm');
                if (form) form.requestSubmit();
            }
        });
    }

    // ===== Help Modal =====
    window.openHelp = function() {
        const modal = document.getElementById('helpModal');
        if (modal) {
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
    };

    window.closeHelp = function() {
        const modal = document.getElementById('helpModal');
        if (modal) {
            modal.classList.remove('active');
            document.body.style.overflow = '';
        }
    };

    document.addEventListener('click', (e) => {
        const modal = document.getElementById('helpModal');
        if (modal && e.target === modal) closeHelp();
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeHelp();
    });

    // ===== Form Submit Handling =====
    document.addEventListener('DOMContentLoaded', function() {
        initEditor();
        
        const form = document.getElementById('postForm');
        const submitBtn = document.getElementById('submitBtn');
        
        if (form && submitBtn) {
            form.addEventListener('submit', function(e) {
                submitBtn.disabled = true;
                const originalContent = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> ' + __('Updating...');
                
                setTimeout(() => {
                    if (submitBtn.disabled) {
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = originalContent;
                    }
                }, 5000);
            });
        }
    });

    // Expose functions globally
    window.insertAtCursor = insertAtCursor;
    window.parseMarkdown = parseMarkdown;
    
})();
</script>
@endpush