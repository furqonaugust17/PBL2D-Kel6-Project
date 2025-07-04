@section('css')
    <link href="{{ asset('plugins/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/vendor/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
@endsection


@section('script')
    <script src="{{ asset('plugins/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/js/plugins-init/datatables.init.js') }}"></script>
    <script src="{{ asset('plugins/vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table-tema').DataTable({
                language: {
                    paginate: {
                        next: '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
                        previous: '<i class="fa fa-angle-double-left" aria-hidden="true"></i>'
                    }
                },
                processing: true,
                serverSide: true,
                ajax: "{{ url()->current() }}",
                columns: [{
                        data: null,
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'kid.nama',
                        name: 'kid_id'
                    },
                    {
                        data: 'nama',
                    },
                    {
                        data: 'is_active',
                    },
                    {
                        data: 'bulan_nama',
                    },
                    {
                        orderable: false,
                        searchable: false,
                        data: 'detail_tema',
                        "render": function(data, type, row) {
                            return `<div>
                                <ul>
                                    ${data.map(item => `<li>Week ${item.week} ${item.nama}</li>`).join('')}
                                </ul>
                            </div>`;
                        }
                    },
                    @role('supervisor')
                        {
                            data: 'id',
                            searchable: false,
                            orderable: false,
                            "render": function(data, type, row) {
                                let uriEdit =
                                    "{{ route('kids-tema.edit', ['kidsTema' => ':id']) }}"
                                    .replace(
                                        ':id', data);


                                return `<div class="d-flex">
                                            <a href="${uriEdit}" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                            <button type="button" class="btn btn-danger shadow btn-xs sharp" onclick="deleteData(${data})"><i class="fa fa-trash"></i></button>
                                            </div>`
                            }
                        }
                    @endrole
                ],
                columnDefs: [{
                    targets: 0,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                }]
            });


        });


        function deleteData(id) {
            Swal.fire({
                title: "Anda Yakin?",
                text: "Data akan terhapus pada sistem!!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Hapus",
                cancelButtonText: "Batal",
            }).then((result) => {
                if (result.value) {
                    let uriDelete = "{{ route('kids-tema.destroy', ['kidsTema' => ':id']) }}".replace(':id',
                        id);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: uriDelete,
                        type: 'DELETE',
                        success: function(data) {
                            toastr.success(data.message, {
                                closeButton: false,
                                debug: false,
                                newestOnTop: false,
                                progressBar: true,
                                positionClass: "toast-top-right",
                                preventDuplicates: false,
                                onclick: null,
                                showDuration: 300,
                                hideDuration: 1000,
                                timeOut: 500,
                                extendedTimeOut: 1000,
                                showEasing: "swing",
                                hideEasing: "linear",
                                showMethod: "fadeIn",
                                hideMethod: "fadeOut"
                            })
                            $('#table-tema').DataTable().ajax.reload()
                        },
                        error: function(data) {
                            Swal.fire({
                                title: "Error",
                                text: "Ada Kesalahan Pada Server",
                                type: "warning",
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "Oke",
                            })
                        }
                    })
                }
            });
        }
    </script>
@endsection


<x-app-layout>
    <x-slot:title>Tema</x-slot:title>
    <div class="row">
        @role('supervisor')
            <div class="col-4">
                <a href="{{ route('kids-tema.create') }}" class="btn btn-sm btn-primary">Tambah Data Tema</a>
            </div>
        @endrole
        <div class="col-12 m-t35">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table-tema" class="display nowrap" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kelas</th>
                                    <th>Tema</th>
                                    <th>Aktif</th>
                                    <th>Bulan</th>
                                    <th>Kegiatan</th>
                                    @role('supervisor')
                                        <th>Action</th>
                                    @endrole
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Kelas</th>
                                    <th>Tema</th>
                                    <th>Aktif</th>
                                    <th>Bulan</th>
                                    <th>Kegiatan</th>
                                    @role('supervisor')
                                        <th>Action</th>
                                    @endrole
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
