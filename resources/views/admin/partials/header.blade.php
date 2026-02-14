<header class="bg-white shadow-sm z-10">
    <div class="flex items-center justify-between px-6 py-4">
        <div class="flex items-center gap-4">
            <button id="sidebarToggle" class="md:hidden p-2 rounded-lg hover:bg-gray-100">
                <i class="fas fa-bars text-gray-600"></i>
            </button>
            <div class="flex items-center gap-2">
                <a href="{{ route('Gallary') }}" class="flex items-center gap-2">

                        <div id="sidebarToggle" class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-graduation-cap text-white text-sm"></i>
                        </div>

                    <span class="text-xl font-bold text-gray-800 hidden md:block">{{ __('Acadimy Sham') }}</span>
                </a>
            </div>
            <div class="flex bg-gray-100 rounded-lg p-0.5">
                    <a href="{{ route('lang.switch', 'ar') }}"
                        class="px-2.5 py-1 text-xs font-medium rounded transition {{ app()->getLocale() === 'ar' ? 'bg-white text-blue-600 shadow-sm' : 'text-gray-600 hover:text-gray-900' }}">
                        {{ __('Arabic') }}
                    </a>
                    <a href="{{ route('lang.switch', 'en') }}"
                        class="px-2.5 py-1 text-xs font-medium rounded transition {{ app()->getLocale() === 'en' ? 'bg-white text-blue-600 shadow-sm' : 'text-gray-600 hover:text-gray-900' }}">
                        EN
                    </a>
                </div>
        </div>

        <div class="flex items-center gap-4">
            {{-- مشروع مستقبلي --}}
            {{-- <div class="relative">
                <button class="p-2 rounded-full hover:bg-gray-100 relative">
                    <i class="fas fa-bell text-gray-600"></i>
                    <span class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">3</span>
                </button>
            </div> --}}
            <div class="flex items-center gap-3">
                <div class="user-avatar bg-gradient-to-r from-indigo-500 to-purple-600">
<img class="size-10 rounded-full object-cover"
                                                src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />                </div>
                
                <div class="hidden md:block">
                    <p class="font-medium text-gray-800">{{ auth()->user()->name }}</p>
                    <p class="text-sm text-gray-500">{{ __('Administrator') }}</p>
                </div>
            </div>
        </div>
    </div>
</header>