<?= $this->extend('Layout/Base'); ?>

<?= $this->section('content'); ?>
<title>edit</title>
<link rel="stylesheet" href="/css/edit.css">

<body class="bg-dark">
    <form action="<?= base_url('/edit_post/' . $poto['foto_id']) ?>" method="post" enctype="multipart/form-data">
        <div class="container mt-5" style="margin-bottom: 60px;">
            <div class="row">
                <!-- Kolom untuk tampilan gambar -->
                <div class="col-md-8">
                    <div class="mb-3">
                        <img id="preview" class="preview" src="<?= base_url('uploads/' . $poto['lokasi_file']); ?>" alt="Preview" />
                        <input type="text" value="<?= base_url('uploads/' . $poto['lokasi_file']); ?>" id="fileDisplay" hidden>
                    </div>
                </div>
                <!-- Kolom untuk formulir input -->
                <div class="col-md-4">
                    <div class="card bg-secondary">
                        <div class="mt-2 me-2 d-flex justify-content-end text-light">
                            <a type="button" class="btn-close" href="/" aria-label="Close"></a>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <div class="d-flex align-items-center mt-2">
                                    <img src="<?= $user->foto_profil ?>" class="img-fluid rounded-circle" alt="User Profile Image" style="width: 75px; height: 75px;">
                                    <h3 class="ms-2 mb-0 text-light"><?= $user->username ?></h3>
                                </div>
                                <div class="container mt-3">
                                    <div class="mb-3">
                                        <h3 class="text-light">Judul</h3>
                                        <input type="text" class="form-control" value="<?= $poto['judul_foto'] ?>" id="titleInput" placeholder="Judul" name="judul_foto" required>
                                    </div>
                                    <div class="mb-3">
                                        <h3 class="text-light">Deskripsi</h3>
                                        <textarea class="form-control" id="descriptionInput" placeholder="Deskripsi" name="desk_foto" rows="3" required><?= $poto['desk_foto'] ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <h3 class="text-light">Upload gambar</h3>
                                        <input class="form-control" type="file" name="lokasi_file" id="gambar" onchange="previewImage(this);" />
                                    </div>
                                    <div>
                                        <button class="btn btn-dark">Simpan perubahan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>
<script>
    function previewImage(input) {
        var preview = document.getElementById('preview');
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

</html>
<?= $this->endSection(); ?>