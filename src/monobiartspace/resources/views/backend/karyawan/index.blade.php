@section('css')
    <link href="{{ asset('plugins/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
@endsection

@section('script')
    <script src="{{ asset('plugins/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/js/plugins-init/datatables.init.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table-karyawan').DataTable({
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
                        data: 'jk',
                        "render": function(data, type, row) {
                            return (row.jk == 'l') ? 'Laki-Laki' : 'Perempuan'
                        }
                    },
                    {
                        data: 'user.email',
                    },
                    {
                        data: 'notelp',
                    },
                    {
                        data: 'alamat',
                    },
                    {
                        "render": function(data, type, row) {
                            return `<div class="d-flex">
										<a href="javascript:void(0);" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
										<a href="javascript:void(0);" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
									</div>`
                        }
                    }
                ]
            });
        });
    </script>
@endsection

<x-app-layout>
    <x-slot:title>Karyawan</x-slot:title>
    <div class="row">
        <div class="col-4">
            <a href="{{ route('karyawan.create') }}" class="btn btn-sm btn-primary">Tambah Data Karyawan</a>
        </div>
        <div class="col-12 m-t35">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table-karyawan" class="display nowrap" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Email</th>
                                    <th>No Telepon</th>
                                    <th>Alamat</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Email</th>
                                    <th>No Telepon</th>
                                    <th>Alamat</th>
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
