<?= $this->extend('public_layout') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card bg-light">
                <div class="card-body">
                    <h2 class="text-center mb-4">Create New Agency Account</h2>
                    <?php $session = session(); ?>
                    <?php if (!is_null($session->getFlashdata("success_message"))) : ?>
                        <div class="alert alert-success"><?= $session->getFlashdata("success_message") ?></div>
                    <?php endif ?>
                    <?php if (isset($validation)) {
                        echo $validation->listErrors();
                    } ?>
                    <form action="<?= base_url('registeragency') ?>" method="post">
                        <div class="mb-3">
                            <label for="company_name" class="form-label">Agency Name</label>
                            <input type="text" class="form-control" name="company_name">
                        </div>

                        <div class="mb-3">
                            <label for="contact_person" class="form-label">Agency Personnel Name</label>
                            <input type="text" class="form-control" name="contact_person">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" name="email">
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control" name="address"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="phone_number" class="form-label">Contact No.</label>
                            <input type="tel" class="form-control" name="phone_number">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password">
                        </div>

                        <div class="mb-3">
                            <label for="cpassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" name="cpassword">
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endsection() ?>