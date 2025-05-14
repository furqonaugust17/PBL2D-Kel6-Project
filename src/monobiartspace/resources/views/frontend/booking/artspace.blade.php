@section('script')
    <script>
        let index = 1;

        function addParticipant() {
            const container = document.getElementById('participants');
            const html = `
        <div class="participant">
            <label>Nama Peserta:</label>
            <input type="text" name="participants[${index}][name]">
            <label>Pilih Kegiatan:</label>
            <select name="participants[${index}][activity_id]">
                @foreach ($kegiatanArtSpace as $kegiatan)
                    <option value="{{ $kegiatan->id }}">{{ $kegiatan->nama }} - Rp {{ $kegiatan->harga }}</option>
                @endforeach
            </select>
        </div>`;
            container.insertAdjacentHTML('beforeend', html);
            index++;
        }
    </script>
@endsection
<x-app>
    <section class="mt-4">
        <form action="{{ route('booking.artspace.store') }}" method="POST">
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
                    <input type="text" name="participants[0][name]">
                    <label>Pilih Kegiatan:</label>
                    <select name="participants[0][activity_id]">
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
    </section>
</x-app>
