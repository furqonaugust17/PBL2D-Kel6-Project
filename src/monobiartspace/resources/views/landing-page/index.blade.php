<x-app>
    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">
        <img src="{{ asset('landing-page/assets/img/hero-bg-2.jpg') }}" alt="" class="hero-bg">

        <div class="container">
            <div class="row gy-4 justify-content-between">
                <div class="col-lg-4 order-lg-last hero-img" data-aos="zoom-out" data-aos-delay="100">
                    <img src="{{ asset('landing-page/assets/image/hero.png') }}" class="img-fluid animated"
                        alt="">
                </div>

                <div class="col-lg-6  d-flex flex-column justify-content-center" data-aos="fade-in">
                    <h1>Bebaskan Imajinasi, Ekspresikan Diri <span>Lewat Seni</span></h1>
                    <p>Monobi menghadirkan pengalaman seni yang menyenangkan dan fleksibel, untuk anak-anak, remaja,
                        hingga
                        dewasa.</p>
                    <div class="d-flex">
                        <a href="#about" class="btn-get-started">Daftar Sekarang</a>
                        <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8"
                            class="glightbox btn-watch-video d-flex align-items-center"><i
                                class="bi bi-play-circle"></i><span>Watch
                                Video</span></a>
                    </div>
                </div>

            </div>
        </div>

        <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
            viewBox="0 24 150 28 " preserveAspectRatio="none">
            <defs>
                <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z">
                </path>
            </defs>
            <g class="wave1">
                <use xlink:href="#wave-path" x="50" y="3"></use>
            </g>
            <g class="wave2">
                <use xlink:href="#wave-path" x="50" y="0"></use>
            </g>
            <g class="wave3">
                <use xlink:href="#wave-path" x="50" y="9"></use>
            </g>
        </svg>

    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row align-items-xl-center gy-5">
                <div class="col-xl-5 content">
                    <h3>About Us</h3>
                    <h2>Monobi adalah platform edukasi seni untuk semua usia</h2>
                    <p>Kami menghadirkan berbagai kelas seni yang fleksibel dan menyenangkan, mulai dari melukis di
                        berbagai
                        media, kreasi clay, merangkai beads, hingga menghias dengan deco cream.</p>
                    <a href="#" class="read-more"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
                </div>

                <div class="col-xl-7">
                    <div class="row gy-4 icon-boxes">
                        <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                            <div class="icon-box">
                                <i class="bi bi-people"></i>
                                <h3>Fleksibel & Ramah untuk Semua Usia</h3>
                                <p>Cocok untuk anak-anak, remaja, hingga dewasa yang ingin memulai atau
                                    mengembangkan passion di
                                    bidang seni</p>
                            </div>
                        </div> <!-- End Icon Box -->
                        <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                            <div class="icon-box">
                                <i class="bi bi-brush"></i>
                                <h3>Beragam Kelas Menarik</h3>
                                <p>Dari melukis hingga dekorasi, pilih kelas sesuai minatmu dengan beragam media
                                    seru yang bisa
                                    dieksplorasi</p>
                            </div>
                        </div> <!-- End Icon Box -->
                        <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
                            <div class="icon-box">
                                <i class="bi bi-box-seam"></i>
                                <h3>Semua Bahan Disediakan</h3>
                                <p>Kamu hanya perlu membawa diri dan kreativitas, biarkan kami yang menyiapkan
                                    sisanya!</p>
                            </div>
                        </div> <!-- End Icon Box -->
                        <div class="col-md-6" data-aos="fade-up" data-aos-delay="500">
                            <div class="icon-box">
                                <i class="bi bi-person-check"></i>
                                <h3>Instruktur Berpengalaman</h3>
                                <p>Mentor yang ahli di bidang seni dan edukasi, siap membimbing dengan suasana
                                    hangat dan suportif</p>
                            </div>
                        </div> <!-- End Icon Box -->
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /About Section -->


    <!-- Details Section -->
    <section id="details" class="details section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Details</h2>
            <div><span>Check Our</span> <span class="description-title">Details</span></div>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row gy-4 align-items-center features-item">
                <div class="col-md-5 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="100">
                    <img src="{{ asset('landing-page/assets/image/outingclass_sd26jatiutara.jpg') }}" class="img-fluid"
                        alt="">
                </div>
                <div class="col-md-7" data-aos="fade-up" data-aos-delay="100">
                    <h3>Outing Class SD 26 Jati Utara Padang</h3>
                    <p class="fst-italic">
                        Outing Class bersama adik2 dari SD 26 Jati Utara Padang✨
                        Di kegiatan kali ini kita melukis di canvas bersama di Taman Melati Padang, seruu banget!!
                        Sampai jumpa di Outing Class selanjutnya 👋🏻
                    </p>
                </div>
            </div><!-- Features Item -->

            <div class="row gy-4 align-items-center features-item">
                <div class="col-md-5 order-1 order-md-2 d-flex align-items-center" data-aos="zoom-out"
                    data-aos-delay="200">
                    <img src="{{ asset('landing-page/assets/image/class_doll.jpg') }}" class="img-fluid" alt="">
                </div>
                <div class="col-md-7 order-2 order-md-1" data-aos="fade-up" data-aos-delay="200">
                    <h3>DIY Boneka Bag Charm</h3>
                    <p>
                        Ekspresikan kreativitasmu dengan membuat boneka gantungan tas (bag charm) yang unik dan
                        menggemaskan! Di
                        kelas ini, peserta akan belajar merakit boneka dari bahan-bahan yang mudah dibentuk dan
                        dihias sesuai
                        selera. Cocok untuk semua usia, aktivitas ini menyenangkan dan bisa jadi hadiah buatan
                        tangan yang
                        istimewa.
                    </p>
                </div>
            </div><!-- Features Item -->

            <div class="row gy-4 align-items-center features-item">
                <div class="col-md-5 d-flex align-items-center" data-aos="zoom-out">
                    <img src="{{ asset('landing-page/assets/image/monobi_after_school.jpg') }}" class="img-fluid"
                        alt="">
                </div>
                <div class="col-md-7" data-aos="fade-up">
                    <h3>Satu Tempat, Banyak Kreasi Seru!</h3>
                    <p>Di Monobi, kamu bisa menikmati berbagai aktivitas seni mulai dari melukis di kanvas, pouch,
                        topi, hingga
                        gypsum, membuat kreasi clay yang unik, merangkai beads warna-warni, sampai menghias dengan
                        teknik deco
                        cream. Setiap kelas dirancang untuk membebaskan kreativitas dan memberi pengalaman seni yang
                        menyenangkan—baik untuk anak-anak maupun dewasa.</p>
                </div>
            </div><!-- Features Item -->
        </div>

    </section><!-- /Details Section -->

    <!-- Gallery Section -->
    <section id="gallery" class="gallery section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Gallery</h2>
            <div><span>Check Our</span> <span class="description-title">Gallery</span></div>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row g-0">

                <div class="col-lg-3 col-md-4">
                    <div class="gallery-item">
                        <a href="{{ asset('landing-page/assets/image/outingclass_sd26jatiutara.jpg') }}"
                            class="glightbox" data-gallery="images-gallery">
                            <img src="{{ asset('landing-page/assets/image/outingclass_sd26jatiutara.jpg') }}"
                                alt="" class="img-fluid">
                        </a>
                    </div>
                </div><!-- End Gallery Item -->

                <div class="col-lg-3 col-md-4">
                    <div class="gallery-item">
                        <a href="{{ asset('landing-page/assets/image/outingclass_sd26jatiutara2.jpg') }}"
                            class="glightbox" data-gallery="images-gallery">
                            <img src="{{ asset('landing-page/assets/image/outingclass_sd26jatiutara2.jpg') }}"
                                alt="" class="img-fluid">
                        </a>
                    </div>
                </div><!-- End Gallery Item -->

                <div class="col-lg-3 col-md-4">
                    <div class="gallery-item">
                        <a href="{{ asset('landing-page/assets/image/merchandise.jpg') }}" class="glightbox"
                            data-gallery="images-gallery">
                            <img src="{{ asset('landing-page/assets/image/merchandise.jpg') }}" alt=""
                                class="img-fluid">
                        </a>
                    </div>
                </div><!-- End Gallery Item -->

                <div class="col-lg-3 col-md-4">
                    <div class="gallery-item">
                        <a href="{{ asset('landing-page/assets/image/class_education.jpg') }}" class="glightbox"
                            data-gallery="images-gallery">
                            <img src="{{ asset('landing-page/assets/image/class_education.jpg') }}" alt=""
                                class="img-fluid">
                        </a>
                    </div>
                </div><!-- End Gallery Item -->

                <div class="col-lg-3 col-md-4">
                    <div class="gallery-item">
                        <a href="{{ asset('landing-page/assets/image/class_kids.jpg') }}" class="glightbox"
                            data-gallery="images-gallery">
                            <img src="{{ asset('landing-page/assets/image/class_kids.jpg') }}" alt=""
                                class="img-fluid">
                        </a>
                    </div>
                </div><!-- End Gallery Item -->

                <div class="col-lg-3 col-md-4">
                    <div class="gallery-item">
                        <a href="{{ asset('landing-page/assets/image/event_collaboration.jpg') }}" class="glightbox"
                            data-gallery="images-gallery">
                            <img src="{{ asset('landing-page/assets/image/event_collaboration.jpg') }}"
                                alt="" class="img-fluid">
                        </a>
                    </div>
                </div><!-- End Gallery Item -->

                <div class="col-lg-3 col-md-4">
                    <div class="gallery-item">
                        <a href="{{ asset('landing-page/assets/image/monobi_after_school2.jpg') }}" class="glightbox"
                            data-gallery="images-gallery">
                            <img src="{{ asset('landing-page/assets/image/monobi_after_school2.jpg') }}"
                                alt="" class="img-fluid">
                        </a>
                    </div>
                </div><!-- End Gallery Item -->

                <div class="col-lg-3 col-md-4">
                    <div class="gallery-item">
                        <a href="{{ asset('landing-page/assets/image/monobi_after_school.jpg') }}" class="glightbox"
                            data-gallery="images-gallery">
                            <img src="{{ asset('landing-page/assets/image/monobi_after_school.jpg') }}"
                                alt="" class="img-fluid">
                        </a>
                    </div>
                </div><!-- End Gallery Item -->

            </div>

        </div>

    </section><!-- /Gallery Section -->

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section dark-background">

        <img src="{{ asset('landing-page/assets/img/testimonials-bg.jpg') }}" class="testimonials-bg"
            alt="">

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
     }
   }
 </script>
                <div class="swiper-wrapper">

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <img src="{{ asset('landing-page/assets/img/testimonials/testimonials-1.jpg') }}"
                                class="testimonial-img" alt="">
                            <h3>Saul Goodman</h3>
                            <h4>Ceo &amp; Founder</h4>
                            <div class="stars">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i>
                            </div>
                            <p>
                                <i class="bi bi-quote quote-icon-left"></i>
                                <span>Proin iaculis purus consequat sem cure digni ssim donec porttitora entum
                                    suscipit rhoncus.
                                    Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus
                                    at semper.</span>
                                <i class="bi bi-quote quote-icon-right"></i>
                            </p>
                        </div>
                    </div><!-- End testimonial item -->

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <img src="{{ asset('landing-page/assets/img/testimonials/testimonials-2.jpg') }}"
                                class="testimonial-img" alt="">
                            <h3>Sara Wilsson</h3>
                            <h4>Designer</h4>
                            <div class="stars">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i>
                            </div>
                            <p>
                                <i class="bi bi-quote quote-icon-left"></i>
                                <span>Export tempor illum tamen malis malis eram quae irure esse labore quem cillum
                                    quid cillum eram
                                    malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam
                                    anim culpa.</span>
                                <i class="bi bi-quote quote-icon-right"></i>
                            </p>
                        </div>
                    </div><!-- End testimonial item -->

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <img src="{{ asset('landing-page/assets/img/testimonials/testimonials-3.jpg') }}"
                                class="testimonial-img" alt="">
                            <h3>Jena Karlis</h3>
                            <h4>Store Owner</h4>
                            <div class="stars">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i>
                            </div>
                            <p>
                                <i class="bi bi-quote quote-icon-left"></i>
                                <span>Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla
                                    quem veniam duis
                                    minim tempor labore quem eram duis noster aute amet eram fore quis sint
                                    minim.</span>
                                <i class="bi bi-quote quote-icon-right"></i>
                            </p>
                        </div>
                    </div><!-- End testimonial item -->

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <img src="{{ asset('landing-page/assets/img/testimonials/testimonials-4.jpg') }}"
                                class="testimonial-img" alt="">
                            <h3>Matt Brandon</h3>
                            <h4>Freelancer</h4>
                            <div class="stars">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i>
                            </div>
                            <p>
                                <i class="bi bi-quote quote-icon-left"></i>
                                <span>Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim
                                    fugiat minim
                                    velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore
                                    labore illum
                                    veniam.</span>
                                <i class="bi bi-quote quote-icon-right"></i>
                            </p>
                        </div>
                    </div><!-- End testimonial item -->

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <img src="{{ asset('landing-page/assets/img/testimonials/testimonials-5.jpg') }}"
                                class="testimonial-img" alt="">
                            <h3>John Larson</h3>
                            <h4>Entrepreneur</h4>
                            <div class="stars">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i>
                            </div>
                            <p>
                                <i class="bi bi-quote quote-icon-left"></i>
                                <span>Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor
                                    noster veniam enim
                                    culpa labore duis sunt culpa nulla illum cillum fugiat legam esse veniam culpa
                                    fore nisi cillum
                                    quid.</span>
                                <i class="bi bi-quote quote-icon-right"></i>
                            </p>
                        </div>
                    </div><!-- End testimonial item -->

                </div>
                <div class="swiper-pagination"></div>
            </div>

        </div>

    </section><!-- /Testimonials Section -->

    <section id="faq" class="faq section light-background">

        <div class="container-fluid">

            <div class="row gy-4">

                <div class="col-lg-7 d-flex flex-column justify-content-center order-2 order-lg-1">

                    <div class="content px-xl-5" data-aos="fade-up" data-aos-delay="100">
                        <h3><span>Frequently Asked </span><strong>Questions</strong></h3>
                        <p>
                            Punya pertanyaan seputar kelas atau layanan Monobi? Tenang, kami sudah rangkum jawaban
                            dari pertanyaan
                            yang paling sering ditanyakan di bawah ini!
                        </p>
                    </div>

                    <div class="faq-container px-xl-5" data-aos="fade-up" data-aos-delay="200">

                        <div class="faq-item faq-active">
                            <i class="faq-icon bi bi-question-circle"></i>
                            <h3>Siapa saja yang bisa ikut kelas di Monobi?</h3>
                            <div class="faq-content">
                                <p>Semua orang bisa ikut! Kelas-kelas kami terbuka untuk anak-anak mulai usia 3
                                    tahun, remaja, hingga
                                    dewasa tanpa batasan usia.</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item-->

                        <div class="faq-item">
                            <i class="faq-icon bi bi-question-circle"></i>
                            <h3>Apakah harus punya pengalaman seni sebelumnya?</h3>
                            <div class="faq-content">
                                <p>Tidak perlu! Semua kelas dirancang untuk pemula maupun yang sudah berpengalaman.
                                    Kamu akan
                                    dibimbing langkah demi langkah oleh instruktur kami.</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item-->

                        <div class="faq-item">
                            <i class="faq-icon bi bi-question-circle"></i>
                            <h3>Apa saja yang perlu saya bawa untuk ikut kelas?</h3>
                            <div class="faq-content">
                                <p>Tidak perlu membawa apa pun—semua bahan dan peralatan sudah kami sediakan. Kamu
                                    tinggal datang dan
                                    berkarya!</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item-->

                    </div>

                </div>

                <div class="col-lg-5 order-1 order-lg-2">
                    <img src="{{ asset('landing-page/assets/img/faq.jpg') }}" class="img-fluid" alt=""
                        data-aos="zoom-in" data-aos-delay="100">
                </div>
            </div>

        </div>

    </section><!-- /Faq Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Contact</h2>
            <div><span>Check Our</span> <span class="description-title">Contact</span></div>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade" data-aos-delay="100">

            <div class="row gy-4">

                <div class="col-lg-4">
                    <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
                        <i class="bi bi-geo-alt flex-shrink-0"></i>
                        <div>
                            <h3>Address</h3>
                            <p>Jl Arwana no 6 Ulak Karang, Padang, Indonesia 25134</p>
                        </div>
                    </div><!-- End Info Item -->

                    <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                        <i class="bi bi-telephone flex-shrink-0"></i>
                        <div>
                            <h3>Call Us</h3>
                            <p>+62 822-4456-8338</p>
                        </div>
                    </div><!-- End Info Item -->

                    <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                        <i class="bi bi-envelope flex-shrink-0"></i>
                        <div>
                            <h3>Email Us</h3>
                            <p>monobi@gmail.com</p>
                        </div>
                    </div><!-- End Info Item -->

                </div>

                <div class="col-lg-8">
                    <form action="" method="post" class="php-email-form" data-aos="fade-up"
                        data-aos-delay="200">
                        <div class="row gy-4">

                            <div class="col-md-6">
                                <input type="text" name="name" class="form-control" placeholder="Nama Anda"
                                    required="">
                            </div>

                            <div class="col-md-6 ">
                                <input type="email" class="form-control" name="email" placeholder="Email Anda"
                                    required="">
                            </div>

                            <div class="col-md-12">
                                <input type="text" class="form-control" name="subject" placeholder="Subject"
                                    required="">
                            </div>

                            <div class="col-md-12">
                                <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
                            </div>

                            <div class="col-md-12 text-center">
                                <div class="loading">Loading</div>
                                <div class="error-message"></div>
                                <div class="sent-message">Your message has been sent. Thank you!</div>

                                <button type="submit">Send Message</button>
                            </div>

                        </div>
                    </form>
                </div><!-- End Contact Form -->

            </div>

        </div>

    </section><!-- /Contact Section -->
</x-app>
