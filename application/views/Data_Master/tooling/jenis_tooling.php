<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/jquery-ui-1.12.1.custom/jquery-ui.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/sweetalert2_ori/dist/sweetalert2.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/ladda-buttons/css/ladda-themeless.min.css">
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
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">Jenis Tooling</h3>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle text-center">
                  <thead>
                    <tr>
                      <th>Kode</th>
                      <th>Jenis Tooling</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($jenis as $key): ?>
                      <tr>
                        <td><?=$key->kode?></td>
                        <td><?=$key->jenistool?></td>
                      </tr>
                    <?php endforeach ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">Proses Tooling</h3>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle text-center">
                  <thead>
                    <tr>
                      <th>Kode</th>
                      <th>Proses Tooling</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($proses as $key): ?>
                      <tr>
                        <td><?=$key->nourut?></td>
                        <td><?=$key->proses?></td>
                      </tr>
                    <?php endforeach ?>
                  </tbody>
                </table>
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
<script src="<?= base_url()?>assets/plugins/ladda-buttons/js/spin.min.js"></script>
<script src="<?= base_url()?>assets/plugins/ladda-buttons/js/ladda.min.js"></script>
<script src="<?= base_url()?>assets/plugins/ladda-buttons/js/ladda.jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('.select2').select2({
        'width': '100%',
    });
    $('.preloader').fadeOut('slow');
    $('.ladda-button').ladda('bind', {timeout: 1000});
    
    // $('.ph-item').fadeOut('slow');
    // $('.test').fadeIn('slow').removeClass('d-none');
    
    // make_skeleton().fadeOut();
   

  })
  
  

</script>
<!-- FootJS -->
</body>
</html>
