@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.1/css/dataTables.bootstrap5.css">
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.1/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.3.1/js/dataTables.bootstrap5.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table-booking').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: "{{ url()->current() }}",
                columns: [{
                        data: null,
                    },
                    {
                        data: 'order_id',
                    },
                    {
                        data: 'type',
                    },
                    {
                        data: 'tanggal_reservasi',
                    },
                    {
                        data: 'amount',
                    },
                    {
                        data: 'id',
                        "render": function(data, type, row) {
                            let uri = "{{ route('booking.show', ['id' => ':id']) }}"
                                .replace(
                                    ':id', data);
                            return `<div class="d-flex">
										<a href="${uri}" class="btn btn-primary shadow btn-xs sharp me-1">Detail</a>
									</div>`
                        }
                    }
                ],
                columnDefs: [{
                    searchable: false,
                    orderable: false,
                    targets: 0,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                }],
                order: [
                    [1, 'asc']
                ]

            });

        });
    </script>
@endsection

<x-app>
    <div class="page-title light-background">
        <div class="container">
            <h1>List Booking</h1>
        </div>
    </div>
    <section class="section">
        <div class="container">
            <div class="table-responsive">
                <table id="table-booking" class="table" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Order ID</th>
                            <th>Booking</th>
                            <th>Tanggal Reservasi</th>
                            <th>Total Bayar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</x-app>
