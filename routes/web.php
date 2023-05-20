<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes([
    'register' => false,
]);

Route::prefix('admin')
    ->middleware(['admin', 'auth'])
    ->group(function () {
        Route::get('dashboard', 'Admin\DashboardController@index')->name('admin.dashboard.index');

        // CRUD USER
        Route::get('user', 'Admin\UserController@index')->name('admin.user.index');
        Route::post('user/create', 'Admin\UserController@store')->name('admin.user.store');
        Route::post('user/update/{id}', 'Admin\UserController@update')->name('admin.user.update');
        Route::get('user/delete/{id}', 'Admin\UserController@delete')->name('admin.user.delete');

        // CRUD JABATAN
        Route::get('jabatan', 'Admin\JabatanController@index')->name('admin.jabatan.index');
        Route::post('jabatan/create', 'Admin\JabatanController@store')->name('admin.jabatan.store');
        Route::post('jabatan/update/{id}', 'Admin\JabatanController@update')->name('admin.jabatan.update');
        Route::get('jabatan/delete/{id}', 'Admin\JabatanController@delete')->name('admin.jabatan.delete');

        // reimbuse
        Route::get('reimbuse', 'Admin\ReimbuseController@index')->name('admin.reimbuse.index');
        Route::get('reimbuse/{id}', 'Admin\ReimbuseController@show')->name('admin.reimbuse.show');
    });


Route::prefix('karyawan')
    ->middleware(['karyawan', 'auth'])
    ->group(function () {
        Route::get('dashboard', 'Karyawan\DashboardController@index')->name('karyawan.dashboard.index');

        // CRUD REIMBUSE
        Route::get('reimbuse', 'Karyawan\ReimbuseController@index')->name('karyawan.reimbuse.index');
        Route::post('reimbuse/create', 'Karyawan\ReimbuseController@store')->name('karyawan.reimbuse.store');

        Route::get('reimbuse/approve', 'Karyawan\ReimbuseController@indexApprove')->name('karyawan.reimbuse.index.approve');
        Route::post('reimbuse/approve/{id}', 'Karyawan\ReimbuseController@approve')->name('karyawan.reimbuse.approve');
        Route::get('reimbuse/{id}', 'Karyawan\ReimbuseController@show')->name('karyawan.reimbuse.show');


    });

Route::prefix('keuangan')
    ->middleware(['keuangan', 'auth'])
    ->group(function () {
        Route::get('dashboard', 'Keuangan\DashboardController@index')->name('keuangan.dashboard.index');

        Route::get('reimbuse', 'Keuangan\ReimbuseController@index')->name('keuangan.reimbuse.index');
        Route::get('reimbuse/all', 'Keuangan\ReimbuseController@indexAll')->name('keuangan.reimbuse.index-all');
        Route::get('reimbuse/detail/{id}', 'Keuangan\ReimbuseController@show')->name('keuangan.reimbuse.show');
        Route::get('reimbuse/ditolak', 'Keuangan\ReimbuseController@indexTolak')->name('keuangan.reimbuse.index.tolak');
        Route::post('reimbuse/payment-voucher/{reimbuse_id}', 'Keuangan\ReimbuseController@paymentVoucher')->name('keuangan.reimbuse.payment.voucher');
        Route::put('reimbuse/payment-voucher/{reimbuse_id}', 'Keuangan\ReimbuseController@updatePaymentVoucher')->name('keuangan.reimbuse.payment.voucher.update');
        Route::post('reimbuse/tolak/{reimbuse_id}', 'Keuangan\ReimbuseController@reimbuseTolak')->name('keuangan.reimbuse.tolak');
        Route::get('reimbuse/transfer', 'Keuangan\ReimbuseController@indexTransfer')->name('keuangan.reimbuse.index.transfer');
        Route::post('reimbuse/transfer/{reimbuse_id}', 'Keuangan\ReimbuseController@approveTransfer')->name('keuangan.reimbuse.index.upload.bukti.transfer');
    });

Route::prefix('partner')
    ->middleware(['partner', 'auth'])
    ->group(function () {
        Route::get('dashboard', 'Partner\DashboardController@index')->name('partner.dashboard.index');

        Route::get('reimbuse', 'Partner\ReimbuseController@index')->name('partner.reimbuse.index');
        Route::get('reimbuse/detail/{id}', 'Partner\ReimbuseController@show')->name('partner.reimbuse.show');
        Route::post('reimbuse/approve/{reimbuse_id}', 'Partner\ReimbuseController@approve')->name('partner.reimbuse.approve');
        Route::post('reimbuse/reject/{reimbuse_id}', 'Partner\ReimbuseController@reject')->name('partner.reimbuse.reject');
    });


Route::prefix('sekretaris')
    ->middleware(['sekretaris', 'auth'])
    ->group(function () {
        Route::get('dashboard', 'Sekretaris\DashboardController@index')->name('sekretaris.dashboard.index');

        Route::get('reimbuse', 'Sekretaris\ReimbuseController@index')->name('sekretaris.reimbuse.index');
        Route::get('reimbuse/detail/{id}', 'Sekretaris\ReimbuseController@show')->name('sekretaris.reimbuse.show');
        Route::post('reimbuse/approve/{reimbuse_id}', 'Sekretaris\ReimbuseController@approve')->name('sekretaris.reimbuse.approve');
        Route::post('reimbuse/reject/{reimbuse_id}', 'Sekretaris\ReimbuseController@reject')->name('sekretaris.reimbuse.reject');

        // Route::get('reimbuse/transfer', 'Sekretaris\ReimbuseController@indexTransfer')->name('sekretaris.reimbuse.index.transfer');
        // Route::post('reimbuse/transfer/{reimbuse_id}', 'Sekretaris\ReimbuseController@uploadBuktiTransfer')->name('sekretaris.reimbuse.index.upload.bukti.transfer');
    });


Route::middleware(['auth'])->group(function () {
    Route::get('payment-voucher/pdf/{reimbuse_id}/{param?}', 'PaymentVoucherController@generatePdf')->name('generatePdf');

    Route::get('lihat-bukti/{reimbuse_id}/{param?}', 'PaymentVoucherController@lihatBuktiNota')->name('lihat.bukti.nota');
});
