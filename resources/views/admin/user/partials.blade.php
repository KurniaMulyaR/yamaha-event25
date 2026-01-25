<div class="flex gap-2">
     <button class="editBtn bg-blue-600 text-white px-3 py-1 rounded text-sm"
        data-id="{{ $dataUser->id }}">
        Edit
    </button>

    <button onclick="deleteUser({{ $dataUser->id }})"
        class="bg-red-600 text-white px-3 py-1 rounded text-sm">
        Delete
    </button>

    <a href="{{ route('admin.user.show', $dataUser->id) }}"
       class="px-3 py-1 text-sm bg-yellow-600 text-white rounded hover:bg-blue-700 transition">
        Show
    </a>
</div>