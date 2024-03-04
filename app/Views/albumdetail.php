<?= $this->extend('Layout/Base'); ?>

<?= $this->section('content'); ?>
<title>Album detail</title>
<?php
// Set nilai $activePage untuk template navbar
$activepage = 'jelajahi';
?>
<link rel="stylesheet" href="/css/branda.css">
<body class="bg-dark">
  <div class="container mb-3">
    <!-- Detail Album -->
    <div class="container mt-5">
    <div class="dropdown">
        <h2 class="card-title text-light d-inline"><?= $NamaAlbum['nama_album'] ?></h2>
        <a class="text-light text-decoration-none d-inline ms-4" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-three-dots fs-5"></i>
        </a>
        <ul class="dropdown-menu ">
            <li><a type="button" class="dropdown-item text-decoration-none text-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit nama album</a></li>
            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal" onclick="openCustomConfirm()">Hapus album</a></li>
        </ul>
    </div>
    <p class="card-text text-light"><?= $NamaAlbum['deskripsi'] ?></p>
</div>

<div class="container mt-3">
      <div class="row row-cols-lg-6 g-lg-3 row-cols-2"> <!-- Menampilkan 2 kolom pada tampilan handphone -->
      <?php foreach ($photo as $pht) : ?>
          <div class="col">
          <a class="text-decoration-none" href="<?= base_url('detail/' . $pht['foto_id']); ?>">
              <!-- Menggunakan gaya CSS untuk membuat gambar lebih besar -->
              <div class="square-container">
                <img src="<?= base_url('uploads/' . $pht['lokasi_file']); ?>" class="square-image img-fluid text" alt="Kanvas">
              </div>
              <!-- Hilangkan judul foto dan elemen lain pada tampilan handphone -->
              <h5 class="mt-3 text-light d-none d-sm-block">
              <?php
                $judul_foto = $pht['judul_foto'];
                $max_length = 17; // Atur panjang maksimum yang diinginkan

                echo strlen($judul_foto) > $max_length ? substr($judul_foto, 0, $max_length) . '...' : $judul_foto;
                ?>
              </h5>
              <div class="d-flex align-items-center d-none d-sm-flex"> <!-- Hilangkan nama user dan foto profil pada tampilan handphone -->
                <img src=" <?= $pht['foto_profil'] ?>" class="img-fluid rounded-circle" alt="User Profile Image" style="width: 25px; height: 25px;">
                <p class="ms-2 mb-0 text-light"> <?= $pht['username'] ?></p>
              </div>
            </a>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
   
    </div>



</body>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content bg-dark text-light">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit album</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body ">
        <form action="<?= base_url('album/edit/') . $NamaAlbum['album_id'] ?>" method="post">
          <div class="mb-3">
            <label for="nama_album" class="form-label">Nama Album</label>
            <input type="text" class="form-control" value="<?= $NamaAlbum['nama_album'] ?>" name="nama_album" required>
          </div>
          <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control" name="deskripsi" rows="3"><?= $NamaAlbum['deskripsi'] ?></textarea>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteConfirmationModalLabel">Konfirmasi Penghapusan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Apakah Anda yakin ingin menghapus album ini dan semua isinya?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <form action="<?= base_url('album/confirmDelete') ?>" method="post">
          <input type="hidden" name="album_id" value="<?= $NamaAlbum['album_id'] ?>">
          <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
      </div>
    </div>
  </div>
</div>
</html>


<?= $this->endSection(); ?>