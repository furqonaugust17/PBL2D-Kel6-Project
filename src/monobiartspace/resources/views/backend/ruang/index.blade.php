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
            $('#table-ruang').DataTable({
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
                    { data: 'nama' },
                    { data: 'kapasitas' },
                    {
                        data: 'id',
                        render: function (data, type, row) {
                            let uriEdit = "{{ route('ruang.edit', ['ruang' => ':id']) }}".replace(':id', data);

                            return `<div class="d-flex">
                                        <a href="${uriEdit}" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                        <button type="button" class="btn btn-danger shadow btn-xs sharp" onclick="deleteData(${data})"><i class="fa fa-trash"></i></button>
                                    </div>`;
                        }
                    }
                ]
            });
        });

        function deleteData(id) {
            Swal.fire({
                title: "Anda Yakin?",
                text: "Data akan terhapus dari sistem!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Hapus",
                cancelButtonText: "Batal",
            }).then((result) => {
                if (result.value) {
                    let uriDelete = "{{ route('ruang.destroy', ['ruang' => ':id']) }}".replace(':id', id);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: uriDelete,
                        type: 'DELETE',
                        success: function (data) {
                            $('#table-ruang').DataTable().ajax.reload();
                        }
                    });
                }
            });
        }
    </script>
@endsection

<x-app-layout>
    <x-slot:title>Data Ruang</x-slot:title>
    <div class="row">
        <div class="col-4">
            <a href="{{ route('ruang.create') }}" class="btn btn-sm btn-primary">Tambah Ruang</a>
        </div>
        <div class="col-12 m-t35">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table-ruang" class="display nowrap" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Nama Ruang</th>
                                    <th>Kapasitas</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Nama Ruang</th>
                                    <th>Kapasitas</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                {{-- diisi otomatis oleh DataTables --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
