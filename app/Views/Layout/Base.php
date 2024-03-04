<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $this->session = session();
    $session = session()
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <link rel="icon" href="/img/logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/navbar.css">
    <link rel="stylesheet" href="/css/beranda.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

    <!-- Bagian HTML Navbar -->
    <!-- Bagian HTML Navbar -->
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark sticky-lg-top">
        <!-- Konten Navbar -->
        <div class="container-fluid">
            <!-- Logo -->
            <a href="/"> <!-- Logo hanya tampil di tampilan desktop -->
                <img class="logo" src="/img/logo.png" alt="User Profile Image">
            </a>
            <!-- Tampilan Handphone -->
            <div class="d-sm-none ">
                <!-- Search Bar -->
                <div class="input-group search-input-container d-flex justify-content-center align-items-center">
                    <form action="<?= base_url('/post/search/') ?>" method="get" class="d-flex" id="search-form">
                        <div class="position-relative">
                            <input class="form-control me-2 search-input" type="search" placeholder="Cari..." aria-label="Search" name="keyword" id="search-input" value="<?= session()->getFlashdata('search_keyword') ?>">
                            <span class="bi bi-search search-icon"></span>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Tampilan Desktop -->
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto" style="margin-left: 19px;">
                    <!-- Daftar Menu -->
                    <li class="nav-item">
                        <a class="nav-link nava <?= ($activepage == 'beranda') ? 'active' : ''; ?>" style="margin-left: 20px;" href="/">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nava <?= ($activepage == 'jelajah') ? 'active' : ''; ?>" style="margin-left: 20px;" href="/jelajahi">Jelajahi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nava <?= ($activepage == 'buat') ? 'active' : ''; ?>" style="margin-left: 20px;" href="/buat">Buat</a>
                    </li>
                </ul>
                <!-- Search Bar -->
                <div class="input-group search-input-container d-flex justify-content-center align-items-center">
                    <form action="<?= base_url('/post/search/') ?>" method="get" class="d-flex" id="search-form">
                        <div class="position-relative">
                            <input class="form-control me-2 search-input" type="search" placeholder="Cari..." aria-label="Search" name="keyword" id="search-input" value="<?= session()->getFlashdata('search_keyword') ?>">
                            <span class="bi bi-search search-icon"></span>
                        </div>
                    </form>
                </div>
                <!-- Profil Pengguna -->
                <ul class="navbar-nav me-auto d-none d-sm-block">
                    <li class="nav-item" style="margin-right: 70px;">
                        <!-- Tombol Login -->
                        <?php if (!$this->session->has('username')) { ?>
                            <a class="nav-link" style="margin-left: 20px;" href="/login">
                                <button type="button" class="btn btn-primary">Login</button>
                            </a>
                        <?php } else { ?>
                            <!-- Dropdown Profil Pengguna -->
                            <div class="dropdown me-3">
                                <a class=" dropdown-toggle text-decoration-none" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: #ffffff;">
                                    <img src="<?= base_url($user_img['foto_profil']); ?>" class="img-fluid rounded-circle" alt="User Profile Image" style="width: 30px; height: 30px;">
                                    <i class="text-light fa-solid fa-user mx-2" style="color: #ffffff;"></i><?= $user_img['username'] ?>
                                </a>
                                <!-- Menu Dropdown -->
                                <ul class="dropdown-menu dropdown-menu-dark">
                                    <li><a class="dropdown-item" href="/profil">Profil</a></li>
                                    <li><a class="dropdown-item" href="/logout">Logout</a></li>
                                </ul>
                            </div>
                        <?php } ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>




    <script>
        document.addEventListener('DOMContentLoaded', function() {
                    const searchInput = document.querySelector('#search-input');
                    const searchForm = document.querySelector('#search-form');
                    let searchValue = '';

                    searchInput.addEventListener('input', function(event) {
                        searchValue = this.value.trim();
                    });

                    searchForm.addEventListener('submit', function(event) {
                        event.preventDefault(); // Menghentikan pengiriman formulir

                        if (searchValue.length > 0) {
                            const searchUrl = '/jelajahi?search=' + encodeURIComponent(searchValue);
                            window.location.href = searchUrl;
                        }
                    });

                    // Memulihkan nilai input setelah pengalihan halaman
                    const urlParams = new URLSearchParams(window.location.search);
                    const searchParam = urlParams.get('search');
                    if (searchParam !== null && window.location.pathname !== '/jelajahi') {
                        searchInput.value = decodeURIComponent(searchParam);
                        searchValue = searchParam;
                    }
    </script>
</head>

<?= $this->renderSection('content'); ?>

<footer class="footer-mobile d-lg-none bg-dark">
    <div class="container-fluid">
        <ul class="row list-unstyled text-light justify-content-center"> <!-- Menggunakan justify-content-center agar ikon berada di tengah -->
            <li class="col-auto">
                <a href="/" class="footer-link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
                        <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z" />
                        <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293z" />
                    </svg>
                </a>
            </li>
            <li class="col-auto">
                <a href="/jelajahi" class="footer-link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                    </svg>
                </a>
            </li>
            <li class="col-auto">
                <a href="/buat" class="footer-link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2" />
                    </svg>
                </a>
            </li>
            <li class="col-auto">

                <?php if (!$this->session->has('username')) { ?>
                    <a class="nav-link" style="margin-left: 20px;" href="/login">
                        <button type="button" class="btn btn-primary">Login</button>
                    </a>
                <?php } else { ?>

                    <div class="dropdown mt-1">
                        <a class="dropdown-toggle dropdown-toggle-arrow text-decoration-none" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?= base_url($user_img['foto_profil']); ?>" class="img-fluid rounded-circle userprofil" alt="User Profile Image">
                        </a>

                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li><a class="dropdown-item" href="/profil">Profil</a></li>
                            <li><a class="dropdown-item" href="/logout">Logout</a></li>
                        </ul>
                    </div>
                <?php } ?>
            </li>
        </ul>
    </div>
</footer>