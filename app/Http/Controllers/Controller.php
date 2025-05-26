<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Carbon\Carbon;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function TS(){
        // $sprint=[[
        //     ["TEST_CASE_ID"=>"TC001","SPRINT"=>"1","CREATED_BY"=>"Dika","DATE_OF_CREATION"=>"45729","EXECUTED_BY"=>"Farhan","DATE_OF_EXECUTION"=>"45729","TYPE"=>"NORMAL FLOW","CODE_REQUIREMENT"=>"R011 - Mengelola Data Pengguna","FITUR_NAME"=>"Mengelola Data Pribadi","TEST_CASE_DESCRIPTION"=>"Menguji agar pengguna (PKL dan Customer) dapat mengakses dan mengubah informasi profil pada aplikasi JelajahKuliner.","PREREQUISITIES"=>"-Pengguna telah memiliki akun dan login ke dalam aplikasi JelajahKuliner.
        //                 -Pengguna dapat mengakses halaman 'My Profile' pada dashboard.","TEST_STEPS"=>"Pengguna mengakses halaman 'My Profile' melalui dashboard.
        //                 Sistem menampilkan informasi profil pengguna yang akurat dan terbaru.
        //                 Pengguna menekan tombol 'Edit' untuk mengubah informasi profil.
        //                 Pengguna mengubah satu atau beberapa field (contoh: nama, nomor telepon, email).
        //                 Pengguna menekan tombol 'Simpan Perubahan' untuk menyimpan perubahan.
        //                 Sistem menyimpan perubahan data dengan aman.
        //                 Sistem memberikan feedback 'Perubahan berhasil disimpan'.","TEST_DATA"=>"Nama Lama: Budi Santoso 
        //                 Nama Baru: Budi Wijaya
        //                 Nomor Telepon Lama: 08123456789
        //                 Nomor Telepon Baru: 08129876543
        //                 Email Lama: budi@budi.com 
        //                 Email Baru: budiwijaya@budi.com","EXPECTED_RESULT"=>"Sistem berhasil memperbarui informasi pengguna dan menampilkan pesan sukses: 'Perubahan berhasil disimpan'.","ACTUAL_RESULT"=>"Sistem berhasil memperbarui informasi pengguna dan menampilkan pesan sukses: 'Perubahan berhasil disimpan'.","STATUS"=>"Berhasil","CATATAN"=>""],["TEST_CASE_ID"=>"TC002","SPRINT"=>"1","CREATED_BY"=>"Farhan","DATE_OF_CREATION"=>"45729","EXECUTED_BY"=>"Evi","DATE_OF_EXECUTION"=>"45729","TYPE"=>"NORMAL FLOW","CODE_REQUIREMENT"=>"R027 - Melakukan Logout","FITUR_NAME"=>"Melakukan Log Out","TEST_CASE_DESCRIPTION"=>"Menguji Autentikasi Aplikasi dalam Melakukan Logout dengan Tidak Menyimpan Login Dari Pengguna","PREREQUISITIES"=>"- User Telah Melakukan Login (TC004)
        //                 ","TEST_STEPS"=>"- Dalam Website Jelajah Kuliner
        //                 - Mengakses Sidebar
        //                 - Click Tombol Logout","TEST_DATA"=>"none","EXPECTED_RESULT"=>"Berhasil mengakhiri sesi","ACTUAL_RESULT"=>"Berhasil mengakhiri sesi","STATUS"=>"Berhasil","CATATAN"=>""],["TEST_CASE_ID"=>"TC003","SPRINT"=>"1","CREATED_BY"=>"Evi","DATE_OF_CREATION"=>"45729","EXECUTED_BY"=>"Zidan","DATE_OF_EXECUTION"=>"45729","TYPE"=>"NORMAL FLOW","CODE_REQUIREMENT"=>"R007 - Membaca Profil PKL","FITUR_NAME"=>"Membaca Data PKL","TEST_CASE_DESCRIPTION"=>"Menguji Agar Pengguna Dapat Melihat dan Membaca data PKL yang ada di maps","PREREQUISITIES"=>"- Koneksi Internet Stabil
        //                 - Harus Sudah ada At Least 1 PKL yang terdaftar
        //                 - Test Case TC006 harus sudah berhasil terlebih dahulu untuk user PKL","TEST_STEPS"=>"- Buka Website Jelajah Kuliner
        //                 - Masuk Halaman Dashboard
        //                 - Klik Salah satu PKL
        //                 - Baca/Lihat Data ","TEST_DATA"=>"none","EXPECTED_RESULT"=>"- Data PKL Terbaca (Menu, Ulasan, Foto PKL)","ACTUAL_RESULT"=>"PKL Terlihat dengan foto, Ulasan, Dan Menu, dan Terdapat Tombol Pesan","STATUS"=>"Berhasil","CATATAN"=>"-"],["TEST_CASE_ID"=>"TC004","SPRINT"=>"1","CREATED_BY"=>"Farhan","DATE_OF_CREATION"=>"45729","EXECUTED_BY"=>"Dika","DATE_OF_EXECUTION"=>"45729","TYPE"=>"NORMAL FLOW","CODE_REQUIREMENT"=>"R002 - Melakukan Login","FITUR_NAME"=>"Melakukan Login","TEST_CASE_DESCRIPTION"=>"Menguji Pengguna Dalam Melakukan Autentikasi Untuk Mengakses Aplikasi","PREREQUISITIES"=>"- Koneksi Internet Stabil
        //                 - Telah Melakukan Registrasi (Buat Akun)
        //                 - Test Case TC006 Harus Sudah Berhasil Untuk User (Pengguna Atau PKL)
        //                 - Mengetahui Email dan Password","TEST_STEPS"=>"- Buka Website Jelajah Kuliner
        //                 - Masuk Halaman Login
        //                 - Masukkan Data Email
        //                 - Masukkan Password
        //                 - Klik Login

        //                 ","TEST_DATA"=>"- Email (String)/budi@budi.com 
        //                 - Password (Hash)/123","EXPECTED_RESULT"=>"Sistem akan memverifikasi data Login pengguna yang jika benar nantinya akan mengarahkan Pengguna ke Halaman Dashboard.","ACTUAL_RESULT"=>"berhasil, masuk ke halaman dashboard","STATUS"=>"Berhasil","CATATAN"=>""],["TEST_CASE_ID"=>"TC005","SPRINT"=>"1","CREATED_BY"=>"Eka","DATE_OF_CREATION"=>"45729","EXECUTED_BY"=>"Awan","DATE_OF_EXECUTION"=>"45729","TYPE"=>"NORMAL FLOW","CODE_REQUIREMENT"=>"R019 - Meihat Dashboard PKL","FITUR_NAME"=>"Melihat Dashboard PKL","TEST_CASE_DESCRIPTION"=>"Menguji Akun PKL apakah dapat melihat dashboard yang menampilkan List menu yang dijual, Ulasan Yang didapat","PREREQUISITIES"=>"- Koneksi Internet Stabil
        //                 - Memiliki Akses Browser
        //                 - Memiliki Link Webstie
        //                 - Account berstatus PKL
        //                 - Sudah Melakukan Buat Data PKL","TEST_STEPS"=>"- Buka Website Jelajah Kuliner
        //                 - Login Dengan Data PKL
        //                 - Klik Dashboard PKL
        //                 - Aksesn Halaman Dashboard PKL","TEST_DATA"=>"- Email (String)/budi@budi.com 
        //                 - Password (Hash)/123","EXPECTED_RESULT"=>"Sistem akan Menampilkan data Apa saja yang dijual dan  Ulasan apa saja yang di dapat","ACTUAL_RESULT"=>"berhasil, masuk kedalam dashboard PKL dan dapat ke menu Tambah Produk dan dpaat melihat Ulasan","STATUS"=>"Berhasil","CATATAN"=>""],["TEST_CASE_ID"=>"TC006","SPRINT"=>"1","CREATED_BY"=>"Awan","DATE_OF_CREATION"=>"45729","EXECUTED_BY"=>"Eka","DATE_OF_EXECUTION"=>"45729","TYPE"=>"NORMAL FLOW","CODE_REQUIREMENT"=>"R001 - Melakukan Registrasi","FITUR_NAME"=>"Melakukan Pendaftaran","TEST_CASE_DESCRIPTION"=>"Menguji skenario yang valid dengan data benar
        //                 Menguji skenario yang salah dalam hal seperti email tidak valid,password lemah atau kolom kosong
        //                 menguji batas minimal dan maksimal dari input","PREREQUISITIES"=>"-Akun dan Data Uji
        //                 -Alat pengujian
        //                 -Spesifikasi Dan Dokumentasi
        //                 -Hak Akses dan Akun
        //                 -Pemahaman Alur bisnis","TEST_STEPS"=>"- Buka Website Jelajah Kuliner
        //                 - Masuk Halaman Daftar
        //                 - Masukkan Data Email
        //                 - Masukkan Password
        //                 - Jika sudah Maka Masuk Di Dasbor Utama
        //                 ","TEST_DATA"=>"- Email (String)/budi@budi.com 
        //                 - Password (Hash)/123","EXPECTED_RESULT"=>"Dalam hal ini dengan input valid data,input Data TIdak Lengkap,Format Data Salah, Passowrd Tidak Sesuai Kriteria,Username atau Email Sudah Terdaftar","ACTUAL_RESULT"=>"berhasil, masuk ke halaman dashboard","STATUS"=>"Berhasil","CATATAN"=>""],["TEST_CASE_ID"=>"TC007","SPRINT"=>"1","CREATED_BY"=>"Zidan","DATE_OF_CREATION"=>"45729","EXECUTED_BY"=>"Eka","DATE_OF_EXECUTION"=>"45729","TYPE"=>"NORMAL FLOW","CODE_REQUIREMENT"=>"R003 - Melihat Map","FITUR_NAME"=>"Melihat Map","TEST_CASE_DESCRIPTION"=>"Menguji Apakah Pengguna ketika Menjalankan Aplikasi Apakah Terlihat Map (Peta)","PREREQUISITIES"=>"- Akses Browser
        //                 - Akses Link Ke Website","TEST_STEPS"=>"- Buka Website Jelajah Kuliner","TEST_DATA"=>"none","EXPECTED_RESULT"=>"Peta terlihat beserta seluurh data PKL","ACTUAL_RESULT"=>"berhasil, peta dan data penjual terlihat","STATUS"=>"Berhasil","CATATAN"=>""],["TEST_CASE_ID"=>"TC008","SPRINT"=>"1","CREATED_BY"=>"Evi","DATE_OF_CREATION"=>"45729","EXECUTED_BY"=>"Awan","DATE_OF_EXECUTION"=>"45729","TYPE"=>"NORMAL FLOW","CODE_REQUIREMENT"=>"R008 - Melihat Review","FITUR_NAME"=>"Melihat Ulasan","TEST_CASE_DESCRIPTION"=>"Menguji Website agar Pengguna Dapat melihat ulasan pengguna pada PKL yang ada di maps","PREREQUISITIES"=>"- Koneksi Internet Stabil
        //                 - Harus Sudah ada At Least 1 PKL yang terdaftar
        //                 - Test Case Membuat Ulasan harus sudah berhasil terlebih dahulu
        //                 ","TEST_STEPS"=>"- Buka Website Jelajah Kuliner
        //                 - Masuk Halaman Dashboard
        //                 - Klik Salah satu PKL
        //                 - Klik Menu 'Ulasan'
        //                 - Baca Ulasan","TEST_DATA"=>"none","EXPECTED_RESULT"=>"- ulasan Pengguna berhasil terlihat/terbaca",
        //                 "ACTUAL_RESULT"=>"berhasil melihat ulasan pengguna","STATUS"=>"berhasil","CATATAN"=>""]],
        //                 [
        //                     ["TEST_CASE_ID"=>"TC009","SPRINT"=>"2","CREATED_BY"=>"Dika","DATE_OF_CREATION"=>"45733","EXECUTED_BY"=>"Evi","DATE_OF_EXECUTION"=>"45734","CODE_REQUIREMENT"=>"R012 - Memberi Review Terhadap Toko","TYPE"=>"NORMAL FLOW","FITUR_NAME"=>"Memberi Review Terhadap Toko","TEST_CASE_DESCRIPTION"=>"Menguji agar pengguna (Customer) dapat mememberikan review terhadap toko yang ingin di review ","PREREQUISITIES"=>"- user sudah dalam kondisi login
        //                     - koneksi jaringan stabil
        //                     - ","TEST_STEPS"=>"-klik tombol ulasan
        //                     - masukan ulasan anda dan bintang anda
        //                     - selesai","TEST_DATA"=>"none","EXPECTED_RESULT"=>"Berhasil memberikan review ","ACTUAL_RESULT"=>"Review berhasil diberikan oleh pengguna. Sistem menampilkan notifikasi bahwa ulasan telah tersimpan, bintang ulasan tampil sesuai input, dan review langsung muncul di halaman toko.","STATUS"=>"Success","CATATAN"=>""],["TEST_CASE_ID"=>"TC010","SPRINT"=>"2","CREATED_BY"=>"Farhan","DATE_OF_CREATION"=>"45734","EXECUTED_BY"=>"Awan","DATE_OF_EXECUTION"=>"45735","CODE_REQUIREMENT"=>"R021 - Mengisi Jumlah Akhir Stok Jualan","TYPE"=>"NORMAL FLOW","FITUR_NAME"=>"Mengisi Akhir Stok Penjualan","TEST_CASE_DESCRIPTION"=>"Menguji agar user mengisi stock penjualan akhir","PREREQUISITIES"=>"- user berada pada dashbord pkl
        //                     ","TEST_STEPS"=>"-klik tombol set stock akhir 
        //                     - isi stock yang ingin diisi
        //                     - klik save","TEST_DATA"=>"none","EXPECTED_RESULT"=>"Stok akhir dapat diisi atau di update","ACTUAL_RESULT"=>"Stok akhir berhasil diperbarui. Setelah pengguna menekan tombol simpan, jumlah stok ditampilkan sesuai input dan sistem menampilkan konfirmasi pembaruan berhasil.","STATUS"=>"Success","CATATAN"=>""],["TEST_CASE_ID"=>"TC011","SPRINT"=>"2","CREATED_BY"=>"Awan","DATE_OF_CREATION"=>"45735","EXECUTED_BY"=>"Evi","DATE_OF_EXECUTION"=>"45736","CODE_REQUIREMENT"=>"R020 - Mengisi Jumlah Awal Stok Jualan","TYPE"=>"NORMAL FLOW","FITUR_NAME"=>"Mengisi Jumlah Awal Stok Jualan","TEST_CASE_DESCRIPTION"=>"Menguji agar user mengisi stock penjualan di awal","PREREQUISITIES"=>"- user berada pada dashbord pkl
        //                     ","TEST_STEPS"=>"-klik tombol set stock awal
        //                     - isi stock yang ingin diisi
        //                     - klik save","TEST_DATA"=>"none","EXPECTED_RESULT"=>"Stock awal dapat diisi atau di update","ACTUAL_RESULT"=>"Stok awal berhasil diisi. Sistem mengupdate data stok dan menampilkan jumlah awal sesuai input yang diberikan oleh pengguna, tanpa adanya error.","STATUS"=>"Success","CATATAN"=>""],["TEST_CASE_ID"=>"TC012","SPRINT"=>"2","CREATED_BY"=>"Zidan","DATE_OF_CREATION"=>"45736","EXECUTED_BY"=>"Dika","DATE_OF_EXECUTION"=>"45737","CODE_REQUIREMENT"=>"R023 - Mengelola Penjualan","TYPE"=>"NORMAL FLOW","FITUR_NAME"=>"Mengelola Penjualan","TEST_CASE_DESCRIPTION"=>"Menguji agar user dapat melakukan pengelolaan penjualan ","PREREQUISITIES"=>"- user berada di dalam halaman dashboard penjualan
        //                     - koneksi jaringan stabil","TEST_STEPS"=>"- klik tombol penjualan","TEST_DATA"=>"none","EXPECTED_RESULT"=>"Terlihat list dashboard penjulaan, dan dapat melihat by filter bulanan, tahun atau hari","ACTUAL_RESULT"=>"Halaman pengelolaan penjualan berhasil ditampilkan. Tombol dan fitur transaksi aktif, serta sistem menampilkan daftar transaksi penjualan dengan benar.","STATUS"=>"Success","CATATAN"=>""],["TEST_CASE_ID"=>"TC013","SPRINT"=>"2","CREATED_BY"=>"Evi","DATE_OF_CREATION"=>"45737","EXECUTED_BY"=>"Dika","DATE_OF_EXECUTION"=>"45738","CODE_REQUIREMENT"=>"R014 - Mengelola Pesanan","TYPE"=>"NORMAL FLOW","FITUR_NAME"=>"Mengelola Pesanan","TEST_CASE_DESCRIPTION"=>"Menguji agar User dapat melihat List Pesanan tanpa terkendala","PREREQUISITIES"=>"- User dalam kondisi sudah login
        //                     - Koneksi Jaringan Stabil
        //                     - Berada dihalaman beranda","TEST_STEPS"=>"- Klik Garis 3 (Burger)
        //                     - Klik tombol 'List Pesanan'","TEST_DATA"=>"none","EXPECTED_RESULT"=>"List Pesanan berhasil di tampilkan atau dilihat","ACTUAL_RESULT"=>"List Pesanan berhasil ditampilkan. Pengguna dapat melihat seluruh riwayat dan status pesanan dengan baik, halaman berjalan lancar tanpa error.","STATUS"=>"Success","CATATAN"=>""],["TEST_CASE_ID"=>"TC014","SPRINT"=>"2","CREATED_BY"=>"Eka","DATE_OF_CREATION"=>"45738","EXECUTED_BY"=>"Farhan","DATE_OF_EXECUTION"=>"45739","CODE_REQUIREMENT"=>"R018 - Mengupdate Status Pesanan","TYPE"=>"NORMAL FLOW","FITUR_NAME"=>"Mengupdate Status Pesanan","TEST_CASE_DESCRIPTION"=>" Menguji alur pesanan mulai dari penerimaan hingga selesai, mencakup perubahan status, pengurangan stok, dan fitur laporan jika pesanan gagal.","PREREQUISITIES"=>"-Koneksi Jaringan aman
        //                     -Sudah Login dalam User Atau PKL
        //                     -Berada dalam halaman Pesan","TEST_STEPS"=>"-Pastikan pengguna berada di halaman Kelola Pesanan.
        //                     -Tekan tombol Terima atau Tolak.
        //                     -Jika Terima, pilih Siap Diambil atau Sedang Dibuat.
        //                     -Jika Sedang Dibuat, tekan Pesanan Selesai.
        //                     -Verifikasi status berubah ke Siap Diambil, lalu tekan Pesanan Berhasil atau Pesanan Batal.
        //                     -Jika Pesanan Berhasil, verifikasi status berubah dan stok berkurang.
        //                     -Jika Pesanan Gagal, akses fitur Laporkan Customer, isi formulir, dan selesaikan proses.","TEST_DATA"=>"none","EXPECTED_RESULT"=>"List update pesanan akan di tampilkan","ACTUAL_RESULT"=>"Status pesanan berhasil diperbarui sesuai alur. Perubahan status ditampilkan real-time (dari Terima → Sedang Dibuat → Selesai), stok berkurang otomatis, dan fitur lapor customer juga berfungsi dengan baik.","STATUS"=>"Success","CATATAN"=>""],["TEST_CASE_ID"=>"TC015","SPRINT"=>"2","CREATED_BY"=>"Eka","DATE_OF_CREATION"=>"45739","EXECUTED_BY"=>"Zidan","DATE_OF_EXECUTION"=>"45740","CODE_REQUIREMENT"=>"R010 - Membatalkan Pesanan","TYPE"=>"NORMAL FLOW","FITUR_NAME"=>"Membatalkan Pesanan","TEST_CASE_DESCRIPTION"=>"Menguji pembatalan pesanan oleh customer sebelum diterima PKL, di mana customer menekan Batalkan Pesanan, mengisi alasan, dan sistem mengubah status menjadi Pesanan Dibatalkan serta menghapus pesanan dari tampilan PKL.","PREREQUISITIES"=>"-Koneksi Jaringan aman
        //                     -Sudah Login dalam User Atau PKL
        //                     -Berada dalam halaman Pesan","TEST_STEPS"=>"-Pastikan customer telah melakukan pemesanan di aplikasi.
        //                     -Verifikasi bahwa tombol Batalkan Pesanan tersedia jika pesanan belum diterima oleh PKL.
        //                     -Tekan tombol Batalkan Pesanan.
        //                     -Isi alasan pembatalan pada kolom yang tersedia.
        //                     -Simpan alasan pembatalan.
        //                     -Verifikasi bahwa status pesanan berubah menjadi Pesanan Dibatalkan.
        //                     -Pastikan pesanan tidak lagi muncul di aplikasi PKL.
        //                     -Verifikasi bahwa sistem mencatat pembatalan dengan sukses.","TEST_DATA"=>"none","EXPECTED_RESULT"=>"List pesanan di batalkan","ACTUAL_RESULT"=>"Pesanan berhasil dibatalkan oleh customer sebelum diterima oleh PKL. Status pesanan berubah menjadi 'Dibatalkan', tidak muncul di aplikasi PKL, dan sistem menyimpan alasan pembatalan dengan sukses.","STATUS"=>"Success","CATATAN"=>""],["TEST_CASE_ID"=>"TC016","SPRINT"=>"2","CREATED_BY"=>"Dika","DATE_OF_CREATION"=>"45740","EXECUTED_BY"=>"Farhan","DATE_OF_EXECUTION"=>"45741","CODE_REQUIREMENT"=>"R009 - Membuat Pesanan","TYPE"=>"NORMAL FLOW","FITUR_NAME"=>"Membuat Pesanan","TEST_CASE_DESCRIPTION"=>"Menguji alur pemesanan hingga pengambilan on-the-spot, mulai dari customer memilih PKL, memesan produk, hingga PKL menyelesaikan pesanan dan customer mengambilnya.","PREREQUISITIES"=>"-Koneksi Jaringan aman
        //                     -Sudah Login dalam User Atau PKL
        //                     -Berada dalam halaman Pesan","TEST_STEPS"=>"-Pilih PKL dari Dashboard.
        //                     -Akses halaman Menu dan pilih produk beserta jumlahnya.
        //                     -Konfirmasi pesanan agar sistem meneruskan ke PKL.
        //                     -Verifikasi PKL mengonfirmasi dan menyelesaikan pesanan.
        //                     -Pastikan sistem memberi notifikasi bahwa pesanan selesai.
        //                     -Customer mengambil pesanan secara on-the-spot dan memverifikasi kesesuaiannya.","TEST_DATA"=>"none","EXPECTED_RESULT"=>"List Pesanan yang baru di buat","ACTUAL_RESULT"=>"Pesanan berhasil dibuat dan diproses. Customer dapat memilih PKL, melakukan pemesanan produk, dan sistem mengirim notifikasi saat pesanan selesai. Proses pengambilan on-the-spot berjalan sesuai alur.","STATUS"=>"Success","CATATAN"=>""],["TEST_CASE_ID"=>"TC017","SPRINT"=>"2","CREATED_BY"=>"Awan","DATE_OF_CREATION"=>"45741","EXECUTED_BY"=>"Eka","DATE_OF_EXECUTION"=>"45742","CODE_REQUIREMENT"=>"R011 - Mengelola Data Pengguna","TYPE"=>"NORMAL FLOW","FITUR_NAME"=>"Mengelola Data Pengguna","TEST_CASE_DESCRIPTION"=>"Menguji fitur edit profil, di mana pengguna mengakses halaman My Profile, mengubah informasi, menekan Simpan Perubahan, dan menerima umpan balik keberhasilan atau kegagalan.","PREREQUISITIES"=>"-Koneksi Jaringan aman
        //                     -Sudah Login dalam User ,PKL, atau Admin","TEST_STEPS"=>"-Buka aplikasi dan akses halaman My Profile pada dashboard.
        //                     -Verifikasi bahwa informasi profil pengguna ditampilkan dengan lengkap.
        //                     -Tekan tombol Edit.
        //                     -Lakukan perubahan pada field informasi profil sesuai kebutuhan.
        //                     -Tekan tombol Simpan Perubahan.
        //                     -Verifikasi bahwa sistem memberikan umpan balik yang sesuai (berhasil atau gagal) atas perubahan yang dilakukan.","TEST_DATA"=>"none","EXPECTED_RESULT"=>"Dalam Halaman My Profil","ACTUAL_RESULT"=>"Perubahan profil berhasil disimpan. Setelah pengguna menekan tombol Simpan Perubahan, sistem menampilkan notifikasi berhasil, dan data profil diperbarui sesuai dengan input terbaru.","STATUS"=>"Success","CATATAN"=>""],["TEST_CASE_ID"=>"TC018","SPRINT"=>"2","CREATED_BY"=>"Zidan","DATE_OF_CREATION"=>"45742","EXECUTED_BY"=>"Zidan","DATE_OF_EXECUTION"=>"45743","CODE_REQUIREMENT"=>"R016 - Menolak Pesanan","TYPE"=>"NORMAL FLOW","FITUR_NAME"=>"Menolak Pesanan","TEST_CASE_DESCRIPTION"=>"Menguji akses ke halaman Kelola Pesanan, di mana pengguna menekan tombol Kelola Pesanan dari Dashboard, dan sistem menampilkan halaman dengan status pesanan.","PREREQUISITIES"=>"-Koneksi Jaringan aman
        //                     -Sudah Login dalam User ,PKL, atau Admin","TEST_STEPS"=>"-Pastikan pengguna berada di halaman Dashboard.
        //                     -Tekan tombol yang menandakan fitur Kelola Pesanan.
        //                     -Verifikasi bahwa sistem menampilkan halaman Kelola Pesanan dengan informasi status pesanan yang sesuai.","TEST_DATA"=>"none","EXPECTED_RESULT"=>"Dalam Halaman dasboard","ACTUAL_RESULT"=>"Halaman Kelola Pesanan berhasil ditampilkan dengan status pesanan yang lengkap dan akurat. Sistem merespons tombol pengelolaan pesanan dengan benar dan tidak terdapat kendala dalam pemuatan data.",
        //                     "STATUS"=>"Success","CATATAN"=>""]
        //                 ],
        //                 [
        //                     ["TEST_CASE_ID"=>"TC019","SPRINT"=>"3","CREATED_BY"=>"Dika","DATE_OF_CREATION"=>"45767","EXECUTED_BY"=>"Evi","DATE_OF_EXECUTION"=>"45767","CODE_REQUIREMENT"=>"R017 - Melaporkan Customer","TYPE"=>"NORMAL FLOW","TEST_CASE_DESCRIPTION"=>"Menguji agar pengguna (PKL) dapat melaporkan keluhan atas costumer yang melanggar pemesanan","PREREQUISITIES"=>"- Sudah Login","TEST_STEPS"=>"- Login sebgai penguna (PKL)
        //                     - Navigasi ke halaman pemesanan atau riwayat pemesanan
        //                     - Pilih pemesanan yang ingin di laporkan
        //                     - Klik tombol 'Laporkan Keluhan'
        //                     - Isi form keluhan dengan informasi yang relevan
        //                     - Klik tombol 'Kirim Laporan' atau 'Submit'
        //                     ","TEST_DATA"=>"","EXPECTED_RESULT"=>"PKL berhasil melakukan pelaporan costumer yang melanggar pemesanan","ACTUAL_RESULT"=>"PKL berhasil melakukan pelaporan costumer yang melanggar pemesanan","STATUS"=>"","CATATAN"=>""],["TEST_CASE_ID"=>"TC020","SPRINT"=>"3","CREATED_BY"=>"Farhan","DATE_OF_CREATION"=>"45767","EXECUTED_BY"=>"Eka","DATE_OF_EXECUTION"=>"45767","CODE_REQUIREMENT"=>"R013 - Mengupdate Lokasi","TYPE"=>"NORMAL FLOW","TEST_CASE_DESCRIPTION"=>"Melakukan update lokasi sesuai posisi koordinat dari PKL secara nyata","PREREQUISITIES"=>"- jaringan bagus
        //                     - GPS menyala","TEST_STEPS"=>"- Login sebagai pengguna (PKL)
        //                     - Navigasi ke fitur 'Update Lokasi
        //                     - Aktifkan izin lokasi pada perangkat (jika diminta)
        //                     - Klik tombol 'Ambil Lokasi Sekarang' atau 'Update Lokasi Otomatis'
        //                     - Konfirmasi pembaruan lokasi dengan klik 'Simpan' atau 'Update'","TEST_DATA"=>"","EXPECTED_RESULT"=>"Update lokasi berhasil otomatis","ACTUAL_RESULT"=>"Update lokasi berhasil otomatis","STATUS"=>"","CATATAN"=>""],["TEST_CASE_ID"=>"TC021","SPRINT"=>"3","CREATED_BY"=>"Eka","DATE_OF_CREATION"=>"45767","EXECUTED_BY"=>"Farhan","DATE_OF_EXECUTION"=>"45767","CODE_REQUIREMENT"=>"R026 - Melakukan Ban Akun","TYPE"=>"NORMAL FLOW","TEST_CASE_DESCRIPTION"=>"Admin dapat melakukan ban akun pada akun yang sudah dilaporkan oleh PKL","PREREQUISITIES"=>"- jaringan bagus
        //                     ","TEST_STEPS"=>"- Login sebagai admin
        //                     - Navigasi ke menu 'Laporan Pengguna' atau 'Laporan Keluhan'
        //                     - Pilih salah satu laporan yang sudah dikirim oleh PKL
        //                     - Klik tombol 'Tinjau' atau 'Verifikasi Laporan'
        //                     - Klik tombol 'Ban Akun' jika laporan dinyatakan valid
        //                     - Konfirmasi tindakan ban (klik 'Ya' atau 'Konfirmasi'","TEST_DATA"=>"","EXPECTED_RESULT"=>"Admin berhasil melakukan ban akun yang dilaporkan","ACTUAL_RESULT"=>"Admin berhasil melakukan ban akun yang dilaporkan","STATUS"=>"","CATATAN"=>"-"],["TEST_CASE_ID"=>"TC022","SPRINT"=>"3","CREATED_BY"=>"Awan","DATE_OF_CREATION"=>"45767","EXECUTED_BY"=>"Awan","DATE_OF_EXECUTION"=>"45767","CODE_REQUIREMENT"=>"R025 - Filter Dashboard Penjualan","TYPE"=>"NORMAL FLOW","TEST_CASE_DESCRIPTION"=>"PKL dapat melakukan filter pada dashboard penjualan","PREREQUISITIES"=>"","TEST_STEPS"=>"- Membuka halaman Dashboard
        //                     - Klik filter ","TEST_DATA"=>"","EXPECTED_RESULT"=>"PKL dapat memfilter dasboard penjualan","ACTUAL_RESULT"=>"PKL dapat memfilter dasboard penjualan","STATUS"=>"","CATATAN"=>""],["TEST_CASE_ID"=>"TC023","SPRINT"=>"3","CREATED_BY"=>"Evi","DATE_OF_CREATION"=>"45767","EXECUTED_BY"=>"Zidan","DATE_OF_EXECUTION"=>"45767","CODE_REQUIREMENT"=>"R004 - Melakukan Pencarian","TYPE"=>"NORMAL FLOW","TEST_CASE_DESCRIPTION"=>"Melakukan Pencarian terkait PKL pada halaman Dashboard","PREREQUISITIES"=>"- Jaringan Bagus
        //                     ","TEST_STEPS"=>"- Membuka halaman Dashboard
        //                     - Klik field Search
        //                     - Klik Search","TEST_DATA"=>"- String","EXPECTED_RESULT"=>"PKL dengan kriteria yang di tulis berhasil muncul","ACTUAL_RESULT"=>"PKL dengan kriteria yang di tulis berhasil muncul","STATUS"=>"",
        //                     "CATATAN"=>""]
        //                 ]

        // ];

        $sprint=[[
            ["Fitur"=>"R011 - Mengelola Data Pengguna","Isi"=>[["TEST_CASE_ID"=>"TC001","SPRINT"=>"1","CREATED_BY"=>"Dika","DATE_OF_CREATION"=>"45729","EXECUTED_BY"=>"Farhan","DATE_OF_EXECUTION"=>"45729","TYPE"=>"NORMAL FLOW","CODE_REQUIREMENT"=>"R011 - Mengelola Data Pengguna","FITUR_NAME"=>"Mengelola Data Pribadi","TEST_CASE_DESCRIPTION"=>"Menguji agar pengguna (PKL dan Customer) dapat mengakses dan mengubah informasi profil pada aplikasi JelajahKuliner.","PREREQUISITIES"=>"-Pengguna telah memiliki akun dan login ke dalam aplikasi JelajahKuliner.
                -Pengguna dapat mengakses halaman 'My Profile' pada dashboard.","TEST_STEPS"=>"Pengguna mengakses halaman 'My Profile' melalui dashboard.
                Sistem menampilkan informasi profil pengguna yang akurat dan terbaru.
                Pengguna menekan tombol 'Edit' untuk mengubah informasi profil.
                Pengguna mengubah satu atau beberapa field (contoh: nama, nomor telepon, email).
                Pengguna menekan tombol 'Simpan Perubahan' untuk menyimpan perubahan.
                Sistem menyimpan perubahan data dengan aman.
                Sistem memberikan feedback 'Perubahan berhasil disimpan'.","TEST_DATA"=>"Nama Lama: Budi Santoso 
                Nama Baru: Budi Wijaya
                Nomor Telepon Lama: 08123456789
                Nomor Telepon Baru: 08129876543
                Email Lama: budi@budi.com 
                Email Baru: budiwijaya@budi.com","EXPECTED_RESULT"=>"Sistem berhasil memperbarui informasi pengguna dan menampilkan pesan sukses: 'Perubahan berhasil disimpan'.","ACTUAL_RESULT"=>"Sistem berhasil memperbarui informasi pengguna dan menampilkan pesan sukses: 'Perubahan berhasil disimpan'.","STATUS"=>"Berhasil","CATATAN"=>""]]],["Fitur"=>"R027 - Melakukan Logout","Isi"=>[["TEST_CASE_ID"=>"TC002","SPRINT"=>"1","CREATED_BY"=>"Farhan","DATE_OF_CREATION"=>"45729","EXECUTED_BY"=>"Evi","DATE_OF_EXECUTION"=>"45729","TYPE"=>"NORMAL FLOW","CODE_REQUIREMENT"=>"R027 - Melakukan Logout","FITUR_NAME"=>"Melakukan Log Out","TEST_CASE_DESCRIPTION"=>"Menguji Autentikasi Aplikasi dalam Melakukan Logout dengan Tidak Menyimpan Login Dari Pengguna","PREREQUISITIES"=>"- User Telah Melakukan Login (TC004)
                ","TEST_STEPS"=>"- Dalam Website Jelajah Kuliner
                - Mengakses Sidebar
                - Click Tombol Logout","TEST_DATA"=>"none","EXPECTED_RESULT"=>"Berhasil mengakhiri sesi","ACTUAL_RESULT"=>"Berhasil mengakhiri sesi","STATUS"=>"Berhasil","CATATAN"=>""]]],["Fitur"=>"R007 - Membaca Profil PKL","Isi"=>[["TEST_CASE_ID"=>"TC003","SPRINT"=>"1","CREATED_BY"=>"Evi","DATE_OF_CREATION"=>"45729","EXECUTED_BY"=>"Zidan","DATE_OF_EXECUTION"=>"45729","TYPE"=>"NORMAL FLOW","CODE_REQUIREMENT"=>"R007 - Membaca Profil PKL","FITUR_NAME"=>"Membaca Data PKL","TEST_CASE_DESCRIPTION"=>"Menguji Agar Pengguna Dapat Melihat dan Membaca data PKL yang ada di maps","PREREQUISITIES"=>"- Koneksi Internet Stabil
                - Harus Sudah ada At Least 1 PKL yang terdaftar
                - Test Case TC006 harus sudah berhasil terlebih dahulu untuk user PKL","TEST_STEPS"=>"- Buka Website Jelajah Kuliner
                - Masuk Halaman Dashboard
                - Klik Salah satu PKL
                - Baca/Lihat Data ","TEST_DATA"=>"none","EXPECTED_RESULT"=>"- Data PKL Terbaca (Menu, Ulasan, Foto PKL)","ACTUAL_RESULT"=>"PKL Terlihat dengan foto, Ulasan, Dan Menu, dan Terdapat Tombol Pesan","STATUS"=>"Berhasil","CATATAN"=>"-"]]],["Fitur"=>"R002 - Melakukan Login","Isi"=>[["TEST_CASE_ID"=>"TC004","SPRINT"=>"1","CREATED_BY"=>"Farhan","DATE_OF_CREATION"=>"45729","EXECUTED_BY"=>"Dika","DATE_OF_EXECUTION"=>"45729","TYPE"=>"NORMAL FLOW","CODE_REQUIREMENT"=>"R002 - Melakukan Login","FITUR_NAME"=>"Melakukan Login","TEST_CASE_DESCRIPTION"=>"Menguji Pengguna Dalam Melakukan Autentikasi Untuk Mengakses Aplikasi","PREREQUISITIES"=>"- Koneksi Internet Stabil
                - Telah Melakukan Registrasi (Buat Akun)
                - Test Case TC006 Harus Sudah Berhasil Untuk User (Pengguna Atau PKL)
                - Mengetahui Email dan Password","TEST_STEPS"=>"- Buka Website Jelajah Kuliner
                - Masuk Halaman Login
                - Masukkan Data Email
                - Masukkan Password
                - Klik Login

                ","TEST_DATA"=>"- Email (String)/budi@budi.com 
                - Password (Hash)/123","EXPECTED_RESULT"=>"Sistem akan memverifikasi data Login pengguna yang jika benar nantinya akan mengarahkan Pengguna ke Halaman Dashboard.","ACTUAL_RESULT"=>"berhasil, masuk ke halaman dashboard","STATUS"=>"Berhasil","CATATAN"=>""],["TEST_CASE_ID"=>"TC004","SPRINT"=>"1","CREATED_BY"=>"Farhan","DATE_OF_CREATION"=>"45729","EXECUTED_BY"=>"Dika","DATE_OF_EXECUTION"=>"45729","TYPE"=>"ALTERNATE FLOW","CODE_REQUIREMENT"=>"R002 - Melakukan Login","FITUR_NAME"=>"Melakukan Login","TEST_CASE_DESCRIPTION"=>"Menguji Pengguna Dalam Melakukan Autentikasi Untuk Mengakses Aplikasi","PREREQUISITIES"=>"- Koneksi Internet Stabil
                - Telah Melakukan Registrasi (Buat Akun)
                - Test Case TC006 Harus Sudah Berhasil Untuk User (Pengguna Atau PKL)
                - Mengetahui Email dan Password","TEST_STEPS"=>"- Buka Website Jelajah Kuliner
                - Masuk Halaman Login
                - Masukkan Data Email
                - Masukkan Password
                - Klik Login

                ","TEST_DATA"=>"- Email (String)/budi@budi.com 
                - Password (Hash)/123","EXPECTED_RESULT"=>"Sistem akan memverifikasi data Login pengguna yang jika benar nantinya akan mengarahkan Pengguna ke Halaman Dashboard.","ACTUAL_RESULT"=>"berhasil, masuk ke halaman dashboard","STATUS"=>"Berhasil","CATATAN"=>""]]],["Fitur"=>"R019 - Meihat Dashboard PKL","Isi"=>[["TEST_CASE_ID"=>"TC005","SPRINT"=>"1","CREATED_BY"=>"Eka","DATE_OF_CREATION"=>"45729","EXECUTED_BY"=>"Awan","DATE_OF_EXECUTION"=>"45729","TYPE"=>"NORMAL FLOW","CODE_REQUIREMENT"=>"R019 - Meihat Dashboard PKL","FITUR_NAME"=>"Melihat Dashboard PKL","TEST_CASE_DESCRIPTION"=>"Menguji Akun PKL apakah dapat melihat dashboard yang menampilkan List menu yang dijual, Ulasan Yang didapat","PREREQUISITIES"=>"- Koneksi Internet Stabil
                - Memiliki Akses Browser
                - Memiliki Link Webstie
                - Account berstatus PKL
                - Sudah Melakukan Buat Data PKL","TEST_STEPS"=>"- Buka Website Jelajah Kuliner
                - Login Dengan Data PKL
                - Klik Dashboard PKL
                - Aksesn Halaman Dashboard PKL","TEST_DATA"=>"- Email (String)/budi@budi.com 
                - Password (Hash)/123","EXPECTED_RESULT"=>"Sistem akan Menampilkan data Apa saja yang dijual dan  Ulasan apa saja yang di dapat","ACTUAL_RESULT"=>"berhasil, masuk kedalam dashboard PKL dan dapat ke menu Tambah Produk dan dpaat melihat Ulasan","STATUS"=>"Berhasil","CATATAN"=>""]]],["Fitur"=>"R001 - Melakukan Registrasi","Isi"=>[["TEST_CASE_ID"=>"TC006","SPRINT"=>"1","CREATED_BY"=>"Awan","DATE_OF_CREATION"=>"45729","EXECUTED_BY"=>"Eka","DATE_OF_EXECUTION"=>"45729","TYPE"=>"NORMAL FLOW","CODE_REQUIREMENT"=>"R001 - Melakukan Registrasi","FITUR_NAME"=>"Melakukan Pendaftaran","TEST_CASE_DESCRIPTION"=>"Menguji skenario yang valid dengan data benar
                Menguji skenario yang salah dalam hal seperti email tidak valid,password lemah atau kolom kosong
                menguji batas minimal dan maksimal dari input","PREREQUISITIES"=>"-Akun dan Data Uji
                -Alat pengujian
                -Spesifikasi Dan Dokumentasi
                -Hak Akses dan Akun
                -Pemahaman Alur bisnis","TEST_STEPS"=>"- Buka Website Jelajah Kuliner
                - Masuk Halaman Daftar
                - Masukkan Data Email
                - Masukkan Password
                - Jika sudah Maka Masuk Di Dasbor Utama
                ","TEST_DATA"=>"- Email (String)/budi@budi.com 
                - Password (Hash)/123","EXPECTED_RESULT"=>"Dalam hal ini dengan input valid data,input Data TIdak Lengkap,Format Data Salah, Passowrd Tidak Sesuai Kriteria,Username atau Email Sudah Terdaftar","ACTUAL_RESULT"=>"berhasil, masuk ke halaman dashboard","STATUS"=>"Berhasil","CATATAN"=>""]]],["Fitur"=>"R003 - Melihat Map","Isi"=>[["TEST_CASE_ID"=>"TC007","SPRINT"=>"1","CREATED_BY"=>"Zidan","DATE_OF_CREATION"=>"45729","EXECUTED_BY"=>"Eka","DATE_OF_EXECUTION"=>"45729","TYPE"=>"NORMAL FLOW","CODE_REQUIREMENT"=>"R003 - Melihat Map","FITUR_NAME"=>"Melihat Map","TEST_CASE_DESCRIPTION"=>"Menguji Apakah Pengguna ketika Menjalankan Aplikasi Apakah Terlihat Map (Peta)","PREREQUISITIES"=>"- Akses Browser
                - Akses Link Ke Website","TEST_STEPS"=>"- Buka Website Jelajah Kuliner","TEST_DATA"=>"none","EXPECTED_RESULT"=>"Peta terlihat beserta seluurh data PKL","ACTUAL_RESULT"=>"berhasil, peta dan data penjual terlihat","STATUS"=>"Berhasil","CATATAN"=>""]]],["Fitur"=>"R008 - Melihat Review","Isi"=>[["TEST_CASE_ID"=>"TC008","SPRINT"=>"1","CREATED_BY"=>"Evi","DATE_OF_CREATION"=>"45729","EXECUTED_BY"=>"Awan","DATE_OF_EXECUTION"=>"45729","TYPE"=>"NORMAL FLOW","CODE_REQUIREMENT"=>"R008 - Melihat Review","FITUR_NAME"=>"Melihat Ulasan","TEST_CASE_DESCRIPTION"=>"Menguji Website agar Pengguna Dapat melihat ulasan pengguna pada PKL yang ada di maps","PREREQUISITIES"=>"- Koneksi Internet Stabil
                - Harus Sudah ada At Least 1 PKL yang terdaftar
                - Test Case Membuat Ulasan harus sudah berhasil terlebih dahulu
                ","TEST_STEPS"=>"- Buka Website Jelajah Kuliner
                - Masuk Halaman Dashboard
                - Klik Salah satu PKL
                - Klik Menu 'Ulasan'
                - Baca Ulasan","TEST_DATA"=>"none","EXPECTED_RESULT"=>"- ulasan Pengguna berhasil terlihat/terbaca","ACTUAL_RESULT"=>"berhasil melihat ulasan pengguna","STATUS"=>"berhasil","CATATAN"=>""],["TEST_CASE_ID"=>"TC008","SPRINT"=>"1","CREATED_BY"=>"Evi","DATE_OF_CREATION"=>"45729","EXECUTED_BY"=>"Awan","DATE_OF_EXECUTION"=>"45729","TYPE"=>"ALTERNATE FLOW","CODE_REQUIREMENT"=>"R008 - Melihat Review","FITUR_NAME"=>"Melihat Ulasan","TEST_CASE_DESCRIPTION"=>"Menguji Website agar Pengguna Dapat melihat ulasan pengguna pada PKL yang ada di maps","PREREQUISITIES"=>"- Koneksi Internet Stabil
                - Harus Sudah ada At Least 1 PKL yang terdaftar
                - Test Case Membuat Ulasan harus sudah berhasil terlebih dahulu
                ","TEST_STEPS"=>"- Buka Website Jelajah Kuliner
                - Masuk Halaman Dashboard
                - Klik Salah satu PKL
                - Klik Menu 'Ulasan'
                - Baca Ulasan","TEST_DATA"=>"none","EXPECTED_RESULT"=>"- ulasan Pengguna berhasil terlihat/terbaca","ACTUAL_RESULT"=>"berhasil melihat ulasan pengguna","STATUS"=>"berhasil","CATATAN"=>""],["TEST_CASE_ID"=>"TC008","SPRINT"=>"1","CREATED_BY"=>"Evi","DATE_OF_CREATION"=>"45729","EXECUTED_BY"=>"Awan","DATE_OF_EXECUTION"=>"45729","TYPE"=>"ALTERNATE FLOW","CODE_REQUIREMENT"=>"R008 - Melihat Review","FITUR_NAME"=>"Melihat Ulasan","TEST_CASE_DESCRIPTION"=>"Menguji Website agar Pengguna Dapat melihat ulasan pengguna pada PKL yang ada di maps","PREREQUISITIES"=>"- Koneksi Internet Stabil
                - Harus Sudah ada At Least 1 PKL yang terdaftar
                - Test Case Membuat Ulasan harus sudah berhasil terlebih dahulu
                ","TEST_STEPS"=>"- Buka Website Jelajah Kuliner
                - Masuk Halaman Dashboard
                - Klik Salah satu PKL
                - Klik Menu 'Ulasan'
                - Baca Ulasan","TEST_DATA"=>"none","EXPECTED_RESULT"=>"- ulasan Pengguna berhasil terlihat/terbaca","ACTUAL_RESULT"=>"berhasil melihat ulasan pengguna","STATUS"=>"berhasil","CATATAN"=>""]]
            ]
        ]];
        // dd($sprint[0][0]['Fitur']);
        $data = $sprint[0];
        // $data = $sprint[];
        // $data = $data[0];
                                                                                                                                                                                                                                                                                                                                                                                                                   
        foreach ($data as $d) {
            // dd($d['Isi'][0]);
            foreach($d['Isi'] as $testCase){
                // dd($testCase["DATE_OF_CREATION"]);
                $testCase["TEST_STEPS"] = array_map('trim', explode("\n", str_replace("-","",$testCase["TEST_STEPS"])));
                $testCase["PREREQUISITIES"] = array_map('trim', explode("\n", str_replace("-","",$testCase["PREREQUISITIES"])));
                $testCase["TEST_DATA"] = array_map('trim', explode("\n", str_replace("-","",$testCase["TEST_DATA"])));
                $date = Carbon::createFromFormat('Y-m-d', '1900-01-01')->addDays($testCase["DATE_OF_CREATION"]);
                $testCase["DATE_OF_CREATION"] = $date->format('d-m-Y');
                
            }
            // Mengubah TEST STEPS menjadi array berdasarkan tanda "-"
        }
        dd($data);
        
        // dd($data);
        return view('testcase',['data'=>$data]);
        // return view();
    }
}
