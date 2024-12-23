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
use App\Livewire\Dashboard\Pages\PermitionAllow;
use App\Livewire\Dashboard\Setting\Countries;
use App\Livewire\Dashboard\Setting\Currencies;
use App\Livewire\Dashboard\Setting\Languages;
use App\Livewire\Dashboard\Setting\UserSpecials;
use App\Livewire\Dashboard\User\UserDetails;
use App\Livewire\Dashboard\User\Users;
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
Route::middleware(['checkAdminPermition','auth:admin'])->prefix('dashboard')->group(function (){
    Route::get('/', Dashboard::class)->name('dashboard');
    Route::get('/success-login', SuccessLogin::class)->name('dashboard.success_login');
    Route::get('/admins', Admins::class)->name('dashboard.admins');
    Route::get('/permitions-groups', PermitionGroups::class)->name('dashboard.permitions_groups');
    ###################### users / owners ###########################3
    Route::get('/users', Users::class)->name('dashboard.users');
    Route::get('/user-details/{username}', UserDetails::class)->name('dashboard.user_details');
    ############### settings ###################################
    Route::get('/countries', Countries::class)->name('dashboard.countries');
    Route::get('/languages', Languages::class)->name('dashboard.languages');
    Route::get('/currencies', Currencies::class)->name('dashboard.currencies');
    Route::get('/specials', UserSpecials::class)->name('dashboard.specials');
    #######################3 profile #################################
    Route::get('/profile', AdminProfile::class)->name('dashboard.profile');
    Route::get('/taskboard', Taskboard::class)->name('dashboard.taskboard');
    Route::get('/messages', Messages::class)->name('dashboard.messages');
});


Route::group(['prefix' => 'dashboard','middleware' => 'checkAdminLogin'],function (){
    Route::get('/login', AuthLogin::class)->name('dashboard.auth.login');
    Route::get('/reset-password', ResetPassword::class)->name('dashboard.auth.reset_password');
});

Route::get('/permition-denide', PermitionAllow::class)->name('dashboard.permition_denide');

Route::get('/change-local/{lang}',function ($lang){
    if (!in_array($lang, ['en', 'ar'])) {
        abort(404);
    }
    app()->setLocale($lang);
    session()->put('locale',$lang);
    return redirect()->back();
})->name('dashboard.change_lang');
