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
                        ? 'انضم إلى مجتمعنا التعليمي وابدأ رحلتك في تعلم أحدث التقنيات' 
                        : 'Join our educational community and start your journey in learning the latest technologies' }}
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

        <!-- يمين: نموذج التسجيل -->
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
                        {{ __('Create Account') }}
                    </h2>
                    <p class="text-center text-gray-600 mb-8">
                        {{ __('Join us today and start learning') }}
                    </p>

                    <x-validation-errors class="mb-4" />

                    <form method="POST" action="{{ route('register') }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
                        @csrf

                        <!-- حقل الاسم -->
                        <div class="mt-4">
                            <x-label for="name" :value="__('Name')" class="text-gray-700" />
                            <div class="relative mt-1">
                                <div class="absolute inset-y-0 {{ app()->getLocale() === 'ar' ? 'right-0 pr-3' : 'left-0 pl-3' }} flex items-center pointer-events-none text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <x-input 
                                    id="name" 
                                    class="block w-full {{ app()->getLocale() === 'ar' ? 'pr-10' : 'pl-10' }} {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }} py-3 border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-base"
                                    type="text" 
                                    name="name" 
                                    :value="old('name')" 
                                    required 
                                    autofocus 
                                    autocomplete="name" 
                                />
                            </div>
                        </div>

                        <!-- حقل البريد الإلكتروني -->
                        <div class="mt-6">
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
                                    autocomplete="new-password" 
                                />
                            </div>
                        </div>

                        <!-- حقل تأكيد كلمة المرور -->
                        <div class="mt-6">
                            <x-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-700" />
                            <div class="relative mt-1">
                                <div class="absolute inset-y-0 {{ app()->getLocale() === 'ar' ? 'right-0 pr-3' : 'left-0 pl-3' }} flex items-center pointer-events-none text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <x-input 
                                    id="password_confirmation" 
                                    class="block w-full {{ app()->getLocale() === 'ar' ? 'pr-10' : 'pl-10' }} {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }} py-3 border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-base"
                                    type="password" 
                                    name="password_confirmation" 
                                    required 
                                    autocomplete="new-password" 
                                />
                            </div>
                        </div>

                        <!-- شروط الاستخدام -->
                        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                            <div class="mt-6">
                                <label for="terms" class="flex items-start">
                                    <x-checkbox id="terms" name="terms" required class="rounded text-blue-600 border-gray-300 focus:ring-blue-500 mt-1" />
                                    <span class="ms-2 text-sm text-gray-600">
                                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-blue-600 hover:text-blue-800">'.__('Terms of Service').'</a>',
                                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-blue-600 hover:text-blue-800">'.__('Privacy Policy').'</a>',
                                        ]) !!}
                                    </span>
                                </label>
                            </div>
                        @endif

                        <!-- زر التسجيل -->
                        <div class="mt-8">
                            <x-button 
                                class="w-full px-4 py-3 bg-gradient-to-r from-blue-600 to-indigo-700 hover:from-blue-700 hover:to-indigo-800 text-white font-semibold rounded-xl shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200 transform hover:scale-[1.02] active:scale-95">
                                {{ __('Register') }}
                            </x-button>
                        </div>
                    </form>

                    <!-- رابط تسجيل الدخول -->
                    <div class="mt-6 pt-6 border-t border-gray-200 text-center">
                        <span class="text-gray-600">{{ __('Already have an account?') }}</span>
                        <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-800 mx-1">
                            {{ __('Sign in') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>