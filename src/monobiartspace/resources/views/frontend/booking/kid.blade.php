@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="kelas_id"]').on('change', function() {
                console.log($(this).val());
            });
        });
    </script>
@endsection
<x-app>
    <section class="mt-4">
        <form action="">
            <div class="">
                <label for="">Nama Lengkap Anak</label>
                <input type="text" name="nama-lengkap">
            </div>
            <div class="">
                <label for="">Nama Panggilan Anak</label>
                <input type="text" name="nama-panggilan">
            </div>
            <div class="">
                <label for="">Usia Anak Saat Ini</label>
                <input type="number" name="usia-saat-ini">
            </div>
            <div class="">
                <label for="">Tanggal Lahir anak</label>
                <input type="date" name="tgl-lahir" id="">
            </div>
            <div class="">
                <label for="">Pilih Kelas</label>
                <select name="kelas_id" id="">
                    <option value="" selected disabled>== Pilih Kelas ==</option>
                    @foreach ($kids as $kelas)
                        <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
                    @endforeach
                </select>
            </div>
        </form>
    </section>
</x-app>
