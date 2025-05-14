{{-- @section('script')
    <script type="text/javascript">
        const swiper = new Swiper('.swiper-artspace', {
            direction: 'horizontal',
            slidesPerView: 4,
            spaceBetween: 20,

            // Navigation arrows
            navigation: {
                nextEl: '.bi-arrow-right.artspace',
                prevEl: '.bi-arrow-left.artspace',
            },
        });
    </script>
@endsection --}}
<x-app>
    <section id="class-list" class="section">
        <div class="container section-title" data-aos="fade-up">
            <div><span>{{ $artSpace->nama }}</span></div>
        </div>
        <div class="container">
            <div class="row">
                {{-- <div class="swiper-artspace">
                    <div class="row justify-content-end">
                        <span class="w-auto"><i class="bi bi-arrow-left artspace"></i></span>
                        <span class="w-auto"><i class="bi bi-arrow-right artspace"></i></span>
                    </div>
                    <div class="swiper-wrapper">
                        @foreach ($artSpace->kegiatan as $kegiatan)
                            <div class="swiper-slide">
                                <div class="card h-100">
                                    <img src="https://dummyimage.com/500x500/000/fff" class="card-img-top"
                                        alt="...">
                                    <div class="card-body">
                                        <h4>{{ $kegiatan->nama }}</h4>
                                        <p>Harga: Rp <span>{{ number_format($kegiatan->harga, 0, ',', '.') }}</span></p>
                                        <a href="">Detail</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div> --}}
                @foreach ($artSpace->kegiatan as $kegiatan)
                    <div class="col-4 pb-4">
                        <div class="card h-100">
                            <img src="https://dummyimage.com/500x500/000/fff" width="500" height="500"
                                class="card-img-top" alt="...">
                            <div class="card-body">
                                <h4>{{ $kegiatan->nama }}</h4>
                                <p>Harga: Rp <span>{{ number_format($kegiatan->harga, 0, ',', '.') }}</span></p>
                                <a href="">Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</x-app>
