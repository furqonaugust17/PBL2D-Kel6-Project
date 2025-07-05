@section('css')
    <link href="{{ asset('plugins/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css">
    <link href="{{ asset('plugins/vendor/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
@endsection
@section('script')
    <script src="{{ asset('plugins/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('plugins/js/plugins-init/datatables.init.js') }}"></script>
    <script src="{{ asset('plugins/vendor/peity/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('plugins/vendor/apexchart/apexchart.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js">
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table-pendaftaran').DataTable({
                searching: false,
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
                            let uriDetail =
                                "{{ route('pendaftaran.show', ['pendaftaran' => ':id']) }}"
                                .replace(
                                    ':id', data);

                            return `<div class="d-flex">
                                        <a href="${uriDetail}" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-eye"></i></a>
                                        <button onclick="sendMessage('${data}')" class="btn btn-secondary shadow btn-xs sharp me-1"><i class="fas fa-paper-plane"></i></button>
                                    </div>`
                        }
                    }
                ],
                columnDefs: [{
                    targets: 0,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                }]
            });

            const seriesData = @json($chart);
            const bulanLabels = [
                "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                "Juli", "Agustus", "September", "Oktober", "November", "Desember"
            ];

            let chart;

            function marketChart() {
                var options = {
                    series: seriesData,
                    chart: {
                        height: 300,
                        type: 'area',
                        toolbar: {
                            show: true
                        }
                    },
                    colors: ["#00ADA3", "#FFAB2D"],
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        curve: 'smooth',
                        width: 3
                    },
                    legend: {
                        position: 'top',
                        labels: {
                            colors: '#000'
                        }
                    },
                    grid: {
                        show: true,
                        strokeDashArray: 6,
                        borderColor: '#dadada',
                    },
                    yaxis: {
                        labels: {
                            style: {
                                colors: '#B5B5C3',
                                fontSize: '12px',
                                fontFamily: 'Poppins'
                            },
                            formatter: function(val) {
                                return Math.round(val);
                            }
                        }
                    },
                    xaxis: {
                        categories: bulanLabels,
                        tickPlacement: 'on',
                        labels: {
                            style: {
                                colors: '#B5B5C3',
                                fontSize: '12px',
                                fontFamily: 'Poppins'
                            }
                        }
                    },
                    fill: {
                        type: 'solid',
                        opacity: 0.2
                    },
                    tooltip: {
                        shared: true,
                        intersect: false
                    },
                    responsive: [{
                        breakpoint: 992,
                        options: {
                            chart: {
                                height: 300,
                                toolbar: {
                                    show: true,
                                    tools: {
                                        download: true,
                                        zoom: false,
                                        zoomin: false,
                                        zoomout: false,
                                        pan: false,
                                        reset: false,
                                    }
                                }
                            },
                            legend: {
                                position: "bottom"
                            },
                            xaxis: {
                                labels: {
                                    style: {
                                        fontSize: '10px'
                                    }
                                }
                            },
                            yaxis: {
                                labels: {
                                    style: {
                                        fontSize: '10px'
                                    }
                                }
                            }
                        }
                    }]
                };

                chart = new ApexCharts(document.querySelector("#marketChart"), options);
                chart.render();
            }

            marketChart();

            $('#year-picker').datepicker({
                format: "yyyy",
                viewMode: "years",
                minViewMode: "years",
                autoclose: true,
                orientation: "bottom"
            }).on('changeDate', function(e) {
                const tahun = e.format(0, "yyyy");

                $.get(`{{ route('dashboard.chart') }}?tahun=${tahun}`, function(response) {
                    if (response.series) {
                        chart.updateSeries(response.series);
                    }
                });
            });
        })

        function sendMessage(data) {
            $.ajax({
                url: `{{ route('pendaftaran.message', ['pendaftaran' => ':id']) }}`.replace(':id', data),
                type: 'GET',
                beforeSend: function() {
                    Swal.fire({
                        title: 'Memproses...',
                        text: 'Mohon tunggu sebentar',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal
                                .showLoading();
                        }
                    });
                },
                success: function(result) {
                    const message = result.data.message;
                    const phone = result.data.phone;
                    const urlWhatsApp =
                        `https://api.whatsapp.com/send?phone=${phone}&text=${message}`;
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
                                title: "Batal",
                                text: "Pesan Batal Dikirimkan",
                                type: "success",
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "Oke",
                            })
                        }
                    });
                },
                error: function(xhr, status, error) {
                    Swal.close();
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: xhr.responseJSON
                            .message,
                    });
                }
            })
        }
    </script>
@endsection
<x-app-layout>
    <x-slot:title>Dashboard</x-slot:title>
    <div class="form-head mb-sm-5 mb-3 d-flex flex-wrap align-items-center">
        <h2 class="font-w600 title mb-2 me-auto ">Dashboard</h2>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-between align-items-center">
                            <div class="">
                                <p class="fs-4 font-w500 m-0">Pemasukan</p>
                                <span class="text-black font-w600">Rp
                                    {{ number_format($pembayaran->pemasukan, 0, ',', '.') }}</span>
                            </div>
                            <div class="border border-1 p-3 rounded bg-primary">
                                <i class="text-white fas fa-money-bill-wave fs-3"></i>
                            </div>
                        </div>
                        <hr class="my-3">
                        <div class="col-12">
                            <div class="row justify-content-between">
                                <div class="col-6 text-center">
                                    <p class="fs-5 font-w500 m-0">Success</p>
                                    <span class="text-black font-w600">{{ $pembayaran->success }}</span>
                                </div>
                                <div class="col-6 text-center">
                                    <p class="fs-5 font-w500 m-0">Pending</p>
                                    <span class="text-black font-w600">{{ $pembayaran->pending }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-between align-items-center">
                            <div class="">
                                <p class="fs-4 font-w500 m-0">Pendaftaran</p>
                                <span class="text-black font-w600">{{ $pendaftaran['total'] }}</span>
                            </div>
                            <div class="border border-1 p-3 rounded bg-primary">
                                <i class="text-white fas fa-file fs-3"></i>
                            </div>
                        </div>
                        <hr class="my-3">
                        <div class="col-12">
                            <div class="row justify-content-between">
                                <div class="col-6 text-center">
                                    <p class="fs-5 font-w500 m-0">{{ $pendaftaran['artspace']->name }}</p>
                                    <span class="text-black font-w600">{{ $pendaftaran['artspace']->count }}</span>
                                </div>
                                <div class="col-6 text-center">
                                    <p class="fs-5 font-w500 m-0">{{ $pendaftaran['kids']->name }}</p>
                                    <span class="text-black font-w600">{{ $pendaftaran['kids']->count }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-0 flex-wrap pb-0">
                    <div class="mb-3">
                        <h4 class="fs-20 text-black">Statistik Pendaftaran</h4>
                        <p class="mb-0 fs-12 text-black"> Menampilkan jumlah pendaftaran untuk Artspace & Kids.</p>
                    </div>

                    <div class=""style="z-index: 1 !important; position: relative;">
                        <input type="text" id="year-picker" class="form-control bg-secondary text-white w-auto"
                            value="{{ date('Y') }}">
                    </div>
                </div>
                <div class="card-body pb-2 px-3">
                    <div id="marketChart" class="market-line"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <h4 class="fs-20 text-black">Pendaftaran Artspace yang Akan Datang</h4>
                    </div>
                    <div class="table-responsive">
                        <table id="table-pendaftaran" class="display nowrap" style="width: 100%;">
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
