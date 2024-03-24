<style>
    .navbar-brand {
        font-family: sans-serif;

        font-size: 24px;

    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #4CAF50; width: 100%;">
    <div class="container-fluid">
        <!-- Company Title (Left) -->
        <a class="navbar-brand" href="<?= base_url() ?>">CarShala</a>

        <!-- Toggler Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation Links (Center) -->
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <!-- Add more navigation links if needed -->
            </ul>
        </div>

        <!-- Register/Login Buttons (Right) -->
        <div class="d-flex">
            <?php $session = session(); ?>
            <?php if (is_null($session->email)) : ?>
                <a class="btn btn-light me-2" href="<?= base_url() ?>registercustomer"><i class="bi bi-person-add"></i> Register as a Customer</a>
                <a class="btn btn-light me-2" href="<?= base_url() ?>registeragency"><i class="bi bi-person-add"></i> Register as an Agency</a>
                <a class="btn btn-light" href="<?= base_url() ?>login"><i class="bi bi-person-square"></i> Login</a>
            <?php else : ?>
                <h3 class="text-light me-3">Hi, <?= $session->name ?></h3>
                <a class="btn btn-light" href="<?= base_url() ?>logout">Logout</a>
            <?php endif; ?>
        </div>
    </div>
</nav>