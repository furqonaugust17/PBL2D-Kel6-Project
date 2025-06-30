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
            $('#table-harga').DataTable({
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
                        data: 'type',
                    },
                    {
                        data: 'tanggal_reservasi',
                        name: 'pendaftarans.tanggal_reservasi'
                    },
                    {
                        data: 'nama_customer',
                        name: 'customers.nama_lengkap'
                    },
                    {
                        data: 'notelp',
                        name: 'customers.notelp'
                    },
                    {
                        data: 'email',
                        name: 'users.email'
                    },
                    {
                        data: 'id',
                        "render": function(data, type, row) {
                            let rowData = JSON.stringify(row).replace(/"/g, '&quot;');

                            let uriDetail =
                                "{{ route('pendaftaran.show', ['pendaftaran' => ':id']) }}"
                                .replace(
                                    ':id', data);


                            return `<div class="d-flex">
                                        <a href="${uriDetail}" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-eye"></i></a>
                                        <button onclick="sendMessage(JSON.parse(this.dataset.row))" data-row="${rowData}"  class="btn btn-secondary shadow btn-xs sharp me-1"><i class="fas fa-paper-plane"></i></button>
                                    </div>`
                        }
                    }
                ],
                columnDefs: [{
                    targets: 0,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                }],
                createdRow: function(row, data, dataIndex) {
                    if (isInReminderRange(data.tanggal_reservasi, 0, 2)) {
                        $(row).addClass('table-danger');
                    }
                    if (isInReminderRange(data.tanggal_reservasi, 3, 5)) {
                        $(row).addClass('table-warning');
                    }
                }
            });

        });

        function sendMessage(data) {
            console.log(data);

            const nomor = data.notelp.replace('+', '');
            const pesan = `📣 Halo ${data.nama_customer},  
Ini pengingat bahwa Anda terdaftar untuk kegiatan di {{ config('app.name') }}:

📅 ${data.tanggal_reservasi}  
🕒 ${data.jadwal}  
🎨 Program: ${String(data.type).charAt(0).toUpperCase() + String(data.type).slice(1)}

Sampai jumpa di lokasi! Jika berhalangan, hubungi kami ya.`;
            const urlWhatsApp = `https://api.whatsapp.com/send?phone=${nomor}&text=${encodeURIComponent(pesan)}`;
            Swal.fire({
                title: "Anda Yakin?",
                text: "Notifikasi Akan Dikirimkan Ke Customer!!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Kirim",
                cancelButtonText: "Batal",
            }).then((result) => {
                if (result.value) {
                    window.open(urlWhatsApp, '_blank');
                } else {
                    Swal.fire({
                        title: "Error",
                        text: "Ada Kesalahan Pada Server",
                        type: "warning",
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Oke",
                    })
                }
            });
        }

        function isInReminderRange(reservasiTanggalStr, dariHari, sampaiHari) {
            const today = new Date();
            const reservasiDate = new Date(reservasiTanggalStr);

            if (isNaN(reservasiDate)) {
                console.error('Tanggal reservasi tidak valid:', reservasiTanggalStr);
                return false;
            }

            today.setHours(0, 0, 0, 0);
            reservasiDate.setHours(0, 0, 0, 0);

            const dayDiff = (reservasiDate - today) / (1000 * 60 * 60 * 24);
            return dayDiff >= dariHari && dayDiff <= sampaiHari;
        }
    </script>
@endsection

<x-app-layout>
    <x-slot:title>Pendaftaran</x-slot:title>
    <div class="row">
        <div class="col-12 m-t35">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table-harga" class="display nowrap" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Type</th>
                                    <th>Tanggal Reservasi</th>
                                    <th>Nama Customer</th>
                                    <th>No Telepon</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Type</th>
                                    <th>Tanggal Reservasi</th>
                                    <th>Nama Customer</th>
                                    <th>No Telepon</th>
                                    <th>Email</th>
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
