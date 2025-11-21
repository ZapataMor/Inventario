<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
        <style>
            .auth-bg {
                background-image: 
                    linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.8)),
                    url('{{ asset('images/imagen.jpg') }}');
                background-size: 100% auto; /* Sin zoom - tamaño original */
                background-position: center;
                background-attachment: fixed;
                background-repeat: no-repeat;
            }
        </style>
    </head>
    <body class="min-h-screen bg-white antialiased dark:bg-zinc-900">
        <div class="auth-bg flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10">
            <div class="flex w-full max-w-sm flex-col gap-2">
                <a href="{{ route('home') }}" class="flex flex-col items-center gap-2 font-medium" wire:navigate>
                    <span class="flex h-9 w-9 mb-1 items-center justify-center rounded-md">
                    </span>
                    <span class="sr-only">{{ config('app.name', 'Laravel') }}</span>
                </a>
                <div class="flex flex-col gap-6">
                    {{ $slot }}
                </div>
            </div>
        </div>
        @fluxScripts
    </body>
</html>