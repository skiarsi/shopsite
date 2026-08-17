<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? config('app.name') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="bg-slate-50">
        <div class="flex min-h-screen items-center justify-center px-4 py-12">
            <div class="w-full max-w-md rounded-3xl bg-white p-8 shadow-xl shadow-slate-200/50 ring-1 ring-slate-100">
                <div class="mb-8 text-center">
                    <h1 class="text-3xl font-semibold text-slate-900">Sign in to your account</h1>
                    <p class="mt-2 text-sm text-slate-500">Enter your credentials to access the dashboard.</p>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger mb-7">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="text-xs text-red-500">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="email" class="mb-2 block text-sm font-medium text-slate-700">Email address</label>
                        <input id="email" name="email" type="email" autocomplete="email" required class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-100" />
                    </div>

                    <div>
                        <label for="password" class="mb-2 block text-sm font-medium text-slate-700">Password</label>
                        <input id="password" name="password" type="password" autocomplete="current-password" required class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-100" />
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="inline-flex items-center gap-2 text-sm text-slate-600">
                            <input name="remember" type="checkbox" class="h-4 w-4 rounded border-slate-300 text-sky-600 focus:ring-sky-500" />
                            Remember me
                        </label>
                        <a href="{{ route('password.request') }}" class="text-sm font-medium text-sky-600 hover:text-sky-700">Forgot password?</a>
                    </div>

                    <button type="submit" class="w-full rounded-2xl bg-sky-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2">Log in</button>
                </form>

                <div class="relative my-8 justify-end w-full flex text-sm">
                    Not a member?&nbsp;<a href="{{ route('register') }}" class="text-sky-600 focus:ring-sky-700">register here</a>
                </div>

                <div class="relative my-8">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-slate-200"></div>
                    </div>
                    <div class="relative flex justify-center text-sm text-slate-500">
                        <span class="bg-white px-5">Or continue with</span>
                    </div>
                </div>

                <div>
                    <a href="{{ route('social.redirect', 'google') }}" class="flex items-center justify-center gap-3 rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-medium text-slate-700 transition hover:bg-slate-50">
                    {{-- <a href="#" class="flex items-center justify-center gap-3 rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-medium text-slate-700 transition hover:bg-slate-50"> --}}
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M22.5 12.236c0-.82-.074-1.61-.213-2.378H12v4.51h5.92c-.255 1.38-1.025 2.55-2.187 3.338v2.777h3.536c2.07-1.908 3.271-4.712 3.271-8.247z" fill="#4285F4"/>
                            <path d="M12 23c2.97 0 5.465-.98 7.287-2.66l-3.536-2.778c-.98.658-2.236 1.05-3.751 1.05-2.882 0-5.323-1.94-6.192-4.55H1.14v2.85C2.938 20.98 7.18 23 12 23z" fill="#34A853"/>
                            <path d="M5.808 13.06a7.213 7.213 0 0 1-.384-2.36c0-.822.146-1.62.384-2.36V5.49H1.14A11.983 11.983 0 0 0 0 12c0 1.93.457 3.75 1.14 5.51l4.668-2.45z" fill="#FBBC05"/>
                            <path d="M12 4.77c1.614 0 3.058.556 4.2 1.64l3.147-3.147C17.463 1.51 14.97.5 12 .5 7.18.5 2.938 2.52 1.14 5.49l4.668 2.86C6.677 6.71 9.118 4.77 12 4.77z" fill="#EA4335"/>
                        </svg>
                        Login with Google
                    </a>
                </div>
            </div>
        </div>
    </body>
</html>
