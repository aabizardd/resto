<div class="error-page">
  <div class="error-content">
    <h3 class="text-center"><i class="fa fa-warning text-red"></i> Ups! Ada yang salah.</h3>
    <p class="text-center">
    <?php
    $link = $this->inilogin->level;
    $link_kecil = strtolower($link);
    ?>
      Anda tidak memiliki akses halaman, Anda dapat kembali ke <a href="<?php echo base_url("".$link_kecil."/dashboard");  ?>">Dasboard</a>.
    </p>
  </div>
</div>
<!-- /.error-page -->