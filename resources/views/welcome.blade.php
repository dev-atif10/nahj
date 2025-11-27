<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * { font-family: 'Instrument Sans', sans-serif; }
         
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        @keyframes gradientShift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
        
        @keyframes pulse-glow {
            0%, 100% { opacity: 0.6; transform: scale(1); }
            50% { opacity: 0.8; transform: scale(1.05); }
        }
        
        .gradient-bg {
            background: linear-gradient(-45deg, #FF2D20, #FF6B6B, #FF8E53, #FFA07A);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .dark .glass-effect {
            background: rgba(22, 22, 21, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .hover-lift {
            transition: all 0.3s ease;
        }
        
        .hover-lift:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
        }
        
        .feature-card {
            position: relative;
            overflow: hidden;
        }
        
        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 45, 32, 0.1), transparent);
            transition: left 0.5s ease;
        }
        
        .feature-card:hover::before {
            left: 100%;
        }
        
        .logo-glow {
            filter: drop-shadow(0 0 20px rgba(255, 45, 32, 0.3));
        }
        
        @media (prefers-color-scheme: dark) {
            .gradient-bg {
                background: linear-gradient(-45deg, #991B11, #CC2418, #FF2D20, #FF4433);
            }
        }
    </style>
</head>
<body class="min-h-screen bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
    <!-- Animated gradient background -->
    <div class="fixed inset-0 gradient-bg opacity-10 -z-10"></div>
    
    <!-- Floating decoration circles -->
    <div class="fixed top-20 left-20 w-72 h-72 bg-red-500/10 rounded-full blur-3xl animate-pulse"></div>
    <div class="fixed bottom-20 right-20 w-96 h-96 bg-orange-500/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 2s;"></div>
    
    <div class="relative min-h-screen flex flex-col">
        <!-- Header -->
        <header class="w-full max-w-7xl mx-auto px-6 py-6">
            <nav class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <svg class="w-10 h-10 text-red-600 logo-glow" viewBox="0 0 50 52" fill="currentColor">
                        <path d="M49.626 11.564a.809.809 0 0 1 .028.209v10.972a.8.8 0 0 1-.402.694l-9.209 5.302V39.25c0 .286-.152.55-.4.694L20.42 51.01c-.044.025-.092.041-.14.058-.018.006-.035.017-.054.022a.805.805 0 0 1-.41 0c-.022-.006-.042-.018-.063-.026-.044-.016-.09-.03-.132-.054L.402 39.944A.801.801 0 0 1 0 39.25V6.334c0-.072.01-.142.028-.21.006-.023.02-.044.028-.067.015-.042.029-.085.051-.124.015-.026.037-.047.055-.071.023-.032.044-.065.071-.093.023-.023.053-.04.079-.06.029-.024.055-.05.088-.069h.001l9.61-5.533a.802.802 0 0 1 .8 0l9.61 5.533h.002c.032.02.059.045.088.068.026.02.055.038.078.06.028.029.048.062.072.094.017.024.04.045.054.071.023.04.036.082.052.124.008.023.022.044.028.068a.809.809 0 0 1 .028.209v20.559l8.008-4.611v-10.51c0-.07.01-.141.028-.208.007-.024.02-.045.028-.068.016-.042.03-.085.052-.124.015-.026.037-.047.054-.071.024-.032.044-.065.072-.093.023-.023.052-.04.078-.06.03-.024.056-.05.088-.069h.001l9.611-5.533a.801.801 0 0 1 .8 0l9.61 5.533c.034.02.06.045.09.068.025.02.054.038.077.06.028.029.048.062.072.094.018.024.04.045.054.071.023.039.036.082.052.124.009.023.022.044.028.068zm-1.574 10.718v-9.124l-3.363 1.936-4.646 2.675v9.124l8.01-4.611zm-9.61 16.505v-9.13l-4.57 2.61-13.05 7.448v9.216l17.62-10.144zM1.602 7.719v31.068L19.22 48.93v-9.214l-9.204-5.209-.003-.002-.004-.002c-.031-.018-.057-.044-.086-.066-.025-.02-.054-.036-.076-.058l-.002-.003c-.026-.025-.044-.056-.066-.084-.02-.027-.044-.05-.06-.078l-.001-.003c-.018-.03-.029-.066-.042-.1-.013-.03-.03-.058-.038-.09v-.001c-.01-.038-.012-.078-.016-.117-.004-.03-.012-.06-.012-.09v-.002-21.481L4.965 9.654 1.602 7.72zm8.81-5.994L2.405 6.334l8.005 4.609 8.006-4.61-8.006-4.608zm4.164 28.764l4.645-2.674V7.719l-3.363 1.936-4.646 2.675v20.096l3.364-1.937zM39.243 7.164l-8.006 4.609 8.006 4.609 8.005-4.61-8.005-4.608zm-.801 10.605l-4.646-2.675-3.363-1.936v9.124l4.645 2.674 3.364 1.937v-9.124zM20.02 38.33l11.743-6.704 5.87-3.35-8-4.606-9.211 5.303-8.395 4.833 7.993 4.524z"/>
                    </svg>
                    <span class="text-xl font-bold bg-gradient-to-r from-red-600 to-orange-600 bg-clip-text text-transparent">Laravel</span>
                </div>
                
                <div class="flex items-center gap-4">
                    <a href="#" class="px-5 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-red-600 dark:hover:text-red-400 transition-colors">
                        Log in
                    </a>
                    <a href="#" class="px-5 py-2 text-sm font-medium bg-red-600 hover:bg-red-700 text-white rounded-lg shadow-md hover-lift">
                        Register
                    </a>
                </div>
            </nav>
        </header>

        <!-- Main Content -->
        <main class="flex-1 flex items-center justify-center px-6 py-12">
            <div class="max-w-6xl w-full">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <!-- Left Column - Content -->
                    <div class="space-y-8">
                        <div class="space-y-4">
                            <div class="inline-block">
                                <span class="px-4 py-2 bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 rounded-full text-sm font-semibold">
                                    v11.x
                                </span>
                            </div>
                            <h1 class="text-5xl lg:text-6xl font-bold leading-tight">
                                The PHP Framework for
                                <span class="bg-gradient-to-r from-red-600 to-orange-600 bg-clip-text text-transparent">
                                    Web Artisans
                                </span>
                            </h1>
                            <p class="text-xl text-gray-600 dark:text-gray-400">
                                Laravel is a web application framework with expressive, elegant syntax. Start building amazing applications today.
                            </p>
                        </div>

                        <!-- Quick Links -->
                        <div class="grid sm:grid-cols-2 gap-4">
                            <a href="https://laravel.com/docs" target="_blank" class="feature-card group p-6 glass-effect rounded-xl hover-lift">
                                <div class="flex items-start gap-4">
                                    <div class="p-3 bg-red-100 dark:bg-red-900/30 rounded-lg group-hover:scale-110 transition-transform">
                                        <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-lg mb-1">Documentation</h3>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Comprehensive guides and API reference</p>
                                    </div>
                                </div>
                            </a>

                            <a href="https://laracasts.com" target="_blank" class="feature-card group p-6 glass-effect rounded-xl hover-lift">
                                <div class="flex items-start gap-4">
                                    <div class="p-3 bg-orange-100 dark:bg-orange-900/30 rounded-lg group-hover:scale-110 transition-transform">
                                        <svg class="w-6 h-6 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-lg mb-1">Laracasts</h3>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Thousands of video tutorials</p>
                                    </div>
                                </div>
                            </a>

                            <a href="https://laravel-news.com" target="_blank" class="feature-card group p-6 glass-effect rounded-xl hover-lift">
                                <div class="flex items-start gap-4">
                                    <div class="p-3 bg-blue-100 dark:bg-blue-900/30 rounded-lg group-hover:scale-110 transition-transform">
                                        <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-lg mb-1">Laravel News</h3>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Latest updates and articles</p>
                                    </div>
                                </div>
                            </a>

                            <a href="https://github.com/laravel/laravel" target="_blank" class="feature-card group p-6 glass-effect rounded-xl hover-lift">
                                <div class="flex items-start gap-4">
                                    <div class="p-3 bg-purple-100 dark:bg-purple-900/30 rounded-lg group-hover:scale-110 transition-transform">
                                        <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-lg mb-1">GitHub</h3>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Open source on GitHub</p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- CTA Buttons -->
                        <div class="flex flex-wrap gap-4">
                            <a href="https://laravel.com/docs" target="_blank" class="px-8 py-4 bg-gradient-to-r from-red-600 to-orange-600 hover:from-red-700 hover:to-orange-700 text-white font-semibold rounded-xl shadow-lg hover-lift flex items-center gap-2">
                                Get Started
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </a>
                            <a href="https://cloud.laravel.com" target="_blank" class="px-8 py-4 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-900 dark:text-white font-semibold rounded-xl shadow-lg hover-lift border border-gray-200 dark:border-gray-700">
                                Deploy to Cloud
                            </a>
                        </div>
                    </div>

                    <!-- Right Column - Visual -->
                    <div class="relative">
                        <div class="glass-effect rounded-2xl p-8 shadow-2xl">
                            <div class="space-y-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-3 h-3 rounded-full bg-red-500"></div>
                                    <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                                    <div class="w-3 h-3 rounded-full bg-green-500"></div>
                                </div>
                                
                                <pre class="text-sm overflow-x-auto"><code class="text-gray-800 dark:text-gray-200"><span class="text-purple-600 dark:text-purple-400">Route</span>::<span class="text-blue-600 dark:text-blue-400">get</span>(<span class="text-green-600 dark:text-green-400">'/'</span>, <span class="text-purple-600 dark:text-purple-400">function</span> () {
    <span class="text-purple-600 dark:text-purple-400">return</span> <span class="text-blue-600 dark:text-blue-400">view</span>(<span class="text-green-600 dark:text-green-400">'welcome'</span>);
});

<span class="text-purple-600 dark:text-purple-400">Route</span>::<span class="text-blue-600 dark:text-blue-400">resource</span>(<span class="text-green-600 dark:text-green-400">'posts'</span>, PostController::<span class="text-purple-600 dark:text-purple-400">class</span>);

<span class="text-purple-600 dark:text-purple-400">Auth</span>::<span class="text-blue-600 dark:text-blue-400">routes</span>();</code></pre>
                            </div>
                        </div>
                        
                        <!-- Floating badge -->
                        <div class="absolute -top-4 -right-4 bg-gradient-to-r from-red-600 to-orange-600 text-white px-6 py-3 rounded-xl shadow-lg" style="animation: float 3s ease-in-out infinite;">
                            <div class="text-sm font-semibold">🚀 Ready to Build</div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="w-full max-w-7xl mx-auto px-6 py-8">
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4 text-sm text-gray-600 dark:text-gray-400">
                <div>
                    Laravel v11.x • PHP v8.2+
                </div>
                <div class="flex gap-6">
                    <a href="https://laravel.com" target="_blank" class="hover:text-red-600 dark:hover:text-red-400 transition-colors">Website</a>
                    <a href="https://github.com/laravel/laravel" target="_blank" class="hover:text-red-600 dark:hover:text-red-400 transition-colors">GitHub</a>
                    <a href="https://twitter.com/laravelphp" target="_blank" class="hover:text-red-600 dark:hover:text-red-400 transition-colors">Twitter</a>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>