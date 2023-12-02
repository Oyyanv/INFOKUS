<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>INFOKUS</title>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        merah: '#C40404',
                        inputbox: '#EFEBEB',
                        bgside: '#E6E6E6',
                        hoverside: '#FF8383',
                        searchc: '#BCBCBC',
                        green: '#61FF54',
                        redbx: '#FF2C2C',
                        greybx: '#929191',
                        reda: '#EC0000',
                        bgtable: '#F1F1F1',
                        txttable: '#737373',
                    }
                }
            }
        }
    </script>
    {{-- alert logout --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="icon" type="image" href="{{ url('image/iconweb.png') }}">
</head>

<body onload="startTime()" class="overflow-hidden">
    {{-- NAVBAR --}}
    <nav class="border-gray-200 bg-white bg-white border-gray-700 shadow-lg">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-32 p-4 z-50">
            <div class="flex items-center justify-center">
                <ul class="list-none m-0 p-0">
                    <li class="text-2xl font-semibold text-black ml-48">
                        <a href="/dashboard" class="flex items-center">
                            Tabel Data SPP
                        </a>
                    </li>
                </ul>
            </div>
            <div class="hidden w-full md:block md:w-auto" id="navbar-solid-bg">
                <ul
                    class="flex flex-col font-medium mt-4 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-transparent dark:bg-gray-800 md:dark:bg-transparent dark:border-gray-700">
                    <li>
                        <a href="#"
                            class="block py-2 pl-3 pr-4 ml-32 rounded md:border-0 hover:text-black md:p-0 text-black text-black hover:bg-gray-700 hover:text-black hover:bg-transparent">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-6 h-6">
                                <path fill-rule="evenodd"
                                    d="M5.25 9a6.75 6.75 0 0113.5 0v.75c0 2.123.8 4.057 2.118 5.52a.75.75 0 01-.297 1.206c-1.544.57-3.16.99-4.831 1.243a3.75 3.75 0 11-7.48 0 24.585 24.585 0 01-4.831-1.244.75.75 0 01-.298-1.205A8.217 8.217 0 005.25 9.75V9zm4.502 8.9a2.25 2.25 0 104.496 0 25.057 25.057 0 01-4.496 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="block py-2 pl-3 pr-4 rounded md:border-0 hover:text-black md:p-0 text-black text-black hover:text-black hover-bg-transparent">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-6 h-6">
                                <path fill-rule="evenodd"
                                    d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- SIDEBAR --}}
    <aside id="logo-sidebar" class="fixed top-0 left-0 w-64 h-full" aria-label="Sidebar">
        <div class="h-full px-3 py-7 overflow-y-hidden bg-bgside dark:bg-bgside shadow-xl">
            <a href="#" class="flex items-center justify-center mb-10">
                <img src="{{ url('image/logo.png') }}" class="h-6 mr-3 sm:h-12" />
                <span class="self-center text-xl font-semibold whitespace-nowrap"></span>
            </a>
            <ul class="space-y-5 font-medium">
                <li>
                    <a href="/dashboard"
                        class="flex items-center p-3 rounded-lg dark:hover:bg-hoverside hover:bg-hoverside group">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                        <span class="ml-3">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="/siswa/sppsiswa/index"
                        class="flex items-center p-3 rounded-lg dark:hover:bg-hoverside hover:bg-hoverside group">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 4.5v15m6-15v15m-10.875 0h15.75c.621 0 1.125-.504 1.125-1.125V5.625c0-.621-.504-1.125-1.125-1.125H4.125C3.504 4.5 3 5.004 3 5.625v12.75c0 .621.504 1.125 1.125 1.125z" />
                        </svg>
                        <span class="ml-3">Data SPP</span>
                    </a>
                </li>
                <br>
                <br>
                <br>
                    <li class="flex items-center justify-center overflow-x-hidden">
                        <a href="#" id="logoutLink"
                            class="flex items-center p-3 rounded-lg dark:hover:bg-hoverside hover:bg-hoverside group pr-32 mt-96">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                            </svg>
                            <button class="ml-3" id="logout">Keluar</button>
                        </a>
                    </li>
            </ul>
        </div>
    </aside>
    {{-- Table data siswa  --}}
    <main class="ml-64 p-10">
        <div class="bg-gray-100 py-4 p-5 rounded-md">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-10 flex">
                <table class="w-full text-sm text-center rtl:text-right border border-collapse">
                    <thead class="text-xs uppercase bg-reda text-white">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                NO
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Bulan
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Total Tagihan
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Tanggal Pembayaran
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Bukti Pembayaran
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Total Pembayaran
                            </th>
                            <th scope="col" class="px-6 py-3">
                                STATUS
                            </th>
                            <th scope="col" class="px-6 py-3">
                                AKSI
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-txttable bg-bgtable">
                        @foreach ($sppsiswa as $row)
                            <tr>
                                <td class="px-6 py-4">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $row->bulan }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ 'Rp' . number_format($row->total_tagihan, 0, ',', '.') . ',00' }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $row->tgl_pembayaran ?? '-' }}
                                </td>
                                <td class="px-6 py-4">
                                    @if($row->bukti_pembayaran)
                                        <img src="{{ asset('storage/'. $row->bukti_pembayaran) }}">
                                    @else
                                        <span>-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    {{ 'Rp' . number_format($row->total_pembayaran, 0, ',', '.') . ',00' }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $row->status }}
                                </td>
                                <td class="px-6 py-4 flex justify-center space-x-4">
                                    <a href="{{ url('/siswa/sppsiswa/show', ['id_pembayaran' => $row->id_pembayaran]) }}"
                                        class="font-medium">
                                        Bayar
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $sppsiswa->links() }}
            </div>
        </div>
    </main>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                confirmButtonColor: ' #de3c10',
            });
        </script>
    @endif
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('logoutLink').addEventListener('click', function() {
                event.preventDefault();
                confirmLogout();
            });

            function confirmLogout() {
                Swal.fire({
                    title: 'Logout',
                    text: 'Apakah kamu ingin keluar?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Tidak',
                    confirmButtonText: 'Ya, saya ingin keluar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "/logout";
                    }
                });
            }
        });
    </script>

</body>

</html>
