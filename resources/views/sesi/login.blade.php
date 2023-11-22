<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.4.2/zxcvbn.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
    <title>SPP</title>
    <link rel="icon" type="image" href="{{ url('image/iconweb.png') }}">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        merah: '#C40404',
                        inputbox: '#EFEBEB',
                    }
                }
            }
        }
    </script>
</head>
<body>
    <div class="flex items-center min-h-screen bg-[url('/image/bg-login.svg')]">
        <div class="flex-1 h-full max-w-6xl mx-auto bg-white rounded-lg shadow-lg">
            <div class="flex flex-col md:flex-row">
                <div class="h-32 md:h-auto md:w-10/12">
                    <img class="object-cover w-full h-full rounded-lg" src="{{ url('image/tes2.png') }}"
                        alt="img" />
                </div>
                <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                    <div class="w-full">
                        <div class="flex justify-center">
                        </div>
                        <img src="{{ url('image/iconweb.png') }}" alt="" class="h-44 w-60 mr-4 rounded-lg">
                        <h1 class="block text-gray-700 mb-3 font-bold">
                            Login :
                        </h1>
                        <form action="/login/proses" method="POST">
                            @csrf
                            {{-- username/email --}}
                            <div>
                                <div class="relative">
                                <input type="email"
                                    class="w-full px-4 py-2 text-sm border rounded-md focus:border-black focus:outline-none focus:ring-1 border-black focus:ring-black bg-inputbox"
                                    placeholder="Email" type="text" name="email" value="{{ session('login_email')}}"/>
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                          </svg>
                                    </div>
                                </div>
                                @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                 @enderror
                            </div>
                            <br>
                            {{-- password --}}
                            <div class="py-1" x-data="{ show: true }">
                                <div class="relative">
                                  <input placeholder="Password" name="password" :type="show ? 'password' : 'text'" class="w-full px-4 py-2 text-sm border rounded-md focus:border-black border-black focus:outline-none focus:ring-1 focus:ring-black bg-inputbox">
                                  <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
                                    <svg class="h-6 text-gray-700" fill="none" @click="show = !show"
                                      :class="{'hidden': !show, 'block':show }" xmlns="http://www.w3.org/2000/svg"
                                      viewbox="0 0 576 512">
                                      <path fill="currentColor"
                                        d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z">
                                      </path>
                                    </svg>
                
                                    <svg class="h-6 text-gray-700" fill="none" @click="show = !show"
                                      :class="{'block': !show, 'hidden':show }" xmlns="http://www.w3.org/2000/svg"
                                      viewbox="0 0 640 512">
                                      <path fill="currentColor"
                                        d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45zm-183.72-142l-39.3-30.38A94.75 94.75 0 0 0 416 256a94.76 94.76 0 0 0-121.31-92.21A47.65 47.65 0 0 1 304 192a46.64 46.64 0 0 1-1.54 10l-73.61-56.89A142.31 142.31 0 0 1 320 112a143.92 143.92 0 0 1 144 144c0 21.63-5.29 41.79-13.9 60.11z">
                                      </path>
                                    </svg>
                
                                  </div>
                                </div>
                                @error('password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                  @enderror
                              </div>
                            {{-- <input type="checkbox" onclick="myFunction()" class="mb-5 mt-5"> Show Password --}}
                            <button
                                class="block w-24 px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-merah border border-transparent rounded-lg active:bg-gray-600 hover:bg-merah-200 focus:outline-none focus:shadow-outline-blue"
                                type="submit" name="submit">
                                LOGIN
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@if(session('success'))
    <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#de3c10',
            });
    </script>
@endif
@if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: '{{ session('error') }}',
            confirmButtonColor:' #de3c10',
        });
    </script>
@endif

</body>
{{-- <script>
    function myFunction() {
        var x = document.getElementById("inputpw");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script> --}}

</html>
