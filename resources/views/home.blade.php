<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-indigo-500">
    <div class="min-h-screen flex flex-col lg:flex-row">
        <!-- Left side - Logo and Motto -->
        <div class="bg-indigo-600 flex flex-col justify-center items-center text-white px-4 py-12 lg:w-1/2">
            <!-- Replace with your actual logo -->
            <svg class="w-24 h-24 lg:w-32 lg:h-32" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 2a8 8 0 100 16 8 8 0 000-16zm0 14a6 6 0 100-12 6 6 0 000 12z" clip-rule="evenodd" />
            </svg>
            <h1 class="mt-6 text-3xl lg:text-4xl font-bold text-center">Segafin</h1>
            <p class="mt-3 text-lg lg:text-xl text-center">Segafin is a platform for managing your finances</p>
        </div>

        <!-- Right side - Login Form -->
        <div class="flex-1 flex items-center justify-center px-4 py-12 lg:w-1/2 bg-white">
            <div class="max-w-md w-full space-y-8">
                <div>
                    <h2 class="mt-6 text-center text-2xl lg:text-3xl font-extrabold text-indigo-900">
                        Sign in to your account
                    </h2>
                </div>
                <form class="mt-8 space-y-6" action="/login" method="get">
                    <input type="hidden" name="remember" value="true">
                    <div class="rounded-md shadow-sm -space-y-px">
                        <div>
                            <label for="email-address" class="sr-only">Email address</label>
                            <input id="email-address"  name="email" type="email" autocomplete="email" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-indigo-300 placeholder-indigo-500 text-indigo-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Email address">
                        </div>
                        <div>
                            <label for="password" class="sr-only">Password</label>
                            <input id="password"  name="password" type="password" autocomplete="current-password" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-indigo-300 placeholder-indigo-500 text-indigo-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Password">
                        </div>
                    </div>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        </div>
                    @endif

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-indigo-300 rounded">
                            <label for="remember-me" class="ml-2 block text-sm text-indigo-900">
                                Remember me
                            </label>
                        </div>

                        <div class="text-sm">
                            <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
                                Forgot your password?
                            </a>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Sign in
                        </button>
                    </div>
                   
                </form>
            </div>
        </div>
    </div>
</body>
</html>