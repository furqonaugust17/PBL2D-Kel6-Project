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
            $('#table-diskon').DataTable({
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
                        data: 'nama',
                    },
                    {
                        data: 'diskon',
                    },
                    {
                        data: 'code',
                    },
                    {
                        data: 'expired_date',
                    },
                    {
                        data: 'id',
                        "render": function(data, type, row) {
                            let uriEdit = "{{ route('diskon.edit', ['diskon' => ':id']) }}"
                                .replace(
                                    ':id', data);


                            return `<div class="d-flex">
                                        <a href="${uriEdit}" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                        <button type="button" class="btn btn-danger shadow btn-xs sharp" onclick="deleteData(${data})"><i class="fa fa-trash"></i></button>
                                    </div>`
                        }
                    }
                ]
            });


        });


        function deleteData(id) {
            // let token = $("meta[name='csrf-token']").attr("content");
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
                    let uriDelete = "{{ route('diskon.destroy', ['diskon' => ':id']) }}".replace(':id', id);
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
                            $('#table-karyawan').DataTable().ajax.reload()
                        }
                    })
                }
            });
        }
    </script>
@endsection


<x-app-layout>
    <x-slot:title>diskon</x-slot:title>
    <div class="row">
        <div class="col-4">
            <a href="{{ route('diskon.create') }}" class="btn btn-sm btn-primary">Tambah Data diskon</a>
        </div>
        <div class="col-12 m-t35">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table-diskon" class="display nowrap" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>diskon</th>
                                    <th>code</th>
                                    <th>expired_date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nama</th>
                                    <th>diskon</th>
                                    <th>code</th>
                                    <th>expired_date</th>
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
