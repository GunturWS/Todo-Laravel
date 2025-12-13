<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-nova-dark text-nova-milk min-h-screen py-10">

<div class="container mx-auto px-4">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-4xl font-bold">My Notes</h1>
        <form method="POST" action="/notes" class="flex gap-3">
            @csrf
            <input
                type="text"
                name="title"
                placeholder="Tambah note baru..."
                required
                class="px-4 py-2 rounded-lg bg-[#3a3a3a] text-nova-milk placeholder:text-[#b8b0a0] focus:outline-none focus:ring-2 focus:ring-nova-milk transition w-60"
            >
            <button type="submit" class="px-4 py-2 rounded-lg bg-nova-milk text-nova-dark font-semibold hover:opacity-90 transition">
                Tambah
            </button>
        </form>
    </div>

    <!-- Notes Grid -->
    <!-- Notes Grid -->
<div class="flex justify-center">
    <div class="w-full max-w-[1000px] grid grid-cols-1 sm:grid-cols-2 gap-6">
        @foreach ($notes as $note)
            <div class="bg-[#2e2e2e] rounded-2xl p-6 shadow-lg hover:shadow-2xl transition flex flex-col">
                <!-- Judul -->
                <p class="text-nova-milk text-sm font-medium break-words mb-3 ">
                    {{ $note->title }}
                </p>

                <!-- Tanggal & Jam -->
                <p class="text-nova-gray text-sm mb-4">
                    Dibuat: {{ $note->created_at->format('d M Y, H:i') }}
                </p>

                <!-- Buttons -->
                <div class="flex justify-end gap-3 mt-auto">
                    <button onclick="openModal({{ $note->id }}, @json($note->title))"
        class="px-4 py-2 rounded-xl bg-nova-gray text-white text-sm hover:bg-[#7c7164] transition">
    Edit
</button>

                    <form method="POST" action="/notes/{{ $note->id }}">
                        @csrf
                        @method('DELETE')
                        <button
                            class="px-4 py-2 rounded-xl bg-red-600 text-white text-sm hover:bg-red-700 transition"
                        >
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>



</div>

<!-- Modal Edit Note -->
<div id="editModal" class="fixed inset-0 bg-black/50 hidden z-50 flex items-center justify-center p-4 overflow-auto">
    <div class="bg-[#2e2e2e] w-full max-w-xl p-6 rounded-3xl shadow-[0_10px_30px_rgba(0,0,0,0.5)] transform scale-95 opacity-0 transition-all duration-300"
         id="modalContent">
        <h3 class="text-center text-2xl font-bold mb-6 text-nova-milk">Edit Note</h3>

        <form method="POST" id="editForm" class="space-y-4">
            @csrf
            @method('PUT')

            <textarea
                name="title"
                id="editTitle"
                rows="8"
                required
                placeholder="Tulis catatanmu di sini..."
                class="w-full px-4 py-4 rounded-2xl bg-[#3a3a3a] text-nova-milk placeholder:text-nova-gray focus:outline-none focus:ring-2 focus:ring-nova-milk resize-y transition shadow-inner"
            ></textarea>

            <div class="flex flex-col sm:flex-row gap-4 mt-4">
                <button type="submit"
                        class="flex-1 py-3 rounded-2xl bg-gradient-to-r from-yellow-400 to-yellow-300 text-nova-dark font-semibold hover:brightness-105 transition">
                    Update
                </button>
                <button type="button" onclick="closeModal()"
                        class="flex-1 py-3 rounded-2xl bg-gray-700 text-white hover:bg-gray-800 transition">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('editModal');
    const modalContent = document.getElementById('modalContent');

    window.openModal = function(id, title) {
        modal.classList.remove('hidden');
        setTimeout(() => {
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        }, 10);

        document.getElementById('editTitle').value = title;
        document.getElementById('editForm').action = '/notes/' + id;
    }

    window.closeModal = function() {
        modalContent.classList.add('scale-95', 'opacity-0');
        modalContent.classList.remove('scale-100', 'opacity-100');
        setTimeout(() => modal.classList.add('hidden'), 300);
    }

    // Close modal saat klik di luar content
    modal.addEventListener('click', (e) => {
        if (e.target === modal) closeModal();
    });
});

</script>


</body>
</html>
