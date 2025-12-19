<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Todo App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-nova-dark flex justify-center pt-20 text-nova-milk">

<!-- LOADER -->
<div id="loader" class="fixed inset-0 bg-nova-dark flex items-center justify-center z-50 transition-opacity duration-500">
    <div class="w-14 h-14 border-4 border-nova-gray border-t-4 border-t-nova-milk rounded-full animate-spin"></div>
</div>

<div class="bg-[#2e2e2e] w-full max-w-md p-6 rounded-xl shadow-2xl">

    <!-- BACK BUTTON (SAMA SEPERTI NOTES) -->
    <a href="/"
       class="inline-block mb-4 px-4 py-2 rounded-lg
              bg-[#3a3a3a] text-nova-milk text-sm
              hover:opacity-90 transition">
        ← Back to Home
    </a>

    <h1 class="text-center text-2xl font-bold tracking-wide mb-6">
        Todo App
    </h1>

    <!-- ADD TODO -->
    <form method="POST" action="/todos" class="flex gap-3 mb-6">
        @csrf
        <input
            type="text"
            name="title"
            placeholder="Tambah todo baru..."
            required
            class="flex-1 px-3 py-2 rounded-lg bg-[#3a3a3a] text-nova-milk
                   placeholder:text-[#b8b0a0]
                   focus:outline-none focus:ring-2 focus:ring-nova-milk"
        >
        <button
            type="submit"
            class="px-4 py-2 rounded-lg bg-nova-milk text-nova-dark
                   font-semibold hover:opacity-90 transition">
            Tambah
        </button>
    </form>

    <!-- LIST -->
    <ul class="space-y-2">
        @foreach ($todos as $todo)
            <li class="bg-[#353535] px-4 py-3 rounded-lg flex justify-between items-center">
                <span class="max-w-[220px] break-words">
                    {{ $todo->title }}
                </span>

                <div class="flex gap-2">
                    <button
                        type="button"
                        onclick="openModal({{ $todo->id }}, '{{ $todo->title }}')"
                        class="px-3 py-1 rounded-md bg-nova-gray
                               text-white text-sm hover:opacity-90 transition">
                        Edit
                    </button>

                    <form action="/todos/{{ $todo->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button
                            type="submit"
                            class="px-3 py-1 rounded-md bg-red-600
                                   text-white text-sm hover:bg-red-700 transition">
                            Hapus
                        </button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
</div>


<!-- MODAL -->
<div id="editModal" class="fixed inset-0 bg-black/70 hidden items-center justify-center z-50">
    <div class="bg-[#2e2e2e] w-full max-w-sm p-6 rounded-xl shadow-2xl">
        <h3 class="text-center text-lg font-semibold mb-4">Edit Todo</h3>

        <form method="POST" id="editForm" class="space-y-4">
            @csrf
            @method('PUT')

            <input
                type="text"
                name="title"
                id="editTitle"
                required
                class="w-full px-3 py-2 rounded-lg bg-[#3a3a3a] text-nova-milk
                       focus:outline-none focus:ring-2 focus:ring-nova-milk"
            >

            <div class="flex gap-3">
                <button type="submit" class="flex-1 py-2 rounded-lg bg-nova-milk text-nova-dark font-semibold hover:opacity-90 transition">
                    Update
                </button>
                <button type="button" onclick="closeModal()" class="flex-1 py-2 rounded-lg bg-gray-600 text-white hover:bg-gray-700 transition">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal(id, title) {
        const modal = document.getElementById('editModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.getElementById('editTitle').value = title;
        document.getElementById('editForm').action = '/todos/' + id;
    }

    function closeModal() {
        const modal = document.getElementById('editModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

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
