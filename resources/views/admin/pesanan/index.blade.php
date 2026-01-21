<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List Pesanan') }}
        </h2>
    </x-slot>

    <Div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table id="delearTable" class="w-full text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Produk</th>
                            <th>Name Delear</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                            <th>Created</th>
                            <th class="px-4 py-2 text-center">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!-- MODAL EDIT -->
    <div id="delearModal" class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg w-full max-w-md p-6">
            <h2 class="text-lg font-bold mb-4" id="modalTitle"></h2>

            <form id="delearForm">
                @csrf
                <input type="hidden" id="delear_id">

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

    <!-- MODL IMPORT -->
     <div id="importModal"
        class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

        <div class="bg-white w-full max-w-md rounded-xl p-6">
            <h2 class="text-lg font-bold mb-4">Import Dealer</h2>

            <input type="file" id="importFile"
                class="w-full border p-2 rounded mb-4">

            <div class="flex justify-end gap-2">
                <button id="closeImportModal"
                    class="px-4 py-2 bg-gray-300 rounded">
                    Cancel
                </button>

                <button id="submitImport"
                    class="px-4 py-2 bg-blue-600 text-white rounded">
                    Import
                </button>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function () {
            $('#delearTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '/admin/reportpesanan',
                columns: [
                    { data: 'id' },
                    { data: 'name' },
                    { data: 'produk' },
                    { data: 'delear' },
                    { data: 'status' },
                    { data: 'keterangan' },
                    { data: 'created_at' },
                    { data: 'action', orderable: false, searchable: false }
                ]
            });

            $('#createDelearBtn').on('click', function () {
                $('#createDelearModal').removeClass('hidden').addClass('flex');
            });

            $('#closeCreateModal').on('click', function () {
                $('#createDelearModal').addClass('hidden').removeClass('flex');
            });
        });

        $('#createDelearForm').submit(function (e) {
            e.preventDefault();

            let formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('code', $('#create_code').val());
            formData.append('district_code', $('#create_district_code').val());
            formData.append('namedds', $('#create_namedds').val());
            formData.append('provinsi', $('#create_provinsi').val());
            formData.append('kota', $('#create_kota').val());
            formData.append('kecamatan', $('#create_kecamatan').val());
            formData.append('namedelear', $('#create_namedelear').val());

            $.ajax({
                url: '/admin/delear',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function () {
                    $('#createDelearModal').addClass('hidden');
                    $('#createDelearForm')[0].reset();
                    $('#photoPreview').addClass('hidden');

                    $('#delearTable').DataTable().ajax.reload();

                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Delear berhasil ditambahkan',
                        timer: 1500,
                        showConfirmButton: false
                    });
                }
            });
        });

        $(document).on('click', '.editBtn', function () {
            let id = $(this).data('id');

            $.get(`/admin/delear/${id}/edit`, function (data) {
                $('#delear_id').val(data.id);
                $('#name').val(data.name);
                $('#email').val(data.email);

                $('#delearModal').removeClass('hidden').addClass('flex');
            });
        });

        $('#delearForm').submit(function (e) {
            e.preventDefault();

            let id = $('#user_id').val();

            $.ajax({
                url: `/admin/delear/${id}`,
                type: 'PUT',
                data: {
                    _token: '{{ csrf_token() }}',
                    name: $('#name').val(),
                    email: $('#email').val()
                },
                success: function () {
                    $('#delearModal').addClass('hidden');
                    $('#delearTable').DataTable().ajax.reload();

                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Delear berhasil diupdate',
                        timer: 1500,
                        showConfirmButton: false
                    });
                }
            });
        });

        $('#closeModal').on('click', function () {
            $('#delearModal').addClass('hidden').removeClass('flex');
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
                    fetch(`/admin/delear/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    }).then(() => {
                        $('#delearTable').DataTable().ajax.reload();
                        Swal.fire('Deleted!', 'Data berhasil dihapus', 'success');
                    });
                }
            });
        }

        // OPEN MODAL
        $('#openImportModal').on('click', function () {
            $('#importModal').removeClass('hidden').addClass('flex');
        });

        // CLOSE MODAL
        $('#closeImportModal').on('click', function () {
            $('#importModal').addClass('hidden').removeClass('flex');
        });

        // SUBMIT IMPORT
        $('#submitImport').on('click', function () {
            let file = $('#importFile')[0].files[0];

            if (!file) {
                alert('Pilih file dulu!');
                return;
            }

            let formData = new FormData();
            formData.append('file', file);

            $('#progressWrapper').removeClass('hidden');

            $.ajax({
                url: '/admin/dealer/import',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (res) {
                    pollProgress(res.batch_id);
                },
                error: function () {
                    alert('Import gagal');
                }
            });
        });

    </script>
</x-app-layout>