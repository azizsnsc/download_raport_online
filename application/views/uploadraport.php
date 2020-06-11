<!--Counter Inbox-->
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
  <link rel="shorcut icon" href="<?php echo base_url().'assets/images/'.$set['LogoSekolah'];?>">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/bootstrap/css/bootstrap.min.css'?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/font-awesome/css/font-awesome.min.css'?>">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/plugins/datatables/dataTables.bootstrap.css'?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/dist/css/AdminLTE.min.css'?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/dist/css/skins/_all-skins.min.css'?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/plugins/toast/jquery.toast.min.css'?>"/>

<style type="text/css">
  thead{
    font-weight: bold;
    font-size: 16px;
  }
</style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!--Header-->
  <?php
    $this->load->view('v_header');
  ?>

  <!-- Left side column. contains the logo and sidebar -->


  <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Kelas : <?php echo $kel; ?>
        <small></small>
      </h1>
      <?php
              $j  = $this->db->get_where('siswa', ['Kelas'=>$kel])->num_rows();
              $j1 = $sisw->num_rows();
              $j3 = $fil->num_rows();
              $j4 = $this->db->query("select*from file,siswa where file.nis=siswa.nis AND siswa.Kelas='".$kel."' AND file.StatusDownload='L' order by file.nis ASC")->num_rows();
      ?>
      <ol class="breadcrumb">
        <li style="font-size: 16px;">Total Siswa : <?php echo $j; ?> </li>
        <li style="font-size: 16px;">Belum Upload : <?php echo $j1; ?> </li>
        <li style="font-size: 16px; color: blue;">Sudah Upload : <?php echo $j3; ?> </li>
        <li style="font-size: 16px; color: blue;">Siswa Download : <?php echo $j4; ?> </li>
      </ol>

    <!-- Main content -->
      <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
          <div class="box">
            <div class="box-header">
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <?php echo $this->session->flashdata('notif') ?>
              <table class="table">
                <thead>
                  <tr>
                    <td>NO</td><td>NIS</td><td>Nama Lngkap</td><td>Status Upload</td><td>Status Download</td>
                  </tr>
                  </thead>
                  <?php
                  $no = 1;
                  foreach ($sisw->result_array() as $ke) { ?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $ke['nis']; ?></td>
                      <td><?php echo $ke['NamaLengkap']; ?></td>
                      <td><span class="fa fa-exclamation-triangle" style="color:red"> Belum Upload</span></td>
                      <td><span class="fa fa-exclamation-triangle" style="color:red"> KOSONG</span></td>
                    </tr>
                  <?php 
                  $no++;
                  }
                  ?>
                  <?php
                  $no = 1;
                  foreach ($fil->result_array() as $de) { ?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $de['nis']; ?></td>
                      <td><?php echo $de['NamaLengkap']; ?></td>
                      <td><span class="fa fa-check" style="color:blue"> Berhasil Upload </span></td>
                      <td>
                        <?php 
                        if ($de['StatusDownload']=='B') {
                          echo '<span class="fa fa-exclamation-triangle" style="color:red"> <a href="'.base_url('uploadraport/download/').$de["LinkRaport"].'">Siswa Belum Download</a> </span>';
                        } else {
                          echo '<span class="fa fa-check" style="color:blue"> <a href="'.base_url('uploadraport/download/').$de["LinkRaport"].'">di Download Pada '.$de["jam_download"].'</a> </span>';
                        }
                        ?>
                        </td>
                    </tr>
                  <?php 
                  $no++;
                  }
                  ?>
                
              </table>


            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php
    $this->load->view('v_footer');
  ?>


</div>
<!-- ./wrapper -->

<script src="<?php echo base_url().'assets/plugins/jQuery/jquery-2.2.3.min.js'?>"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url().'assets/bootstrap/js/bootstrap.min.js'?>"></script>
<!-- DataTables -->
<script src="<?php echo base_url().'assets/plugins/datatables/jquery.dataTables.min.js'?>"></script>
<script src="<?php echo base_url().'assets/plugins/datatables/dataTables.bootstrap.min.js'?>"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url().'assets/plugins/slimScroll/jquery.slimscroll.min.js'?>"></script>
<!-- FastClick -->
<script src="<?php echo base_url().'assets/plugins/fastclick/fastclick.js'?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url().'assets/dist/js/app.min.js'?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url().'assets/dist/js/demo.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/plugins/toast/jquery.toast.min.js'?>"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
<?php if($this->session->flashdata('msg')=='error'):?>
        <script type="text/javascript">
                $.toast({
                    heading: 'Error',
                    text: "Password dan Ulangi Password yang Anda masukan tidak sama.",
                    showHideTransition: 'slide',
                    icon: 'error',
                    hideAfter: false,
                    position: 'bottom-right',
                    bgColor: '#FF4859'
                });
        </script>

    <?php elseif($this->session->flashdata('msg')=='success'):?>
        <script type="text/javascript">
                $.toast({
                    heading: 'Success',
                    text: "Data Berhasil disimpan ke database.",
                    showHideTransition: 'slide',
                    icon: 'success',
                    hideAfter: false,
                    position: 'bottom-right',
                    bgColor: '#7EC857'
                });
        </script>
    <?php elseif($this->session->flashdata('msg')=='info'):?>
        <script type="text/javascript">
                $.toast({
                    heading: 'Info',
                    text: "Data berhasil di update",
                    showHideTransition: 'slide',
                    icon: 'info',
                    hideAfter: false,
                    position: 'bottom-right',
                    bgColor: '#00C9E6'
                });
        </script>
    <?php elseif($this->session->flashdata('msg')=='success-hapus'):?>
        <script type="text/javascript">
                $.toast({
                    heading: 'Success',
                    text: "Data Berhasil dihapus.",
                    showHideTransition: 'slide',
                    icon: 'success',
                    hideAfter: false,
                    position: 'bottom-right',
                    bgColor: '#7EC857'
                });
        </script>
    <?php else:?>

    <?php endif;?>

</body>
</html>
