<!DOCTYPE html>
   <html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.css">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
      <title>hi</title>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    </head>
    @stack('style')

    <style>
         @import url("https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz,wght@6..12,200..1000&display=swap");
        .sidebar {
            width: 200px; /* adjust the width to your liking */
            background-color: #f0f0f0; /* light gray background */
            padding: 10px;
            border: 1px solid #ddd; /* light gray border */
            border-radius: 10px; /* rounded corners */
        }
        
        .logo {
            margin-bottom: 20px;
        }
        
        .logo img {
            width: 50px; /* adjust the logo size to your liking */
            height: 50px;
            border-radius: 50%; /* circular logo */
        }
        
        ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        li {
            margin-bottom: 10px;
        }
        
        a {
            text-decoration: none;
            color: #337ab7; /* blue text color */
        }
        
        a:hover {
            color: #23527c; /* darker blue text color on hover */
        }
        /*=============== VARIABLES CSS ===============*/
        :root {
            --header-height: 2rem;
        
            /*========== Colors ==========*/
            /*Color mode HSL(hue, saturation, lightness)*/
            --first-color: hsl(228, 85%, 63%);
            --title-color: hsl(228, 18%, 16%);
            --text-color: hsl(228, 8%, 56%);
            --body-color: hsl(228, 100%, 99%);
            --shadow-color: hsla(228, 80%, 4%, .1);
        
            /*========== Font and typography ==========*/
            /*.5rem = 8px | 1rem = 16px ...*/
            --body-font: "Nunito Sans", system-ui;
            --normal-font-size: .938rem;
            --smaller-font-size: .75rem;
            --tiny-font-size: .75rem;
        
            /*========== Font weight ==========*/
            --font-regular: 400;
            --font-semi-bold: 600;
        
            /*========== z index ==========*/
            --z-tooltip: 10;
            --z-fixed: 100;
        }
        
        /*========== Responsive typography ==========*/
        @media screen and (min-width: 1150px) {
            :root {
            --normal-font-size: 1rem;
            --smaller-font-size: .813rem;
            }
        }
        
        /*=============== BASE ===============*/
        * {
            box-sizing: border-box;
            padding: 0;
            margin: 0;
        }
        
        body {
            font-family: var(--body-font);
            font-size: var(--normal-font-size);
            background-color: var(--body-color);
            color: var(--text-color);
            transition: background-color .4s;
        }
        
        a {
            text-decoration: none;
        }
        
        img {
            display: block;
            max-width: 100%;
            height: auto;
        }
        
        button {
            all: unset;
        }
        
        /*=============== VARIABLES DARK THEME ===============*/
        body.dark-theme {
            --first-color: hsl(228, 70%, 63%);
            --title-color: hsl(228, 18%, 96%);
            --text-color: hsl(228, 12%, 61%);
            --body-color: hsl(228, 24%, 16%);
            --shadow-color: hsla(228, 80%, 4%, .3);
        }
        .dark-theme .sidebar__content::-webkit-scrollbar {
            background-color: hsl(228, 16%, 30%);
        }
        
        .dark-theme .sidebar__content::-webkit-scrollbar-thumb {
            background-color: hsl(228, 16%, 40%);
        }
        
        /*=============== REUSABLE CSS CLASSES ===============*/
        .container {
            margin-inline: 1.5rem;
        }
        
        .main {
            padding-top: 5rem;
        }
        
        /*=============== HEADER ===============*/
        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: var(--z-fixed);
            margin: .75rem; 
        }
        
        .header__container {
            width: 100%;
            height: var(--header-height);
            background-color: var(--body-color);
            box-shadow: 0 2px 24px var(--shadow-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-inline: 1.5rem;
            border-radius: 1rem;
            transition: background-color .4s;
        }
        
        .header__logo {
            display: inline-flex;
            align-items: center;
            column-gap: .25rem;
        }
        
        .header__logo i {
            font-size: 1.5rem;
            color: var(--first-color);
        }
        
        .header__logo span {
            color: var(--title-color);
            font-weight: var(--font-semi-bold);
        }
        
        .header__toggle {
            font-size: 1.5rem;
            color: var(--title-color);
            cursor: pointer;
        }
        
        /*=============== SIDEBAR ===============*/
        .sidebar {
            position: fixed;
            left: -120%;
            top: 0;
            bottom: 0;
            z-index: var(--z-fixed);
            width: 280px;
            background-color: var(--body-color);
            box-shadow: 2px 0 24px var(--shadow-color);
            padding-block: 1.5rem;
            margin: .75rem;
            border-radius: 1rem;
            transition: left .4s, background-color .4s, width .4s;
        }
        
        .sidebar__container, 
        .sidebar__content {
            display: flex;
            flex-direction: column;
            row-gap: 3rem;
        }
        
        .sidebar__container {
            height: 100%;
            overflow: hidden;
        }
        
        .sidebar__user {
            display: grid;
            grid-template-columns: repeat(2, max-content);
            align-items: center;
            column-gap: 1rem;
            padding-left: 2rem;
        }
        
        .sidebar__img {
            position: relative;
            width: 40px;
            height: 40px;
            background-color: var(--first-color);
            border-radius: 50%;
            overflow: hidden;
            display: grid;
            justify-items: center;
        }
        
        .sidebar__img img {
            position: absolute;
            width: 36px;
            bottom: -1px;
        }
        
        .sidebar__info h3 {
            font-size: 0.9rem;
            color: var(--title-color);
            transition: color .4s;
        }
        
        .sidebar__info span {
            font-size: 0.9rem;
        }
        
        .sidebar__content {
            overflow: hidden auto;
        }
        
        .sidebar__content::-webkit-scrollbar {
            width: .3rem;
            background-color: hsl(228, 8%, 85%);
        }
        
        .sidebar__content::-webkit-scrollbar-thumb {
            background-color: hsl(228, 8%, 75%);
        }
        

        
        .sidebar__list, 
        .sidebar__actions {
            display: grid;
            row-gap: 1.5rem;
        }
        
        .sidebar__link {
            position: relative;
            display: grid;
            grid-template-columns: repeat(2, max-content);
            align-items: center;
            column-gap: 1rem;
            color: var(--text-color);
            padding-left: 2rem;
            transition: color .4s, opacity .4s;
        }
        
        .sidebar__link i {
            font-size: 1.25rem;
        }
        
        .sidebar__link span {
            font-weight: var(--font-semi-bold);
        }
        
        .sidebar__link:hover {
            color: var(--first-color);
        }
        
        .sidebar__actions {
            margin-top: auto;
        }
        
        .sidebar__actions button {
            cursor: pointer;
        }
        
        .sidebar__theme {
            width: 100%;
            font-size: 1.25rem;
        }
        
        .sidebar__theme span {
            font-size: var(--normal-font-size);
            font-family: var(--body-font);
        }
        
        /* Show sidebar */
        .show-sidebar {
            left: 0;
        }
        
        /* Active link */
        .active-link {
            color: var(--first-color);
        }
        
        .active-link::after {
            content: "";
            position: absolute;
            left: 0;
            width: 3px;
            height: 20px;
            background-color: var(--first-color);
        }
        
        /*=============== BREAKPOINTS ===============*/
        /* For small devices */
        @media screen and (max-width: 360px) {
            .header__container {
            padding-inline: 1rem;
            }
        
            .sidebar {
            width: max-content;
            }
            .sidebar__info, 
            .sidebar__link span {
            display: none;
            }
            .sidebar__user, 
            .sidebar__list, 
            .sidebar__actions {
            justify-content: center;
            }
            .sidebar__user, 
            .sidebar__link {
            grid-template-columns: max-content;
            }
            .sidebar__user {
            padding: 0;
            }
            .sidebar__link {
            padding-inline: 2rem;
            }
        }
        
        /* For large devices */
        @media screen and (min-width: 1150px) {
            .header {
            margin: 1rem;
            padding-left: 290px;
            transition: padding .4s;
            }
            .header__container {
            height: calc(var(--header-height) + 2rem);
            padding-inline: 2rem;
            }
            .header__logo {
            order: 1;
            }
        
            .sidebar {
            left: 0;
            width: 270px;
            margin: .70rem;
            }
            .sidebar__info, 
            .sidebar__link span {
            transition: opacity .4s;
            }
            .sidebar__user {
            transition: padding .4s;
            }
        
            /* Reduce sidebar */
            .show-sidebar {
            width: 90px;
            }
            .show-sidebar .sidebar__user {
            padding-left: 1.25rem;
            }
            .show-sidebar {
            padding-left: 0;
            margin-inline: auto;
            }
            .show-sidebar .sidebar__info, 
            .show-sidebar .sidebar__link span {
            opacity: 0;
            }
        
            .main {
            padding-left: 285px;
            padding-top: 7rem;
            transition: padding .4s;
            }
        
            /* Add padding left */
            .left-pd {
            padding-left: 90px;
            }
        } 
    </style>
   <body>
      <header class="header" id="header">
         <div class="header__container">
            <a href="#" class="header__logo">
               <i class="ri-cloud-fill"></i>
               <span>Cloud</span>
            </a>
            
            <button class="header__toggle" id="header-toggle">
               <i class="ri-menu-line"></i>
            </button>
         </div>
      </header>

      <!--=============== SIDEBAR ===============-->
      <nav class="sidebar" id="sidebar">
         <div class="sidebar__container">
            <div class="sidebar__user">
               <div class="sidebar__img">
                  <img src="public/img/profil">
               </div>
   
               <div class="sidebar__info">
                  <h3>EUNOLA</h3>
                  <span>emaileunola@gmail.com</span>
               </div>
            </div>

            <div class="sidebar__content">
               <div>

                  <div class="sidebar__list">
                     <a href="{{ route('home') }}" class="sidebar__link {{ Route::is('home') ? 'active-link' : '' }}">
                        <i class="ri-dashboard-line"></i>
                        <span>Dashboard</span>
                     </a>
                     
                     <a href="{{route('data_siswa.data')}}" class="sidebar__link {{ Route::is('data_siswa.data') ? 'active-link' : '' }}" >
                        <i class="ri-user-add-line"></i>
                        <span>Data siswa</span>
                     </a>

                     <a href="#" class="sidebar__link">
                        <i class="ri-user-line"></i>
                        <span>Murid XI</span>
                     </a>

                     <a href="#" class="sidebar__link">
                        <i class="ri-user-line"></i>
                        <span>Murid X</span>
                     </a>

                     <a href="#" class="sidebar__link">
                        <i class="ri-team-fill"></i>
                        <span>Pengurus</span>
                     </a>
                  </div>
               </div>

               <div>

                  <div class="sidebar__list">
                    <a href="{{route('kelola_siswa.siswa')}}" class="sidebar__link {{ Route::is('kelola_siswa.siswa') ? 'active-link' : '' }}" >
                        <i class="ri-admin-line"></i>
                        <span>Peran</span>
                     </a>

                     <a href="#" class="sidebar__link">
                        <i class="ri-contacts-line"></i>
                        <span>Contact</span>
                     </a>

                  </div>
               </div>
            </div>

            <div class="sidebar__actions">
               <button>
                  <i class="ri-moon-clear-fill sidebar__link sidebar__theme" id="theme-button">
                     <span>Theme</span>
                  </i>
               </button>

               <button class="sidebar__link">
                  <i class="ri-logout-box-r-fill"></i>
                  <span>Log Out</span>
               </button>
            </div>
         </div>
      </nav>
      @yield('content-dinamis')

      <script>
        /*=============== DARK LIGHT THEME ===============*/ 
        const themeButton = document.getElementById('theme-button')
        const darkTheme = 'dark-theme'
        const iconTheme = 'ri-sun-fill'
        
        // Previously selected topic (if user selected)
        const selectedTheme = localStorage.getItem('selected-theme')
        const selectedIcon = localStorage.getItem('selected-icon')
        
        // We obtain the current theme that the interface has by validating the dark-theme class
        const getCurrentTheme = () => document.body.classList.contains(darkTheme) ? 'dark' : 'light'
        const getCurrentIcon = () => themeButton.classList.contains(iconTheme) ? 'ri-moon-clear-fill' : 'ri-sun-fill'
        
        // We validate if the user previously chose a topic
        if (selectedTheme) {
        // If the validation is fulfilled, we ask what the issue was to know if we activated or deactivated the dark
        document.body.classList[selectedTheme === 'dark' ? 'add' : 'remove'](darkTheme)
        themeButton.classList[selectedIcon === 'ri-moon-clear-fill' ? 'add' : 'remove'](iconTheme)
        }
        
        // Activate / deactivate the theme manually with the button
        themeButton.addEventListener('click', () => {
            // Add or remove the dark / icon theme
            document.body.classList.toggle(darkTheme)
            themeButton.classList.toggle(iconTheme)
            // We save the theme and the current icon that the user chose
            localStorage.setItem('selected-theme', getCurrentTheme())
            localStorage.setItem('selected-icon', getCurrentIcon())

        })

        const sidebarLink = document.querySelectorAll('.sidebar__list a')
    
    function linkColor(){
        sidebarLink.forEach(l => l.classList.remove('active-link'))
        this.classList.add('active-link')
    }
    sidebarLink.forEach(l => l.addEventListener('click', linkColor))

        
      </script>

      @stack('script')
   </body>
</html>