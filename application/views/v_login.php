<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$set = $this->db->get_where('sekolah', ['id'=>1])->row_array();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Aplikasi Download Raport</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- OG Meta Tags to improve the way the post looks when you share the page on LinkedIn, Facebook, Google+ -->
  <meta property="og:site_name" content="DOWNLOAD RAPORT SISWA <?php echo $set['NamaSekolah']; ?>" /> <!-- website name -->
  <meta property="og:site" content="" /> <!-- website link -->
  <meta property="og:title" content="DOWNLOAD RAPORT SISWA <?php echo $set['NamaSekolah']; ?>"/> <!-- title shown in the actual shared post -->
  <meta property="og:description" content="DOWNLOAD RAPORT SISWA <?php echo $set['NamaSekolah']; ?>" /> <!-- description shown in the actual shared post -->
  <meta property="og:image" content="<?php echo base_url().'assets/images/'.$set['LogoSekolah'];?>" /> <!-- image link, make sure it's jpg -->
  <meta property="og:url" content="" /> <!-- where do you want your post to link to -->
  <meta property="og:type" content="article" />

  <link rel="shorcut icon" href="<?php echo base_url().'assets/images/'.$set['LogoSekolah'];?>">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/bootstrap/css/bootstrap.min.css'?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/font-awesome/css/font-awesome.min.css'?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/dist/css/AdminLTE.min.css'?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/plugins/iCheck/square/blue.css'?>">
  <style type="text/css">
    .form-signin
{
    max-width: 330px;
    padding: 15px;
    margin: 0 auto;
}
.form-signin .form-signin-heading, .form-signin .checkbox
{
    margin-bottom: 10px;
}
.form-signin .checkbox
{
    font-weight: normal;
}
.form-signin .form-control
{
    position: relative;
    font-size: 16px;
    height: auto;
    padding: 10px;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
.form-signin .form-control:focus
{
    z-index: 2;
}
.form-signin input[type="text"]
{
    margin-bottom: -1px;
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
}
.form-signin input[type="password"]
{
    margin-bottom: 10px;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
}
.account-wall
{
    margin-top: 20px;
    padding: 40px 0px 20px 0px;
    background-color: #f7f7f7;
    -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
}
.login-title
{
    color: #555;
    font-size: 18px;
    font-weight: 400;
    display: block;
}
.profile-img
{
    width: 96px;
    height: 96px;
    margin: 0 auto 10px;
    display: block;
    -moz-border-radius: 50%;
    -webkit-border-radius: 50%;
    border-radius: 50%;
}
.need-help
{
    margin-top: 10px;
}
.new-account
{
    display: block;
    margin-top: 10px;
}
#clockdiv{
    font-family: sans-serif;
    color: #fff;
    display: inline-block;
    font-weight: 100;
    text-align: center;
    font-size: 30px;
}

#clockdiv > div{
    padding: 10px;
    border-radius: 3px;
    background: #0084ff;
    display: inline-block;
}

#clockdiv div > span{
    padding: 15px;
    border-radius: 3px;
    background: #176bba;
    display: inline-block;
}

.smalltext{
    padding-top: 5px;
    font-size: 16px;
    font-weight: bold;
}

  </style>

</head>
<body class="hold-transition login-page">
<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h1 class="text-center login-title" style="padding-top: 20%"></h1>
            <div class="account-wall">
                <img class="profile-img" src="<?php echo base_url().'assets/images/'.$set['LogoSekolah'];?>?sz=120"
                    alt=""><center style="font-weight: bold; font-size: 18px;">Download Raport Siswa</center>
                <?php echo $this->session->flashdata('msg') ?>
                <div id="demo"></div>
            </div>
        </div>
    </div>
</div
<!-- /.login-box -->
<?php 
function tanggal_ing($tgll){
 $bulann = array (
  1 =>   'January',
  'February',
  'March',
  'April',
  'May',
  'June',
  'July',
  'August',
  'September',
  'October',
  'November',
  'December'
 );
 $pecahh = explode('-', $tgll);
 
 
 return $bulann[ (int)$pecahh[1] ] . ' ' .$pecahh[2]. ', ' .$pecahh[0]  ; 
 // variabel pecah 2 = tahun || variabel pecah 1 = bulan || variabel pecah 0 = tanggal
}

$r=$this->db->get_where('sekolah', ['id'=>2])->row_array(); ?>
<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url().'assets/plugins/jQuery/jquery-2.2.3.min.js'?>"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url().'assets/bootstrap/js/bootstrap.min.js'?>"></script>
<!-- iCheck -->
<script type="text/javascript">
// Set the date we're counting down to
var countDownDate = new Date("<?php echo tanggal_ing($r['Judul']); ?>, <?php echo $r['NamaSekolah']; ?>").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  document.getElementById("demo").innerHTML = "<center><div id='clockdiv'> <div><span>" + days + "</span><div class='smalltext'>Hari</div></div> <div><span>" + hours + " </span><div class='smalltext'>Jam</div></div> <div><span> " + minutes + " </span><div class='smalltext'>Menit</div></div> <div><span> " + seconds + " </span><div class='smalltext'>Detik</div></div></div></center>";

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = '<form class="form-signin" method="post" action="<?php echo base_url("loginaplikasi/proses");?>"><input type="text" class="form-control" placeholder="NIS" name="username" required autofocus><input type="password" class="form-control" placeholder="Password" name="password" required><button class="btn btn-lg btn-primary btn-block" type="submit">Masuk</button></form>';
  }
}, 1000);
</script>
</body>
</html>
