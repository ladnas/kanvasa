<?= $this->extend('Layout/Base'); ?>

<?= $this->section('content'); ?>
<?php
$this->session = session();
$session = session()
?>

<link rel="stylesheet" href="/css/profil.css">
<style>
    /* Semua gambar di tab album */
    #profile .album-image {
        display: none;
    }

    /* Tampilkan hanya gambar pertama */
    #profile .album-image:first-child {
        display: block;
    }
</style>
<title>Profil anda</title>

<body class="bg-dark">
    <div class="container mt-4">
        <div class="row">
            <div class="col-4 col-md-2">
                <!-- Foto Profil -->
                <img src="<?= base_url($user['foto_profil']); ?>" class="img-fluid rounded-circle fotoprofil" alt="User Profile Image">
            </div>
            <div class="col-8 col-md-8 mt-4">
                <!-- Informasi Profil -->
                <div class="ms-md-4">
                    <h1 class="text-light"><?= $user['username']; ?><a type="button" href="edit_profil" class="btn btn-secondary ms-3">Edit profil</a> </h1>
                    <p class="lead text-light smaller-text"><?= $user['bio'] ?></p>
                </div>
            </div>
        </div>
    </div>


    <div class="container mt-5 tengah">
        <!-- Navbar Tabs -->
        <ul class="nav nav-tengah">
            <li class="nav-item ms-4">
                <a class="nav-link text-light nava ms-2 show active" id="postingan-tab" data-bs-toggle="tab" href="#postingan">Postingan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light nava ms-4" id="album-tab" data-bs-toggle="tab" href="#album">Album</a>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content bawah">
    <!-- Tab Postingan -->
    <div class="tab-pane fade show active ms-3" id="postingan">
        <!-- Konten Beranda -->
        <div class="container mt-2">
            <?php if (empty($user_posts)) : ?>
                <div class="row justify-content-center"> <!-- Ubah di sini -->
                    <div class="col text-center mt-5">
                        <h3 class="text-light">Belum ada postingan</h3>
                    </div>
                </div>
            <?php else : ?>
                <div class="row row-cols-lg-6 g-lg-3 row-cols-2"> <!-- Menampilkan 2 kolom pada tampilan handphone -->
                    <?php foreach ($user_posts as $post) : ?>
                        <div class="col">
                            <a href="<?= base_url('detail/' . $post['foto_id']) ?>" class="text-decoration-none">
                                <!-- Menggunakan gaya CSS untuk membuat gambar lebih besar -->
                                <div class="square-container">
                                    <img src="<?= base_url('uploads/' . $post['lokasi_file']); ?>" class="square-image img-fluid text" alt="Kanvas">
                                </div>
                                <!-- Hilangkan judul foto dan elemen lain pada tampilan handphone -->
                                <h5 class="mt-3 text-light d-none d-sm-block">
                                    <?php
                                    $judul_foto = $post['judul_foto'];
                                    $max_length = 14; // Atur panjang maksimum yang diinginkan

                                    echo strlen($judul_foto) > $max_length ? substr($judul_foto, 0, $max_length) . '...' : $judul_foto;
                                    ?>
                                </h5>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Tab Album -->
    <div class="tab-pane fade ms-3" id="album">
        <!-- Konten Album -->
        <div class="container mt-2">
            <div class="row row-cols-lg-6 g-lg-3 row-cols-2"> <!-- Ubah di sini -->
                <?php if (!empty($albume)) : ?>
                    <?php
                    // Grouping the albums based on album_id
                    $groupedAlbums = [];
                    foreach ($albume as $album) {
                        $groupedAlbums[$album['album_id']][] = $album;
                    }
                    ?>
                    <?php foreach ($groupedAlbums as $albumId => $album) : ?>
                        <div class="col">
                            <a href="<?= base_url('albumdetail/' . $albumId) ?>" class="text-decoration-none">
                                <div class="card-body">
                                    <?php foreach ($album as $foto) : ?>
                                        <!-- Menggunakan gaya CSS untuk membuat gambar lebih besar -->
                                        <div class="square-container">
                                            <img src="<?= base_url('uploads/' . $foto['lokasi_file']); ?>" class="square-image img-fluid text" alt="Kanvas">
                                        </div>
                                    <?php endforeach; ?>
                                    <!-- Hilangkan judul foto dan elemen lain pada tampilan handphone -->
                                    <h5 class="mt-3 text-light d-none d-sm-block">
                                        <?php
                                        $nama_album = $album[0]['nama_album']; // Taking the album name from the first photo in the album
                                        $max_length = 18; // Set the desired maximum length

                                        echo strlen($nama_album) > $max_length ? substr($nama_album, 0, $max_length) . '...' : $nama_album;
                                        ?>
                                    </h5>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="col text-center mt-5">
                        <h2 class="text-light text-center">Belum ada album</h2>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

    </div>


</body>
<script>
    $(document).ready(function() {
        // Mendapatkan nilai $activePage yang dikirim dari controller
        var activepage = '<?= $activepage ?>';

        // Mengatur tab yang aktif berdasarkan halaman yang sedang diakses
        $('a.nav-link').removeClass('active');
        $('a.nav-link[data-page="' + activepage + '"]').addClass('active');
    });
</script>

</html>
<?= $this->endSection(); ?>