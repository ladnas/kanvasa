<?= $this->extend('Layout/Base'); ?>

<?= $this->section('content'); ?>
<?php
$this->session = session();
$session = session()
?>

<?php
// Mendapatkan flashdata
$successMessage = session()->getFlashdata('success');
$errorMessage = session()->getFlashdata('error');
?>
<?php if ($successMessage) : ?>
    <div class="alert alert-success" role="alert">
        <?= $successMessage ?>
    </div>
<?php endif; ?>

<?php if ($errorMessage) : ?>
    <div class="alert alert-danger" role="alert">
        <?= $errorMessage ?>
    </div>
<?php endif; ?>


<title>Edit Profil anda</title>
<link rel="stylesheet" href="/css/profil.css">
<body class="bg-dark ">
<div class="container rounded bg-secondary mt-5" style="margin-bottom: 60px;">
    <form action="<?= base_url('editProfil/' . $user['user_id']); ?>" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-4 border-right">
                <div class="card mt-3 mb-3 bg-dark">
                    <div class="card-body">
                        <div class="text-light d-flex flex-column align-items-center text-center p-3 py-5">
                            <div class="upload-container position-relative mt-3" onclick="document.getElementById('gambarProfil').click();">
                                <img class="preview rounded-circle img-fluid" id="previewProfil" src="<?= base_url($user['foto_profil']); ?>" alt="Preview Profil" />
                                <label class="position-absolute top-0 end-0 p-3" for="gambarProfil" style="margin-left: -30px;">
                                    <i class="bi bi-pencil text-dark fs-5"></i>
                                </label>
                            </div>
                            <input type="file" name="foto_profil" id="gambarProfil" style="display: none;" onchange="previewImageProfil(this);" />
                            <h3 class="font-weight-bold"><?= $user['username'] ?></h3>
                            <span class="text-light-50"><?= $user['alamat'] ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex flex-row align-items-center back"><i class="fa fa-long-arrow-left mr-1 mb-1"></i>
                        <h3 class="text-right text-light">Edit Profil</h3>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <input type="text" class="form-control bg-dark text-light mb-3" placeholder="first name" name="username" value="<?= $user['username'] ?>">
                            <input type="text" class="form-control bg-dark text-light mb-3" value="<?= $user['nama_lengkap'] ?>" name="nama_lengkap" placeholder="nama lengkap">
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control bg-dark text-light mb-3" placeholder="Email" name="email" value="<?= $user['email'] ?>">
                            <input type="text" class="form-control bg-dark text-light" value="<?= $user['alamat'] ?>" name="alamat" placeholder="alamat">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <textarea class="form-control bg-dark text-light" id="descriptionInput " placeholder="Bio anda" name="bio" rows="3"><?= $user['bio'] ?></textarea>
                        </div>
                    </div>
                    <div class="mt-3 text-right"><button class="btn btn-primary profile-button" type="submit">Save Profile</button></div>
                </div>
            </div>
        </div>
    </form>
</div>

</body>
<script>
    function previewImageProfil(input) {
        var previewProfil = document.getElementById('previewProfil');
        var uploadTextProfil = document.querySelector('.upload-text');

        // Menghapus gambar sebelumnya
        previewProfil.src = "";

        if (input.files && input.files[0]) {
            var readerProfil = new FileReader();

            readerProfil.onload = function(e) {
                previewProfil.src = e.target.result;
                uploadTextProfil.style.display = 'none';
                previewProfil.style.display = 'block';
                adjustInputSizeProfil();
            }

            readerProfil.readAsDataURL(input.files[0]);
        }
    }

    function adjustInputSizeProfil() {
        var previewProfil = document.getElementById('previewProfil');
        var uploadContainerProfil = document.querySelector('.upload-container');

        // Set tinggi dan lebar input sesuai dengan dimensi gambar
        uploadContainerProfil.style.width = previewProfil.width + '40%';
        uploadContainerProfil.style.height = previewProfil.height + '40% ';
    }
</script>

</html>
<?= $this->endSection(); ?>