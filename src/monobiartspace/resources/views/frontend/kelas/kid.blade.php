@section('css')
    <style>
        .swiper {
            width: 100%;
            height: 100%;
        }

        .swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #444;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .swiper {
            width: 100%;
            height: 300px;
            margin-left: auto;
            margin-right: auto;
        }

        .swiper-slide {
            background-size: cover;
            background-position: center;
        }

        .mySwiper2 {
            height: 80%;
            width: 100%;
        }

        .mySwiper {
            height: 20%;
            box-sizing: border-box;
            padding: 10px 0;
        }

        .mySwiper .swiper-slide {
            width: 25%;
            height: 100%;
            opacity: 0.4;
        }

        .mySwiper .swiper-slide-thumb-active {
            opacity: 1;
        }

        .swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
@endsection
@section('script')
    {{-- <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script> --}}
    <script type="text/javascript">
        $(document).ready(function() {
            const swiper = new Swiper(".mySwiper", {
                loop: true,
                spaceBetween: 10,
                slidesPerView: 5,
                freeMode: true,
                watchSlidesProgress: true,
            });
            const swiper2 = new Swiper(".mySwiper2", {
                loop: true,
                spaceBetween: 10,
                navigation: {
                    nextEl: ".btn-next",
                    prevEl: ".btn-prev",
                },
                thumbs: {
                    swiper: swiper,
                },
            });
        })
    </script>
@endsection
<x-app>
    <div class="page-title light-background">
    </div>
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-12">
                    <div class="rounded">
                        <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff"
                            class="swiper mySwiper2">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img src="https://swiperjs.com/demos/images/nature-1.jpg" />
                                </div>
                                <div class="swiper-slide">
                                    <img src="https://swiperjs.com/demos/images/nature-2.jpg" />
                                </div>
                                <div class="swiper-slide">
                                    <img src="https://swiperjs.com/demos/images/nature-3.jpg" />
                                </div>
                                <div class="swiper-slide">
                                    <img src="https://swiperjs.com/demos/images/nature-4.jpg" />
                                </div>
                                <div class="swiper-slide">
                                    <img src="https://swiperjs.com/demos/images/nature-5.jpg" />
                                </div>
                            </div>

                        </div>
                        <div class="d-flex align-items-center justify-content-center gap-2">
                            <div class="btn-prev">
                                <i class="bi bi-chevron-left  text-black fs-4"></i>
                            </div>
                            <div thumbsSlider="" class="swiper mySwiper">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img src="https://swiperjs.com/demos/images/nature-1.jpg" />
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="https://swiperjs.com/demos/images/nature-2.jpg" />
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="https://swiperjs.com/demos/images/nature-3.jpg" />
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="https://swiperjs.com/demos/images/nature-4.jpg" />
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="https://swiperjs.com/demos/images/nature-5.jpg" />
                                    </div>
                                </div>
                            </div>
                            <div class="btn-next">
                                <i class="bi bi-chevron-right text-black fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-12">
                    <h1 class="fw-bold">{{ $data->nama }}</h1>
                    <p class="text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi repudiandae
                        excepturi ea
                        blanditiis perferendis velit laboriosam ratione nobis quia eaque ipsum repellendus sed nulla,
                        voluptas alias quis, eius dolores voluptatum.</p>
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <h2>Tema Setiap Minggu</h2>
                            <ul>
                                @foreach ($data->detailTema as $tema)
                                    <li>{{ $tema->nama }} (Week {{ $tema->week }})</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-lg-6 col-12">
                            <h2>Harga</h2>
                            <ul>
                                <li>Normal Meet Rp 100.000</li>
                                <li>Bundle 3 Week Rp 320.000</li>
                            </ul>
                        </div>
                    </div>
                    <div class="button-wrapper btn btn-primary">
                        <a href="{{ route('booking.artspace') }}" class="text-white">Pesan Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app>
