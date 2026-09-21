@extends('layouts.mantis')

@section('title', 'Data User')

@section('content')

<div class="col-12">

    {{-- JUDUL HALAMAN --}}
    <div class="mb-4">
        <h3 class="mb-1 fw-bold">Halaman User</h3>
        <p class="text-muted mb-0">
            Kelola akun dan hak akses pengguna
        </p>
    </div>


    {{-- CARD DATA USER --}}
    <div class="card border-0 shadow-sm">

        {{-- HEADER --}}
        <div class="card-header bg-white py-4 px-4">
            <div class="d-flex align-items-center">

                <div
                    class="rounded-3 d-flex align-items-center justify-content-center me-3"
                    style="
                        width: 50px;
                        height: 50px;
                        background: #e8f1ff;
                    "
                >
                    <i
                        class="ti ti-users"
                        style="font-size: 28px; color: #4680ff;"
                    ></i>
                </div>

                <div>
                    <h4 class="mb-1">Data User</h4>
                    <p class="text-muted mb-0">
                        Kelola akun dan hak akses pengguna
                    </p>
                </div>

            </div>
        </div>


        {{-- BODY --}}
        <div class="card-body px-4">

            {{-- FILTER ROLE --}}
            <div class="mb-4">

                <div class="dropdown">

                    <button
                        class="btn btn-outline-secondary dropdown-toggle"
                        type="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                    >
                        <i class="ti ti-filter me-1"></i>
                        Filter Berdasarkan Role
                    </button>

                    <div
                        class="dropdown-menu p-3"
                        style="min-width: 220px;"
                    >

                        {{-- ADMIN --}}
                        <div class="form-check mb-2">

                            <input
                                class="form-check-input role-filter"
                                type="checkbox"
                                value="admin"
                                id="filterAdmin"
                            >

                            <label
                                class="form-check-label"
                                for="filterAdmin"
                            >
                                Admin
                            </label>

                        </div>


                        {{-- SUPERVISOR --}}
                        <div class="form-check mb-2">

                            <input
                                class="form-check-input role-filter"
                                type="checkbox"
                                value="supervisor"
                                id="filterSupervisor"
                            >

                            <label
                                class="form-check-label"
                                for="filterSupervisor"
                            >
                                Supervisor
                            </label>

                        </div>


                        {{-- STAFF --}}
                        <div class="form-check">

                            <input
                                class="form-check-input role-filter"
                                type="checkbox"
                                value="staff"
                                id="filterStaff"
                            >

                            <label
                                class="form-check-label"
                                for="filterStaff"
                            >
                                Staff
                            </label>

                        </div>

                    </div>

                </div>

            </div>


            {{-- TABEL --}}
            <div class="table-responsive">

                <table
                    class="table table-hover align-middle"
                    id="table"
                >

                    <thead>

                        <tr>

                            <th width="60">
                                No
                            </th>

                            <th>
                                Nama
                            </th>

                            <th>
                                Email
                            </th>

                            <th>
                                Role
                            </th>

                            <th
                                width="160"
                                class="text-end"
                            >
                                Opsi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse ($users as $index => $user)

                        <tr>

                            {{-- NOMOR --}}
                            <td>
                                {{ $index + 1 }}
                            </td>


                            {{-- NAMA --}}
                            <td>

                                <div class="d-flex align-items-center">

                                    <div
                                        class="rounded-circle d-flex align-items-center justify-content-center me-3"
                                        style="
                                            width: 40px;
                                            height: 40px;
                                            background: #e8f1ff;
                                        "
                                    >
                                        <i
                                            class="ti ti-user"
                                            style="
                                                font-size: 20px;
                                                color: #4680ff;
                                            "
                                        ></i>
                                    </div>

                                    <span class="fw-semibold">
                                        {{ $user->name }}
                                    </span>

                                </div>

                            </td>


                            {{-- EMAIL --}}
                            <td>
                                <span class="text-muted">
                                    {{ $user->email }}
                                </span>
                            </td>


                            {{-- ROLE --}}
                            <td>

                                @if (strtolower(trim($user->role ?? '')) === 'admin')

                                    <span
                                        class="badge bg-primary user-role"
                                        data-role="admin"
                                    >
                                        <i class="ti ti-shield me-1"></i>
                                        Admin
                                    </span>

                                @elseif (strtolower(trim($user->role ?? '')) === 'supervisor')

                                    <span
                                        class="badge bg-warning text-dark user-role"
                                        data-role="supervisor"
                                    >
                                        <i class="ti ti-user-check me-1"></i>
                                        Supervisor
                                    </span>

                                @else

                                    <span
                                        class="badge bg-info user-role"
                                        data-role="staff"
                                    >
                                        <i class="ti ti-user me-1"></i>
                                        Staff
                                    </span>

                                @endif

                            </td>


                            {{-- OPSI --}}
                            <td class="text-end">

                                <button
                                    type="button"
                                    class="btn btn-success btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#roleModal{{ $user->id }}"
                                >
                                    <i class="ti ti-refresh me-1"></i>
                                    Ganti Role
                                </button>

                            </td>

                        </tr>


                        {{-- MODAL GANTI ROLE --}}
                        <div
                            class="modal fade"
                            id="roleModal{{ $user->id }}"
                            tabindex="-1"
                            aria-hidden="true"
                        >

                            <div class="modal-dialog modal-dialog-centered">

                                <div class="modal-content">

                                    <div class="modal-header">

                                        <h5 class="modal-title">
                                            Ganti Role User
                                        </h5>

                                        <button
                                            type="button"
                                            class="btn-close"
                                            data-bs-dismiss="modal"
                                            aria-label="Close"
                                        ></button>

                                    </div>


                                    <form
                                        action="{{ route('users.update-roles') }}"
                                        method="POST"
                                    >

                                        @csrf

                                        <input
                                            type="hidden"
                                            name="user_id"
                                            value="{{ $user->id }}"
                                        >


                                        <div class="modal-body">

                                            <div class="mb-3">

                                                <label class="form-label">
                                                    Nama User
                                                </label>

                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    value="{{ $user->name }}"
                                                    readonly
                                                >

                                            </div>


                                            <div class="mb-3">

                                                <label
                                                    for="role{{ $user->id }}"
                                                    class="form-label"
                                                >
                                                    Role
                                                </label>

                                                <select
                                                    name="role"
                                                    id="role{{ $user->id }}"
                                                    class="form-control"
                                                    required
                                                >

                                                    <option
                                                        value="admin"
                                                        {{ $user->role === 'admin' ? 'selected' : '' }}
                                                    >
                                                        Admin
                                                    </option>

                                                    <option
                                                        value="supervisor"
                                                        {{ $user->role === 'supervisor' ? 'selected' : '' }}
                                                    >
                                                        Supervisor
                                                    </option>

                                                    <option
                                                        value="staff"
                                                        {{ $user->role === 'staff' ? 'selected' : '' }}
                                                    >
                                                        Staff
                                                    </option>

                                                </select>

                                            </div>

                                        </div>


                                        <div class="modal-footer">

                                            <button
                                                type="button"
                                                class="btn btn-light"
                                                data-bs-dismiss="modal"
                                            >
                                                Batal
                                            </button>

                                            <button
                                                type="submit"
                                                class="btn btn-primary"
                                            >
                                                <i class="ti ti-device-floppy me-1"></i>
                                                Simpan
                                            </button>

                                        </div>

                                    </form>

                                </div>

                            </div>

                        </div>

                        @empty

                        <tr>

                            <td
                                colspan="5"
                                class="text-center py-4"
                            >
                                <i class="ti ti-users-off fs-1 text-muted"></i>

                                <p class="text-muted mb-0 mt-2">
                                    Belum ada data user.
                                </p>

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>


{{-- FILTER CHECKBOX --}}
<script>

document.addEventListener('DOMContentLoaded', function () {

    const checkboxes = document.querySelectorAll('.role-filter');

    const rows = document.querySelectorAll('#table tbody tr');


    checkboxes.forEach(function (checkbox) {

        checkbox.addEventListener('change', function () {

            const selectedRoles = Array.from(checkboxes)
                .filter(function (item) {
                    return item.checked;
                })
                .map(function (item) {
                    return item.value;
                });


            rows.forEach(function (row) {

                const roleElement =
                    row.querySelector('.user-role');


                if (!roleElement) {
                    return;
                }


                const role =
                    roleElement.dataset.role;


                if (
                    selectedRoles.length === 0 ||
                    selectedRoles.includes(role)
                ) {

                    row.style.display = '';

                } else {

                    row.style.display = 'none';

                }

            });

        });

    });

});

</script>

@endsection