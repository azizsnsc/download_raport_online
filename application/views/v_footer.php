        <div class="modal fade" id="ModalUbah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                        <h4 class="modal-title" id="myModalLabel">Ubah Data Login</h4>
                    </div>
                    <form class="form-horizontal" action="<?php echo base_url().'datauser/ubahpassword'?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body" style="padding: 5%">
                      <input type="hidden" name="id">
                      <div class="form-group">
                        <label>Masukan Username Baru</label>
                        <input type="text" name="username" class="form-control">
                      </div>
                      <div class="form-group">
                        <label>Masukan Password Baru</label>
                        <input type="text" name="password" class="form-control">
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
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; 2020 <a href="https://www.sinauo.com/">Sinauo.com</a>.</strong> All rights reserved.
  </footer>