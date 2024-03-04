<?= $this->extend('Layout/Base'); ?>

<?= $this->section('content'); ?>
<title>Buat</title>
<?php
// Set nilai $activePage untuk template navbar
$activepage = 'buat';
?>
<link rel="stylesheet" href="/css/buat.css">

<body class="bg-dark">
    <?php
    $this->session = session();
    $session = session()
    ?>
    <div class="container mt-5 bawah">
    <div class="row">
        <div class="col-12">
            <div class="mb-3">
                <h2 class="text-white">Upload kanvas anda!</h2>
            </div>
        </div>
    </div>
    <form action="/buat_post" method="post" enctype="multipart/form-data">
        <div class="row">
            <!-- Area untuk mengupload gambar -->
            <div class="col-md-6 mb-3">
                <div class="upload-container" onclick="document.getElementById('gambar').click();">
                    <span class="upload-text">Ketuk untuk mengupload gambar anda</span>
                    <img id="preview" src="#" alt="Preview" />
                </div>
                <input type="file" name="lokasi_file" id="gambar" style="display: none;" onchange="previewImage(this);" accept="image/*" />
            </div>
            <!-- Form input untuk judul, deskripsi, dan tombol upload -->
            <div class="col-md-6">
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="titleInput" class="form-label">Judul</label>
                            <input type="text" class="form-control" id="titleInput" placeholder="Judul" name="judul_foto" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="descriptionInput" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="descriptionInput" placeholder="Deskripsi" name="desk_foto" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input-group mb-3">
                            <?php $session = session(); ?>
                            <input type="text" value="<?= $session->get('user_id'); ?>" class="form-control" name="user_id" hidden>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>



</body>
<script>
    function previewImage(input) {
        var preview = document.getElementById('preview');
        var uploadText = document.querySelector('.upload-text');

        // Menghapus gambar sebelumnya
        preview.src = "";

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                uploadText.style.display = 'none';
                preview.style.display = 'block';
                adjustInputSize();
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    function adjustInputSize() {
        var preview = document.getElementById('preview');
        var uploadContainer = document.querySelector('.upload-container');

        // Set tinggi dan lebar input sesuai dengan dimensi gambar
        uploadContainer.style.width = preview.width + '100%';
        uploadContainer.style.height = preview.height + '100%';
    }
</script>

</html>
<?= $this->endSection(); ?>