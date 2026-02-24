<x-app-layout>
    @push('styles')
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom Styles - Blue Academic Theme -->
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
            
            /* Content Colors */
            --code-bg: #f1f5f9;
            --code-text: #1e293b;
            --blockquote-border: #3b82f6;
            --table-header: #eff6ff;
            --table-border: #bfdbfe;
            
            /* Shadows */
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.1);
            --shadow-lg: 0 10px 25px -5px rgba(37, 99, 235, 0.15);
        }

        body {
            font-family: 'Tajawal', sans-serif;
            background: var(--background);
            color: var(--text-primary);
            line-height: 1.7;
        }

        /* Hero Header */
        .article-hero {
            background: var(--primary-gradient);
            padding: 3rem 1rem 4rem;
            position: relative;
            overflow: hidden;
        }

        .article-hero::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            border-radius: 50%;
        }

        .article-meta {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1.5rem;
            flex-wrap: wrap;
            margin-bottom: 1.25rem;
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.9rem;
        }

        .article-meta span {
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .article-meta i {
            opacity: 0.9;
        }

        .article-title {
            font-size: clamp(1.5rem, 4vw, 2.25rem);
            font-weight: 800;
            color: white;
            text-align: center;
            line-height: 1.4;
            margin: 0;
            max-width: 900px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Article Container - FULL WIDTH */
        .article-container {
            width: 100%;
            max-width: 1200px;
            margin: -3rem auto 0;
            padding: 0 2rem;
            position: relative;
            z-index: 10;
        }

        .article-card {
            background: var(--surface);
            border-radius: 24px;
            padding: 3rem 4rem;
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border);
            width: 100%;
        }

        /* Content Typography - Wide & Comfortable */
        .article-content {
            font-size: 1.15rem;
            line-height: 2;
            color: var(--text-secondary);
            width: 100%;
        }

        .article-content > *:first-child {
            margin-top: 0;
        }

        .article-content h2 {
            font-size: 1.65rem;
            font-weight: 700;
            color: var(--text-primary);
            margin: 3rem 0 1.25rem;
            padding-bottom: 0.875rem;
            border-bottom: 3px solid var(--accent);
            display: inline-block;
        }

        .article-content h3 {
            font-size: 1.4rem;
            font-weight: 600;
            color: var(--text-primary);
            margin: 2.5rem 0 1rem;
        }

        .article-content p {
            margin: 0 0 1.5rem;
            text-align: justify;
            max-width: 100%;
        }

        .article-content p:last-child {
            margin-bottom: 0;
        }

        /* Links */
        .article-content a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            border-bottom: 2px solid transparent;
            transition: border-color 0.2s ease;
        }

        .article-content a:hover {
            border-bottom-color: var(--primary);
        }

        /* Bold & Italic */
        .article-content strong {
            color: var(--text-primary);
            font-weight: 700;
        }

        .article-content em {
            color: var(--primary-dark);
            font-style: italic;
        }

        /* ============ LISTS FIX ============ */
        /* Unordered Lists - Fixed RTL/LTR */
        .article-content ul {
            margin: 1.25rem 0;
            padding: 0;
            list-style: none;
            width: 100%;
        }

        .article-content ul li {
            margin: 0.75rem 0;
            padding: 0.25rem 0 0.25rem 2rem;
            position: relative;
            line-height: 1.8;
        }

        /* LTR: Bullet on left */
        .article-content ul li::before {
            content: '•';
            color: var(--primary);
            font-weight: bold;
            font-size: 1.4rem;
            position: absolute;
            right: auto;
            left: 0;
            top: 0.1rem;
            line-height: 1;
        }

        /* RTL: Bullet on right */
        [dir="rtl"] .article-content ul li {
            padding: 0.25rem 2rem 0.25rem 0;
        }

        [dir="rtl"] .article-content ul li::before {
            left: auto;
            right: 0;
        }

        /* Ordered Lists */
        .article-content ol {
            margin: 1.25rem 0;
            padding-right: 0;
            padding-left: 0;
            list-style: none;
            counter-reset: item;
            width: 100%;
        }

        .article-content ol li {
            margin: 0.75rem 0;
            padding: 0.25rem 0 0.25rem 2.5rem;
            position: relative;
            counter-increment: item;
            line-height: 1.8;
        }

        .article-content ol li::before {
            content: counter(item) ".";
            color: var(--primary);
            font-weight: 700;
            position: absolute;
            right: auto;
            left: 0;
            top: 0.1rem;
            min-width: 1.8rem;
            text-align: right;
        }

        [dir="rtl"] .article-content ol li {
            padding: 0.25rem 2.5rem 0.25rem 0;
        }

        [dir="rtl"] .article-content ol li::before {
            left: auto;
            right: 0;
            text-align: left;
        }

        /* Nested Lists */
        .article-content ul ul,
        .article-content ol ol,
        .article-content ul ol,
        .article-content ol ul {
            margin: 0.5rem 0 0.5rem 2rem;
        }

        [dir="rtl"] .article-content ul ul,
        [dir="rtl"] .article-content ol ol,
        [dir="rtl"] .article-content ul ol,
        [dir="rtl"] .article-content ol ul {
            margin: 0.5rem 2rem 0.5rem 0;
        }

        /* Images */
        .article-content img {
            max-width: 100%;
            height: auto;
            border-radius: 16px;
            margin: 2rem auto;
            display: block;
            box-shadow: var(--shadow);
            border: 4px solid white;
            transition: transform 0.3s ease;
        }

        .article-content img:hover {
            transform: scale(1.02);
        }

        .article-content .image-caption {
            text-align: center;
            font-size: 0.95rem;
            color: var(--text-muted);
            margin-top: -1.25rem;
            margin-bottom: 2rem;
            font-style: italic;
        }

        /* Code Blocks */
        .article-content pre {
            background: var(--code-bg);
            border-radius: 12px;
            padding: 1.5rem;
            margin: 2rem 0;
            overflow-x: auto;
            direction: ltr;
            text-align: left;
            border: 1px solid var(--border);
            width: 100%;
            box-sizing: border-box;
        }

        [dir="rtl"] .article-content pre {
            direction: ltr;
            text-align: left;
        }

        .article-content code {
            background: var(--code-bg);
            color: var(--code-text);
            padding: 0.25rem 0.6rem;
            border-radius: 6px;
            font-family: 'Fira Code', 'Courier New', monospace;
            font-size: 0.95em;
        }

        .article-content pre code {
            padding: 0;
            background: transparent;
            font-size: 0.92em;
            line-height: 1.7;
        }

        /* Blockquotes */
        .article-content blockquote {
            margin: 2rem 0;
            padding: 1.25rem 1.75rem;
            border-right: 4px solid var(--blockquote-border);
            background: #eff6ff;
            border-radius: 0 12px 12px 0;
            color: var(--text-secondary);
            font-style: italic;
            width: 100%;
            box-sizing: border-box;
        }

        [dir="rtl"] .article-content blockquote {
            border-right: none;
            border-left: 4px solid var(--blockquote-border);
            border-radius: 12px 0 0 12px;
        }

        .article-content blockquote p {
            margin: 0;
        }

        /* Tables - Full Width */
        .article-content table {
            width: 100%;
            border-collapse: collapse;
            margin: 2rem 0;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            display: table;
        }

        .article-content thead {
            background: var(--table-header);
        }

        .article-content th {
            padding: 1.25rem 1.5rem;
            text-align: right;
            font-weight: 600;
            color: var(--text-primary);
            border-bottom: 2px solid var(--table-border);
        }

        [dir="rtl"] .article-content th {
            text-align: left;
        }

        .article-content td {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--border);
            color: var(--text-secondary);
        }

        .article-content tr:last-child td {
            border-bottom: none;
        }

        .article-content tr:hover {
            background: #f8fafc;
        }

        /* Horizontal Rule */
        .article-content hr {
            border: none;
            height: 2px;
            background: var(--primary-gradient);
            margin: 3rem 0;
            border-radius: 2px;
            width: 100%;
        }

        /* Share Section */
        .share-section {
            margin-top: 3rem;
            padding-top: 2.5rem;
            border-top: 1px solid var(--border);
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            width: 100%;
        }

        .share-label {
            font-weight: 600;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .share-buttons {
            display: flex;
            gap: 0.625rem;
        }

        .share-btn {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: #eff6ff;
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .share-btn:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-3px);
            box-shadow: var(--shadow);
        }

        .share-btn.facebook:hover { background: #1877f2; color: white; }
        .share-btn.twitter:hover { background: #1da1f2; color: white; }
        .share-btn.whatsapp:hover { background: #25d366;
            color: white; }
        .share-btn.linkedin:hover { background: #0a66c2; color: white; }

        .copy-link {
            background: white;
            border: 2px solid var(--border);
            color: var(--text-secondary);
        }

        .copy-link:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        .copy-link.copied {
            background: #10b981;
            border-color: #10b981;
            color: white;
        }

        /* Article Footer */
        .article-footer {
            margin-top: 3.5rem;
            padding-top: 2.5rem;
            border-top: 1px solid var(--border);
            text-align: center;
            width: 100%;
        }

        .academy-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: #eff6ff;
            color: var(--primary);
            padding: 0.875rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1rem;
        }

        .academy-badge i {
            font-size: 1.2rem;
        }

        /* Comments Section Wrapper */
        .comments-section {
            margin-top: 4rem;
            padding-top: 2.5rem;
            border-top: 1px solid var(--border);
            width: 100%;
        }

        .comments-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 1.75rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Back to Blog Link */
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--primary);
            font-weight: 500;
            text-decoration: none;
            padding: 0.625rem 1.25rem;
            border-radius: 12px;
            transition: all 0.3s ease;
            margin-bottom: 1.5rem;
            background: #eff6ff;
        }

        .back-link:hover {
            background: var(--primary);
            color: white;
            transform: translateX(-4px);
        }

        [dir="rtl"] .back-link:hover {
            transform: translateX(4px);
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .article-card {
                padding: 2.5rem 3rem;
            }
        }

        @media (max-width: 768px) {
            .article-hero {
                padding: 2.5rem 1rem 3rem;
            }
            
            .article-container {
                margin-top: -2rem;
                padding: 0 1rem;
            }
            
            .article-card {
                padding: 2rem 1.5rem;
                border-radius: 20px;
            }
            
            .article-content {
                font-size: 1.1rem;
                line-height: 1.9;
            }
            
            .article-content h2 {
                font-size: 1.45rem;
            }
            
            .article-content ul li,
            .article-content ol li {
                padding-right: 0;
                padding-left: 0;
            }
            
            [dir="rtl"] .article-content ul li,
            [dir="rtl"] .article-content ol li {
                padding-right: 1.8rem;
                padding-left: 0;
            }
            
            .share-buttons {
                width: 100%;
                justify-content: center;
            }
        }

        /* RTL Support */
        [dir="rtl"] {
            direction: rtl;
            text-align: right;
        }
        
        [dir="rtl"] .share-btn i {
            transform: scaleX(-1);
        }
        
        [dir="rtl"] .back-link i:first-child {
            transform: rotate(180deg);
        }
    </style>
    @endpush

    <!-- Article Hero -->
    <header class="article-hero">
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto text-center">
                <!-- Meta Info -->
                <div class="article-meta">
                    <span><i class="far fa-calendar"></i> {{ $post->created_at->format('d F Y') }}</span>
                    <span><i class="far fa-clock"></i> <span id="readTime">--</span> {{ __('min read') }}</span>
                    <span><i class="far fa-eye"></i> <span id="wordCount">--</span> {{ __('words') }}</span>
                </div>
                
                <!-- Title -->
                <h1 class="article-title" id="articleTitle">{{ $post->title }}</h1>
            </div>
        </div>
    </header>

    <!-- Main Article - FULL WIDTH CONTAINER -->
    <main class="article-container">
        <article class="article-card">
            <!-- Back Link -->
            <a href="{{ route('posts.index') }}" class="back-link">
                <i class="fas fa-arrow-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }}"></i>
                {{ __('Back to Blog') }}
            </a>

            <!-- Content (Raw - Will be parsed by JS) -->
            <div class="article-content" id="articleContent" data-raw-content="{!! addslashes($post->body) !!}">
                <!-- Content will be rendered by JavaScript -->
                <div class="text-center py-12">
                    <div class="inline-block animate-spin rounded-full h-10 w-10 border-4 border-primary border-t-transparent"></div>
                    <p class="mt-4 text-text-secondary">{{ __('Loading content...') }}</p>
                </div>
            </div>

            <!-- Share Section -->
            <div class="share-section">
                <span class="share-label">
                    <i class="fas fa-share-alt"></i>
                    {{ __('Share this article') }}
                </span>
                <div class="share-buttons">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                       target="_blank" 
                       class="share-btn facebook" 
                       title="{{ __('Share on Facebook') }}"
                       aria-label="{{ __('Share on Facebook') }}">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($post->title) }}" 
                       target="_blank" 
                       class="share-btn twitter" 
                       title="{{ __('Share on Twitter') }}"
                       aria-label="{{ __('Share on Twitter') }}">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://wa.me/?text={{ urlencode($post->title . ' ' . url()->current()) }}" 
                       target="_blank" 
                       class="share-btn whatsapp" 
                       title="{{ __('Share on WhatsApp') }}"
                       aria-label="{{ __('Share on WhatsApp') }}">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}" 
                       target="_blank" 
                       class="share-btn linkedin" 
                       title="{{ __('Share on LinkedIn') }}"
                       aria-label="{{ __('Share on LinkedIn') }}">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <button class="share-btn copy-link" 
                            onclick="copyLink()" 
                            title="{{ __('Copy Link') }}"
                            aria-label="{{ __('Copy Link') }}"
                            id="copyBtn">
                        <i class="fas fa-link"></i>
                    </button>
                </div>
            </div>
            @auth
                @if(auth()->user()->is_admin())
                    <div class="article-footer">
                        <div class="academy-badge">
                            <i class="fas fa-graduation-cap"></i>
                            <a href="{{ route('admin.posts.edit', $post->id) }}">{{ __('Edit') }}</a>
                        </div>
                    </div>
                @endif
            @endauth
        </article>

        <!-- Comments Section -->
        <section class="comments-section">
            <h3 class="comments-title">
                <i class="far fa-comments"></i>
                {{ __('Comments') }}
            </h3>
            <livewire:post-comments :post="$post" />
        </section>
    </main>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get raw content and parse it
            const contentEl = document.getElementById('articleContent');
            const rawContent = contentEl.dataset.rawContent;
            
            // Parse and render content
            const parsedContent = parseMarkdown(rawContent);
            contentEl.innerHTML = parsedContent;
            
            // Calculate and display stats
            updateArticleStats(rawContent);
            
            // Initialize lazy loading for images
            lazyLoadImages();
        });

        /**
         * Markdown-like Parser for Arabic/English Content
         */
        function parseMarkdown(text) {
            if (!text) return '';
            
            let html = text;
            
            // 1. Escape HTML first to prevent XSS
            html = html.replace(/&/g, '&amp;')
                      .replace(/</g, '&lt;')
                      .replace(/>/g, '&gt;');
            
            // 2. Images: [img:url] or [img:url|caption]
            html = html.replace(/\[img:([^\]|]+)(?:\|([^\]]+))?\]/g, (match, url, caption) => {
                const cleanUrl = url.trim();
                const cleanCaption = caption ? caption.trim() : '';
                return `<figure style="margin:2rem auto;text-align:center;max-width:100%">
                    <img src="${cleanUrl}" alt="${cleanCaption || 'Article image'}" loading="lazy" style="max-width:100%;height:auto;border-radius:16px;box-shadow:0 10px 25px -5px rgba(37,99,235,0.15);border:4px solid white" onerror="this.parentElement.style.display='none'">
                    ${cleanCaption ? `<figcaption class="image-caption">${cleanCaption}</figcaption>` : ''}
                </figure>`;
            });
            
            // 3. Links: [text](url)
            html = html.replace(/\[([^\]]+)\]\(([^)]+)\)/g, '<a href="$2" target="_blank" rel="noopener noreferrer">$1</a>');
            
            // 4. Bold: **text** or __text__
            html = html.replace(/\*\*([^*]+)\*\*/g, '<strong>$1</strong>');
            html = html.replace(/__([^_]+)__/g, '<strong>$1</strong>');
            
            // 5. Italic: *text* or _text_
            html = html.replace(/\*([^*]+)\*/g, '<em>$1</em>');
            html = html.replace(/_([^_]+)_/g, '<em>$1</em>');
            
            // 6. Inline Code: `code`
            html = html.replace(/`([^`]+)`/g, '<code>$1</code>');
            
            // 7. Code Blocks: ```code```
            html = html.replace(/```([\s\S]*?)```/g, '<pre><code>$1</code></pre>');
            
            // 8. Blockquotes: > text
            html = html.replace(/^&gt; (.+)$/gm, '<blockquote><p>$1</p></blockquote>');
            
            // 9. Horizontal Rule: --- or ***
            html = html.replace(/^(-{3,}|\*{3,})$/gm, '<hr>');
            
            // 10. Headings: ## Heading
            html = html.replace(/^## (.+)$/gm, '<h2>$1</h2>');
            html = html.replace(/^### (.+)$/gm, '<h3>$1</h3>');
            
            // 11. Tables: | col1 | col2 |
            html = parseTables(html);
            
            // 12. Unordered Lists: - item or * item
            html = parseUnorderedLists(html);
            
            // 13. Ordered Lists: 1. item
            html = parseOrderedLists(html);
            
            // 14. Paragraphs: Wrap remaining text blocks in <p>
            html = parseParagraphs(html);
            
            return html;
        }

        /**
         * Parse Markdown Tables
         */
        function parseTables(html) {
            const lines = html.split('\n');
            let result = [];
            let inTable = false;
            let tableRows = [];
            
            for (let i = 0; i < lines.length; i++) {
                const line = lines[i].trim();
                
                if (line.startsWith('|') && line.endsWith('|')) {
                    if (!inTable) {
                        inTable = true;
                        tableRows = [];
                    }
                    
                    if (!line.match(/^\|[ -:|]+\|$/)) {
                        const cells = line.split('|')
                            .slice(1, -1)
                            .map(cell => cell.trim())
                            .map(cell => `<td>${cell}</td>`)
                            .join('');
                        tableRows.push(`<tr>${cells}</tr>`);
                    }
                } else {
                    if (inTable && tableRows.length > 0) {
                        const header = tableRows.shift();
                        const body = tableRows.join('');
                        result.push(`<table><thead>${header.replace(/<td>/g, '<th>').replace(/<\/td>/g, '</th>')}</thead><tbody>${body}</tbody></table>`);
                        inTable = false;
                        tableRows = [];
                    }
                    result.push(line);
                }
            }
            
            if (inTable && tableRows.length > 0) {
                const header = tableRows.shift();
                const body = tableRows.join('');
                result.push(`<table><thead>${header.replace(/<td>/g, '<th>').replace(/<\/td>/g, '</th>')}</thead><tbody>${body}</tbody></table>`);
            }
            
            return result.join('\n');
        }

        /**
         * Parse Unordered Lists - FIXED
         */
        function parseUnorderedLists(html) {
            const lines = html.split('\n');
            let result = [];
            let inList = false;
            let listLevel = 0;
            
            for (let i = 0; i < lines.length; i++) {
                const line = lines[i];
                const trimmed = line.trim();
                
                // Check for list item with proper indentation handling
                if (trimmed.match(/^[\-\*]\s+.+$/)) {
                    if (!inList) {
                        result.push('<ul>');
                        inList = true;
                        listLevel = 0;
                    }
                    
                    // Count indentation for nested lists
                    const indent = line.match(/^(\s*)/)[1].length;
                    const level = Math.floor(indent / 2);
                    
                    // Handle nesting
                    if (level > listLevel) {
                        for (let j = listLevel; j < level; j++) {
                            result.push('<ul>');
                        }
                    } else if (level < listLevel) {
                        for (let j = listLevel; j > level; j--) {
                            result.push('</ul>');
                        }
                    }
                    listLevel = level;
                    
                    const content = trimmed.replace(/^[\-\*]\s+/, '');
                    result.push(`<li>${content}</li>`);
                } else {
                    if (inList) {
                        // Close all open lists
                        for (let j = 0; j <= listLevel; j++) {
                            result.push('</ul>');
                        }
                        inList = false;
                        listLevel = 0;
                    }
                    result.push(line);
                }
            }
            
            if (inList) {
                for (let j = 0; j <= listLevel; j++) {
                    result.push('</ul>');
                }
            }
            
            return result.join('\n');
        }

        /**
         * Parse Ordered Lists - FIXED
         */
        function parseOrderedLists(html) {
            const lines = html.split('\n');
            let result = [];
            let inList = false;
            let listLevel = 0;
            
            for (let i = 0; i < lines.length; i++) {
                const line = lines[i];
                const trimmed = line.trim();
                
                if (trimmed.match(/^\d+\.\s+.+$/)) {
                    if (!inList) {
                        result.push('<ol>');
                        inList = true;
                        listLevel = 0;
                    }
                    
                    const indent = line.match(/^(\s*)/)[1].length;
                    const level = Math.floor(indent / 2);
                    
                    if (level > listLevel) {
                        for (let j = listLevel; j < level; j++) {
                            result.push('<ol>');
                        }
                    } else if (level < listLevel) {
                        for (let j = listLevel; j > level; j--) {
                            result.push('</ol>');
                        }
                    }
                    listLevel = level;
                    
                    const content = trimmed.replace(/^\d+\.\s+/, '');
                    result.push(`<li>${content}</li>`);
                } else {
                    if (inList) {
                        for (let j = 0; j <= listLevel; j++) {
                            result.push('</ol>');
                        }
                        inList = false;
                        listLevel = 0;
                    }
                    result.push(line);
                }
            }
            
            if (inList) {
                for (let j = 0; j <= listLevel; j++) {
                    result.push('</ol>');
                }
            }
            
            return result.join('\n');
        }

        /**
         * Wrap text blocks in paragraphs
         */
        function parseParagraphs(html) {
            const blocks = html.split(/(<\/?(?:h[2-6]|ul|ol|li|table|thead|tbody|tr|th|td|blockquote|pre|hr|figure|figcaption)[^>]*>)/i);
            
            return blocks.map(block => {
                if (block.trim() === '' || block.startsWith('<') || block.startsWith('</')) {
                    return block;
                }
                const trimmed = block.trim();
                if (trimmed && !trimmed.startsWith('<')) {
                    return `<p>${trimmed}</p>`;
                }
                return block;
            }).join('');
        }

        /**
         * Calculate and display article stats
         */
        function updateArticleStats(rawText) {
            const cleanText = rawText
                .replace(/\[img:[^\]]+\]/g, '')
                .replace(/\*\*([^*]+)\*\*/g, '$1')
                .replace(/\*([^*]+)\*/g, '$1')
                .replace(/`([^`]+)`/g, '$1');
            
            const words = cleanText.match(/[\u0600-\u06FF\w]+/g) || [];
            const wordCount = words.length;
            document.getElementById('wordCount').textContent = wordCount.toLocaleString('ar-EG');
            
            const readTime = Math.ceil(wordCount / 200);
            document.getElementById('readTime').textContent = readTime;
        }

        /**
         * Lazy load images
         */
        function lazyLoadImages() {
            if ('IntersectionObserver' in window) {
                const images = document.querySelectorAll('#articleContent img[loading="lazy"]');
                const imageObserver = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            imageObserver.unobserve(entry.target);
                        }
                    });
                });
                images.forEach(img => imageObserver.observe(img));
            }
        }

        /**
         * Copy article link to clipboard
         */
        function copyLink() {
            const url = window.location.href;
            const btn = document.getElementById('copyBtn');
            const originalIcon = btn.innerHTML;
            
            navigator.clipboard.writeText(url).then(() => {
                btn.innerHTML = '<i class="fas fa-check"></i>';
                btn.classList.add('copied');
                setTimeout(() => {
                    btn.innerHTML = originalIcon;
                    btn.classList.remove('copied');
                }, 2000);
            }).catch(err => {
                const textarea = document.createElement('textarea');
                textarea.value = url;
                document.body.appendChild(textarea);
                textarea.select();
                document.execCommand('copy');
                document.body.removeChild(textarea);
                
                btn.innerHTML = '<i class="fas fa-check"></i>';
                btn.classList.add('copied');
                setTimeout(() => {
                    btn.innerHTML = originalIcon;
                    btn.classList.remove('copied');
                }, 2000);
            });
        }

        window.copyLink = copyLink;
    </script>
    @endpush
</x-app-layout>