<div>

    <nav class="pc-sidebar">

        <div class="navbar-wrapper">

            {{-- ================================================= --}}
            {{-- LOGO / NAMA APLIKASI --}}
            {{-- ================================================= --}}

            <div class="m-header">

                <a href="{{ auth()->check() ? route('home') : route('login') }}"
                   class="b-brand text-primary">

                    <span class="fw-bold">
                        Aplikasi Manajemen Pegawai
                    </span>

                </a>

            </div>


            {{-- ================================================= --}}
            {{-- MENU SIDEBAR --}}
            {{-- ================================================= --}}

            <div class="navbar-content">

                <ul class="pc-navbar">

                    {{-- ================================================= --}}
                    {{-- MENU UNTUK USER YANG SUDAH LOGIN --}}
                    {{-- ================================================= --}}

                    @auth

                        {{-- DASHBOARD --}}
                        <x-sidebar.link
                            title="Dashboard"
                            icon="ti ti-dashboard"
                            route="home"
                        />


                        {{-- ================================================= --}}
                        {{-- CEK ROLE --}}
                        {{-- ================================================= --}}

                        @php
                            $role = strtolower(trim(auth()->user()->role ?? ''));
                        @endphp


                        {{-- ================================================= --}}
                        {{-- DATA USERS --}}
                        {{-- ADMIN & SUPERVISOR --}}
                        {{-- ================================================= --}}

                        @if ($role === 'admin' || $role === 'supervisor')

                            <x-sidebar.link
                                title="Data users"
                                icon="ti ti-users"
                                route="users.index"
                            />

                        @endif


                        {{-- ================================================= --}}
                        {{-- DATA PEGAWAI --}}
                        {{-- ================================================= --}}

                        <x-sidebar.link
                            title="Data pegawai"
                            icon="ti ti-users"
                            route="pegawai.index"
                        />


                        {{-- ================================================= --}}
                        {{-- DATA BAGIAN --}}
                        {{-- ================================================= --}}

                        <x-sidebar.link
                            title="Data bagian"
                            icon="ti ti-building"
                            route="bagian.index"
                        />

                    @endauth

                </ul>

            </div>

        </div>

    </nav>

</div>