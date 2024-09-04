<?php

use App\Livewire\Dashboard\Admin\Admins;
use App\Livewire\Dashboard\Pages\Messages;
use App\Livewire\Dashboard\Pages\Taskboard;
use App\Livewire\Dashboard\Admin\AdminProfile;
use App\Livewire\Dashboard\Admin\PermitionGroups;
use App\Livewire\Dashboard\Auth\AuthLogin;
use App\Livewire\Dashboard\Auth\ResetPassword;
use App\Livewire\Dashboard\Auth\SuccessLogin;
use App\Livewire\Dashboard\Dashboard;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
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
Route::group(['prefix' => 'dashboard','middleware' => 'auth:admin'],function (){
    Route::get('/', Dashboard::class)->name('dashboard');
    Route::get('/success-login', SuccessLogin::class)->name('dashboard.success_login');
    Route::get('/admins', Admins::class)->name('dashboard.admins');
    Route::get('/permitions-groups', PermitionGroups::class)->name('dashboard.permitions_groups');
    Route::get('/profile', AdminProfile::class)->name('dashboard.profile');
    Route::get('/taskboard', Taskboard::class)->name('dashboard.taskboard');
    Route::get('/messages', Messages::class)->name('dashboard.messages');
});

Route::group(['prefix' => 'dashboard','middleware' => 'checkAdminLogin'],function (){
    Route::get('/login', AuthLogin::class)->name('dashboard.auth.login');
    Route::get('/reset-password', ResetPassword::class)->name('dashboard.auth.reset_password');
});


Route::get('/change-local/{lang}',function ($lang){
    if (!in_array($lang, ['en', 'ar'])) {
        abort(404);
    }
    app()->setLocale($lang);
    session()->put('locale',$lang);
    return redirect()->back();
})->name('dashboard.change_lang');
