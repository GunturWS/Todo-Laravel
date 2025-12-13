<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Todo App</title>

    <style>
        :root {
            --nova-dark: #242424;
            --nova-gray: #665c54;
            --nova-milk: #e7d7ad;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: var(--nova-dark);
            display: flex;
            justify-content: center;
            padding-top: 80px;
            color: var(--nova-milk);
        }

        .container {
            background: #2e2e2e;
            width: 420px;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.4);
        }

        h1 {
            text-align: center;
            margin-bottom: 24px;
            color: var(--nova-milk);
            letter-spacing: 1px;
        }

        /* ADD FORM */
        form.add {
            display: flex;
            gap: 10px;
            margin-bottom: 24px;
        }

        input {
            flex: 1;
            padding: 10px 12px;
            border-radius: 8px;
            border: none;
            background: #3a3a3a;
            color: var(--nova-milk);
        }

        input::placeholder {
            color: #b8b0a0;
        }

        button {
            padding: 10px 14px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-weight: 600;
        }

        .btn-add {
            background: var(--nova-milk);
            color: var(--nova-dark);
        }

        .btn-add:hover {
            opacity: 0.9;
        }

        /* LIST */
        ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        li {
            background: #353535;
            padding: 12px 14px;
            border-radius: 8px;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .todo-title {
            max-width: 220px;
            word-wrap: break-word;
        }

        .actions {
            display: flex;
            gap: 6px;
        }

        .btn-edit {
            background: var(--nova-gray);
            color: white;
        }

        .btn-delete {
            background: #c0392b;
            color: white;
        }

        /* MODAL */
        .modal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.7);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background: #2e2e2e;
            padding: 24px;
            width: 320px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.6);
        }

        .modal-content h3 {
            margin-bottom: 16px;
            text-align: center;
            color: var(--nova-milk);
        }

        .modal-content input {
            width: 100%;
        }

        .modal-actions {
            display: flex;
            gap: 10px;
            margin-top: 16px;
        }

        .btn-update {
            background: var(--nova-milk);
            color: var(--nova-dark);
            flex: 1;
        }

        .btn-cancel {
            background: #555;
            color: white;
            flex: 1;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Todo App</h1>

    <form method="POST" action="/todos" class="add">
        @csrf
        <input type="text" name="title" placeholder="Tambah todo baru..." required>
        <button type="submit" class="btn-add">Tambah</button>
    </form>

    <ul>
        @foreach ($todos as $todo)
            <li>
                <span class="todo-title">{{ $todo->title }}</span>

                <div class="actions">
                    <button
                        class="btn-edit"
                        onclick="openModal({{ $todo->id }}, '{{ $todo->title }}')"
                    >
                        Edit
                    </button>

                    <form action="/todos/{{ $todo->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn-delete">Hapus</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
</div>

<!-- MODAL -->
<div class="modal" id="editModal">
    <div class="modal-content">
        <h3>Edit Todo</h3>

        <form method="POST" id="editForm">
            @csrf
            @method('PUT')

            <input type="text" name="title" id="editTitle" required>

            <div class="modal-actions">
                <button type="submit" class="btn-update">Update</button>
                <button type="button" class="btn-cancel" onclick="closeModal()">Batal</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal(id, title) {
        document.getElementById('editModal').style.display = 'flex';
        document.getElementById('editTitle').value = title;
        document.getElementById('editForm').action = '/todos/' + id;
    }

    function closeModal() {
        document.getElementById('editModal').style.display = 'none';
    }
</script>

</body>
</html>
