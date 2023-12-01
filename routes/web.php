<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GurustaffController;
use App\Http\Controllers\OrtuController;
use App\Http\Controllers\OrtuSiswaController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */
Route::get('/', function () {
    return view('sesi/login');
});

Route::middleware(['guest'])->group(function () {

    Route::get('/login', [SessionController::class, 'index'])->name('login');
    Route::post('/login/proses', [SessionController::class, 'login']);

});

Route::get('/home', function () {
    return redirect('/dashboard');
});

// Route::get ('/dashboard',[DashboardController::class, 'index']);
Route::middleware(['auth', 'isLogin'])->group(function () {
    Route::get('/logout', [SessionController::class, 'logout']);
    Route::get('/dashboard', [DashboardController::class, 'index']);
    // ->middleware('isLogin');
    Route::get('/dashboard/siswa', [DashboardController::class, 'siswa'])->middleware('userAkses:siswa');
    Route::get('/dashboard/admin', [DashboardController::class, 'admin'])->middleware('userAkses:admin');
});

Route::middleware(['auth', 'isLogin'])->group(function () {
    Route::get('/logout', [SessionController::class, 'logout']);
    Route::get('/dashboard', [DashboardController::class, 'index']);
    // ->middleware('isLogin');
    Route::get('/dashboard/siswa', [DashboardController::class, 'siswa'])->middleware('userAkses:siswa');
    Route::get('/dashboard/admin', [DashboardController::class, 'admin'])->middleware('userAkses:admin');

});

Route::middleware(['auth', 'isLogin'])->group(function () {
    //detail
    Route::get('/admin/datasiswa/detailsiswa',[AdminController::class, 'detailsiswa'])->middleware('userAkses:admin');
    //form
    Route::get('/admin/datasiswa/tambah', [AdminController::class, 'tambah'])->middleware('userAkses:admin');
    Route::get('/admin/dataortu/tambah', [AdminController::class, 'tambahortu'])->middleware('userAkses:admin');
    Route::get('/admin/datatagihan/tambah', [AdminController::class, 'tambahtagihan'])->middleware('userAkses:admin');
    Route::get('/admin/gurustaff/tambah', [AdminController::class, 'tambahstaff'])->middleware('userAkses:admin');
    //index
    Route::get('/admin/datasiswa/index', [AdminController::class, 'index'])->middleware('userAkses:admin');
    Route::get('/admin/dataspp/index', [AdminController::class, 'indexspp'])->middleware('userAkses:admin');
    Route::get('/admin/dataortu/index', [AdminController::class, 'indexortu'])->middleware('userAkses:admin');
    Route::get('/admin/datatagihan/index', [AdminController::class, 'indextagihan'])->middleware('userAkses:admin');
    Route::get('/admin/datauser/index', [AdminController::class, 'indexuser'])->middleware('userAkses:admin');
    Route::get('/admin/gurustaff/index', [AdminController::class, 'indexstaff'])->middleware('userAkses:admin');
    //datasiswa
    Route::group(['prefix' => '/admin/datasiswa'], function () {
        Route::get('/index', [SiswaController::class, 'index'])->name('/admin/datasiswa/index');
        Route::get('/show/{NIS_Angkatan}', [SiswaController::class, 'show'])->name('/admin/datasiswa/show');  
        Route::post('/create', [SiswaController::class, 'store']);
        //UPDATE/edit DATA SISWA
        Route::put('/update/{NIS_Angkatan}', [SiswaController::class, 'update'])->name('/admin/datasiswa/update');
        Route::delete('/delete/{NIS_Angkatan}', [SiswaController::class, 'delete'])->name('/admin/datasiswa/delete');
        //DETAIL INFORMASI SISWA
        Route::get('/detailsiswa/{NIK_Orangtua}', [OrtuSiswaController::class, 'index'])->name('/admin/datasiswa/detailsiswa');
    });
    //dataortu
    Route::group(['prefix' => '/admin/dataortu'], function () {
        Route::get('/index', [OrtuController::class, 'index'])->name('/admin/dataortu/index');
        Route::get('/show/{NIK_Orangtua}', [OrtuController::class, 'show']);
        Route::post('/create', [OrtuController::class, 'store']);
        Route::put('/update/{NIK_Orangtua}', [OrtuController::class, 'update'])->name('/admin/dataortu/update');
        Route::delete('/delete/{NIK_Orangtua}', [OrtuController::class, 'delete'])->name('/admin/dataortu/delete');
        //DETAIL INFORMASI ORANGTUA
        Route::get('/detailortu/{NIK_Orangtua}', [OrtuSiswaController::class, 'indexortu'])->name('/admin/dataortu/detailortu');
    });
    //data tagihan
    Route::group(['prefix' => '/admin/datatagihan'], function () {
        Route::get('/index', [TagihanController::class, 'index'])->name('/admin/datatagihan/index');
        Route::get('/show/{id_tagihan}', [TagihanController::class, 'show']);
        Route::post('/create', [TagihanController::class, 'store']);
        Route::put('/update/{id_tagihan}', [TagihanController::class, 'update'])->name('/admin/datatagihan/update');
        Route::delete('/delete/{id_tagihan}', [TagihanController::class, 'delete'])->name('/admin/datatagihan/delete');
    });

     //data user
     Route::group(['prefix' => '/admin/datauser'], function () {
        Route::get('/index', [UserController::class, 'index'])->name('/admin/datauser/index');
        Route::get('/show/{id_user}', [UserController::class, 'show']);
        Route::post('/create', [UserController::class, 'store']);
        Route::put('/update/{id_user}', [UserController::class, 'update'])->name('/admin/datauser/update');
        Route::delete('/delete/{id_user}', [UserController::class, 'delete'])->name('/admin/datauser/delete');
    });

     //data gurustaff
     Route::group(['prefix' => '/admin/gurustaff'], function () {
        Route::get('/index', [GurustaffController::class, 'index'])->name('/admin/gurustaff/index');
        Route::get('/show/{id_nip}', [GurustaffController::class, 'show']);
        Route::post('/create', [GurustaffController::class, 'store']);
        Route::put('/update/{id_nip}', [GurustaffController::class, 'update'])->name('/admin/gurustaff/update');
        Route::delete('/delete/{id_nip}', [GurustaffController::class, 'delete'])->name('/admin/gurustaff/delete');
    });
});


// Route::get('/dashboard', function () {
//     // Periksa status pengguna dan arahkan sesuai status mereka
//     if (Auth::user()->status == 'admin') {
//         return redirect('/dashboard/admin');
//     } elseif (Auth::user()->status == 'siswa') {
//         return redirect('/dashboard/siswa');
//     }
// })->middleware('auth');
