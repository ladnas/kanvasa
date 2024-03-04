<?= $this->extend('Layout/Base'); ?>

<?= $this->section('content'); ?>
<title>Beranda</title>
<?php
// Set nilai $activePage untuk template navbar
$activepage = 'beranda';
?>
<link rel="stylesheet" href="css/branda.css">
<body class="bg-dark">
  <div class="container mb-4">
    <div>
      <h2 class="text-light krh2">
        Terbaru
      </h2>
    </div>

    <div class="container">
      <div class="row row-cols-lg-6 g-lg-3 row-cols-2"> <!-- Menampilkan 2 kolom pada tampilan handphone -->
        <?php foreach ($foto as $pst) : ?>
          <div class="col">
            <a class="text-decoration-none" href="<?= base_url('detail/' . $pst->foto_id); ?>">
              <!-- Menggunakan gaya CSS untuk membuat gambar lebih besar -->
              <div class="square-container">
                <img src="<?= base_url('uploads/' . $pst->lokasi_file); ?>" class="square-image img-fluid text" alt="Kanvas">
              </div>
              <!-- Hilangkan judul foto dan elemen lain pada tampilan handphone -->
              <h5 class="mt-3 text-light d-none d-sm-block">
                <?php
                $judul_foto = $pst->judul_foto;
                $max_length = 14; // Atur panjang maksimum yang diinginkan

                echo strlen($judul_foto) > $max_length ? substr($judul_foto, 0, $max_length) . '...' : $judul_foto;
                ?>
              </h5>
              <div class="d-flex align-items-center d-none d-sm-flex"> <!-- Hilangkan nama user dan foto profil pada tampilan handphone -->
                <img src="<?= $pst->foto_profil  ?>" class="img-fluid rounded-circle" alt="User Profile Image" style="width: 25px; height: 25px;">
                <p class="ms-2 mb-0 text-light"><?= $pst->nama_user ?></p>
              </div>
            </a>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <div class="mt-5">
      <h2 class="text-light krh2">
        Untuk anda
      </h2>
    </div>

    <div class="container bawah">
      <div class="row row-cols-lg-6 g-lg-3 row-cols-2"> <!-- Menampilkan 2 kolom pada tampilan handphone -->
        <?php foreach ($foto as $pst) : ?>
          <div class="col">
            <a class="text-decoration-none" href="<?= base_url('detail/' . $pst->foto_id); ?>">
              <!-- Menggunakan gaya CSS untuk membuat gambar lebih besar -->
              <div class="square-container">
                <img src="<?= base_url('uploads/' . $pst->lokasi_file); ?>" class="square-image img-fluid text" alt="Kanvas">
              </div>
              <!-- Hilangkan judul foto dan elemen lain pada tampilan handphone -->
              <h5 class="mt-3 text-light d-none d-sm-block">
                <?php
                $judul_foto = $pst->judul_foto;
                $max_length = 14; // Atur panjang maksimum yang diinginkan

                echo strlen($judul_foto) > $max_length ? substr($judul_foto, 0, $max_length) . '...' : $judul_foto;
                ?>
              </h5>
              <div class="d-flex align-items-center d-none d-sm-flex"> <!-- Hilangkan nama user dan foto profil pada tampilan handphone -->
                <img src="<?= $pst->foto_profil  ?>" class="img-fluid rounded-circle" alt="User Profile Image" style="width: 25px; height: 25px;">
                <p class="ms-2 mb-0 text-light"><?= $pst->nama_user ?></p>
              </div>
            </a>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</body>

</html>
<?= $this->endSection(); ?>
