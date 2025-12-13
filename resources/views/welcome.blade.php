<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-nova-dark text-nova-milk h-screen w-screen overflow-hidden flex items-center justify-center relative">

    <!-- LOADER -->
    <div id="loader" class="fixed inset-0 bg-nova-dark flex items-center justify-center z-50 transition-opacity duration-500">
        <div class="w-14 h-14 border-4 border-nova-gray border-t-4 border-t-nova-milk rounded-full animate-spin"></div>
    </div>

    <!-- CONTENT -->
    <div id="content" class="opacity-0 transform translate-y-5 transition-all duration-700 text-center p-10 bg-[#2e2e2e] rounded-xl shadow-2xl space-y-6">
        <h1 class="text-3xl font-bold mb-3">Welcome to My App</h1>
        <p class="text-nova-gray">Kelola aktivitas harianmu dengan mudah</p>

        <div class="flex flex-col sm:flex-row justify-center gap-4 mt-4">
            <!-- Todo Button -->
            <a href="/todos" class="px-6 py-3 bg-nova-milk text-nova-dark font-bold rounded-lg hover:opacity-90 hover:scale-105 transition transform">
                Masuk ke Todo
            </a>

            <!-- Note Button -->
            <a href="/notes" class="px-6 py-3 bg-nova-gray text-nova-milk font-bold rounded-lg hover:opacity-90 hover:scale-105 transition transform">
                Masuk ke Note
            </a>
        </div>
    </div>

    <script>
        window.addEventListener('load', () => {
            const loader = document.getElementById('loader');
            const content = document.getElementById('content');

            setTimeout(() => {
                loader.classList.add('opacity-0');
                setTimeout(() => loader.style.display = 'none', 500); // hilangkan loader setelah fade
                content.classList.add('opacity-100', 'translate-y-0');
            }, 1000); // durasi loading
        });
    </script>

</body>
</html>
