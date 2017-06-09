<!DOCTYPE html>
<html>
    <head> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')?>" rel="stylesheet">
    </head> 
<body>
    <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Pondok Web</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Data Referensi
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="<?php echo base_url('td_guru/') ?>">Daftar Referensi Guru</a></li>
          <li><a href="<?php echo base_url('td_santri/') ?>">Daftar Referensi Santri</a></li>
          <li><a href="<?php echo base_url('tr_kkm/') ?>">Daftar Referensi KKM</a></li>
          <li><a href="<?php echo base_url('Tr_Pelajaran/') ?>">Daftr Referensi Pelajaran</a></li>
        </ul>
      </li>
      <li><a href="<?php echo base_url('tr_kelas/');?>">Kelas</a></li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Nilai
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="<?php echo base_url('td_santri_pelajaran/') ?>">List Santri</a></li>
        </ul>
      </li>
    </ul>
    <!--<ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    </ul>-->
  </div>
</nav>
    <?php echo $body; ?>
    <script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
    <script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
    <script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js')?>"></script>
    <script src="<?php echo base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js')?>"></script>
    <?php 
    echo $script_var_location;
    echo $script_js;
    ?>
    <?php echo $modal;?>
</body>
</html>