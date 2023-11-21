<?php
use App\Http\Controllers\SessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;
use illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
// Route::get('/', function () {
//     return view('sesi/login');
// });

// Route::middleware(['guest'])->group(function(){

//     Route::get('/login',[SessionController::class,'index'])->name('login');
//     Route::post('/login/proses',[SessionController::class,'login']);

// });

// Route::get('/home', function(){
//     return redirect('/dashboard');
// });

// // Route::get ('/dashboard',[DashboardController::class, 'index']);
// Route::middleware(['auth','isLogin'])->group(function(){
//     Route::get('/logout', [SessionController::class, 'logout'] );
//     Route::get('/dashboard', [DashboardController::class, 'index'] );
//     // ->middleware('isLogin');
//     Route::get('/dashboard/siswa', [DashboardController::class, 'siswa'] )->middleware('userAkses:siswa');
//     Route::get('/dashboard/admin', [DashboardController::class, 'admin'] )->middleware('userAkses:admin');
// });

// Route::middleware(['auth','isLogin'])->group(function(){
//     Route::get('/logout', [SessionController::class, 'logout'] );
//     Route::get('/dashboard', [DashboardController::class, 'index'] );
//     // ->middleware('isLogin');
//     Route::get('/dashboard/siswa', [DashboardController::class, 'siswa'] )->middleware('userAkses:siswa');
//     Route::get('/dashboard/admin', [DashboardController::class, 'admin'] )->middleware('userAkses:admin');

// });


//     Route::get('/admin/datasiswa/index', [AdminController::class, 'index'] );

//     Route::controller(SiswaController::class)->group(function (){
//         Route::get('/admin/datasiswa/index', 'index');
//         Route::get('/admin/datasiswa/show', 'show');
//         Route::post('/admin/datasiswa/create', 'create');
//         Route::put('/admin/datasiswa/edit', 'edit');
//         Route::patch('/admin/datasiswa/update', 'update');
//         Route::delete('/admin/datasiswa/delete', 'destroy');
//     });


// Route::get('/dashboard', function () {
//     // Periksa status pengguna dan arahkan sesuai status mereka
//     if (Auth::user()->status == 'admin') {
//         return redirect('/dashboard/admin');
//     } elseif (Auth::user()->status == 'siswa') {
//         return redirect('/dashboard/siswa');
//     }
// })->middleware('auth');
