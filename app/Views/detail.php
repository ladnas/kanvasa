<?= $this->extend('Layout/Base'); ?>

<?= $this->section('content'); ?>
<title>Detail</title>
<link rel="stylesheet" href="/css/detail.css">

<body class="bg-dark">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8">
                <div class="mb-3">
                    <img src="<?= base_url('uploads/' . $poto['lokasi_file']); ?>" alt="" class="img-fluid">
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-secondary">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <img src="<?= base_url($user->foto_profil)  ?>" class="img-fluid rounded-circle me-2" alt="User Profile Image" style="width: 75px; height: 75px; object-fit: cover;">
                            <h3 class="mb-0 text-light"><?= $user->username ?></h3>
                        </div>
                        <div class="mt-3">
                            <h2 class="card-title text-light"><?= $poto['judul_foto'] ?></h2>
                            <p class="card-text text-light"><?= $poto['desk_foto'] ?></p>
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center"> <!-- Kontainer untuk ikon like, komentar, dan bookmark -->
                            <form action="<?= base_url('like_dislike/' . $poto['foto_id']) ?>" method="post" id="likeDislikeForm">
                        <input type="hidden" name="foto_id" value="<?= $poto['foto_id'] ?>">
                        <button type="submit" class="btn p-0 text-light" id="likeDislikeButton">
                            <?php if ($isLiked) : ?>
                                <i class="bi bi-heart-fill"></i>
                            <?php else : ?>
                                <i class="bi bi-heart"></i>
                            <?php endif; ?>
                            <span class="ms-1" id="likeCount"><?= $total_like ?></span>
                        </button>
                    </form>
                            <div class="text-light ms-3 me-3">
                                <i class="bi bi-chat-right-text-fill"></i>
                                <span class="ms-1"><?= $total_komentar ?></span>
                            </div>
                            <a type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="text-light text-decoration-none">
                                <i class="bi bi-bookmark-plus-fill"></i>
                            </a>
                        </div>
                        <?php if ($isOwner) : ?>
                            <div class="dropdown">
                                <a class="text-light text-decoration-none" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical fs-5"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a href="<?= base_url('/edit/' . $poto['foto_id']); ?>" class="dropdown-item">Edit kanvas</a></li>
                                    <li><a class="dropdown-item" href="#" onclick="openCustomConfirm()">Hapus kanvas</a></li>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="card-footer">
                        <h3 class="text-light">Komentar</h3>
                        <div class="container" style="max-height: 300px; overflow-y: auto;">
                            <!-- Komentar -->
                            <?php if (empty($komentar)) : ?>
                                <p class="text-light text-center mt-5">Belum ada komentar.</p>
                            <?php else : ?>
                                <?php foreach ($komentar as $k) : ?>
                                    <div class="row align-items-center">
                                        <div class="col-3">
                                            <!-- Foto Profil -->
                                            <img src="<?= base_url($k['foto_profil']) ?>" class="img-fluid rounded-circle mt-2" alt="User Profile Image" style="width: 40px; height: 40px; object-fit: cover;">
                                        </div>
                                        <div class="col-9">
                                            <!-- Informasi Profil -->
                                            <div class="mt-4 kanan">
                                                <h6 class="text-light" style="margin-bottom: 0"><?= $k['username'] ?></h6>
                                                <p class="text-light" style="margin-bottom: 0"><?= $k['isi_komentar'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <!-- Form Komentar -->
                        <form action="<?= base_url('komentar/tambah') ?>" method="post">
                            <div class="mb-3 mt-5">
                                <input type="hidden" name="foto_id" value="<?= $poto['foto_id'] ?>">
                                <input type="text" class="form-control" name="isi_komentar" placeholder="Tambahkan komentar..." aria-label="Tambahkan komentar">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


</body>
<!-- Modal delete post -->
<div class="modal fade " id="customConfirmModal" tabindex="-1" aria-labelledby="customConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content bg-dark">
            <div class="modal-header text-light">
                <h5 class="modal-title" id="customConfirmModalLabel">Konfirmasi Hapus</h5>
            </div>
            <div class="modal-body text-light">
                <p>Apakah Anda yakin ingin menghapus kanvas Anda?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <a href="<?= base_url('/delete/' . $poto['foto_id']); ?>" class="btn btn-danger">Hapus</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal album -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-light" id="exampleModalLabel">Tambah ke album</h1>
                <a type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#CreateAlbum">Buat album!</a>
            </div>
            <div class="modal-body text-light">
                <ul class="list-group">
                    <?php if (!empty($albums)) : ?>
                        <?php foreach ($albums as $album) : ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center bg-secondary text-light">
                                <span><?= $album['nama_album']; ?></span>
                                <div>
                                    <?php if ($album['included_in_album']) : ?>
                                        <a href="<?= base_url('removepost/' . $poto['foto_id'] . '/' . $album['album_id']); ?>" class="btn btn-outline-light btn-sm me-2">
                                            <i class="bi bi-trash"></i> Remove
                                        </a>
                                    <?php else : ?>
                                        <a href="<?= base_url('Albumitem/addToAlbum/' . $poto['foto_id'] . '/' . $album['album_id']); ?>" class="btn btn-outline-light btn-sm">
                                            <i class="bi bi-plus"></i> Add
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <li class="list-group-item">Belum ada album.</li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal buat album -->
<div class="modal fade" id="CreateAlbum" tabindex="-1" aria-labelledby="CreateAlbum" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-light" id="CreateAlbum">Buat album baru!</h1>

            </div>

            <div class="modal-body text-light">
                <!-- Form Membuat Album -->
                <form action="<?= base_url('album/create/') . $poto['foto_id']; ?>" method="post">
                    <div class="mb-3">
                        <label for="nama_album" class="form-label">Nama Album</label>
                        <input type="text" class="form-control" name="nama_album" required>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" rows="3"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openCustomConfirm() {
            // Tampilkan modal
            var myModal = new bootstrap.Modal(document.getElementById('customConfirmModal'));
            myModal.show();
        }
    </script>

    </html>
    <?= $this->endSection(); ?>