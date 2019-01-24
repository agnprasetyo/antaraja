<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="box-body">
                 <div class="box-group" id="accordion"  style ="font-family: Candara, Candara, Sans-serif">
                   <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                   <div class="panel box box-primary">
                     <div class="box-header with-border">
                       <h4 class="box-title">
                         <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" style="font-size: 16pt">
                           Petunjuk dan Syarat
                         </a>
                       </h4>
                     </div>
                     <div id="collapseOne" class="panel-collapse collapse in">
                       <div class="box-body" style="font-size: 12pt;">
                         <p>Adapun petunjuk dan syarat dalam penggunaan website e-aspirasi Surakarta, yaitu :
                         <p>1. Setiap pengirim aspirasi terlebih dahulu harus mendaftarkan diri pada Menu "SignUp" dan wajib mengisi semua data yang dibutuhkan dalam Menu "SignUp".
                         <br>2. Tahap selanjutnya, masuk atau login dengan memilih Menu "Login" kemudian masukkan username dan password yang sudah dibuat saat SignUp.
                         <br>3. Setelah itu pengirim aspirasi dapat memilih apa yang ingin diadukan. Terdapat 3 pilihan yaitu Infrastruktur, Pelayanan dan Gangguan Keamanan yang bisa dilihat pada Beranda.
                         <br>4. Di dalam pilihan tersebut terdapat beberapa informasi yang harus diisi. Antara lain yaitu Jenis, Status dan Review.
                         <br>5. Setelah mengirimkan aspirasinya, pengirim dapat melihat daftar aspirasi apa saja yang telah dikirimkan dalam bentuk maps dan tabel.</p>
                       </div>
                     </div>
                   </div>
                   <div class="panel box box-danger">
                     <div class="box-header with-border">
                       <h4 class="box-title">
                         <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" style="font-size: 16pt">
                           Bagaimana dengan Privasi Data yang telah dimasukkan?
                         </a>
                       </h4>
                     </div>
                     <div id="collapseTwo" class="panel-collapse collapse">
                       <div class="box-body" style="font-size: 12pt">
                         <p>Privasi Data yang diinputkan tidak dapat dilihat oleh pengguna lain. Hanya aduan yang sudah disampaikan yang akan menjadi tampilan pada map dan tabel. Data-data yang lebih pribadi tidak akan ditampilkan pada map dan tabel.</p>
                       </div>
                     </div>
                   </div>
                   <div class="panel box box-success">
                     <div class="box-header with-border">
                       <h4 class="box-title">
                         <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" style="font-size: 16pt">
                           Persyaratan dan Ketentuan Penggunaan
                         </a>
                       </h4>
                     </div>
                     <div id="collapseThree" class="panel-collapse collapse">
                       <div class="box-body" style="font-size: 12pt">
                        <p>Berikut adalah syarat-syarat penggunaan (Terms Of Use), yang mungkin dapat direvisi oleh pemilik situs, dari waktu ke waktu tanpa pemberitahuan terlebih dahulu, dan berlaku untuk Anda dalam melakukan akses dan penggunaan situs ini. Bacalah semua syarat-syarat dan ketentuan ini dengan seksama. Dengan mengakses Situs e-Aspirasi Surakarta ini dan salah satu halaman yang terdapat di dalamnya, Anda setuju untuk terikat dengan syarat-syarat dan ketentuan di bawah ini. Jika Anda tidak menyetujui syarat-syarat dan ketentuan yang ditetapkan di bawah ini, mohon untuk tidak mengakses Situs e-Aspirasi Surakarta ini dan/atau salah satu halaman yang terdapat di dalamnya.</p>
                        <i><h4>Kepemilikan dan Pengelolaan Situs e-Aspirasi Surakarta</h4></i>
                        <p>Bahwa Situs e-Aspirasi Surakrta ini dimiliki oleh founder dan bertanggung jawab sepenuhnya atas :
                        <p>(i) Pengelolaan dan manajemen hosting dan domain Situs e-Aspirasi Surakarta; dan
                        <p>(ii) Penyediaan, pengelolaan serta pemeliharaan content</p>
                       </div>
                     </div>
                   </div>
                 </div>
               </div>
</div>
