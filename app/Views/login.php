<?= $this->extend('public_layout') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card bg-light">
                <div class="card-body">
                    <h2 class="text-center mb-4">Login to Your Account</h2>
                    <?php $session = session(); ?>
                    <?php if (!is_null($session->getFlashdata("failed_message"))) : ?>
                        <div class="alert alert-danger"><?= $session->getFlashdata("failed_message") ?></div>
                    <?php endif ?>
                    <?php if (isset($validation)) {
                        echo $validation->listErrors();
                    } ?>
                    <form action="<?= base_url('login') ?>" method="post">
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-select" name="role">
                                <option>Customer</option>
                                <option>Agency</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endsection() ?>