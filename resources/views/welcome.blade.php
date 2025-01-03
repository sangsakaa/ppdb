<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DAPOMEET </title>
    <link rel="shortcut icon" href="https://ula.smedi.my.id/asset/images/logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="preload" as="style" href="https://ula.smedi.my.id/build/assets/app.f573eb26.css" />
    <link rel="modulepreload" href="https://ula.smedi.my.id/build/assets/app.964ce7c9.js" />
    <link rel="stylesheet" href="https://ula.smedi.my.id/build/assets/app.f573eb26.css" />
    <script type="module" src="https://ula.smedi.my.id/build/assets/app.964ce7c9.js"></script>
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
</head>
<style>
    .jumbotron {
        padding-top: 6rem;
        background-color: #e2edff;
        padding-bottom: 0%;
    }

    #project {
        background-color: #e2edff;
    }

    .card {
        margin-bottom: 0.5rem;
    }

    .footer {
        padding-bottom: 0%;
    }

    section {
        padding-top: 4rem;
    }

    .p {
        font-family: bold;
    }
</style>

<body id="home">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm fixed-top">
        <div class="container sm:text-xs">
            <a class="navbar-brand uppercase text-sm  " href="/">KARYA MANDIRI</a>
            <div :class="navClasses   hover:hover:bg-sky-300">
                <ul class="navbar-nav ml-auto text-white">
                    @if (Route::has('login'))
                    <div class="  right-0 px-6  sm:block">
                        @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm  text-white px-2 dark:text-gray-900 ">BERANDA</a>
                        @else
                        <a href="{{ route('login') }}" class="text-sm  text-white px-2 dark:text-gray-900 ">MASUK</a>
                        @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-sm  text-white px-2 dark:text-gray-900 ">DAFTAR</a>
                        @endif
                        @endauth
                    </div>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <script>
        export default {
            data() {
                return {
                    isOpen: false,
                };
            },
            computed: {
                navClasses() {
                    return {
                        'collapse navbar-collapse': !this.isOpen,
                        'navbar-collapse': this.isOpen,
                    };
                },
            },
            methods: {
                toggleNav() {
                    this.isOpen = !this.isOpen;
                },
            },
        };
    </script>
    <style scoped>
        /* Tambahkan gaya CSS khusus di sini jika diperlukan */
    </style>
    <section class="jumbotron jumbotron-fluid text-center">
        <center>
            <img src="images/logo.png" alt="" width="200px">
            <h2 class=" ">Pusat Kegiatan Belajar Masyarakat </h2>
            <p class=" uppercase sm:text-3xl text-xs">KARYA MANDIRI</p>
        </center>
    </section>
    <div class=" sm:grid-cols-2 grid grid-cols-1">
        <section class="jumbotron grid justify-items-center ">
            <lord-icon src="https://cdn.lordicon.com/amjaykqd.json" trigger="hover" style="width:223px;height:205px">
            </lord-icon>
            <span>Consultation</span>
        </section>
        <section class="jumbotron  grid justify-items-center     ">
            <lord-icon src="https://cdn.lordicon.com/yypubrzc.json" trigger="hover" style="width:223px;height:205px">
            </lord-icon>
            <span>Development</span>
        </section>
    </div>
    <!-- endfooter -->
    <script src="https://cdn.lordicon.com/lordicon-1.3.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous">
    </script>
    <footer class="jumbotron jumbotron-fluid text-center">
        <div class=" bg-blue-600 h-10">
            <div class=" py-2 text-white   text-xs">
                &copy 2024 sangsaka
            </div>
        </div>
    </footer>
</body>

</html>