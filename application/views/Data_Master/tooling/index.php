<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/jquery-ui-1.12.1.custom/jquery-ui.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/sweetalert2_ori/dist/sweetalert2.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/sweetalert2_ori/dist/sweetalert2.min.css">
  <?php $this->load->view("_partial/head")?>
</head>
<body class="hold-transition sidebar-mini layout-fixed sidebar-collapse layout-navbar-fixed layout-footer-fixed">
<div class="preloader">
  <div class="loader">
      <div></div>
      <div></div>
      <div></div>
  </div>
</div>
<div class="wrapper">
    <?php $this->load->view('_partial/navbar');?>
    <?php $this->load->view('_partial/sidebar');?>
    <div class="content-wrapper">
      <?php $this->load->view('_partial/content-header');?>
      <div class="content">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-2">
                  <div class="form-group">
                    <label>Tooling Category</label>
                    <select class="select2 form-control filter" id="filKategori">
                      <option value="">ALL</option>
                      <option value="Single">Single</option>
                      <option value="Settingan">Settingan</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label>Jenis Proses</label>
                    <select class="select2 form-control filter" id="filJenisProses">
                      <option value="">ALL</option>
                      <?php foreach ($proses as $key2): ?>
                        <option value="<?=$key2->proses?>"><?=$key2->proses?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label>Jenis Tool</label>
                    <select class="select2 form-control filter" id="filJenisTool">
                      <option value="">ALL</option>
                      <?php foreach ($jenis as $key): ?>
                        <option value="<?=$key->kode?>"><?=$key->jenistool?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <form id="search">
                    <div class="form-group">
                      <label>&nbsp;</label>
                      <span class="fa fa-search form-control-icon"></span>
                      <input type="search" class="form-control form-control-search" id="filSearch" placeholder="Cari Berdasarkan NIK atau Nama Karyawan">
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>  
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <div id="getTabel"></div>
                </div>
              </div>
            </div>
          </div>    
        </div>
      </div>
    </div>
    <?php $this->load->view('_partial/footer');?>
</div>
<?php $this->load->view("_partial/js");?>
<script src="<?= base_url()?>assets/plugins/select2/js/select2.full.min.js"></script>
<script src="<?= base_url()?>assets/plugins/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="<?= base_url()?>assets/plugins/sweetalert2_ori/dist/sweetalert2.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('.select2').select2({
        'width': '100%',
    });
    getTabel();
    // $('.ph-item').fadeOut('slow');
    // $('.test').fadeIn('slow').removeClass('d-none');
    
    // make_skeleton().fadeOut();
   $('.filter').on('change', function(){
    getTabel();
   });
   $('#search').submit(function(e){
    e.preventDefault();
    getTabel();
   });

  })
  
  function getTabel() {
    var gagal = '<div class="alert alert-danger alert-dismissible">';
        gagal +='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
        gagal +='<h5><i class="icon fas fa-ban"></i>Gagal Meload Data!</h5>';
        gagal +='Lakukan Refresh pada Halaman Ini! Jika Masih Error Mohon Untuk Hubungi Staff IT!';
        gagal +='</div>';
    var filKategori = $('#filKategori').val();
    var filJenisProses = $('#filJenisProses').val();
    var filJenisTool = $('#filJenisTool').val();
    var filSearch = $('#filSearch').val();
    $.ajax({
      type:'post',
      url: 'getTabelTooling',
      data:{filKategori, filJenisProses, filJenisTool, filSearch},
      cache: false,
      async: true,
      beforeSend: function(data){
        $('.preloader').show();
      },  
      success: function(data){
        $('#getTabel').html(data);
      },
      complete: function(data){
        $('.preloader').fadeOut("slow");
      },
      error: function(data){
        $('#getTabel').html(gagal);
      }
    })
  }

</script>
<!-- FootJS -->
</body>
</html>
