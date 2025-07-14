@section('css')
    <link href="{{ asset('plugins/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/vendor/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
@endsection

@section('script')
    <script src="{{ asset('plugins/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/js/plugins-init/datatables.init.js') }}"></script>
    <script src="{{ asset('plugins/vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#table-inventaris').DataTable({
                language: {
                    paginate: {
                        next: '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
                        previous: '<i class="fa fa-angle-double-left" aria-hidden="true"></i>'
                    }
                },
                processing: true,
                serverSide: true,
                ajax: "{{ url()->current() }}",
                columns: [
                    { data: 'nama_barang' },
                    { data: 'kategori' },
                    { data: 'jumlah_stok_awal' },
                    { data: 'keterangan' },
                    {
                        data: 'id',
                        render: function (data) {
                            let uriEdit = "{{ route('inventaris.edit', ['inventaris' => ':id']) }}".replace(':id', data);
                            return `
                                <div class="d-flex">
                                    <a href="${uriEdit}" class="btn btn-primary shadow btn-xs sharp me-1">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger shadow btn-xs sharp" onclick="deleteData(${data})">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            `;
                        }
                    }
                ]
            });
        });

        function deleteData(id) {
            Swal.fire({
                title: "Anda Yakin?",
                text: "Data akan dihapus dari sistem!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Hapus",
                cancelButtonText: "Batal",
            }).then((result) => {
                if (result.value) {
                    let uriDelete = "{{ route('inventaris.destroy', ':id') }}".replace(':id', id);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: uriDelete,
                        type: 'DELETE',
                        success: function (data) {
                            toastr.success(data.message);
                            $('#table-inventaris').DataTable().ajax.reload();
                        }
                    });
                }
            });
        }
    </script>
@endsection

<x-app-layout>
    <x-slot:title>Inventaris</x-slot:title>

    <div class="row">
        <div class="col-4">
            <a href="{{ route('inventaris.create') }}" class="btn btn-sm btn-primary">Tambah Inventaris</a>
        </div>
        <div class="col-12 m-t35">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table-inventaris" class="display nowrap" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>Kategori</th>
                                    <th>Stok Awal</th>
                                    <th>Keterangan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>Kategori</th>
                                    <th>Stok Awal</th>
                                    <th>Keterangan</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
