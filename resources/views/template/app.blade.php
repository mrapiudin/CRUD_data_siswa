<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap"rel="stylesheet"/>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="sweetalert2.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Sidebar menu</title>
</head>
@stack('style')

<body id="body">

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Quicksand:wght@400;700&display=swap");

        /*===== VARIABLES CSS Y SASS =====*/
        /*Varibles sass*/
        /*Variables css*/
        /*===== Colores =====*/
        :root {
            --first-color: #002034;
            --second-color: #2aafe3;
            --white-color: hsl(0, 0%, 100%);
        }

        /*===== Fuente y tipografia =====*/
        :root {
            --body-font: 'Quicksand', sans-serif;
            --small-font-size: 0.875rem;
        }

        @media screen and (min-width: 768px) {
            :root {
                --small-font-size: 0.938rem;
            }
        }

        /*===== z index =====*/
        :root {
            --z-back: -10;
            --z-normal: 1;
            --z-tooltip: 10;
            --z-fixed: 100;
            --z-modal: 1000;
        }

        /*===== BASE =====*/
        *,
        ::before,
        ::after {
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }

        body {
            position: relative;
            margin: 0;
            padding: 1rem 0 0 5rem;
            font-family: var(--body-font);
            background-color: var(--white-color);
            -webkit-transition: .5s;
            transition: .5s;
        }

        h1 {
            margin: 0;
        }

        ul,
        li {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        a {
            text-decoration: none;
        }

        /*=====  NAV =====*/
        .l-navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 56px;
            height: 100vh;
            background-color: var(--first-color);
            padding: 1.25rem .5rem 2rem;
            -webkit-transition: .5s;
            transition: .5s;
            z-index: var(--z-fixed);
        }

        .nav {
            height: 100%;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            -webkit-box-pack: justify;
            -ms-flex-pack: justify;
            justify-content: space-between;
            overflow: hidden;
        }

        .nav__logo {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            margin-bottom: 2rem;
            padding: 0 .5rem;
        }

        .nav__logo-icon {
            margin-right: 1.2rem;
        }

        .nav__logo-text {
            color: var(--white-color);
            font-weight: 700;
        }

        .nav__toggle {
            position: absolute;
            top: 1.10rem;
            right: -.6rem;
            width: 18px;
            height: 18px;
            background-color: var(--second-color);
            border-radius: 50%;
            font-size: 1.25rem;
            color: var(--first-color);
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            cursor: pointer;
            -webkit-transition: .5s;
            transition: .5s;
        }

        .nav__link {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            padding: .5rem;
            margin-bottom: 1rem;
            border-radius: .5rem;
            color: var(--white-color);
            -webkit-transition: .3s;
            transition: .3s;
        }

        .nav__link:hover {
            background-color: var(--second-color);
            color: var(--first-color);
        }

        .nav__icon {
            font-size: 1.5rem;
            margin-right: 1rem;
        }

        .nav__text {
            font-weight: 700;
        }

        /*Show menu*/
        .show {
            width: 168px;
        }

        /*Rotate toggle*/
        .rotate {
            -webkit-transform: rotate(180deg);
            transform: rotate(180deg);
            -webkit-transition: .5s;
            transition: .5s;
        }

        /*Active links menu*/
        .active {
            background-color: var(--second-color);
            color: var(--first-color);
        }

        /*Add padding body*/
        .expander {
            padding: 1rem 0 0 12rem;
            -webkit-transition: .5s;
            transition: .5s;
        }

        .atas {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin-bottom: 2rem;
        }
    </style>
    <div class="l-navbar" id="navbar">
        <nav class="nav">
            <div>
                <div class="atas">
                    <h1 style="color: white">ADUKAN</h1>
                    <span style="color: white;" >{{ Auth::user()->name }}</span>
                </div>
                <div class="nav__toggle" id="nav-toggle">
                    <i class='bx bx-chevron-right'></i>
                </div>

                <ul class="nav__list">
                    {{-- <a href="{{ route('guest.dashboard_guest') }}"
                        class="nav__link {{ Route::is('guest.dashboard_guest') ? 'active' : '' }}">
                        <i class='bx bx-grid-alt nav__icon'></i>
                        <span class="nav__text">Home</span>
                    </a>

                    <a href="{{ route('guest.keluhan') }}"
                        class="nav__link {{ Route::is('guest.keluhan') ? 'active' : '' }}">
                        <i class='bx bx-plus nav__icon'></i>
                        <span class="nav__text">Pengaduan</span>
                    </a> --}}

                    <a href="{{ route('staff.dashboard_staff')}}" 
                        class="nav__link {{ Route::is('staff.dashboard_staff') ? 'active' : '' }}">
                        <i class='bx bx-user nav__icon'></i>
                        <span class="nav__text">Staff</span>
                    </a>

                    {{-- <a href="{{route('headstaff.dashboard')}}" class="nav__link {{Route::is('headstaff.dashboard') ? 'active' : ''}}">
                        <i class='bx bx-user nav__icon'></i>
                        <span class="nav__text">Head staff</span>
                    </a>

                    <a href="{{route('headstaff.diagram')}}" class="nav__link {{Route::is('headstaff.diagram') ? 'active' : ''}}">    
                        <i class='bx bxs-bar-chart-alt-2'></i>
                        <span class="nav__text"> Diagram</span> 
                    </a>
                     --}}
                    {{-- <a href="{{ route('headstaff.dashboard_admin') }}" 
                        class="nav__link {{Route::is('headstaff.dashboard_admin') ? 'active' : ''}}">
                        <i class='bx bx-heart nav__icon'></i>
                        <span class="nav__text">head staff</span>
                    </a> --}}

                   
                </ul>
            </div>
            <a href="#" class="nav__link">
                <i class='bx bx-log-out-circle nav__icon'></i>
                <span class="nav__text">Close</span>
            </a>
        </nav>
    </div>

    @yield('content-dinamis')
    <script>
        // SHOW MENU
        const showMenu = (toggleId, navbarId, bodyId) => {
            const toggle = document.getElementById(toggleId),
                navbar = document.getElementById(navbarId),
                bodypadding = document.getElementById(bodyId)

            if (toggle && navbar) {
                toggle.addEventListener('click', () => {
                    // APARECER MENU
                    navbar.classList.toggle('show')
                    // ROTATE TOGGLE
                    toggle.classList.toggle('rotate')
                    // PADDING BODY
                    bodypadding.classList.toggle('expander')
                })
            }
        }
        showMenu('nav-toggle', 'navbar', 'body')

        // LINK ACTIVE COLOR
        const linkColor = document.querySelectorAll('.nav__link');

        function colorLink() {
            linkColor.forEach(l => l.classList.remove('active'));
            this.classList.add('active');
        }

        linkColor.forEach(l => l.addEventListener('click', colorLink));
    </script>
    @stack('script')
</body>

</html>
