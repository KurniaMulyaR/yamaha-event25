<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Report') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table id="usersTable" class="w-full text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Created</th>
                            <th class="px-4 py-2 text-center">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!-- MODAL -->
    <div id="userModal" class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg w-full max-w-md p-6">
            <h2 class="text-lg font-bold mb-4" id="modalTitle"></h2>

            <form id="userForm">
                @csrf
                <input type="hidden" id="user_id">

                <div class="mb-4">
                    <label class="text-sm font-semibold">Name</label>
                    <input type="text" id="name" class="w-full border rounded px-3 py-2">
                </div>

                <div class="mb-4">
                    <label class="text-sm font-semibold">Email</label>
                    <input type="email" id="email" class="w-full border rounded px-3 py-2">
                </div>

                <div class="flex justify-end gap-2">
                    <button type="button" id="closeModal"
                        class="px-4 py-2 bg-gray-400 rounded text-white">Cancel</button>

                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 rounded text-white">Save</button>
                </div>
            </form>
        </div>
    </div>


    <script>
        $(document).ready(function () {
            $('#usersTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        className: 'bg-green-600 text-white px-3 py-2 rounded'
                    },
                ],
                processing: true,
                serverSide: true,
                ajax: '/admin/reportusers',
                columns: [
                    { data: 'id' },
                    { data: 'name' },
                    { data: 'email' },
                    { data: 'created_at' },
                    { data: 'action', orderable: false, searchable: false }
                ]
            });
        });

        $(document).on('click', '.editBtn', function () {
            let id = $(this).data('id');

            $.get(`/admin/user/${id}/edit`, function (data) {
                $('#user_id').val(data.id);
                $('#name').val(data.name);
                $('#email').val(data.email);

                $('#userModal').removeClass('hidden').addClass('flex');
            });
        });

        $('#userForm').submit(function (e) {
            e.preventDefault();

            let id = $('#user_id').val();

            $.ajax({
                url: `/admin/user/${id}`,
                type: 'PUT',
                data: {
                    _token: '{{ csrf_token() }}',
                    name: $('#name').val(),
                    email: $('#email').val()
                },
                success: function () {
                    $('#userModal').addClass('hidden');
                    $('#usersTable').DataTable().ajax.reload();

                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'User berhasil diupdate',
                        timer: 1500,
                        showConfirmButton: false
                    });
                }
            });
        });

        $('#closeModal').on('click', function () {
            $('#userModal').addClass('hidden').removeClass('flex');
        });

        function deleteUser(id) {
            Swal.fire({
                title: 'Yakin?',
                text: 'Data tidak bisa dikembalikan',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/admin/user/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    }).then(() => {
                        $('#usersTable').DataTable().ajax.reload();
                        Swal.fire('Deleted!', 'Data berhasil dihapus', 'success');
                    });
                }
            });
        }
    </script>
</x-app-layout>