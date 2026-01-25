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
                            <th>Order ID</th>
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
    <div id="pengirimanModal" class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg w-full max-w-md p-6">
            <h2 class="text-lg font-bold mb-4" id="modalTitle"></h2>

            <form id="kirimForm">
                @csrf
                <input type="hidden" id="pengiriman_id">

                <div class="mb-4">
                    <label class="text-sm font-semibold">Status</label>
                    <select id="status" name="status" required autocomplete="status-name" class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        <option class="px-2 py-1 text-xs font-semibold text-black bg-yellow-200">PENDING</option>
                        <option class="px-2 py-1 text-xs font-semibold text-black bg-green-200">LUNAS</option>
                        <option class="px-2 py-1 text-xs font-semibold text-black bg-blue-400">PENGIRIMAN</option>
                        <option class="px-2 py-1 text-xs font-semibold text-black bg-green-400">TERKIRIM</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="text-sm font-semibold">Keterangan</label>
                    <textarea id="keterangan" name="keterangan" rows="3" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"></textarea>
                          
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
            $('#delearTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '/admin/reportpesanan',
                columns: [
                    { data: 'id' },
                    { data: 'name' },
                    { data: 'orderid' },
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

        $(document).on('click', '.editBtn', function () {
            let id = $(this).data('id');

            $.get(`/admin/pengiriman/${id}/edit`, function (data) {
                $('#pengiriman_id').val(data.id);
                $('#status').val(data.status);
                $('#keterangan').val(data.keterangan);

                $('#pengirimanModal').removeClass('hidden').addClass('flex');
            });
        });

        $('#kirimForm').submit(function (e) {
            e.preventDefault();

            let id = $('#pengiriman_id').val();

            // 1️⃣ Tutup popup langsung
            $('#pengirimanModal').addClass('hidden');

            // 2️⃣ Loading / proses kirim
            Swal.fire({
                title: 'Mengirim data...',
                text: 'Mohon tunggu',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // 3️⃣ AJAX kirim data
            $.ajax({
                url: `/admin/pengiriman/${id}`,
                type: 'PUT',
                data: {
                    _token: '{{ csrf_token() }}',
                    status: $('#status').val(),
                    keterangan: $('#keterangan').val()
                },
                success: function () {
                    // 4️⃣ Tutup loading → sukses
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Dealer berhasil diupdate',
                        timer: 1500,
                        showConfirmButton: false
                    });

                    $('#delearTable').DataTable().ajax.reload();
                },
                error: function (xhr) {
                    // 5️⃣ Jika error → tampilkan pesan
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: xhr.responseJSON?.message || 'Terjadi kesalahan'
                    });
                }
            });
        });


        $('#closeModal').on('click', function () {
            $('#pengirimanModal').addClass('hidden').removeClass('flex');
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

    </script>
</x-app-layout>