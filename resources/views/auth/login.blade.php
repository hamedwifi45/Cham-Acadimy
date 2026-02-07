<x-guest-layout>
    <div class="min-h-screen flex flex-col lg:flex-row {{ app()->getLocale() === 'ar' ? 'lg:flex-row-reverse bg-gradient-to-r' : 'bg-gradient-to-br' }} from-blue-50 to-indigo-100">
        <!-- يسار: شعار وأوصاف (يظهر فقط على الشاشات الكبيرة) -->
        <div class="hidden lg:flex lg:w-1/2 items-center justify-center bg-white/80 backdrop-blur-sm border-r border-gray-200">
            <div class="text-center max-w-md px-10">
                <div class="mb-8">
                    <a href="/" class="inline-block">
                        <x-application-mark class="w-48 h-48 mx-auto" />
                    </a>
                </div>
                <h1 class="text-3xl font-bold text-gray-800 mb-4">
                    {{ app()->getLocale() === 'ar' ? 'أكاديمية الشام' : 'Cham Academy' }}
                </h1>
                <p class="text-gray-600 leading-relaxed">
                    {{ app()->getLocale() === 'ar' 
                        ? 'منصة تعليمية متكاملة لتعلم أحدث تقنيات البرمجة وإدارة الأعمال' 
                        : 'A comprehensive educational platform to learn the latest programming technologies and business management' }}
                </p>
                <div class="mt-8 flex justify-center space-x-4 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }}">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-blue-600">10K+</div>
                        <div class="text-gray-700">{{ __('Students') }}</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-blue-600">50+</div>
                        <div class="text-gray-700">{{ __('Courses') }}</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-blue-600">4.9</div>
                        <div class="text-gray-700">{{ __('Rating') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- يمين: نموذج تسجيل الدخول -->
        <div class="flex-1 flex flex-col items-center justify-center p-4 sm:p-6">
            <!-- زر تبديل اللغة (يظهر في الأعلى) -->
            <div class="mb-6">
                <div class="flex bg-gray-100 rounded-lg p-0.5">
                    <a href="{{ route('lang.switch', 'ar') }}"
                        class="px-3 py-1 text-sm font-medium rounded transition {{ app()->getLocale() === 'ar' ? 'bg-white text-blue-600 shadow-sm' : 'text-gray-600 hover:text-gray-900' }}">
                        عربـي
                    </a>
                    <a href="{{ route('lang.switch', 'en') }}"
                        class="px-3 py-1 text-sm font-medium rounded transition {{ app()->getLocale() === 'en' ? 'bg-white text-blue-600 shadow-sm' : 'text-gray-600 hover:text-gray-900' }}">
                        EN
                    </a>
                </div>
            </div>

            <!-- حاوية النموذج -->
            <div class="w-full max-w-md bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-200">
                <div class="p-6 sm:p-8">
                    <h2 class="text-2xl md:text-3xl font-bold text-center text-gray-800 mb-2">
                        {{ __('Welcome Back!') }}
                    </h2>
                    <p class="text-center text-gray-600 mb-8">
                        {{ __('Sign in to your account') }}
                    </p>

                    <x-validation-errors class="mb-4" />

                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
                        @csrf

                        <!-- حقل البريد الإلكتروني -->
                        <div class="mt-4">
                            <x-label for="email" :value="__('Email')" class="text-gray-700" />
                            <div class="relative mt-1">
                                <div class="absolute inset-y-0 {{ app()->getLocale() === 'ar' ? 'right-0 pr-3' : 'left-0 pl-3' }} flex items-center pointer-events-none text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <x-input 
                                    id="email" 
                                    class="block w-full {{ app()->getLocale() === 'ar' ? 'pr-10' : 'pl-10' }} {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }} py-3 border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-base"
                                    type="email" 
                                    name="email" 
                                    :value="old('email')" 
                                    required 
                                    autofocus 
                                    autocomplete="username" 
                                />
                            </div>
                        </div>

                        <!-- حقل كلمة المرور -->
                        <div class="mt-6">
                            <x-label for="password" :value="__('Password')" class="text-gray-700" />
                            <div class="relative mt-1">
                                <div class="absolute inset-y-0 {{ app()->getLocale() === 'ar' ? 'right-0 pr-3' : 'left-0 pl-3' }} flex items-center pointer-events-none text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                                <x-input 
                                    id="password" 
                                    class="block w-full {{ app()->getLocale() === 'ar' ? 'pr-10' : 'pl-10' }} {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }} py-3 border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-base"
                                    type="password" 
                                    name="password" 
                                    required 
                                    autocomplete="current-password" 
                                />
                            </div>
                        </div>

                        <div class="flex items-center justify-between mt-6">
                            <!-- خيار تذكرني -->
                            <label for="remember_me" class="flex items-center">
                                <x-checkbox id="remember_me" name="remember" class="rounded text-blue-600 border-gray-300 focus:ring-blue-500" />
                                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                            </label>

                            <!-- نسيت كلمة المرور -->
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-sm font-medium text-blue-600 hover:text-blue-800">
                                    {{ __('Forgot password?') }}
                                </a>
                            @endif
                        </div>

                        <!-- زر التسجيل -->
                        <div class="mt-8">
                            <x-button 
                                class="w-full px-4 py-3 bg-gradient-to-r from-blue-600 to-indigo-700 hover:from-blue-700 hover:to-indigo-800 text-white font-semibold rounded-xl shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200 transform hover:scale-[1.02] active:scale-95">
                                {{ __('Sign In') }}
                            </x-button>
                        </div>
                    </form>

                    {{-- تأجل لنهاية المشروع لتوفير الوقت --}}
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <p class="text-center text-gray-600 mb-4">{{ __('Or continue with') }}</p>
                        <div class="flex justify-center space-x-4 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }}">
                            <a href="#" class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600 hover:bg-blue-100 transition-colors">
                                <i class="fab fa-facebook-f text-xl"></i>
                            </a>
                            <a href="{{ route('auth.google.redirect') }}" class="w-12 h-12 rounded-xl bg-red-50 flex items-center justify-center text-red-600 hover:bg-red-100 transition-colors">
                                <i class="fab fa-google text-xl"></i>
                            </a>
                            <a href="#" class="w-12 h-12 rounded-xl bg-gray-50 flex items-center justify-center text-gray-800 hover:bg-gray-100 transition-colors">
                                <i class="fab fa-apple text-xl"></i>
                            </a>
                        </div>
                    </div>

                    <!-- رابط التسجيل -->
                    <div class="mt-6 text-center">
                        <span class="text-gray-600">{{ __('Don\'t have an account?') }}</span>
                        <a href="{{ route('register') }}" class="font-medium text-blue-600 hover:text-blue-800 mx-1">
                            {{ __('Sign up') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>