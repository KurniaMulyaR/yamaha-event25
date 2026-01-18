<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List Delear') }}
        </h2>
    </x-slot>

    <Div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <button id="createDelearBtn"
                    class="mb-4 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded font-semibold">
                    + Create Delear
                </button>
                <button id="openImportModal"
                    class="bg-blue-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
                    + Import Dealer
                </button>
                <table id="delearTable" class="w-full text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th>ID</th>
                            <th>Code</th>
                            <th>District Code</th>
                            <th>Name DDS</th>
                            <th>Provinsi</th>
                            <th>Kota</th>
                            <th>Kecamatan</th>
                            <th>Name Delear</th>
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

    <div id="createDelearModal"
        class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50">

        <div class="bg-white rounded-lg w-full max-w-md p-6">
            <h2 class="text-lg font-bold mb-4">Create Delear</h2>

            <form id="createDelearForm">
                <div class="mb-4">
                    <label class="text-sm font-semibold">Code</label>
                    <input type="text" id="create_code"
                        class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="text-sm font-semibold">District Code</label>
                    <input type="text" id="create_district_code"
                        class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="text-sm font-semibold">Name DDS</label>
                    <input type="text" id="create_namedds"
                        class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="text-sm font-semibold">Provinsi</label>
                    <input type="text" id="create_provinsi"
                        class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="text-sm font-semibold">Kota</label>
                    <input type="text" id="create_kota"
                        class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="text-sm font-semibold">Kecamatan</label>
                    <input type="text" id="create_kecamatan"
                        class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="text-sm font-semibold">Name Delear</label>
                    <input type="text" id="create_namedelear"
                        class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="flex justify-end gap-2">
                    <button type="button" id="closeCreateModal"
                        class="px-4 py-2 bg-gray-400 rounded text-white">
                        Cancel
                    </button>

                    <button type="submit"
                        class="px-4 py-2 bg-green-600 rounded text-white">
                        Create
                    </button>
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

            <!-- Progress -->
            <div id="progressWrapper" class="hidden mb-4">
                <div class="w-full bg-gray-200 rounded-full h-4">
                    <div id="progressBar"
                        class="bg-blue-600 h-4 rounded-full text-xs text-white text-center"
                        style="width:0%">
                        0%
                    </div>
                </div>
                <p id="progressText" class="text-sm mt-2"></p>
            </div>

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
                ajax: '/admin/reportdelear',
                columns: [
                    { data: 'id' },
                    { data: 'code' },
                    { data: 'district_code' },
                    { data: 'namedds' },
                    { data: 'provinsi' },
                    { data: 'kota' },
                    { data: 'kecamatan' },
                    { data: 'namedelear' },
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

        // PROGRESS POLLING
        function pollProgress(batchId) {
            let interval = setInterval(() => {
                $.get(`/admin/dealer/import/progress/${batchId}`, function (res) {
                    $('#progressBar')
                        .css('width', res.progress + '%')
                        .text(res.progress + '%');

                    $('#progressText').text(res.message);

                    if (res.progress >= 100) {
                        clearInterval(interval);
                        setTimeout(() => {
                            $('#importModal').addClass('hidden');
                            $('#dealerTable').DataTable().ajax.reload();
                        }, 1000);
                    }
                });
            }, 1000);
        }

    </script>
</x-app-layout>