<div>

    <header class="pc-header">

        <div class="header-wrapper">

            {{-- ================================================= --}}
            {{-- BAGIAN KIRI --}}
            {{-- ================================================= --}}

            <div class="me-auto pc-mob-drp">

                <ul class="list-unstyled">

                    {{-- MENU SIDEBAR --}}
                    <li class="pc-h-item pc-sidebar-collapse">
                        <a
                            href="#"
                            class="pc-head-link ms-0"
                            id="sidebar-hide"
                            title="Sembunyikan Sidebar">

                            <i class="ti ti-menu-2"></i>

                        </a>
                    </li>


                    {{-- MENU MOBILE --}}
                    <li class="pc-h-item pc-sidebar-popup">

                        <a
                            href="#"
                            class="pc-head-link ms-0"
                            id="mobile-collapse"
                            title="Menu">

                            <i class="ti ti-menu-2"></i>

                        </a>

                    </li>


                    {{-- SEARCH MOBILE --}}
                    <li class="dropdown pc-h-item d-inline-flex d-md-none">

                        <a
                            class="pc-head-link dropdown-toggle arrow-none m-0"
                            data-bs-toggle="dropdown"
                            href="#"
                            role="button"
                            aria-haspopup="false"
                            aria-expanded="false">

                            <i class="ti ti-search"></i>

                        </a>


                        <div class="dropdown-menu pc-h-dropdown drp-search">

                            <form class="px-3">

                                <div class="form-group mb-0 d-flex align-items-center">

                                    <i class="ti ti-search"></i>

                                    <input
                                        type="search"
                                        class="form-control border-0 shadow-none"
                                        placeholder="Cari di sini...">

                                </div>

                            </form>

                        </div>

                    </li>


                    {{-- SEARCH DESKTOP --}}
                    <li class="pc-h-item d-none d-md-inline-flex">

                        <form class="header-search">

                            <i
                                class="ti ti-search icon-search">
                            </i>

                            <input
                                type="search"
                                class="form-control"
                                placeholder="Cari di sini...">

                        </form>

                    </li>

                </ul>

            </div>


            {{-- ================================================= --}}
            {{-- BAGIAN KANAN --}}
            {{-- ================================================= --}}

            <div class="ms-auto">

                <ul class="list-unstyled">


                    {{-- ================================================= --}}
                    {{-- NOTIFIKASI --}}
                    {{-- ================================================= --}}

                    <li class="dropdown pc-h-item">

                        <a
                            class="pc-head-link dropdown-toggle arrow-none me-0"
                            data-bs-toggle="dropdown"
                            href="#"
                            role="button"
                            aria-haspopup="false"
                            aria-expanded="false"
                            title="Notifikasi">

                            <i class="ti ti-mail"></i>

                        </a>


                        <div
                            class="dropdown-menu dropdown-notification dropdown-menu-end pc-h-dropdown"
                            style="width: 360px;">


                            {{-- HEADER NOTIFIKASI --}}
                            <div
                                class="dropdown-header d-flex align-items-center justify-content-between">

                                <h5 class="m-0">
                                    Notifikasi
                                </h5>

                                <a
                                    href="#"
                                    class="pc-head-link bg-transparent">

                                    <i class="ti ti-x text-danger"></i>

                                </a>

                            </div>


                            <div class="dropdown-divider"></div>


                            {{-- ISI NOTIFIKASI --}}
                            <div
                                class="dropdown-header px-0 text-wrap header-notification-scroll position-relative"
                                style="max-height: 300px; overflow-y: auto;">

                                <div class="list-group list-group-flush w-100">


                                    {{-- NOTIFIKASI 1 --}}
                                    <a
                                        href="#"
                                        class="list-group-item list-group-item-action">

                                        <div class="d-flex">

                                            <div class="flex-shrink-0">

                                                <div
                                                    class="avtar avtar-s bg-light-primary">

                                                    <i class="ti ti-user-plus text-primary"></i>

                                                </div>

                                            </div>

                                            <div class="flex-grow-1 ms-3">

                                                <p class="text-body mb-1">
                                                    Selamat datang di
                                                    <b>Aplikasi Manajemen Pegawai</b>.
                                                </p>

                                                <span class="text-muted">
                                                    Sistem siap digunakan.
                                                </span>

                                            </div>

                                        </div>

                                    </a>


                                    {{-- NOTIFIKASI 2 --}}
                                    <a
                                        href="#"
                                        class="list-group-item list-group-item-action">

                                        <div class="d-flex">

                                            <div class="flex-shrink-0">

                                                <div
                                                    class="avtar avtar-s bg-light-success">

                                                    <i class="ti ti-check text-success"></i>

                                                </div>

                                            </div>

                                            <div class="flex-grow-1 ms-3">

                                                <p class="text-body mb-1">
                                                    Data pegawai dapat dikelola
                                                    melalui menu <b>Data Pegawai</b>.
                                                </p>

                                                <span class="text-muted">
                                                    Informasi sistem
                                                </span>

                                            </div>

                                        </div>

                                    </a>


                                </div>

                            </div>


                            <div class="dropdown-divider"></div>


                            <div class="text-center py-2">

                                <span class="text-muted small">
                                    Tidak ada notifikasi baru
                                </span>

                            </div>

                        </div>

                    </li>


                    {{-- ================================================= --}}
                    {{-- PROFILE USER --}}
                    {{-- ================================================= --}}

                    <li class="dropdown pc-h-item header-user-profile">

                        <a
                            class="pc-head-link dropdown-toggle arrow-none me-0"
                            data-bs-toggle="dropdown"
                            href="#"
                            role="button"
                            aria-haspopup="false"
                            data-bs-auto-close="outside"
                            aria-expanded="false">


                            {{-- AVATAR --}}
                            <img
                                src="{{ asset('template/dist/assets/images/user/avatar-2.jpg') }}"
                                alt="user-image"
                                class="user-avtar">


                            {{-- NAMA USER --}}
                            <span>
                                {{ auth()->user()?->name ?? 'Pengguna' }}
                            </span>

                        </a>


                        {{-- ================================================= --}}
                        {{-- DROPDOWN PROFILE --}}
                        {{-- ================================================= --}}

                        <div
                            class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown"
                            style="min-width: 280px;">


                            {{-- HEADER PROFILE --}}
                            <div class="dropdown-header">

                                <div class="d-flex align-items-center">


                                    {{-- AVATAR --}}
                                    <div class="flex-shrink-0">

                                        <img
                                            src="{{ asset('template/dist/assets/images/user/avatar-2.jpg') }}"
                                            alt="user-image"
                                            class="user-avtar wid-45">

                                    </div>


                                    {{-- INFORMASI USER --}}
                                    <div class="flex-grow-1 ms-3">

                                        <h6 class="mb-1">

                                            {{ auth()->user()?->name ?? 'Pengguna' }}

                                        </h6>

                                        <span class="text-muted">

                                            {{ ucfirst(auth()->user()?->role ?? 'staff') }}

                                        </span>

                                    </div>

                                </div>

                            </div>


                            <div class="dropdown-divider"></div>


                            {{-- ================================================= --}}
                            {{-- EDIT PROFIL --}}
                            {{-- ================================================= --}}

                            <a
                                href="{{ route('profile.edit') }}"
                                class="dropdown-item">

                                <i class="ti ti-edit-circle"></i>

                                <span>
                                    Edit Profil
                                </span>

                            </a>


                            {{-- ================================================= --}}
                            {{-- LOGOUT --}}
                            {{-- ================================================= --}}

                            <div class="dropdown-item p-0">

                                <form
                                    action="{{ route('logout') }}"
                                    method="POST"
                                    class="w-100">

                                    @csrf

                                    <button
                                        type="submit"
                                        class="btn btn-danger w-100 text-start rounded-0 border-0 py-2 px-3">

                                        <i class="ti ti-power text-white me-2"></i>

                                        <span>
                                            Logout
                                        </span>

                                    </button>

                                </form>

                            </div>

                        </div>

                    </li>

                </ul>

            </div>

        </div>

    </header>

</div>