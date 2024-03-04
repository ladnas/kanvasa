<?= $this->extend('Layout/Base'); ?>

<?= $this->section('content'); ?>
<title>Jelahi</title>
<link rel="stylesheet" href="/css/jelajah.css">
<?php
// Set nilai $activePage untuk template navbar
$activepage = 'jelajahi';
?>

<body class="bg-dark bawah">
  <div class="container mb-3">
    <div class="text-centers  mb-3"> <!-- Tambahkan class text-center di sini -->
      <h2 class="text-light krh2">
        Jelajahi
      </h2>
    </div>

    <div class="container">
      <?php if (empty($foto)) : ?>
        <div class="text-center text-secondary">
          <h1>Tidak ada kanvas yang cocok</h1>
        </div>
        
      <?php else : ?>
        <div class="row row-cols-lg-6 g-lg-4 row-cols-2">
          <?php foreach ($foto as $pst) : ?>
            <div class="col">
              <a class="text-decoration-none" href="<?= base_url('detail/' . $pst->foto_id); ?>">
                <div class="square-container">
                  <img src="<?= base_url('uploads/' . $pst->lokasi_file); ?>" class="square-image img-fluid text" alt="User Image">
                </div>
                <h5 class="mt-3 text-light d-none d-sm-block">
                <?php
                $judul_foto = $pst->judul_foto;
                $max_length = 13; // Atur panjang maksimum yang diinginkan

                echo strlen($judul_foto) > $max_length ? substr($judul_foto, 0, $max_length) . '...' : $judul_foto;
                ?>
              </h5>
                <div class="d-flex align-items-center d-none d-sm-flex">
                  <img src="<?= $pst->foto_profil  ?>" class="img-fluid rounded-circle" alt="User Profile Image" style="width: 25px; height: 25px;">
                  <p class="ms-2 mb-0 text-light "><?= $pst->nama_user ?></p>
                </div>
              </a>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</body>



</html>
<?= $this->endSection(); ?>


