@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            const buildSwiperSlider = sliderElm => {
                const sliderIdentifier = sliderElm.dataset.id;
                return new Swiper(`#${sliderElm.id}`, {
                    direction: 'horizontal',

                    pagination: {
                        el: `.swiper-pagination-${sliderIdentifier}`,
                    },

                    navigation: {
                        nextEl: `.btn-nav-right-${sliderIdentifier}`,
                        prevEl: `.btn-nav-left-${sliderIdentifier}`,
                    },

                    breakpoints: {
                        480: {
                            slidesPerView: 2,
                            spaceBetween: 30
                        },
                        992: {
                            slidesPerView: 3,
                            spaceBetween: 50
                        }
                    }
                });
            }

            const artSpaceSlider = document.querySelectorAll('.swiper-class');
            const kidSlider = document.querySelectorAll('.swiper-kids');

            artSpaceSlider.forEach(slider => buildSwiperSlider(slider));
            kidSlider.forEach(slider => buildSwiperSlider(slider));
        })
    </script>
@endsection
<x-app>
    <x-slot:title>All Monobi Class</x-slot:title>
    <div class="page-title light-background">
        <div class="container">
            <h1>All Monobi Class</h1>
        </div>
    </div>
    <section class="section">
        <div class="container">
            @foreach ($artspaces as $indexArtSpace => $artspace)
                <div class="artspace">
                    <div class="row">
                        <div class="swiper-class"id="slider{{ $indexArtSpace }}" data-id="slider{{ $indexArtSpace }}">
                            <h1>{{ $artspace->nama }}</h1>
                            <div class="swiper-wrapper h-auto">
                                @foreach ($artspace->kegiatan as $indexKegiatan => $kegiatan)
                                    <div class="swiper-slide">
                                        <a class="link-underline link-underline-opacity-0"
                                            href="{{ route('class.detail', ['tipe' => 'artspace', 'slug' => $kegiatan->slug]) }}">
                                            <div class="card h-100">
                                                <img src="{{ empty($kegiatan->images[0]->file) ? 'https://www.davidhechler.com/wp-content/uploads/2016/07/500x500-dummy-image.jpg' : asset('storage/' . $kegiatan->images[0]->file) }}"
                                                    class="card-img-top" alt="...">
                                                <div class="card-body">
                                                    <h5 class="card-title text-truncate">{{ $kegiatan->nama }}</h5>
                                                    <p class="card-text">
                                                        {{ number_format($kegiatan->harga, 0, ',', '.') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="navigation-button d-flex justify-content-center mt-4 gap-3">
                        <div class="btn-nav-left-slider{{ $indexArtSpace }}">
                            <div class="bg-primary rounded-circle d-flex justify-content-center align-items-center"
                                style="width: 30px; height: 30px;">
                                <i class="bi bi-chevron-left  text-white"></i>
                            </div>
                        </div>
                        <div class="swiper-pagination-slider{{ $indexArtSpace }} w-auto d-flex align-items-center">
                        </div>
                        <div class="btn-nav-right-slider{{ $indexArtSpace }}">
                            <div class="bg-primary rounded-circle d-flex justify-content-center align-items-center"
                                style="width: 30px; height: 30px;">
                                <i class="bi bi-chevron-right text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            @foreach ($kids as $indexKid => $kid)
                <div class="artspace">
                    <div class="row">
                        <div class="swiper-kids" id="slider-kid-{{ $indexKid }}"
                            data-id="slider-kid-{{ $indexKid }}">
                            <h1>{{ $kid->nama }}</h1>
                            <div class="swiper-wrapper h-auto">
                                @foreach ($kid->temas as $indexTema => $tema)
                                    <div class="swiper-slide">
                                        <a class="link-underline link-underline-opacity-0"
                                            href="{{ route('class.detail', ['tipe' => 'kid', 'slug' => $tema->slug]) }}">
                                            <div class="card h-100">
                                                <img src="{{ empty($tema->images[0]->file) ? 'https://www.davidhechler.com/wp-content/uploads/2016/07/500x500-dummy-image.jpg' : asset('storage/' . $tema->images[0]->file) }}"
                                                    class="card-img-top" alt="...">
                                                <div class="card-body">
                                                    <h5 class="card-title text-truncate">{{ $tema->nama }}</h5>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="navigation-button d-flex justify-content-center mt-4 gap-3">
                        <div class="btn-nav-left-slider-kid-{{ $indexKid }}">
                            <div class="bg-primary rounded-circle d-flex justify-content-center align-items-center"
                                style="width: 30px; height: 30px;">
                                <i class="bi bi-chevron-left  text-white"></i>
                            </div>
                        </div>
                        <div class="swiper-pagination-slider-kid-{{ $indexKid }} w-auto d-flex align-items-center">
                        </div>
                        <div class="btn-nav-right-slider-kid-{{ $indexKid }}">
                            <div class="bg-primary rounded-circle d-flex justify-content-center align-items-center"
                                style="width: 30px; height: 30px;">
                                <i class="bi bi-chevron-right text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</x-app>
