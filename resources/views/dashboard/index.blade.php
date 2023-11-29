@if (Auth::check())
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <script src="https://cdn.tailwindcss.com"></script>
        <title>Dashboard</title>
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
                        }
                    }
                }
            }
        </script>
        <script>
            function startTime() {
                var today = new Date();
                var hr = today.getHours();
                var min = today.getMinutes();
                //Add a zero in front of numbers<10
                hr = checkTime(hr);
                min = checkTime(min);

                document.getElementById("clockHour").innerHTML = hr;
                document.getElementById("clockMin").innerHTML = min;
                var months = ['JAN', 'FEB', 'MAR', 'APR', 'MEI', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'];
                var curDay = today.getDate();
                var curMonth = months[today.getMonth()];
                var curYear = today.getFullYear();
                var date = curDay + " " + curMonth + " " + curYear;
                document.getElementById("date").innerHTML = date;

                var time = setTimeout(function() {
                    startTime()
                }, 500);
            }

            function checkTime(i) {
                if (i < 10) {
                    i = "0" + i;
                }
                return i;
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
                                INFOKUS SKATEL
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
                    {{-- SISWA --}}
                    @if (Auth::user()->status == 'siswa')
                        <li>
                            <a href="#"
                                class="flex items-center p-3 rounded-lg dark:hover:bg-hoverside hover:bg-hoverside group">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 4.5v15m6-15v15m-10.875 0h15.75c.621 0 1.125-.504 1.125-1.125V5.625c0-.621-.504-1.125-1.125-1.125H4.125C3.504 4.5 3 5.004 3 5.625v12.75c0 .621.504 1.125 1.125 1.125z" />
                                </svg>
                                <span class="ml-3">Tabel SPP</span>
                            </a>
                        </li>
                        <li class="flex items-center justify-center py-16 overflow-x-hidden">
                            <a href="#" id="logoutLink"
                                class="flex justify-center mt-96 p-3 rounded-lg dark:hover:bg-hoverside hover:bg-hoverside group">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                                </svg>
                                <button class="ml-3" id="logout">Keluar</button>
                            </a>
                        </li>
                    @endif
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

        {{-- ISI  --}}
        <main class="ml-64 p-10">
            <div class="bg-gray-100 py-4 p-5 rounded-md">
                @if (Auth::user()->status == 'admin')
                    <div class="flex flex-row">
                        <ul class="max-w-md w-3/12 space-y-2 list-none list-inside" id="listItems">
                            <li data-index="0" class="cursor-pointer">
                                <div class="box bg-green rounded-md text-center text-black m-0 py-2.5 px-2 shadow-xl">
                                    <p>Sudah Membayar</p>
                                </div>
                            </li>
                            <li data-index="1" class="cursor-pointer">
                                <div class="box bg-redbx rounded-md text-center text-black m-0 py-2.5 px-2 shadow-xl">
                                    <p>Belum Membayar</p>
                                </div>
                            </li>
                            <li data-index="2" class="cursor-pointer">
                                <div class="box bg-greybx rounded-md text-center text-black  py-2.5 px-2 shadow-xl">
                                    <p>Menunggu Konfirmasi</p>
                                </div>
                            </li>
                        </ul>
                        <div class="absolute p-10 mt-32">
                            <div id="clockdate" class="float-right rounded-md bg-gray-300 p-14">
                                <div class="clockdate-wrapper">
                                    <div class="clockWrap flex items-center">
                                        <div id="clockHour" class="text-4xl font-bold text-black "></div>
                                        <span id="clockSpan" class="text-4xl font-bold text-black">:</span>
                                        <div id="clockMin" class="text-4xl font-bold text-black"></div>
                                    </div>
                                    <div id="date" class="text-lg  text-gray-600  mt-1 rounded-md"></div>
                                </div>
                            </div>
                        </div>
                        <div class="w-2/3 ml-14 block">
                            <canvas class="" id="chartLine"></canvas>
                        </div>
                    </div>
                    <div class="mt-10">
                        <div class="flex">
                            <img src="{{ url('image/iconweb.png') }}" alt="" class="h-20 w-70 mr-4 ml-3 mt-10 rounded-lg">
                            <p class="text-justify indent-10 mr-6">
                              INFOKUS (Informasi Keuangan Siswa) adalah sebuah web yang dirancang untuk pembayaran SPP siswa siswi 
                              SMK TELKOM BANJARBARU yang dibuat untuk memudahkan pembayaran SPP siswa dengan mengandalkan 
                              keunggulan dan pengemabangan IT pada dunia sekarang. Web ini juga memudahkan admin untuk memeriksa/memantau 
                              pembayaran siswa siswi dalam per bulan dengan menggunakan diagram (Sudah Membayar) dengan warna diagram 
                              hijau (Belum Membayar) dengan warna diagram merah dan (Menunggu Konfirmasi) dengan menggunakan warna diagram 
                              abu-abu, grafik ini akan berubah tiap bulan nya sesuai dengan pembayaran yang dilakukan oleh siswa siswi. 
                              Ini adalah halam Dashboard dari admin, halaman ini berfungngsi memantau grafik dan juga penyusunan data 
                              bagi sudah membayar, belum membayar dan menunggu konfirmasi dan untuk lebih lanjut nya silah kan di coba dan 
                              digunakan pada web tersebut, Terima Kasih.
                            </p>
                        </div>
                        <div>
                            <p class="text-justify">
                                
                            </p>
                        </div>
                    </div>
                @endif



                @if (Auth::user()->status == 'siswa')
                    <div class="flex">
                        <img src="{{ url('image/logouser.jpg') }}" alt="" class="h-44 mr-4 rounded-lg">
                        <p class="text-justify indent-10">
                            INFOKUS (Informasi Keuangan Siswa) adalah sebuah web yang dirancang untuk pembayaran SPP siswa siswi 
                            SMK TELKOM BANJARBARU yang dibuat untuk memudahkan pembayaran SPP siswa dengan mengandalkan 
                            keunggulan dan pengemabangan IT pada dunia sekarang. Web ini juga memudahkan siswa siswi untuk melakukan 
                            pembayaran SPP pada siswa siswi dalam per bulan dengan menggunakan WEB tersebut. WEB ini dirancang untuk 
                            admin dan siswa siswi untuk lebih mudah melakukan pembayaran SPP, disini para siswa bisa menggunakan Tabel
                            SPP sebagai melakukan pembayaran dan jika sudah melakukan pembayaran nanti akan menunggu konfirmasi dan akan
                            mendapat kan notifikasi di email untuk bukti pembayaran dan jika ada ke gagalan bisa di coba ulang atau melakukan
                            pembayaran secara langsung ke kantor. Ini adalah halam Dashboard dari siswa, halaman ini berfungngsi memantau grafik 
                            dan juga penyusunan data bagi sudah membayar, belum membayar dan menunggu konfirmasi dan untuk lebih lanjut nya silah 
                            kan di coba dan digunakan pada web tersebut, Terima Kasih.
                            </p>
                        </p>
                    </div>
                    <div>
                        <p class="text-justify">
                            Siswa tidak bisa melihat diagram pembayaran dan hanya menggunakan fitur pembayaran sebaliknya admin bisa meliat
                            diagram tapi tidak bisa meliat fitur pembayaran dari siswa tapi akan mendapat notifikasi jika siswa melakukan
                            pembayaran atau belum dan mana siswa yang menunggu konfirmasi karna tiap fitur dari dashboard siswa dan admin
                            dibuat berbeda/tidak sama. jika belum melakukan pembayaran akan dapat notifikasi dan jika sudah melakukan pembayaran
                            juga akan mendapat notifikasi sehabis admin mengkonfirmasi pembayaran.
                        </p>
                    </div>
            </div>
            <div class="">
                <div class="mt-48">
                    <div id="clockdate" class="float-right rounded-md p-14">
                        <div class="clockdate-wrapper">
                            <div class="clockWrap flex items-center">
                                <div id="clockHour" class="text-4xl font-bold text-black bg-gray-200 p-2 rounded-md"></div>
                                <span id="clockSpan" class="text-4xl font-bold text-black">:</span>
                                <div id="clockMin" class="text-4xl font-bold text-black bg-gray-200 p-2 rounded-md"></div>
                            </div>
                            <div id="date" class="text-lg text-center text-gray-600 bg-gray-200 p-1 mt-1 rounded-md"></div>
                        </div>
                    </div>
                </div>
@endif
</main>


<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"
    integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    const labels = ["1", "2", "3", "4", "5", "7", "8", "9", "10"];
    const datasets = [{
            label: "Sudah Membayar",
            backgroundColor: "green",
            borderColor: 'rgb(97, 255, 84)',
            data: [40, 10, 5, 2, 20, 30, 45, 40, 40],
            fill: false,
        },
        {
            label: "Belum Membayar",
            backgroundColor: "red",
            borderColor: 'rgb(255, 44, 44)',
            data: [10, 15, 20, 25, 30, 35, 40, 10, 5],
            fill: false,
        },
        {
            label: "Menunggu Konfirmasi",
            backgroundColor: "gray",
            borderColor: 'rgb(146, 145, 145)',
            data: [10, 10, 5, 5, 5, 2, 0, 0, 0],
            fill: false,
        },
    ];

    const configLineChart = {
        type: "line",
        data: {
            labels,
            datasets
        },
        options: {},
    };

    var chartLine = new Chart(
        document.getElementById("chartLine"),
        configLineChart
    );

    const listItems = document.querySelectorAll("#listItems li");
    const datasetStatus = [false, false, false];

    listItems.forEach((item) => {
        item.addEventListener("click", function() {
            const dataIndex = item.getAttribute("data-index");
            datasetStatus[dataIndex] = !datasetStatus[dataIndex];

            // Menonaktifkan atau mengaktifkan dataset berdasarkan status
            datasets[dataIndex].hidden = !datasetStatus[dataIndex];
            chartLine.update();
        });
    });
</script>
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
@else
<?php
return redirect('login');
?>
@endif
