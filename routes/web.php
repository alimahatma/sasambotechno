<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\InstansiController;
use App\Http\Controllers\KategoriProdukController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\RoleAdminController;
use App\Http\Controllers\RoleMemberController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\KurrirController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\SablonController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\TrxSablonController;
use App\Http\Controllers\WarnaController;
use App\Http\Middleware\Authenticate;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Auth;

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
// use App\Events\NewUserRegistered;

// Route::get('registers', function () {
//     event(new NewUserRegistered('info@dicloud.id'));
// });

Auth::routes([
    'verify' => true
]);

// route halaman landing page
Route::get('/', [HomeController::class, 'SendToIndex'])->name('landingpage');
Route::get('/produk', [HomeController::class, 'SendToProduk'])->name('produk');
Route::get('/tutorial', [HomeController::class, 'SendToTutorial'])->name('tutorial');
Route::get('/video', [HomeController::class, 'SendToVideo'])->name('video');
Route::get('/contact', [HomeController::class, 'SendToContact'])->name('contact');

// route authentication
Route::get('/login', [UserController::class, 'GetLogin'])->name('login');
Route::name('auth')->group(function () {
    Route::get('/register', [UserController::class, 'GetRegister'])->name('register');
    Route::get('/register', [UserController::class, 'GetRegister'])->name('register');
    Route::post('/addRegister', [UserController::class, 'PostRegister'])->name('addRegister');
    Route::post('/loginAuth', [UserController::class, 'AuthLogin'])->name('LoginAuth');
    // Route::post('/loginAuth', [Authenticate::class, 'AuthLogin'])->name('LoginAuth');
    Route::get('/logout', [UserController::class, 'Logout'])->name('logout');

    // route for reset password
    Route::get('/requestReset', [ResetPasswordController::class, 'ViewResetPasswd'])->name('RequestReset');
    Route::post('/sendResetPasswd', [ResetPasswordController::class, 'SendResetPasswd'])->name('SendResetPasswd');
    Route::get('/resetpasswdform/{token}', [ResetPasswordController::class, 'ResetPasswdForm'])->name('resetpasswdform.get');
    Route::post('/resetpasswdform', [ResetPasswordController::class, 'SendResetForm'])->name('resetpasswdform');
});

// route for role super admin
// route for table user
Route::prefix('user')->group(function () {
    Route::get('/', [UserController::class, 'GetAllUser'])->name('akun');
    Route::post('/change', [UserController::class, 'ChangeRole'])->name('change');
    Route::get('/delete/{id}', [UserController::class, 'Delete'])->name('delete');
});

// route table instansi
Route::prefix('instansi')->group(function () {
    Route::get('/', [InstansiController::class, 'GetInstansi'])->name('instansi');
    Route::post('/addinstansi', [InstansiController::class, 'AddInstansi'])->name('addInstansi');
    Route::post('/updtinstansi', [InstansiController::class, 'UpdtInstansi'])->name('updtinstansi');
    Route::get('/delete/{id}', [InstansiController::class, 'Delete'])->name('delete');
});

// route table kategori produk
Route::prefix('kategoriProduk')->group(function () {
    Route::get('/', [KategoriProdukController::class, 'GetKategori'])->name('kategori');
    Route::post('/addkategori', [KategoriProdukController::class, 'AddKategori'])->name('addKategori');
    Route::post('/updtkategori', [KategoriProdukController::class, 'UpdtKategori'])->name('updtKategori');
    Route::get('/delete/{id}', [KategoriProdukController::class, 'Delete'])->name('delete');
});

// route table produk
Route::prefix('produks')->group(function () {
    Route::get('/', [ProdukController::class, 'GetAllProduk'])->name('produk');
    Route::post('/addproduk', [ProdukController::class, 'AddProduct'])->name('addproduk');
    Route::post('/updtproduk', [ProdukController::class, 'UpdtProduct'])->name('updtproduk');
    Route::get('/deleteproduk/{id}', [ProdukController::class, 'DeleteProduk'])->name('deleteproduk');
});

// route table supplier
Route::prefix('supplier')->group(function () {
    Route::get('/', [SupplierController::class, 'GetSupplier'])->name('supplier');
    Route::post('/addsupplier', [SupplierController::class, 'AddSupplier'])->name('addsupplier');
    Route::post('/updtsupplier', [SupplierController::class, 'UpdtSupplier'])->name('updtsupplier');
    Route::get('/delete/{id}', [SupplierController::class, 'DeleteSupplier'])->name('deletesupplier');
});

// route table kurir
Route::prefix('kurir')->group(function () {
    Route::get('/', [KurrirController::class, 'GetKurir'])->name('kurir');
    Route::post('/addkurir', [KurrirController::class, 'AddKurir'])->name('addkurir');
    Route::post('/updtkurir', [KurrirController::class, 'UpdtKurir'])->name('updtkurir');
    Route::get('/delete/{id}', [KurrirController::class, 'DeleteKurir'])->name('deletekurir');
});

// route table sablon
Route::prefix('sablon')->group(function () {
    Route::get('/', [SablonController::class, 'GetSablon'])->name('sablon');
    Route::post('/addsablon', [SablonController::class, 'AddSablon'])->name('addsablon');
    Route::post('/updtsablon', [SablonController::class, 'UpdtSablon'])->name('updtsablon');
    Route::get('/delete/{id}', [SablonController::class, 'DeleteSablon'])->name('deletesablon');
});

// route table warna
Route::prefix('warna')->group(function () {
    Route::get('/', [WarnaController::class, 'GetWarna'])->name('warna');
    Route::post('/addwarna', [WarnaController::class, 'AddWarna'])->name('addwarna');
    Route::post('/updtwarna', [WarnaController::class, 'UpdtWarna'])->name('updtwarna');
    Route::get('/delete/{id}', [WarnaController::class, 'DeleteWarna'])->name('deletewarna');
});

// route table stok
Route::prefix('stok')->group(function () {
    Route::get('/', [StokController::class, 'GetStok'])->name('stok');
    Route::post('/addstok', [StokController::class, 'AddStok'])->name('addstok');
    Route::post('/updtstok', [StokController::class, 'UpdtStok'])->name('updtstok');
    Route::get('/delete/{id}', [StokController::class, 'DeleteStok'])->name('deletestok');
});

// route table transaksi
Route::prefix('transaksi')->group(function () {
    Route::get('/', [TransaksiController::class, 'GetTransaksi'])->name('transaksi');
});

// route table pesanan
Route::prefix('pesanan')->group(function () {
    Route::get('/', [PesananController::class, 'GetPesanan'])->name('pesanan');
});

// route table member
Route::prefix('member')->group(function () {
    Route::get('/', [MemberController::class, 'GetMember'])->name('member');
    Route::post('/addmember', [MemberController::class, 'AddMember'])->name('addmember');
    Route::post('/updtmember', [MemberController::class, 'UpdtMember'])->name('updtmember');
    Route::get('/delete/{id}', [MemberController::class, 'DeleteMember'])->name('deletemember');
});

// route transaksi sablon
Route::prefix('trx_sablon')->group(function () {
    Route::get('/', [TrxSablonController::class, 'GetTrxSablon'])->name('trxSablon');
    Route::post('/addtrxSablon', [TrxSablonController::class, 'AddTrxSablon'])->name('addtrxSablon');
    Route::post('/updttrxSablon', [TrxSablonController::class, 'UpdtTrxSablon'])->name('updttrxSablon');
    Route::get('/delete/{id}', [TrxSablonController::class, 'DeleteTrxSablon'])->name('deletetrxSablon');
});

// route role admin
Route::name('admin')->group(function () {
    Route::get('/index', [RoleAdminController::class, 'GetIndex'])->name('akun')->middleware('verified');
});

// route for role access member or client
Route::name('members')->group(function () {
    Route::get('/home', [RoleMemberController::class, 'GetHome'])->name('home')->middleware('verified');
    Route::get('/pilihbaju', [RoleMemberController::class, 'GetCloth'])->name('pilihbaju')->middleware('verified');
    Route::get('/trackingsablon', [TrxSablonController::class, 'GetTrxSablon'])->name('trackingSablon')->middleware('verified');
    Route::get('/trackingkurir', [RoleMemberController::class, 'GetKurirs'])->name('trackingKurir')->middleware('verified');
    Route::get('/getprofile', [MemberController::class, 'GetMember'])->name('getProfile')->middleware('verified');
    Route::post('/saveprofile', [MemberController::class, 'AddMember'])->name('addProfile')->middleware('verified');
    Route::get('/profile', [RoleMemberController::class, 'GetProfile'])->name('Profile')->middleware('verified');
    Route::get('/pesanananda', [TrxSablonController::class, 'GetPesananAnda'])->name('pesananAnda')->middleware('verified');
    Route::get('/invoice', [RoleMemberController::class, 'GetInvoice'])->name('invoice')->middleware('verified');
});
