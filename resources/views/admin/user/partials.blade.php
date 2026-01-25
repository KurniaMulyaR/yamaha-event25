<div class="flex gap-2">
     <button class="editBtn bg-blue-600 text-white px-3 py-1 rounded text-sm"
        data-id="{{ $dataUser->id }}">
        Edit
    </button>

    <button onclick="deleteUser({{ $dataUser->id }})"
        class="bg-red-600 text-white px-3 py-1 rounded text-sm">
        Delete
    </button>
</div>