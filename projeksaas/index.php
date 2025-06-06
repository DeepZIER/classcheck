<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SIJA - Sistem Informasi Jaringan dan Aplikasi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="assets/style/index.css" />
</head>

<body>
    <header>
        <div class="logo"><img src="./assets/files/logoSIJA.png" alt="" /></div>
        <nav class="nav-links">
            <a href="#beranda">Beranda</a>
            <a href="#tentang">Tentang</a>
            <a href="#guru">Guru</a>
            <a href="#mata-pelajaran">Mata Pelajaran</a>
            <a href="#galeri">Galeri</a>
            <a href="#kontak">Kontak</a>
        </nav>
        <!-- <button class="login-btn">Log In</button> -->
        <button class="mobile-menu-btn" style="display: none">
        <i class="fas fa-bars"></i>
      </button>
    </header>

    <div class="mobile-menu">
        <button class="close-menu">
        <i class="fas fa-times"></i>
      </button>
        <div class="mobile-links">
            <a href="#beranda">Beranda</a>
            <a href="#tentang">Tentang</a>
            <a href="#guru">Guru</a>
            <a href="#mata-pelajaran">Mata Pelajaran</a>
            <a href="#galeri">Galeri</a>
            <a href="#kontak">Kontak</a>

            <button class="cta-btn">Log In</button>
        </div>
    </div>

    <div class="overlay"></div>

    <section class="hero" id="beranda">
        <div class="hero-content">
            <img src="./assets/files/logoSIJA.png" alt="" />
            <h1>Selamat Datang di SIJA</h1>
            <p>
                SIJA (Sistem Informasi Jaringan dan Aplikasi) merupakan salah satu jurusan yang ada di SMK Negeri 26 Jakarta. Jurusan ini memberikan siswa dengan pengetahuan dan keterampilan di bidang jaringan komputer, pemrograman aplikasi, serta sistem informasi berbasis
                industri. Siapkan dirimu untuk menjadi teknisi IT yang terampil di dunia industri dan teknologi.
            </p>
            <a href="login/login.php" class="cta-btn pulse">Pergi Ke Ruang Alat? <i class="fas fa-arrow-right"></i
        ></a>
        </div>
    </section>

    <section class="" id="tentang">
        <h2 class="section-title">Tentang SIJA</h2>
        <div class="about-content animate-fade-in">
            <p>
                Jurusan SIJA merupakan salah satu jurusan yang dirancang sebagai program keahlian 4 tahun yang fokus pada pengembangan teknologi jaringan komputer, pemrograman aplikasi, serta sistem informasi berbasis industri. Dengan 4 tahun masa pendidikan, siswa akan
                dibekali tidak hanya dengan teori tapi juga praktik untuk menjamin pembelajaran berbasis proyek, mengacu industri, serta kurikulum yang terintegrasi dengan kebutuhan dunia kerja.
            </p>
        </div>
    </section>
    <!--  -->
    <section class="stats-section">
        <div class="stats-container">
            <!-- Siswa -->
            <div class="stat-card">
                <div class="icon-wrapper">
                    <!-- Icon orang -->
                    <div class="stat-icon"><i class="fas fa-user-graduate"></i></div>
                </div>
                <div class="stat-number counter" data-target="345">0</div>
                <div class="stat-label">Siswa</div>
            </div>

            <!-- Pengajar -->
            <div class="stat-card">
                <div class="icon-wrapper">
                    <!-- Icon pengajar -->
                    <div class="stat-icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                </div>
                <div class="stat-number counter" data-target="4">0</div>
                <div class="stat-label">Pengajar</div>
            </div>

            <!-- Ruang -->
            <div class="stat-card">
                <div class="icon-wrapper">
                    <!-- Icon ruang -->
                    <div class="stat-icon">
                        <i class="fas fa-school"></i>
                    </div>
                </div>
                <div class="stat-number counter" data-target="10">0</div>
                <div class="stat-label">Ruang</div>
            </div>

            <!-- Mapel -->
            <div class="stat-card">
                <div class="icon-wrapper">
                    <!-- Icon mapel -->
                    <div class="stat-icon">
                        <i class="fas fa-book"></i>
                    </div>
                </div>
                <div class="stat-number counter" data-target="9">0</div>
                <div class="stat-label">Mapel</div>
            </div>

            <!-- Perusahaan -->
            <div class="stat-card">
                <div class="icon-wrapper">
                    <!-- Icon perusahaan -->
                    <div class="stat-icon">
                        <i class="fas fa-handshake"></i>
                    </div>
                </div>
                <div class="stat-number counter" data-target="35">0</div>
                <div class="stat-label">Perusahaan</div>
            </div>
        </div>
    </section>
    <!--  -->

    <section class="section" id="guru">
        <h2 class="section-title">Meet Our Teachers</h2>
        <div class="teachers">
            <div class="teacher-card animate-fade-in">
                <div class="teacher-img">
                    <img src="./assets/files/teacher/pur.png" alt="" />
                </div>
                <div class="teacher-info">
                    <h3>Purwanto, M.Kom</h3>
                    <p>Guru Jurusan</p>
                </div>
            </div>
            <div class="teacher-card animate-fade-in">
                <div class="teacher-img">
                    <img src="./assets/files/teacher/kuri.png" alt="" />
                </div>
                <div class="teacher-info">
                    <h3>Kuri Asih, SE, S.Kom.</h3>
                    <p>Guru Jurusan</p>
                </div>
            </div>
            <div class="teacher-card animate-fade-in">
                <div class="teacher-img">
                    <img src="./assets/files/teacher/rizqo.jpg" alt="" />
                </div>
                <div class="teacher-info">
                    <h3>Rizqo</h3>
                    <p>Guru Jurusan</p>
                </div>
            </div>
            <div class="teacher-card animate-fade-in">
                <div class="teacher-img">
                    <img src="./assets/files/teacher/yopi.png" alt="" />
                </div>
                <div class="teacher-info">
                    <h3>Drs. H. Sutaryo</h3>
                    <p>Kepala Jurusan</p>
                </div>
            </div>
        </div>
    </section>

    <div class="wrap">
        <section class="section" id="mata-pelajaran">
            <h2 class="section-title">Mata Pelajaran</h2>
            <div class="subjects">
                <div class="subject-card animate-fade-in">
                    <div class="subject-icon floating">
                        <i class="fas fa-laptop-code"></i>
                    </div>
                    <h3>Sistem Komputer</h3>
                    <p>
                        Mempelajari sistem komputer dari sisi hardware, interkoneksi antar komponen, serta pemahaman dasar tentang prinsip kerja komputer. Siswa akan memahami arsitektur dasar komputer serta memecahkan masalah.
                    </p>
                </div>
                <div class="subject-card animate-fade-in">
                    <div class="subject-icon floating">
                        <i class="fas fa-network-wired"></i>
                    </div>
                    <h3>Komputer dan Jaringan Dasar</h3>
                    <p>
                        Komputer dan jaringan dasar mengajarkan prinsip-prinsip jaringan komputer, instalasi sistem operasi, setting IP address, serta membangun jaringan dasar dalam skala kecil.
                    </p>
                </div>
                <div class="subject-card animate-fade-in">
                    <div class="subject-icon floating">
                        <i class="fas fa-code"></i>
                    </div>
                    <h3>Pemrograman Dasar</h3>
                    <p>
                        Pemrograman dasar mengajarkan logika pemrograman, algoritma dasar, flowchart, serta implementasi dalam bahasa pemrograman dasar seperti C++ dan Python.
                    </p>
                </div>
                <div class="subject-card animate-fade-in">
                    <div class="subject-icon floating">
                        <i class="fas fa-database"></i>
                    </div>
                    <h3>Dasar Desain Grafis</h3>
                    <p>
                        Siswa belajar prinsip-prinsip desain, penggunaan tools desain grafis, editing gambar, layout, logo, serta pengenalan UI/UX dasar.
                    </p>
                </div>
                <div class="subject-card animate-fade-in">
                    <div class="subject-icon floating">
                        <i class="fas fa-globe"></i>
                    </div>
                    <h3>Sistem Informasi IoT (Things)</h3>
                    <p>
                        Sistem Internet of Things mempelajari konsep IoT, sensor, aktuator, komunikasi data, cloud computing, serta implementasi sistem smart-home, wearable devices dan proyek IoT lainnya.
                    </p>
                </div>
                <div class="subject-card animate-fade-in">
                    <div class="subject-icon floating">
                        <i class="fas fa-server"></i>
                    </div>
                    <h3>Sistem Komunikasi Jaringan</h3>
                    <p>
                        Mempelajari teknologi jaringan lanjutan, topologi kompleks, routing, switching, keamanan jaringan, serta implementasi jaringan untuk kebutuhan perusahaan.
                    </p>
                </div>
                <div class="subject-card animate-fade-in">
                    <div class="subject-icon floating">
                        <i class="fas fa-cloud"></i>
                    </div>
                    <h3>Software as a Service (Saas)</h3>
                    <p>
                        Siswa belajar service layanan berbasis cloud, deployment aplikasi web, customizing aplikasi, integrasi layanan cloud, serta pengelolaan aplikasi berbasis SaaS.
                    </p>
                </div>
                <div class="subject-card animate-fade-in">
                    <div class="subject-icon floating">
                        <i class="fas fa-cubes"></i>
                    </div>
                    <h3>Platform as a Service (PaaS)</h3>
                    <p>
                        Mata pelajaran ini membahas platform cloud sebagai layanan, hosting aplikasi, deployment, scaling, manajemen database cloud, serta pemantauan performa aplikasi.
                    </p>
                </div>
                <div class="subject-card animate-fade-in">
                    <div class="subject-icon floating">
                        <i class="fas fa-hdd"></i>
                    </div>
                    <h3>Infrastructure as a Service (IaaS)</h3>
                    <p>
                        Mempelajari infrastruktur TI berbasis cloud, virtualisasi server, storage cloud, jaringan virtual, serta manajemen sumber daya komputasi berbasis cloud.
                    </p>
                </div>
            </div>
        </section>
    </div>

    <section class="section" id="gedung">
        <h2 class="section-title">Gedung SIJA</h2>
        <div class="building animate-fade-in">
            <img src="assets/files/gedung-sija/sija1.jpg" alt="Gedung SIJA" class="building-img" />
        </div>
    </section>

    <section class="section" id="galeri">
        <h2 class="section-title">Our Memory</h2>
        <div class="memory-gallery">
            <img src="assets/files/memory/memory1.jpg" alt="Memory 1" class="memory-img animate-fade-in" />
            <img src="assets/files/memory/memory2.jpg" alt="Memory 2" class="memory-img animate-fade-in" />
            <img src="assets/files/memory/memory3.jpg" alt="Memory 3" class="memory-img animate-fade-in" />
            <img src="assets/files/memory/memory4.jpg" alt="Memory 4" class="memory-img animate-fade-in" />
            <img src="assets/files/memory/memory5.jpg" alt="Memory 5" class="memory-img animate-fade-in" />
            <img src="assets/files/memory/memory6.jpg" alt="Memory 6" class="memory-img animate-fade-in" />
            <img src="assets/files/memory/memory7.jpg" alt="Memory 7" class="memory-img animate-fade-in" />
            <img src="assets/files/memory/memory8.jpg" alt="Memory 8" class="memory-img animate-fade-in" />
        </div>
    </section>

    <footer id="kontak">
        <div class="footer-content">
            <div class="footer-section">
                <h3>Tentang Kami</h3>
                <p>
                    SIJA SMK Negeri 26 Jakarta adalah jurusan yang fokus pada pengembangan keterampilan di bidang sistem informasi dan jaringan.
                </p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div class="footer-section">
                <h3>Informasi Kontak</h3>
                <p>
                    <i class="fas fa-map-marker-alt"></i> Jl. Balai Pustaka Baru I, Jakarta Timur
                </p>
                <p><i class="fas fa-phone"></i> (021) 123-456</p>
                <p><i class="fas fa-envelope"></i> info@sija26jkt.sch.id</p>
            </div>
            <div class="footer-section">
                <h3>Link Penting</h3>
                <a href="https://smkn26jt.smarteschool.id/web">Website Sekolah</a>
                <a href="#https://smkn26jkt.smarteschool.id/smartschool/login">Portal Siswa</a
          >
          <a href="#https://smkn26jkt.smarteschool.id/smartschool/login"
            >E-Learning</a
          >
          <a href="#">Perpustakaan</a>
            </div>
            <div class="footer-section">
                <h3>Kirim Pesan</h3>
                <form>
                    <input type="email" placeholder="Email Anda" style="
                width: 100%;
                padding: 0.5rem;
                margin-bottom: 1rem;
                border-radius: 5px;
                border: none;
              " />
                    <textarea placeholder="Pesan Anda" style="
                width: 100%;
                padding: 0.5rem;
                margin-bottom: 1rem;
                border-radius: 5px;
                border: none;
                height: 100px;
              "></textarea>
                    <button type="submit" class="cta-btn" style="width: 100%">
              Kirim
            </button>
                </form>
            </div>
        </div>
        <div class="copyright">
            <p>&copy; 2025 SIJA SMK Negeri 26 Jakarta. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Mobile menu functionality
        const mobileMenuBtn = document.querySelector(".mobile-menu-btn");
        const closeMenuBtn = document.querySelector(".close-menu");
        const mobileMenu = document.querySelector(".mobile-menu");
        const overlay = document.querySelector(".overlay");

        mobileMenuBtn.addEventListener("click", () => {
            mobileMenu.classList.add("active");
            overlay.classList.add("active");
            document.body.style.overflow = "hidden";
        });

        closeMenuBtn.addEventListener("click", () => {
            mobileMenu.classList.remove("active");
            overlay.classList.remove("active");
            document.body.style.overflow = "auto";
        });

        overlay.addEventListener("click", () => {
            mobileMenu.classList.remove("active");
            overlay.classList.remove("active");
            document.body.style.overflow = "auto";
        });

        // Animation on scroll
        const animatedElements = document.querySelectorAll(".animate-fade-in");

        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add("visible");
                    }
                });
            }, {
                threshold: 0.1,
            }
        );

        animatedElements.forEach((element) => {
            observer.observe(element);
        });

        // Smooth scrolling for navigation
        document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
            anchor.addEventListener("click", function(e) {
                e.preventDefault();

                const targetId = this.getAttribute("href");
                const targetElement = document.querySelector(targetId);

                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 70,
                        behavior: "smooth",
                    });

                    // Close mobile menu if open
                    mobileMenu.classList.remove("active");
                    overlay.classList.remove("active");
                    document.body.style.overflow = "auto";
                }
            });
        });

        //
        const counters = document.querySelectorAll(".counter");

        counters.forEach((counter) => {
            counter.innerText = "0";
            const updateCounter = () => {
                const target = +counter.getAttribute("data-target");
                const count = +counter.innerText;
                const increment = Math.ceil(target / 50);

                if (count < target) {
                    counter.innerText = `${Math.min(count + increment, target)}`;
                    setTimeout(updateCounter, 30);
                } else {
                    counter.innerText = target;
                }
            };

            // Trigger saat elemen terlihat
            const observer = new IntersectionObserver(
                (entries) => {
                    if (entries[0].isIntersecting) {
                        updateCounter();
                        observer.disconnect();
                    }
                }, {
                    threshold: 0.5,
                }
            );

            observer.observe(counter);
        });
        //

        window.addEventListener("scroll", function() {
            const header = document.querySelector("header");
            header.classList.toggle("scrolled", window.scrollY > 10);
        });
    </script>
</body>

</html>