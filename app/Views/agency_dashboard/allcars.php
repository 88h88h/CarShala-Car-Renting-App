<?= $this->extend('public_layout') ?>
<?= $this->section('content') ?>

<div class="container">
    <h2>All Cars Added by Agency</h2>

    <?php if (empty($cars)) : ?>
        <p>No cars have been added by the agency.</p>
    <?php else : ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="bg-success text-white">
                    <tr>
                        <th>Vehicle Model</th>
                        <th>Vehicle Number</th>
                        <th>Seating Capacity</th>
                        <th>Rent per Day</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cars as $car) : ?>
                        <tr>
                            <td><?= $car['vehicle_model']; ?></td>
                            <td><?= $car['vehicle_number']; ?></td>
                            <td><?= $car['seating_capacity']; ?></td>
                            <td>$<?= $car['rent_per_day']; ?></td>
                            <td>
                                <a href="<?= site_url('/addcar/' . $car['id']); ?>" class="btn btn-success btn-sm">Edit</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?= $this->endsection() ?>