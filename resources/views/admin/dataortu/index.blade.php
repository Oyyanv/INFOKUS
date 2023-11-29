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
                           buttons: '#CBCBCB'
                       }
                   }
               }
           }
       </script>
       {{-- alert logout --}}
       <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
       <link rel="icon" type="image" href="{{ url('image/iconweb.png') }}">
   </head>

   <body onload="startTime()">
       {{-- NAVBAR --}}
       <nav class="border-gray-200 bg-white bg-white border-gray-700 shadow-lg">
           <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-32 p-4 z-50">
               <div class="flex items-center justify-center">
                   <ul class="list-none m-0 p-0">
                       <li class="text-2xl font-semibold text-black ml-48">
                           <a href="#" class="flex items-center">
                               Tabel Data Orang Tua Siswa
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
                           <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                               stroke="currentColor" class="w-6 h-6">
                               <path stroke-linecap="round" stroke-linejoin="round"
                                   d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                           </svg>
                           <span class="ml-3">Dashboard</span>
                       </a>
                   </li>
                   {{-- ADMIN  --}}
                   @if (Auth::user()->status == 'admin')
                       <li>
                           <a href="/admin/dataspp/index"
                               class="flex items-center p-3 rounded-lg dark:hover:bg-hoverside hover:bg-hoverside group">
                               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                   stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                   <path stroke-linecap="round" stroke-linejoin="round"
                                       d="M9 4.5v15m6-15v15m-10.875 0h15.75c.621 0 1.125-.504 1.125-1.125V5.625c0-.621-.504-1.125-1.125-1.125H4.125C3.504 4.5 3 5.004 3 5.625v12.75c0 .621.504 1.125 1.125 1.125z" />
                               </svg>
                               <span class="ml-3">Data SPP</span>
                           </a>
                       </li>
                       <li>
                           <a href="/admin/datasiswa/index"
                               class="flex items-center p-3 rounded-lg dark:hover:bg-hoverside hover:bg-hoverside group">
                               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                   stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                   <path stroke-linecap="round" stroke-linejoin="round"
                                       d="M9 4.5v15m6-15v15m-10.875 0h15.75c.621 0 1.125-.504 1.125-1.125V5.625c0-.621-.504-1.125-1.125-1.125H4.125C3.504 4.5 3 5.004 3 5.625v12.75c0 .621.504 1.125 1.125 1.125z" />
                               </svg>
                               <span class="ml-3">Data Siswa</span>
                           </a>
                       </li>
                       <li>
                        <a href="/admin/dataortu/index"
                            class="flex items-center p-3 rounded-lg dark:hover:bg-hoverside hover:bg-hoverside group">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 4.5v15m6-15v15m-10.875 0h15.75c.621 0 1.125-.504 1.125-1.125V5.625c0-.621-.504-1.125-1.125-1.125H4.125C3.504 4.5 3 5.004 3 5.625v12.75c0 .621.504 1.125 1.125 1.125z" />
                            </svg>
                            <span class="ml-3">Data Orangtua Siswa</span>
                        </a>
                    </li>
                       <li class="flex items-center justify-center overflow-x-hidden">
                           <a href="#" id="logoutLink"
                               class="flex justify-center mt-80 p-3 rounded-lg dark:hover:bg-hoverside hover:bg-hoverside group">
                               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                   stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                   <path stroke-linecap="round" stroke-linejoin="round"
                                       d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                               </svg>
                               <button class="ml-3" id="logout">Keluar</button>
                           </a>
                       </li>
                   @endif
               </ul>
           </div>
       </aside>
       {{-- Table data siswa  --}}
       <main class="ml-64 p-10">
           <div class="bg-gray-100 py-4 p-5 rounded-md">
               <button type="button"
                   class="text-txttable font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 bg-buttons flex float-right mt-2"
                   onclick="window.location='{{ url('/admin/dataortu/tambah') }}'">
                   <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                       stroke="currentColor" class="w-6 h-6">
                       <path stroke-linecap="round" stroke-linejoin="round"
                           d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                   </svg>
                   <span class="ml-2">Tambah Data</span>
               </button>
               <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-20 flex">
                   <table class="w-full text-sm text-center rtl:text-right border border-collapse">
                       <thead class="text-xs uppercase bg-reda text-white">
                           <tr>
                               <th scope="col" class="px-6 py-3">
                                   NIK
                               </th>
                               <th scope="col" class="px-6 py-3">
                                   Nama
                               </th>
                               <th scope="col" class="px-6 py-3">
                                   Alamat
                               </th>
                               <th scope="col" class="px-6 py-3">
                                   Nomor Telepon
                               </th>
                               <th scope="col" class="px-6 py-3">
                                   Aksi
                               </th>
                           </tr>
                       </thead>
                       <tbody class="text-txttable bg-bgtable">
                           @foreach ($ortu as $row)
                               <tr>
                                   <td scope="row" class="px-6 py-4 font-medium">
                                       {{ $row->NIK }}
                                   </td>
                                   <td class="px-6 py-4">
                                       {{ $row->Nama }}
                                   </td>
                                   <td class="px-6 py-4">
                                       {{ $row->Alamat }}
                                   </td>
                                   <td class="px-6 py-4">
                                       {{ $row->No_Telp }}
                                   </td>
                                   <td class="px-6 py-4 flex justify-center space-x-4">
                                       <a href="{{ url('/admin/dataortu/show', $row->NIK_Orangtua) }}" class="font-medium">
                                           <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                               fill="currentColor" class="w-6 h-6">
                                               <path fill-rule="evenodd"
                                                   d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" />
                                           </svg>
                                       </a>
                                       <a href="{{ route('/admin/dataortu/detailortu', $row->NIK_Orangtua) }}" class="font-medium">
                                           <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                               fill="currentColor" class="w-6 h-6">
                                               <path fill-rule="evenodd"
                                                   d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 01.67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 11-.671-1.34l.041-.022zM12 9a.75.75 0 100-1.5.75.75 0 000 1.5z"
                                                   clip-rule="evenodd" />
                                           </svg>
                                       </a>
                                       <form id="hapusortu" method="POST"
                                           action="{{ route('/admin/dataortu/delete', ['NIK_Orangtua' => $row->NIK_Orangtua]) }}">
                                           @csrf
                                           @method('DELETE')
                                           <button type="submit">
                                               <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                   fill="currentColor" class="w-5 h-5">
                                                   <path fill-rule="evenodd"
                                                       d="M8.75 1A2.75 2.75 0 006 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 10.23 1.482l.149-.022.841 10.518A2.75 2.75 0 007.596 19h4.807a2.75 2.75 0 002.742-2.53l.841-10.52.149.023a.75.75 0 00.23-1.482A41.03 41.03 0 0014 4.193V3.75A2.75 2.75 0 0011.25 1h-2.5zM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4zM8.58 7.72a.75.75 0 00-1.5.06l.3 7.5a.75.75 0 101.5-.06l-.3-7.5zm4.34.06a.75.75 0 10-1.5-.06l-.3 7.5a.75.75 0 101.5.06l.3-7.5z"
                                                       clip-rule="evenodd" />
                                               </svg>
                                           </button>
                                       </form>
                                   </td>
                               </tr>
                           @endforeach
                       </tbody>
                   </table>
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
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('hapusortu').addEventListener('click', function(event) {
                    event.preventDefault();
                    confirmDelete();
                });
 
                function confirmDelete() {
                    Swal.fire({
                        text: 'Apakah Ingin Menghapus Data Ortu?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        cancelButtonText: 'Tidak',
                        confirmButtonText: 'Ya'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('hapusortu').submit();
                        }
                    });
                }
            });
        </script>

   </body>

   </html>
