<?php
use App\Http\Controllers\SessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\AdminController;
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

Route::get('/login', function () {
    return view('sesi/login');
});

Route::middleware(['guest'])->group(function(){

    Route::get('/login',[SessionController::class,'index'])->name('login');
    Route::post('/login/proses',[SessionController::class,'login']);

});

Route::get('/home', function(){
    return redirect('/dashboard');
});

// Route::get ('/dashboard',[DashboardController::class, 'index']);
Route::middleware(['auth','isLogin'])->group(function(){
    Route::get('/logout', [SessionController::class, 'logout'] );
    Route::get('/dashboard', [DashboardController::class, 'index'] );
    // ->middleware('isLogin');
    Route::get('/dashboard/siswa', [DashboardController::class, 'siswa'] )->middleware('userAkses:siswa');
    Route::get('/dashboard/admin', [DashboardController::class, 'admin'] )->middleware('userAkses:admin');
});

Route::middleware(['auth','isLogin'])->group(function(){
    Route::get('/logout', [SessionController::class, 'logout'] );
    Route::get('/dashboard', [DashboardController::class, 'index'] );
    // ->middleware('isLogin');
    Route::get('/dashboard/siswa', [DashboardController::class, 'siswa'] )->middleware('userAkses:siswa');
    Route::get('/dashboard/admin', [DashboardController::class, 'admin'] )->middleware('userAkses:admin');

});

Route::middleware(['auth','isLogin'])->group(function(){
    Route::get('/admin/datasiswa', [AdminController::class, 'index'] )->middleware('userAkses:admin');
    
    Route::controller(SiswaController::class)->group(function (){
        Route::get('/siswa/index', 'index');
        Route::post('/siswa/create', 'create');
        Route::put('/siswa/edit', 'edit');
        Route::patch('/siswa/update', 'update');
        Route::delete('/siswa/delete', 'destroy');
    });
});

