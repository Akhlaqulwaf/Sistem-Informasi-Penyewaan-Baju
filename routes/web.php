<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProdukController;

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

Auth::routes();
Route::get('/','user\WelcomeController@index')->name('home');
Route::get('/home','user\WelcomeController@index')->name('home2');
Route::get('/kontak','user\WelcomeController@kontak')->name('kontak');
Route::get('/produk','user\ProdukController@index')->name('user.produk');
Route::get('/produk/cari','user\ProdukController@cari')->name('user.produk.cari');
Route::get('/kategori/{id}','KategoriController@produkByKategori')->name('user.kategori');
Route::get('/produk/{id}','user\ProdukController@detail')->name('user.produk.detail');

Route::get('/jaza','user\JazaController@index')->name('user.jaza');
Route::get('/kelompok/{id}','KelompokController@jazaByKelompok')->name('user.kelompok');
Route::get('/jaza/{id}','user\JazaController@detail')->name('user.jaza.detail');


Route::group(['middleware' => ['auth','checkRole:admin']],function(){  
    Route::get('/admin','DashboardController@index')->name('admin.dashboard');
    Route::get('/pengaturan/alamat','admin\PengaturanController@aturalamat')->name('admin.pengaturan.alamat');
    Route::get('/pengaturan/ubahalamat/{id}','admin\PengaturanController@ubahalamat')->name('admin.pengaturan.ubahalamat');
    Route::get('/pengaturan/alamat/getcity/{id}','admin\PengaturanController@getCity')->name('admin.pengaturan.getCity');
    Route::post('pengaturan/simpanalamat','admin\PengaturanController@simpanalamat')->name('admin.pengaturan.simpanalamat');
    Route::post('pengaturan/updatealamat/{id}','admin\PengaturanController@updatealamat')->name('admin.pengaturan.updatealamat');

    Route::get('/admin/categories','admin\CategoriesController@index')->name('admin.categories');
    Route::get('/admin/categories/tambah','admin\CategoriesController@tambah')->name('admin.categories.tambah');
    Route::post('/admin/categories/store','admin\CategoriesController@store')->name('admin.categories.store');
    Route::post('/admin/categories/update/{id}','admin\CategoriesController@update')->name('admin.categories.update');
    Route::get('/admin/categories/edit/{id}','admin\CategoriesController@edit')->name('admin.categories.edit');
    Route::get('/admin/categories/delete/{id}','admin\CategoriesController@delete')->name('admin.categories.delete');

    Route::get('/admin/sizes','admin\SizesController@index')->name('admin.sizes');
    Route::get('/admin/sizes/tambah','admin\SizesController@tambah')->name('admin.sizes.tambah');
    Route::post('/admin/sizes/store','admin\SizesController@store')->name('admin.sizes.store');
    Route::post('/admin/sizes/update/{id}','admin\SizesController@update')->name('admin.sizes.update');
    Route::get('/admin/sizes/edit/{id}','admin\SizesController@edit')->name('admin.sizes.edit');
    Route::get('/admin/sizes/delete/{id}','admin\SizesController@delete')->name('admin.sizes.delete');
    
    Route::get('/admin/product','admin\ProductController@index')->name('admin.product');
    Route::get('/admin/product/tambah','admin\ProductController@tambah')->name('admin.product.tambah');
    Route::post('/admin/product/store','admin\ProductController@store')->name('admin.product.store');
    Route::get('/admin/product/edit/{id}','admin\ProductController@edit')->name('admin.product.edit');
    Route::get('/admin/product/delete/{id}','admin\ProductController@delete')->name('admin.product.delete');
    Route::post('/admin/product/update/{id}','admin\ProductController@update')->name('admin.product.update');
    Route::match(['get','post'],'/admin/product/addgambar/{id}','admin\ProductController@addgambar')->name('admin.product.addgambar');
    Route::match(['get','post'],'/admin/product/addAttributes/{id}','admin\ProductController@addAttributes')->name('admin.product.addAttributes');
    Route::get('/admin/product/deleteAttribute/{id}','admin\ProductController@deleteAttribute')->name('admin.product.deleteAttribute');
    Route::get('/admin/product/deleteGambar/{id}','admin\ProductController@deleteGambar')->name('admin.product.deleteGambar');

    Route::get('/admin/transaksi','admin\TransaksiController@index')->name('admin.transaksi');
    Route::get('/admin/transaksi/perludicek','admin\TransaksiController@perludicek')->name('admin.transaksi.perludicek');
    Route::get('/admin/transaksi/dipinjam','admin\TransaksiController@dipinjam')->name('admin.transaksi.dipinjam');
    Route::get('/admin/transaksi/denda','admin\TransaksiController@denda')->name('admin.transaksi.denda');
    Route::get('/admin/transaksi/detail/{id}','admin\TransaksiController@detail')->name('admin.transaksi.detail');
    Route::get('/admin/transaksi/detailDenda/{id}','admin\TransaksiController@detailDenda')->name('admin.transaksi.detailDenda');
    Route::get('/admin/transaksi/konfirmasi/{id}','admin\TransaksiController@konfirmasi')->name('admin.transaksi.konfirmasi');
    Route::get('/admin/transaksi/tolak/{id}','admin\TransaksiController@tolakpembayaran')->name('admin.transaksi.tolakpembayaran');
    Route::get('/admin/transaksi/selesai','admin\TransaksiController@selesai')->name('admin.transaksi.selesai');
    Route::get('/admin/transaksi/dibatalkan','admin\TransaksiController@dibatalkan')->name('admin.transaksi.dibatalkan');
    Route::get('/admin/transaksi/pesananditerima/{id}','admin\TransaksiController@pesananditerima')->name('admin.transaksi.pesananditerima');
    Route::get('/admin/transaksi/dendaterbayar/{id}','admin\TransaksiController@dendaterbayar')->name('admin.transaksi.dendaterbayar');
    Route::get('/admin/transaksi/kembali/{id}','admin\TransaksiController@kembali')->name('admin.transaksi.kembali');
    Route::get('/admin/transaksi/nota/{id}','admin\TransaksiController@nota')->name('admin.transaksi.nota');
    Route::get('/admin/transaksi/laptgl','admin\TransaksiController@laptgl')->name('admin.transaksi.laptgl');

    Route::get('/admin/rekening','admin\RekeningController@index')->name('admin.rekening');
    Route::get('/admin/rekening/edit/{id}','admin\RekeningController@edit')->name('admin.rekening.edit');
    Route::get('/admin/rekening/tambah','admin\RekeningController@tambah')->name('admin.rekening.tambah');
    Route::post('/admin/rekening/store','admin\RekeningController@store')->name('admin.rekening.store');
    Route::get('/admin/rekening/delete/{id}','admin\RekeningController@delete')->name('admin.rekening.delete');
    Route::post('/admin/rekening/update/{id}','admin\RekeningController@update')->name('admin.rekening.update');

    Route::get('/admin/pelanggan','admin\PelangganController@index')->name('admin.pelanggan');

    //Route Jasa Hafis
    //kategori admin hafis jasa
    Route::get('/admin/kelompoks','admin\KelompoksController@index')->name('admin.kelompoks');
    Route::get('/admin/kelompoks/tambah','admin\KelompoksController@tambah')->name('admin.kelompoks.tambah');
    Route::post('/admin/kelompoks/store','admin\KelompoksController@store')->name('admin.kelompoks.store');
    Route::post('/admin/kelompoks/update/{id}','admin\KelompoksController@update')->name('admin.kelompoks.update');
    Route::get('/admin/kelompoks/edit/{id}','admin\KelompoksController@edit')->name('admin.kelompoks.edit');
    Route::get('/admin/kelompoks/delete/{id}','admin\KelompoksController@delete')->name('admin.kelompoks.delete');

    //product jasa hafis
    Route::get('/admin/jasa','admin\JasaController@index')->name('admin.jasa');
    Route::get('/admin/jasa/tambah','admin\JasaController@tambah')->name('admin.jasa.tambah');
    Route::post('/admin/jasa/store','admin\JasaController@store')->name('admin.jasa.store');
    Route::get('/admin/jasa/edit/{id}','admin\JasaController@edit')->name('admin.jasa.edit');
    Route::get('/admin/jasa/delete/{id}','admin\JasaController@delete')->name('admin.jasa.delete');
    Route::post('/admin/jasa/update/{id}','admin\JasaController@update')->name('admin.jasa.update');
    Route::match(['get','post'],'/admin/jasa/addAttributes/{id}','admin\JasaController@addAttributes')->name('admin.jasa.addAttributes');
    Route::get('/admin/jasa/deleteAttribute/{id}','admin\JasaController@deleteAttribute')->name('admin.jasa.deleteAttribute');

    //transaksi jasa hafis
    Route::get('/admin/trans','admin\TransController@index')->name('admin.trans');
    Route::get('/admin/trans/perludicek','admin\TransController@perludicek')->name('admin.trans.perludicek');
    Route::get('/admin/trans/detail/{id}','admin\TransController@detail')->name('admin.trans.detail');
    Route::get('/admin/trans/konfirmasi/{id}','admin\TransController@konfirmasi')->name('admin.trans.konfirmasi');
    Route::get('/admin/trans/selesai','admin\TransController@selesai')->name('admin.trans.selesai');
    Route::get('/admin/trans/dibatalkan','admin\TransController@dibatalkan')->name('admin.trans.dibatalkan');

    //rekening
    Route::get('/admin/bon','admin\BonController@index')->name('admin.bon');
    Route::get('/admin/bon/edit/{id}','admin\BonController@edit')->name('admin.bon.edit');
    Route::get('/admin/bon/tambah','admin\BonController@tambah')->name('admin.bon.tambah');
    Route::post('/admin/bon/store','admin\BonController@store')->name('admin.bon.store');
    Route::get('/admin/bon/delete/{id}','admin\BonController@delete')->name('admin.bon.delete');
    Route::post('/admin/bon/update/{id}','admin\BonController@update')->name('admin.bon.update');
});

Route::group(['middleware' => ['auth','checkRole:customer']],function(){
    Route::post('/keranjang/simpan','user\KeranjangController@simpan')->name('user.keranjang.simpan');
    Route::get('/keranjang','user\KeranjangController@index')->name('user.keranjang');
    Route::post('/keranjang/update','user\KeranjangController@update')->name('user.keranjang.update');
    Route::get('/keranjang/delete/{id}','user\KeranjangController@delete')->name('user.keranjang.delete');

    //keranjang jasa Hafis
    Route::post('/keranjank/simpan','user\KeranjankController@simpan')->name('user.keranjank.simpan');
    Route::get('/keranjank','user\KeranjankController@index')->name('user.keranjank');
    Route::post('/keranjank/update','user\KeranjankController@update')->name('user.keranjank.update');
    Route::get('/keranjank/delete/{id}','user\KeranjankController@delete')->name('user.keranjank.delete');
    
    Route::get('/alamat','user\AlamatController@index')->name('user.alamat');
    Route::post('/alamat/update/{id}','user\AlamatController@update')->name('user.alamat.update');
    Route::get('/alamat/edit/{id}','user\AlamatController@edit')->name('user.alamat.edit');


    Route::get('/checkout','user\CheckoutController@index')->name('user.checkout');
    Route::post('/order/simpan','user\OrderController@simpan')->name('user.order.simpan');
    Route::get('/order/sukses','user\OrderController@sukses')->name('user.order.sukses');
    Route::get('/order','user\OrderController@index')->name('user.order');
    Route::get('/order/detail/{id}','user\OrderController@detail')->name('user.order.detail');
    Route::get('/order/pesanandibatalkan/{id}','user\OrderController@pesanandibatalkan')->name('user.order.pesanandibatalkan');
    Route::get('/order/pembayaran/{id}','user\OrderController@pembayaran')->name('user.order.pembayaran');
    Route::post('/order/kirimbukti/{id}','user\OrderController@kirimbukti')->name('user.order.kirimbukti');
    Route::post('/order/buktiDenda/{id}','user\OrderController@buktiDenda')->name('user.order.buktiDenda');
});