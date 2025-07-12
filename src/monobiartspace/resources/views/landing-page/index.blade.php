@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            const swiper = new Swiper('.swiper-class', {
                // Optional parameters
                direction: 'horizontal',

                // If we need pagination
                pagination: {
                    el: '.swiper-pagination-class',
                },

                // Navigation arrows
                navigation: {
                    nextEl: '.btn-nav-right',
                    prevEl: '.btn-nav-left',
                },

                breakpoints: {
                    "480": {
                        "slidesPerView": 2,
                        "spaceBetween": 30
                    },
                    "992": {
                        "slidesPerView": 3,
                        "spaceBetween": 50
                    }
                }
            });

            @if (!empty($datas))
                getDataClass('{{ $datas[0]->jenis }}', '{{ $datas[0]->id }}');
            @endif

        })

        function getDataClass(type, id) {
            let uri = `{{ route('class', ['tipe' => ':tipe', 'id' => ':id']) }}`.replace(':tipe', `${type}`).replace(':id',
                `${id}`);
            let classContainer = $('#features-tab-1')
            $.ajax({
                url: uri,
                type: 'GET',
                beforeSend: function() {
                    classContainer.removeClass('show active').fadeOut(200, function() {
                        classContainer.children('.row').children('.swiper-class').children(
                            '.swiper-wrapper').empty();
                    });
                },
                success: function(result) {
                    $.each(result.data, function(key, val) {
                        let uriDetail =
                            `{{ route('class.detail', ['tipe' => ':kid', 'slug' => ':slug']) }}`
                            .replace(':kid', type == 'kids' ? 'kid' : 'artspace').replace(
                                ':slug', val.slug);
                        classContainer.children('.row').children('.swiper-class').children(
                            '.swiper-wrapper').append(`
                            <div class="swiper-slide">
                                <a class="link-underline link-underline-opacity-0"
                                            href="${uriDetail}">
                                <div class="card h-100">
                                    <img src="${val.images.length != 0 ? 'storage/' +  val.images[0].file : 'https://www.davidhechler.com/wp-content/uploads/2016/07/500x500-dummy-image.jpg'}" class="card-img-top" alt="..." loading="lazy">
                                    <div class="card-body">
                                        <h5 class="card-title">${val.nama}</h5>
                                        ${(type != 'kids'? `<p class="card-text">${Intl.NumberFormat("id-ID", {style: "currency", currency: "IDR", minimumFractionDigits: 0, maximumFractionDigits: 0}).format(val.harga)}</p>` : '')}
                                    </div>
                                </div>
                                </a>
                            </div>
                        `)
                    })
                    classContainer.fadeIn(250).addClass('show active');
                }
            })
        }
    </script>
@endsection
<x-app>
    <x-slot:title>Monobi</x-slot:title>
    <section id="hero" class="hero section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="hero-content" data-aos="fade-up" data-aos-delay="200">
                        <h1 class="mb-4">
                            Temukan <br>
                            Kebahagiaanmu <br>
                            Di <span class="accent-text">Monobi</span>
                        </h1>

                        <p class="mb-4 mb-md-5">
                            Monobi menghadirkan pengalaman seni yang menyenangkan dan fleksibel, untuk anak-anak,
                            remaja,
                            hingga
                            dewasa.</p>

                        <div class="hero-buttons">
                            <a href="#about" class="btn btn-primary me-0 me-sm-2 mx-1">Mulai Sekarang</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="hero-image" data-aos="zoom-out" data-aos-delay="300">
                        <img src="{{ asset('landing-page/assets/image/hero.webp') }}" alt="Hero Image"
                            class="img-fluid">
                    </div>
                </div>
            </div>
        </div>

    </section>

    <!-- About Section -->
    <section id="about" class="about section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-4 align-items-center justify-content-between">

                <div class="col-xl-5" data-aos="fade-up" data-aos-delay="200">
                    <span class="about-meta">ABOUT US</span>
                    <h2 class="about-title">Monobi adalah platform edukasi seni untuk semua usia</h2>
                    <p class="about-description">Kami menghadirkan berbagai kelas seni yang fleksibel dan menyenangkan,
                        mulai dari melukis diberbagai media, kreasi clay, merangkai beads, hingga menghias dengan deco
                        cream.</p>

                    <div class="row feature-list-wrapper">
                        <div class="col-md-6">
                            <ul class="feature-list">
                                <li><i class="bi bi-check-circle-fill"></i>Fleksibel & Ramah untuk Semua Usia</li>
                                <li><i class="bi bi-check-circle-fill"></i>Beragam Kelas Menarik</li>
                                <li><i class="bi bi-check-circle-fill"></i>Semua Bahan Disediakan</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="image-wrapper">
                        <div class="images position-relative" data-aos="zoom-out" data-aos-delay="400">
                            <img src="{{ asset('landing-page/assets/image/monobi_after_school.webp') }}"
                                alt="Business Meeting" class="img-fluid main-image rounded-4">
                            <img src="{{ asset('landing-page/assets/image/outingclass_sd26jatiutara2.webp') }}"
                                alt="Team Discussion" class="img-fluid small-image rounded-4">
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section><!-- /About Section -->

    <!-- Features Section -->
    <section id="class" class="features section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Monobi Class</h2>
            <p>Pilih kelas yang paling cocok buat kamu. Yuk, temukan keseruan belajar bareng Monobi!</p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="d-flex flex-column justify-content-center align-items-center gap-2">

                <ul class="nav nav-tabs" data-aos="fade-up" data-aos-delay="100">
                    @foreach ($datas as $data)
                        <li class="nav-item">
                            <a class="nav-link {{ $loop->index == 0 ? 'active show' : '' }}"
                                data-id="{{ $data->id }}" data-type="{{ $data->jenis }}" data-bs-toggle="tab"
                                data-bs-target="#features-tab-1"
                                onclick="getDataClass('{{ $data->jenis }}', '{{ $data->id }}')">
                                <h4>{{ $data->nama }}</h4>
                            </a>
                        </li>
                    @endforeach
                </ul>
                <a href="{{ route('class.index') }}" data-aos="fade-up" data-aos-delay="100">see all</a>
            </div>

            <div class="tab-content" data-aos="fade-up" data-aos-delay="200">
                <div class="tab-pane fade active show" id="features-tab-1">
                    <div class="row">
                        <div class="swiper-class">
                            <div class="swiper-wrapper">
                            </div>
                        </div>
                    </div>
                    <div class="navigation-button d-flex justify-content-center mt-4 gap-3">
                        <div class="btn-nav-left">
                            <div class="bg-primary rounded-circle d-flex justify-content-center align-items-center"
                                style="width: 30px; height: 30px;">
                                <i class="bi bi-chevron-left  text-white"></i>
                            </div>
                        </div>
                        <div class="swiper-pagination-class w-auto d-flex align-items-center"></div>
                        <div class="btn-nav-right">
                            <div class="bg-primary rounded-circle d-flex justify-content-center align-items-center"
                                style="width: 30px; height: 30px;">
                                <i class="bi bi-chevron-right text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section><!-- /Features Section -->

    <!-- Clients Section -->
    <section id="clients" class="clients section">
        <div class="container section-title" data-aos="fade-up">
            <h2>Partner</h2>
        </div>
        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="swiper init-swiper">
                <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              },
              "breakpoints": {
                "320": {
                  "slidesPerView": 2,
                  "spaceBetween": 40
                },
                "480": {
                  "slidesPerView": 3,
                  "spaceBetween": 60
                },
                "640": {
                  "slidesPerView": 4,
                  "spaceBetween": 80
                },
                "992": {
                  "slidesPerView": 6,
                  "spaceBetween": 120
                }
              }
            }
          </script>
                <div class="swiper-wrapper align-items-center">
                    @foreach ($partners as $partner)
                        <div class="swiper-slide"><img src="{{ asset('storage/' . $partner->image) }}"
                                class="img-fluid" alt="{{ $partner->name }}" loading="lazy">
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>

    <section id="gallery" class="services section light-background">
        <div class="container section-title" data-aos="fade-up">
            <h2>Gallery</h2>
            <p>Intip momen seru yang udah kami abadikan di sini, siapa tahu ada kamu juga!</p>
        </div>
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row g-2">
                @foreach ($galleries as $gallery)
                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-card d-flex">
                            <img src="{{ asset('storage/' . $gallery->image) }}" class="img-fluid"
                                alt="{{ $gallery->deskripsi }}" loading="lazy">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="faq-9 faq section light-background" id="faq">
        <div class="container">
            <div class="row">
                <div class="col-lg-5" data-aos="fade-up">
                    <h2 class="faq-title">Have a question? Check out the FAQ</h2>
                    <p class="faq-description">Punya pertanyaan seputar kelas atau layanan Monobi? Tenang, kami sudah
                        rangkum jawaban
                        dari pertanyaan yang paling sering ditanyakan di bawah ini!</p>
                    <div class="faq-arrow d-none d-lg-block" data-aos="fade-up" data-aos-delay="200">
                        <svg class="faq-arrow" width="200" height="211" viewBox="0 0 200 211" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M198.804 194.488C189.279 189.596 179.529 185.52 169.407 182.07L169.384 182.049C169.227 181.994 169.07 181.939 168.912 181.884C166.669 181.139 165.906 184.546 167.669 185.615C174.053 189.473 182.761 191.837 189.146 195.695C156.603 195.912 119.781 196.591 91.266 179.049C62.5221 161.368 48.1094 130.695 56.934 98.891C84.5539 98.7247 112.556 84.0176 129.508 62.667C136.396 53.9724 146.193 35.1448 129.773 30.2717C114.292 25.6624 93.7109 41.8875 83.1971 51.3147C70.1109 63.039 59.63 78.433 54.2039 95.0087C52.1221 94.9842 50.0776 94.8683 48.0703 94.6608C30.1803 92.8027 11.2197 83.6338 5.44902 65.1074C-1.88449 41.5699 14.4994 19.0183 27.9202 1.56641C28.6411 0.625793 27.2862 -0.561638 26.5419 0.358501C13.4588 16.4098 -0.221091 34.5242 0.896608 56.5659C1.8218 74.6941 14.221 87.9401 30.4121 94.2058C37.7076 97.0203 45.3454 98.5003 53.0334 98.8449C47.8679 117.532 49.2961 137.487 60.7729 155.283C87.7615 197.081 139.616 201.147 184.786 201.155L174.332 206.827C172.119 208.033 174.345 211.287 176.537 210.105C182.06 207.125 187.582 204.122 193.084 201.144C193.346 201.147 195.161 199.887 195.423 199.868C197.08 198.548 193.084 201.144 195.528 199.81C196.688 199.192 197.846 198.552 199.006 197.935C200.397 197.167 200.007 195.087 198.804 194.488ZM60.8213 88.0427C67.6894 72.648 78.8538 59.1566 92.1207 49.0388C98.8475 43.9065 106.334 39.2953 114.188 36.1439C117.295 34.8947 120.798 33.6609 124.168 33.635C134.365 33.5511 136.354 42.9911 132.638 51.031C120.47 77.4222 86.8639 93.9837 58.0983 94.9666C58.8971 92.6666 59.783 90.3603 60.8213 88.0427Z"
                                fill="currentColor"></path>
                        </svg>
                    </div>
                </div>
                <div class="col-lg-7" data-aos="fade-up" data-aos-delay="300">
                    <div class="faq-container">
                        <div class="faq-item">
                            <h3>Siapa saja yang bisa ikut kelas di Monobi?</h3>
                            <div class="faq-content">
                                <p>Semua orang bisa ikut! Kelas-kelas kami terbuka untuk anak-anak mulai usia 3 tahun,
                                    remaja, hingga dewasa tanpa batasan usia.</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div>
                        <div class="faq-item">
                            <h3>Apakah harus punya pengalaman seni sebelumnya?</h3>
                            <div class="faq-content">
                                <p>Tidak perlu! Semua kelas dirancang untuk pemula maupun yang sudah berpengalaman. Kamu
                                    akan dibimbing langkah demi langkah oleh instruktur kami.</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div>
                        <div class="faq-item">
                            <h3>Apa saja yang perlu saya bawa untuk ikut kelas?</h3>
                            <div class="faq-content">
                                <p>Tidak perlu membawa apa pun—semua bahan dan peralatan sudah kami sediakan. Kamu
                                    tinggal datang dan berkarya!</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section id="contact" class="contact section light-background">

        <div class="container section-title" data-aos="fade-up">
            <h2>Contact</h2>
            <p>Punya pertanyaan atau ide seru? Yuk, ngobrol bareng kami lewat form ini!</p>
        </div>

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row g-4 g-lg-5">
                <div class="col-lg-5">
                    <div class="info-box" data-aos="fade-up" data-aos-delay="200">
                        <h3>Info Kontak</h3>
                        <p>Mau mampir atau ngobrol lewat chat? Info lengkap kami ada di bawah. Jangan sungkan, kami
                            ramah kok!</p>

                        <div class="info-item" data-aos="fade-up" data-aos-delay="300">
                            <div class="icon-box">
                                <i class="bi bi-geo-alt"></i>
                            </div>
                            <div class="content">
                                <h4>Alamat Kami</h4>
                                <p>Jl Arwana no 6 Ulak Karang</p>
                                <p>Padang, Indonesia 25134</p>
                            </div>
                        </div>

                        <div class="info-item" data-aos="fade-up" data-aos-delay="400">
                            <div class="icon-box">
                                <i class="bi bi-telephone"></i>
                            </div>
                            <div class="content">
                                <h4>Nomor Telepon</h4>
                                <p>+62 822-4456-8338</p>
                            </div>
                        </div>

                        <div class="info-item" data-aos="fade-up" data-aos-delay="500">
                            <div class="icon-box">
                                <i class="bi bi-envelope"></i>
                            </div>
                            <div class="content">
                                <h4>Email</h4>
                                <p>{{ env('MAIL_FROM_ADDRESS') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="contact-form" data-aos="fade-up" data-aos-delay="300">
                        <h3>Ada Pertanyaan? Kirim Aja di Sini</h3>
                        <p>Tulis pesanmu di bawah. Gak perlu formal, yang penting jelas. Kami baca semua pesan, serius!
                        </p>
                        <form action="{{ route('send-message') }}" method="post" class="php-email-form"
                            data-aos="fade-up" data-aos-delay="200">
                            @csrf
                            <div class="row gy-4">
                                <div class="col-md-6">
                                    <input type="text" name="name" class="form-control"
                                        placeholder="Nama Anda" required="">
                                </div>
                                <div class="col-md-6 ">
                                    <input type="email" class="form-control" name="email"
                                        placeholder="Email Anda" required="">
                                </div>
                                <div class="col-12">
                                    <input type="text" class="form-control" name="subject" placeholder="Subject"
                                        required="">
                                </div>
                                <div class="col-12">
                                    <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
                                </div>
                                <div class="col-12 text-center">
                                    <div class="loading">Loading</div>
                                    <div class="error-message"></div>
                                    <div class="sent-message"></div>

                                    <button type="submit" class="btn">Kirim Pesan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app>
