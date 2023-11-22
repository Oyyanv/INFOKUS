<?php
use App\Http\Controllers\SessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;
use illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::get('/login', function () {
//     return view('sesi/login');
// });

// Route::middleware(['guest'])->group(function(){

//     Route::post('api/login/proses', [SessionController::class,'index'])->name('api.login.proses')->middleware('web');

//     Route::post('api/login/proses',[SessionController::class,'login']);

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

Route::get('/admin/datasiswa/index', [AdminController::class, 'index'] );

Route::group(['prefix' => '/admin/datasiswa'], function () {
    Route::get('/index', [SiswaController::class, 'index']);
    Route::get('/show', [SiswaController::class, 'show']);
    Route::post('/create', [SiswaController::class, 'create']);
    Route::put('/edit', [SiswaController::class, 'edit']);
    Route::patch('/update', [SiswaController::class, 'update']);
    Route::delete('/delete', [SiswaController::class, 'destroy']);
});

