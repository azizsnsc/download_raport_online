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
        IMPORT DATA SISWA
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Soal</li>
      </ol>
    </section>

    <!-- Main content -->
      <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
          <div class="box">
            <div class="box-header">
              <form method="POST" action="<?php echo base_url() ?>datasiswa/uploaddata" enctype="multipart/form-data">
                <div class="col-xs-4"><label>Upload data dengan excel : <a href='<?php echo base_url('datasiswa/downloadexcel') ?>'>Download Tempelate Excel</a></label><input type="file" name="userfile" class="form-control"></div> 
                <div class="col-xs-4"  style="padding-top: 23px;"><button type="Submit" class="btn btn-primary">Upload </button>  
                  <?php $jd = $soa->num_rows();
                  if (!empty($jd)) {
               echo  ' | <a class="btn btn-success btn-flat" data-toggle="modal" data-target="#ModalTambah"><span class="fa fa-plus"> INPUT SISWA</span></a>';
               } ?>
                </div>
              <div class="col-xs-4" style="padding-top: 21px;">
              <a class="btn btn-success btn-danger" href="<?php echo base_url().'datasiswa/kosong/'?>" style="float: right;"><span class="fa fa-plus"></span> Kosongkan Siswa</a>
              </div>
              </form>
            </div>
            <?php echo $this->session->flashdata('notif') ?>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-striped" style="font-size:13px;">
                <thead>
                <tr>
                <th>ID</th>
                <th>NIS</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                    $no=0;
                    foreach ($soa->result_array() as $i) :
                       $no++;
                    ?>
                <tr>
                  <td><?php echo $i['ID'];?></td>
                  <td><?php echo $i['nis'];?></td>
                  <td><?php echo $i['NamaLengkap'];?></td>
                  <td><?php echo $i['Kelas'];?></td>
                  <td><a class="btn" data-toggle="modal" data-target="#ModalEdit<?php echo $i['ID'];?>"><span class="fa fa-pencil"></span></a>
                      <a class="btn" data-toggle="modal" data-target="#ModalHapus<?php echo $i['ID'];?>"><span class="fa fa-trash"></span></a>
                  </td>
                </tr>
        <?php endforeach;?>
                </tbody>
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


  <?php foreach ($soa->result_array() as $i) :
  ?>
  <!--Modal Hapus Pengguna-->
        <div class="modal fade" id="ModalHapus<?php echo $i['ID'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                        <h4 class="modal-title" id="myModalLabel">Hapus Siswa</h4>
                    </div>
                    <form class="form-horizontal" action="<?php echo base_url().'datasiswa/hapus'?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                     <input type="hidden" name="ID" value="<?php echo $i['ID'];?>"/>
                            <p>Apakah Anda yakin mau menghapus Nama Siswa <b><?php echo $i['NamaLengkap'].' ('.$i['Kelas'].')';?></b> ?</p>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-flat" id="simpan">Hapus</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
  <?php endforeach;?>

  <?php foreach ($soa->result_array() as $i) :
  ?>
  <!--Modal Hapus Pengguna-->
        <div class="modal fade" id="ModalEdit<?php echo $i['ID'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
           <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                        <h4 class="modal-title" id="myModalLabel">NIS</h4>
                    </div>
                    <form class="form-horizontal" action="<?php echo base_url().'datasiswa/ubah'?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body" style="padding: 5%">
                      <input type="hidden" name="ID" value="<?php echo $i['ID']; ?>">
                      <div class="form-group">
                        <label>NIS</label>
                        <input type="text" name="nis" class="form-control" value="<?php echo $i['nis']; ?>">
                      </div>
                      <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="NamaLengkap" class="form-control" value="<?php echo $i['NamaLengkap']; ?>">
                      </div>
                      <div class="form-group">
                        <label>Kelas</label>
                        <select name="Kelas" class="form-control">
                          <?php
                            $ds = $this->db->query('select Kelas from siswa group by Kelas');
                            $jd = $ds->num_rows();
                          if (!empty($jd)) {
                            foreach ($ds->result_array() as $ke) {
                              if ($ke['Kelas']==$i['Kelas']) {
                                $ok = "selected";
                              } else {
                                $ok = "";
                              }
                              echo "<option value='".$ke['Kelas']."' ".$ok.">".$ke['Kelas']."</option>";
                            }
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-flat" id="simpan">Simpan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
  <?php endforeach;?>


  <!--Modal Hapus Pengguna-->
        <div class="modal fade" id="ModalTambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                        <h4 class="modal-title" id="myModalLabel">Tambah Siswa</h4>
                    </div>
                    <form class="form-horizontal" action="<?php echo base_url().'datasiswa/simpan'?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body" style="padding: 5%">
                      <input type="hidden" name="id">
                      <div class="form-group">
                        <label>NIS</label>
                        <input type="number" name="nis" class="form-control">
                      </div>
                      <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="NamaLengkap" class="form-control">
                      </div>
                      <div class="form-group">
                        <label>Kelas</label>
                        <select name="Kelas" class="form-control">
                          <?php
                            $ds = $this->db->query('select Kelas from siswa group by Kelas');
                            $jd = $ds->num_rows();
                          if (!empty($jd)) {
                            foreach ($ds->result_array() as $ke) {
                              echo "<option value='".$ke['Kelas']."'>".$ke['Kelas']."</option>";
                            }
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-flat" id="simpan">Simpan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>


<!-- jQuery 2.2.3 -->
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
