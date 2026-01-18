<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List Produk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <button id="createProdukBtn"
                    class="mb-4 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded font-semibold">
                    + Create Produk
                </button>
                <table id="produkTable" class="w-full text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Price</th>
                            <th>Unit</th>
                            <th>Colour</th>
                            <th>img</th>
                            <th>Created</th>
                            <th class="px-4 py-2 text-center">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!-- MODAL EDIT -->
    <div id="produkModal" class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg w-full max-w-md p-6">
            <h2 class="text-lg font-bold mb-4" id="modalTitle"></h2>

            <form id="produkForm" enctype="multipart/form-data">
                <input type="hidden" id="produk_id">

                <div class="mb-4">
                    <label class="text-sm font-semibold">Name</label>
                    <input type="text" id="name" name="name" class="w-full border rounded px-3 py-2">
                </div>

                <div class="mb-4">
                    <label class="text-sm font-semibold">Type</label>
                    <input type="text" id="type" name="type"
                        class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="text-sm font-semibold">Price</label>
                    <input type="number" id="price" name="price"
                        class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="text-sm font-semibold">Unit</label>
                    <input type="text" id="unit" name="ttlunit"
                        class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="text-sm font-semibold">Colour</label>
                    <input type="text" id="colour" name="colour"
                        class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="mb-3">
                    <label class="text-sm font-semibold">Foto Saat Ini</label>
                    <img id="oldImage"
                        class="w-32 h-32 rounded object-cover border hidden">
                </div>

                <!-- Upload foto baru -->
                <div class="mb-3">
                    <label class="text-sm font-semibold">Ganti Foto</label>
                    <input type="file"
                        name="img"
                        id="img"
                        accept="produk/*"
                        class="block w-full text-sm">
                </div>

                <!-- Preview foto baru -->
                <div id="previewWrapper" class="hidden mb-3">
                    <label class="text-sm font-semibold">Preview Baru</label>
                    <img id="previewImage"
                        class="w-32 h-32 rounded object-cover border">
                </div>

                <button class="bg-blue-600 text-white px-4 py-2 rounded">
                    Update
                </button>
            </form>
        </div>
    </div>

<div id="createProdukModal"
    class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50">

    <div class="bg-white rounded-lg w-full max-w-md p-6">
        <h2 class="text-lg font-bold mb-4">Create User</h2>

        <form id="createProdukForm">
            <div class="mb-4">
                <label class="text-sm font-semibold">Name</label>
                <input type="text" id="create_name" name="name"
                    class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label class="text-sm font-semibold">Type</label>
                <input type="text" id="create_type" name="type"
                    class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label class="text-sm font-semibold">Price</label>
                <input type="number" id="create_price" name="price"
                    class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label class="text-sm font-semibold">Unit</label>
                <input type="text" id="create_unit" name="ttlunit"
                    class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label class="text-sm font-semibold">Colour</label>
                <input type="text" id="create_colour" name="colour"
                    class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label class="text-sm font-semibold">Img</label>

                <input type="file"
                    id="create_img"
                    name="img"
                    accept="image/*"
                    class="w-full border rounded px-3 py-2 bg-white" required>

                <!-- Preview -->
                <img id="photoPreview"
                    class="mt-3 w-24 h-24 rounded-full object-cover hidden border">
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


    <script>
        $(document).ready(function () {
            $('#produkTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '/admin/reportproduk',
                columns: [
                    { data: 'id' },
                    { data: 'name' },
                    { data: 'type' },
                    { data: 'price' },
                    { data: 'ttlunit' },
                    { data: 'colour' },
                    { data: 'img' },
                    { data: 'created_at' },
                    { data: 'action', orderable: false, searchable: false }
                ]
            });

            $('#createProdukBtn').on('click', function () {
                $('#createProdukModal').removeClass('hidden').addClass('flex');
            });

            $('#closeCreateModal').on('click', function () {
                $('#createProdukModal').addClass('hidden').removeClass('flex');
            });
        });

        $('#create_img').on('change', function () {
            const file = this.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = e => {
                    $('#photoPreview')
                        .attr('src', e.target.result)
                        .removeClass('hidden');
                };
                reader.readAsDataURL(file);
            }
        });

        $('#createProdukForm').submit(function (e) {
            e.preventDefault();

            let formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('name', $('#create_name').val());;
            formData.append('type', $('#create_type').val());;
            formData.append('price', $('#create_price').val());;
            formData.append('ttlunit', $('#create_unit').val());;
            formData.append('colour', $('#create_colour').val());;

            let photo = $('#create_img')[0].files[0];
            if (photo) {
                formData.append('img', photo);
            }

            $.ajax({
                url: '/admin/produk',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function () {
                    $('#createProdukModal').addClass('hidden');
                    $('#createProdukForm')[0].reset();
                    $('#photoPreview').addClass('hidden');

                    $('#produkTable').DataTable().ajax.reload();

                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Produk berhasil ditambahkan',
                        timer: 1500,
                        showConfirmButton: false
                    });
                }
            });
        });

        $('#imgInput').on('change', function () {
            let file = this.files[0];
            if (!file) return;

            let reader = new FileReader();
            reader.onload = e => {
                $('#previewImage').attr('src', e.target.result);
                $('#previewWrapper').removeClass('hidden');
            };
            reader.readAsDataURL(file);
        });

        $(document).on('click', '.editBtn', function () {
            let id = $(this).data('id');

            $.get(`/admin/produk/${id}/edit`, function (data) {
                $('#produk_id').val(data.id);
                $('#name').val(data.name);
                $('#type').val(data.type);
                $('#price').val(data.price);
                $('#unit').val(data.ttlunit);
                $('#colour').val(data.colour);
                // TAMPILKAN FOTO LAMA
                if (data.img) {
                    $('#oldImage')
                        .attr('src', `/storage/${data.img}`)
                        .removeClass('hidden');
                } else {
                    $('#oldImage').addClass('hidden');
                }

                $('#img').val('');

                $('#produkModal').removeClass('hidden').addClass('flex');
            });
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#produkForm').submit(function (e) {
            e.preventDefault();

            let id = $('#produk_id').val();
            let formData = new FormData(this);
            formData.append('_method', 'PUT');
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('name', $('#name').val());;
            formData.append('type', $('#type').val());;
            formData.append('price', $('#price').val());;
            formData.append('ttlunit', $('#unit').val());;
            formData.append('colour', $('#colour').val());;

            let photo = $('#img')[0].files[0];
            if (photo) {
                formData.append('img', photo);
            }

            $.ajax({
                url: `/admin/produk/${id}`,
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function () {
                    $('#produkModal').addClass('hidden');
                    $('#produkTable').DataTable().ajax.reload();

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
            $('#produkModal').addClass('hidden').removeClass('flex');
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
                    fetch(`/admin/produk/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    }).then(() => {
                        $('#produkTable').DataTable().ajax.reload();
                        Swal.fire('Deleted!', 'Data berhasil dihapus', 'success');
                    });
                }
            });
        }
    </script>
</x-app-layout>