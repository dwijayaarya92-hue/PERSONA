<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title', 'Aplikasi Manajemen Pegawai')
    </title>

    {{-- Fonts --}}
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    {{-- DataTables --}}
    <link rel="stylesheet"
          href="https://cdn.datatables.net/2.3.8/css/dataTables.dataTables.min.css">

    {{-- Vite --}}
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    {{-- Dashboard CSS --}}
    <link rel="stylesheet"
          href="{{ asset('css/mantis-dashboard.css') }}">

</head>


<body>

<div id="app">


    {{-- =====================================================
         SIDEBAR
    ====================================================== --}}

    <aside class="mantis-sidebar">

        {{-- LOGO --}}
        <div class="mantis-logo">

            <div>APLIKASI</div>
            <div>MANAJEMEN</div>
            <div>PEGAWAI</div>

        </div>


        {{-- MENU --}}
        <div class="mantis-menu">


            {{-- DASHBOARD --}}
            <a href="{{ route('home') }}"
               class="mantis-menu-item {{ request()->routeIs('home') ? 'active' : '' }}">

                <span class="menu-icon">🏠</span>

                <span>Dashboard</span>

            </a>


            {{-- USERS --}}
            @if(Route::has('users.index'))

                <a href="{{ route('users.index') }}"
                   class="mantis-menu-item {{ request()->routeIs('users.*') ? 'active' : '' }}">

                    <span class="menu-icon">👥</span>

                    <span>Data users</span>

                </a>

            @endif


            {{-- PEGAWAI --}}
            <a href="{{ route('pegawai.index') }}"
               class="mantis-menu-item {{ request()->routeIs('pegawai.*') ? 'active' : '' }}">

                <span class="menu-icon">👤</span>

                <span>Data pegawai</span>

            </a>


            {{-- BAGIAN --}}
            <a href="{{ route('bagian.index') }}"
               class="mantis-menu-item {{ request()->routeIs('bagian.*') ? 'active' : '' }}">

                <span class="menu-icon">🏢</span>

                <span>Data bagian</span>

            </a>

        </div>

    </aside>



    {{-- =====================================================
         MAIN CONTENT
    ====================================================== --}}

    <div class="mantis-main">


        {{-- =================================================
             TOPBAR
        ================================================== --}}

        <header class="mantis-topbar">


            {{-- SEARCH --}}
            <div class="mantis-search">

                <span class="search-icon">
                    🔍
                </span>

                <input
                    type="text"
                    placeholder="Search here..."
                >

            </div>


            {{-- USER --}}
            <div class="mantis-user">

                <span class="message-icon">
                    ✉
                </span>


                @auth

                    <span class="user-avatar">
                        👤
                    </span>

                    <span class="user-name">
                        {{ Auth::user()->name }}
                    </span>


                    <div class="user-dropdown">

                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">

                            Logout

                        </a>


                        <form id="logout-form"
                              action="{{ route('logout') }}"
                              method="POST"
                              style="display:none;">

                            @csrf

                        </form>

                    </div>

                @endauth

            </div>

        </header>



        {{-- =================================================
             PAGE CONTENT
        ================================================== --}}

        <main class="mantis-content">


            {{-- SUCCESS ALERT --}}

            @if(session('success'))

                <div class="alert alert-success alert-dismissible fade show"
                     id="success-alert"
                     role="alert">

                    {{ session('success') }}

                </div>

            @endif


            {{-- ERROR ALERT --}}

            @if(session('error'))

                <div class="alert alert-danger alert-dismissible fade show"
                     role="alert">

                    {{ session('error') }}

                </div>

            @endif


            {{-- CONTENT DARI HOME / PEGAWAI / BAGIAN --}}

            @yield('content')


        </main>



        {{-- =================================================
             FOOTER
        ================================================== --}}

        <footer class="mantis-footer">

            <span>
                Mantis ♥ crafted by Team Codedthemes - Distributed by ThemeWagon
            </span>

            <span>
                Home
            </span>

        </footer>


    </div>

</div>



{{-- =========================================================
     JAVASCRIPT
========================================================= --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script src="https://cdn.datatables.net/2.3.8/js/dataTables.min.js"></script>


<script>

    $(document).ready(function () {

        /*
        |--------------------------------------------------------------------------
        | DATATABLE
        |--------------------------------------------------------------------------
        */

        if ($('#table').length) {

            new DataTable('#table');

        }


        /*
        |--------------------------------------------------------------------------
        | SUCCESS ALERT
        |--------------------------------------------------------------------------
        */

        setTimeout(function () {

            $('#success-alert').fadeOut('slow');

        }, 3000);

    });

</script>


</body>
</html>