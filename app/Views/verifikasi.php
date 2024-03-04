<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Verification</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            background-color: #343a40;
        }
        .card {
            margin-top: 100px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card text-center">
                <div class="card-header bg-dark text-white">
                    Account Verification
                </div>
                <div class="card-body bg-dark text-light">
                    <p class="card-text">Thank you for registering! To complete the registration process, please click the button below to verify your account.</p>
                    <img src="img/verified.png" alt="" style="width: 300px;" class="mb-3">
                    <br>
                    <a href="<?= base_url('verifyaccount/' . session()->get('email')) ?>" class="btn btn-primary btn-lg">Verify Account</a>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.2.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
