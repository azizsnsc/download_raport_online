<!--Counter Inbox-->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$set = $this->db->get_where('sekolah', ['id'=>1])->row_array();
?>

<header class="main-header">

    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">DFL</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">DFILE</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url().'assets/images/'.$set['LogoSekolah'];?>" class="user-image" alt="">
              <span class="hidden-xs"><?php echo $this->session->userdata('nama_user'); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url().'assets/images/'.$set['LogoSekolah'];?>" class="img-circle" alt="">

                <p><?php echo $this->session->userdata('username'); ?>
                </p>
              </li>
              <!-- Menu Body -->

              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="<?php echo base_url().'bagianadmin/logout'?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
                <div class="pull-left">
                  <a data-toggle="modal" data-target="#ModalUbah" class="btn btn-default btn-flat">Ubah User Login</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="<?php echo base_url().''?>" target="_blank" title="Lihat Website"><i class="fa fa-globe"></i></a>
          </li>
        </ul>
      </div>

    </nav>
  </header>

  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">Menu Utama</li>
        <li>
          <a href="<?php echo base_url().'bagianadmin'?>">
            <i class="fa fa-home"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <small class="label pull-right"></small>
            </span>
          </a>
        </li>
        <?php $dk = $this->db->query("select ID,Kelas from siswa group by Kelas"); 
          $jkd = $dk->num_rows();
          if (!empty($jkd)) {
        ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-upload"></i>
            <span>Status Upload / Download</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           <?php
           foreach ($dk->result_array() as $kd) {
             echo '<li><a href="'.base_url("uploadraport/data/").$kd["ID"].'"><i class="fa fa-list"></i> '.$kd["Kelas"].'</a></li>';
           }
           ?>
          </ul>
        </li>
        <?php } else { echo ""; } ?>
        <li>
          <a href="<?php echo base_url().'datasiswa'?>">
            <i class="fa fa-user"></i> <span>Data Siswa / Peserta</span>
            <span class="pull-right-container">
              <small class="label pull-right"></small>
            </span>
          </a>
        </li>
        <li>
          <a href="<?php echo base_url().'password'?>">
            <i class="fa fa-lock"></i> <span>Password Walikelas</span>
            <span class="pull-right-container">
              <small class="label pull-right"></small>
            </span>
          </a>
        </li>
        <li>
          <a href="<?php echo base_url().'datasekolah'?>">
            <i class="fa fa-gear"></i> <span>Data Sekolah</span>
            <span class="pull-right-container">
              <small class="label pull-right"></small>
            </span>
          </a>
        </li>
        <li>
          <a href="<?php echo base_url().'datasekolah/jadwal'?>">
            <i class="fa fa-gear"></i> <span>Setting Jadwal Download</span>
            <span class="pull-right-container">
              <small class="label pull-right"></small>
            </span>
          </a>
        </li>
         <li>
          <a href="<?php echo base_url().'bagianadmin/logout'?>">
            <i class="fa fa-sign-out"></i> <span>Sign Out</span>
            <span class="pull-right-container">
              <small class="label pull-right"></small>
            </span>
          </a>
        </li>


      </ul>
    </section>
     
  </aside>