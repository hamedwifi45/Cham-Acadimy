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
                    {{ __('Cham Academy') }}
                </h1>
                <p class="text-gray-600 leading-relaxed">
                    {{ app()->getLocale() === 'ar' 
                        ? __('Join our learning community and start your journey to learn the latest technologies') 
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

                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <p class="text-center text-gray-600 mb-4">{{ __('Or continue with') }}</p>
                        <div class="flex justify-center space-x-4 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }}">
                            
                            <a href="{{ route('auth.google.redirect') }}" class="w-12 h-12 rounded-xl bg-red-50 flex items-center justify-center text-red-600 hover:bg-red-100 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="-3 0 262 262" preserveAspectRatio="xMidYMid">
                                    <path
                                        d="M255.878 133.451c0-10.734-.871-18.567-2.756-26.69H130.55v48.448h71.947c-1.45 12.04-9.283 30.172-26.69 42.356l-.244 1.622 38.755 30.023 2.685.268c24.659-22.774 38.875-56.282 38.875-96.027"
                                        fill="#4285F4" />
                                    <path
                                        d="M130.55 261.1c35.248 0 64.839-11.605 86.453-31.622l-41.196-31.913c-11.024 7.688-25.82 13.055-45.257 13.055-34.523 0-63.824-22.773-74.269-54.25l-1.531.13-40.298 31.187-.527 1.465C35.393 231.798 79.49 261.1 130.55 261.1"
                                        fill="#34A853" />
                                    <path
                                        d="M56.281 156.37c-2.756-8.123-4.351-16.827-4.351-25.82 0-8.994 1.595-17.697 4.206-25.82l-.073-1.73L15.26 71.312l-1.335.635C5.077 89.644 0 109.517 0 130.55s5.077 40.905 13.925 58.602l42.356-32.782"
                                        fill="#FBBC05" />
                                    <path
                                        d="M130.55 50.479c24.514 0 41.05 10.589 50.479 19.438l36.844-35.974C195.245 12.91 165.798 0 130.55 0 79.49 0 35.393 29.301 13.925 71.947l42.211 32.783c10.59-31.477 39.891-54.251 74.414-54.251"
                                        fill="#EB4335" />
                                </svg>
                            </a>
                            
                        </div>
                    </div>
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