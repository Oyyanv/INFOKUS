<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrtuController;
use App\Http\Controllers\OrtuSiswaController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\SiswaController;
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
    //index
    Route::get('/admin/datasiswa/index', [AdminController::class, 'index'])->middleware('userAkses:admin');
    Route::get('/admin/dataspp/index', [AdminController::class, 'indexspp'])->middleware('userAkses:admin');
    Route::get('/admin/dataortu/index', [AdminController::class, 'indexortu'])->middleware('userAkses:admin');
    //datasiswa
    Route::group(['prefix' => '/admin/datasiswa'], function () {
        Route::get('/index', [SiswaController::class, 'index'])->name('/admin/datasiswa/index');
        Route::get('/show/{NIS_Kelas}', [SiswaController::class, 'show'])->name('/admin/datasiswa/show');  
        Route::post('/create', [SiswaController::class, 'store']);
        // Route::put('/editsiswa', [SiswaController::class, 'edit']);
        Route::put('/update/{NIS_Kelas}', [SiswaController::class, 'update'])->name('admin.datasiswa.update');  
        Route::delete('/delete', [SiswaController::class, 'destroy']);
        //DETAIL INFORMASI SISWA
        Route::get('/detailsiswa/{NIK_Orangtua}', [OrtuSiswaController::class, 'index'])->name('/admin/datasiswa/detailsiswa');
    });
    //dataortu
    Route::group(['prefix' => '/admin/dataortu'], function () {
        Route::get('/index', [OrtuController::class, 'index'])->name('/admin/dataortu/index');
        Route::get('/show', [OrtuController::class, 'show']);
        Route::post('/create', [OrtuController::class, 'store']);
        Route::put('/edit', [OrtuController::class, 'edit']);
        Route::patch('/update', [OrtuController::class, 'update']);
        Route::delete('/delete', [OrtuController::class, 'destroy']);
        //DETAIL INFORMASI ORANGTUA
        Route::get('/detailortu/{NIK_Orangtua}', [OrtuSiswaController::class, 'indexortu'])->name('/admin/dataortu/detailortu');
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
