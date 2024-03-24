<?= $this->extend('public_layout') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <a href="<?= base_url('/bookedcars'); ?>" class="btn btn-success btn-lg btn-block">View Booked Cars</a>
                </div>
                <div class="col-md-6 mb-3">
                    <a href="<?= base_url('/agencycars'); ?>" class="btn btn-success btn-lg btn-block">View All Cars</a>
                </div>
                <div class="col-md-6 mb-3">
                    <a href="<?= base_url('/addcar'); ?>" class="btn btn-success btn-lg btn-block">Add New Car</a>
                </div>
                <div class="col-md-6 mb-3">
                    <a href="<?= base_url('/cars'); ?>" class="btn btn-success btn-lg btn-block">All Cars Available On Rent</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endsection() ?>