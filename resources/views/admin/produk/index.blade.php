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
                            <th>Varian</th>
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
        <div class="bg-white rounded-lg w-full max-w-md p-6 overflow-auto max-h-[35rem]">
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

                <hr class="my-4">

                <div class="mb-2 flex justify-between items-center">
                    <label class="text-sm font-semibold">Varian</label>
                    <button type="button"
                        id="addEditVarian"
                        class="px-3 py-1 bg-blue-600 text-white rounded text-sm">
                        + Tambah Varian
                    </button>
                </div>

                <div id="editVarianWrapper" class="space-y-3"></div>

                <button class="bg-blue-600 text-white px-4 py-2 rounded">
                    Update
                </button>
            </form>
        </div>
    </div>

    <template id="editVarianTemplate">
        <div class="border rounded p-3 bg-gray-50 relative varian-item">
            <button type="button"
                class="removeVarian absolute top-2 right-2 text-red-600 font-bold">
                ×
            </button>

            <!-- ID VARIAN (hidden, penting untuk update) -->
            <input type="hidden" data-name="id">

            <div class="mb-2">
                <label class="text-xs font-semibold">Nama Varian</label>
                <input type="text"
                    class="w-full border rounded px-2 py-1"
                    data-name="name"
                    required>
            </div>

            <div class="mb-2">
                <label class="text-xs font-semibold">Jumlah Unit</label>
                <input type="number"
                    class="w-full border rounded px-2 py-1"
                    data-name="jmlunit"
                    required>
            </div>

            <div class="mb-2">
                <label class="text-xs font-semibold">Colour</label>
                <input type="text"
                    class="w-full border rounded px-2 py-1"
                    data-name="colour"
                    required>
            </div>

            <div class="mb-2">
                <label class="text-xs font-semibold">Price</label>
                <input type="text"
                    class="w-full border rounded px-2 py-1"
                    data-name="price"
                    required>
            </div>

            <div class="mb-2">
                <label class="text-xs font-semibold">DP</label>
                <input type="number"
                    class="w-full border rounded px-2 py-1"
                    data-name="dp"
                    required>
            </div>

            <div class="mb-2">
                <label class="text-sm font-semibold">Img</label>

                    <input type="file"
                        accept="image/*"
                        data-name="img"
                        class="img-input w-full border rounded px-3 py-2 bg-white">

                    <!-- Preview -->
                    <img
                        class="photo-preview mt-3 w-24 h-24 rounded object-cover hidden border">
            </div>
        </div>
    </template>


<div id="createProdukModal"
    class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50">

    <div class="bg-white rounded-lg w-full max-w-md p-6 max-h-[35rem] overflow-y-auto">
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
<!-- 
            <div class="mb-4">
                <label class="text-sm font-semibold">Price</label>
                <input type="number" id="create_price" name="price"
                    class="w-full border rounded px-3 py-2" required>
            </div> -->

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

            <hr class="my-4">

            <div class="mb-2 flex justify-between items-center">
                <label class="text-sm font-semibold">Varian</label>
                <button type="button"
                    id="addVarian"
                    class="px-3 py-1 bg-blue-600 text-white rounded text-sm">
                    + Tambah Varian
                </button>
            </div>

            <div id="varianWrapper" class="space-y-3"></div>

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

<template id="varianTemplate">
    <div class="border rounded p-3 relative bg-gray-50">
        <button type="button"
            class="removeVarian absolute top-2 right-2 text-red-600 font-bold">
            ×
        </button>

        <div class="mb-2">
            <label class="text-xs font-semibold">Nama Varian</label>
            <input type="text"
                class="w-full border rounded px-2 py-1"
                data-name="name"
                required>
        </div>

        <div class="mb-2">
            <label class="text-xs font-semibold">Jumlah Unit</label>
            <input type="number"
                class="w-full border rounded px-2 py-1"
                data-name="jmlunit"
                required>
        </div>

        <div class="mb-2">
            <label class="text-xs font-semibold">Price</label>
            <input type="number"
                class="w-full border rounded px-2 py-1"
                data-name="price"
                required>
        </div>

        <div class="mb-2">
            <label class="text-xs font-semibold">Colour</label>
            <input type="text"
                class="w-full border rounded px-2 py-1"
                data-name="colour"
                required>
        </div>

        <div class="mb-2">
            <label class="text-xs font-semibold">DP</label>
            <input type="number"
                class="w-full border rounded px-2 py-1"
                data-name="dp"
                required>
        </div>

        <div class="mb-2">
            <label class="text-sm font-semibold">Img</label>

                <input type="file"
                    id="create_imgv"
                    name="imge"
                    accept="image/*"
                    class="w-full border rounded px-3 py-2 bg-white">

                <!-- Preview -->
                <img id="photoPreviewe"
                    class="mt-3 w-24 h-24 rounded-full object-cover hidden border">
        </div>
    </div>
</template>


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
                    { data: 'varian'},
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

            let varianIndex = 0;

            // ADD VARIAN
            $('#addVarian').on('click', function () {

                let $template = $($('#varianTemplate').html());

                $template.find('[data-name]').each(function () {
                    let field = $(this).data('name');
                    $(this).attr('name', `varian[${varianIndex}][${field}]`);
                });

                $('#varianWrapper').append($template);
                varianIndex++;
            });

            // REMOVE VARIAN (delegation)
            $(document).on('click', '.removeVarian', function () {
                $(this).closest('.varian-item').remove();
            });

            // OPTIONAL: auto add 1 varian saat form dibuka
            $('#addVarian').trigger('click');
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

        $('#create_imgv').on('change', function () {
            const file = this.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = e => {
                    $('#photoPreviewe')
                        .attr('src', e.target.result)
                        .removeClass('hidden');
                };
                reader.readAsDataURL(file);
            }
        });

        $('#createProdukForm').submit(function (e) {
            e.preventDefault();

            let formData = new FormData(this); 
            // 👆 OTOMATIS ambil semua input termasuk:
            // name, type, price, ttlunit, colour, img, varian[0][...], varian[1][...]

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
                    $('#varianWrapper').empty(); // reset varian

                    $('#produkTable').DataTable().ajax.reload();

                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Produk berhasil ditambahkan',
                        timer: 1500,
                        showConfirmButton: false
                    });
                },
                error: function (xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: xhr.responseJSON?.message ?? 'Terjadi kesalahan'
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

        let editVarianIndex = 0;    
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
                
                if(data.varians){
                    data.varians.forEach(function (v) {
                        addEditVarian(v);
                    });
                }

                $('#img').val('');

                $('#produkModal').removeClass('hidden').addClass('flex');
            });
        });

        function addEditVarian(data = null) {
            let $tpl = $($('#editVarianTemplate').html());
            let index = editVarianIndex;

            // set name untuk semua field
            $tpl.find('[data-name]').each(function () {
                let field = $(this).data('name');

                $(this).attr('name', `varian[${index}][${field}]`);

                // ⚠️ FILE INPUT TIDAK BOLEH .val()
                if (data && data[field] && $(this).attr('type') !== 'file') {
                    $(this).val(data[field]);
                }
            });

            // 🔥 JIKA EDIT & ADA IMAGE LAMA
            if (data && data.img) {
                let $preview = $tpl.find('.photo-preview');
                $preview
                    .attr('src', data.img)
                    .removeClass('hidden');

                // simpan img lama (buat backend)
                $('<input>')
                    .attr({
                        type: 'hidden',
                        name: `varian[${index}][old_img]`,
                        value: data.img.replace('/storage/', '')
                    })
                    .appendTo($tpl);
            }

            // 🔥 PREVIEW IMAGE BARU SAAT DIPILIH
            $tpl.find('.img-input').on('change', function () {
                let file = this.files[0];
                let $preview = $(this).siblings('.photo-preview');

                if (file) {
                    let reader = new FileReader();
                    reader.onload = e => {
                        $preview
                            .attr('src', e.target.result)
                            .removeClass('hidden');
                    };
                    reader.readAsDataURL(file);
                }
            });

            $('#editVarianWrapper').append($tpl);
            editVarianIndex++;
        }


        // ADD NEW EMPTY VARIAN
        $('#addEditVarian').on('click', function () {
            addEditVarian();
        });

        // REMOVE VARIAN
        $(document).on('click', '.removeVarian', function () {
            $(this).closest('.varian-item').remove();
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