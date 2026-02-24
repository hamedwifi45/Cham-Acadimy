<nav x-data="{ open: false }" class="bg-white shadow-sm border-b">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('Gallary') }}" class="shrink-0 flex items-center">
                    <x-application-mark class="block h-9 w-auto" />
                </a>
            </div>

            <!-- Center: Navigation + Search -->
            <div class="hidden sm:flex sm:items-center sm:space-x-6 rtl:space-x-reverse">
                <!-- Navigation Links -->
                <x-nav-link href="{{ route('Gallary') }}" :active="request()->routeIs('Gallary')">
                    {{ __('Home') }}
                </x-nav-link>
                <x-nav-link href="{{ route('courses.index') }}" :active="request()->routeIs('courses.index')">
                    {{ __('Courses') }}
                </x-nav-link>
                <x-nav-link href="{{ route('posts.index') }}" :active="request()->routeIs('posts.index')">
                    {{ __('Blog') }}
                </x-nav-link>
                @auth
                @if (auth()->user()->has_any_course())
                    <x-nav-link href="{{ route('courses.mycourse') }}" :active="request()->routeIs('courses.mycourse')">
                        {{ __('MY Course') }}
                    </x-nav-link>
                @endif
                @endauth
                <!-- Search Bar -->
                <div class="relative">
                    @livewire('search')
                </div>
            </div>

            <!-- Right Side: Language Toggle + Auth -->
            <div class="flex items-center space-x-4 rtl:space-x-reverse">
                <!-- Language Switcher -->
                <div class="flex bg-gray-100 rounded-lg p-0.5">
                    <a href="{{ route('lang.switch', 'ar') }}"
                        class="px-2.5 py-1 text-xs font-medium rounded transition {{ app()->getLocale() === 'ar' ? 'bg-white text-blue-600 shadow-sm' : 'text-gray-600 hover:text-gray-900' }}">
                        عربـي
                    </a>
                    <a href="{{ route('lang.switch', 'en') }}"
                        class="px-2.5 py-1 text-xs font-medium rounded transition {{ app()->getLocale() === 'en' ? 'bg-white text-blue-600 shadow-sm' : 'text-gray-600 hover:text-gray-900' }}">
                        EN
                    </a>
                </div>

                <!-- Auth Section -->
                @auth
                    <div class="hidden sm:block ms-2">
                        <div class="ms-3 relative">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                        <button class="flex items-center text-sm rounded-full focus:outline-none">
                                            <img class="size-8 rounded-full object-cover"
                                                src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                        </button>
                                    @else
                                        <span class="inline-flex rounded-md">
                                            <button type="button"
                                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                                {{ Auth::user()->name }}
                                                <svg class="ms-1 -me-0.5 size-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                </svg>
                                            </button>
                                        </span>
                                    @endif
                                </x-slot>

                                <x-slot name="content">
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Account') }}
                                    </div>
                                    <x-dropdown-link href="{{ route('profile.show') }}">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>

                                    @if(auth()->user()->is_admin())
                                        <x-dropdown-link href="{{ route('admin.dashboard') }}">
                                            {{ __('Admin Dashboard') }}
                                        </x-dropdown-link>
                                    @endif
                                    @if (auth()->user()->has_any_course())
                                        <x-dropdown-link href="{{ route('courses.mycourse') }}"
                                            :active="request()->routeIs('courses.mycourse')">
                                            {{ __('MY Course') }}
                                        </x-dropdown-link>
                                    @endif

                                    <div class="border-t border-gray-200"></div>
                                    <form method="POST" action="{{ route('logout') }}" x-data>
                                        @csrf
                                        <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>
                @endauth
                @guest
                    <div class="hidden sm:flex items-center space-x-3 rtl:space-x-reverse">
                        <a href="{{ route('login') }}"
                            class="text-sm font-medium text-gray-700 hover:text-blue-600 transition">
                            {{ __('Login') }}
                        </a>
                        <a href="{{ route('register') }}"
                            class="px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-700 rounded-lg hover:from-blue-700 hover:to-indigo-800 transition shadow-md">
                            {{ __('Register') }}
                        </a>
                    </div>
                @endguest
                <!-- Hamburger for mobile -->
                <div class="-me-2 flex items-center sm:hidden">
                    <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition">
                        <svg class="size-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Responsive Menu (Mobile) -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('Gallary') }}" :active="request()->routeIs('Gallary')">
                {{ __('Home') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('courses.index') }}" :active="request()->routeIs('courses.index')">
                {{ __('Courses') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('posts.index') }}" :active="request()->routeIs('posts.index')">
                {{ __('Blog') }}
            </x-responsive-nav-link>
            @auth
            @if (auth()->user()->has_any_course())
                <x-responsive-nav-link href="{{ route('courses.mycourse') }}" :active="request()->routeIs('courses.mycourse')">
                    {{ __('MY Course') }}
                </x-responsive-nav-link>
            @endif
            @endauth
            <!-- Mobile Search -->
            <div class="px-4 py-2">
                @livewire('search')
            </div>
        </div>

        @auth
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="flex items-center px-4">
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <img class="size-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                            alt="{{ Auth::user()->name }}" />
                    @endif
                    <div class="ms-3">
                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>
                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>


                    @if(auth()->user()->is_admin() )
                        <x-responsive-nav-link href="{{ route('admin.dashboard') }}">
                            {{ __('Admin Dashboard') }}
                        </x-responsive-nav-link>
                    @endif

                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <x-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @endauth
        @guest
            <div class="pt-4 pb-6 px-4 space-y-3 border-t border-gray-200">
                <a href="{{ route('login') }}"
                    class="w-full text-center block px-4 py-2 text-sm font-medium text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100 transition">
                    {{ __('Login') }}
                </a>
                <a href="{{ route('register') }}"
                    class="w-full text-center block px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-700 rounded-lg hover:from-blue-700 hover:to-indigo-800 transition shadow-md">
                    {{ __('Register') }}
                </a>
            </div>
        @endguest
    </div>
</nav>