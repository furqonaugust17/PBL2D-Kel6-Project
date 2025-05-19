@section('script')
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#form').on('submit', function(e) {
                e.preventDefault();
                let tanggal = $('input[name="tanggal"]').val();
                let sesi = $('select[name="sesi"]').val();
                let participants = [];
                $('.participant').each(function() {
                    let name = $(this).find('input[name="participants[][name]"]').val();
                    let activity_id = $(this).find('select[name="participants[][activity_id]"]')
                        .val();

                    participants.push({
                        name: name,
                        activity_id: activity_id
                    });
                });

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{ url()->current() }}",
                    type: 'POST',
                    data: {
                        tanggal,
                        sesi,
                        participants
                    },
                    success: function(data) {
                        console.log(data);
                        window.snap.pay(`${data.snapToken}`);
                        // window.snap.pay(`${data.snapToken}`, {
                        //     embedId: 'snap-container'
                        // });
                    }
                })
                console.log({
                    tanggal,
                    sesi,
                    participants
                });

            })
        });


        let counterParticipant = 1;

        function addParticipant() {
            const container = document.getElementById('participants');
            const html = `
        <div class="participant">
            <label>Nama Peserta:</label>
            <input type="text" name="participants[][name]">
            <label>Pilih Kegiatan:</label>
            <select name="participants[][activity_id]">
                @foreach ($kegiatanArtSpace as $kegiatan)
                    <option value="{{ $kegiatan->id }}">{{ $kegiatan->nama }} - Rp {{ $kegiatan->harga }}</option>
                @endforeach
            </select>
        </div>`;
            container.insertAdjacentHTML('beforeend', html);
            counterParticipant++;
        }
    </script>
@endsection
<x-app>
    <section class="mt-4">
        <form action="{{ route('booking.artspace.store') }}" method="POST" id="form">
            @csrf
            <div class="booking-date">
                <label>Tanggal Akan Datang:</label>
                <input type="date" name="tanggal" id="">
            </div>
            <div class="session">
                <label>Sesi:</label>
                <select name="sesi">
                    @foreach ($jadwalArtSpace as $jadwal)
                        <option value="{{ $jadwal->id }}">{{ $jadwal->sesi }} {{ $jadwal->mulai }} -
                            {{ $jadwal->akhir }}</option>
                    @endforeach
                </select>
            </div>
            <div id="participants">
                <div class="participant">
                    <label>Nama Peserta:</label>
                    <input type="text" name="participants[][name]">
                    <label>Pilih Kegiatan:</label>
                    <select name="participants[][activity_id]">
                        @foreach ($kegiatanArtSpace as $kegiatan)
                            <option value="{{ $kegiatan->id }}">{{ $kegiatan->nama }} - Rp {{ $kegiatan->harga }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button type="button" onclick="addParticipant()">+ Tambah Peserta</button>
            <button type="submit">Daftar</button>
        </form>
        <div id="snap-container"></div>
    </section>
</x-app>
