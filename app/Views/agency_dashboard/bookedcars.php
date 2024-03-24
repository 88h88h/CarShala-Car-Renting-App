<?= $this->extend('public_layout') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
    <h2 class="text-center mb-4">View Booked Cars</h2>

    <div class="row">
        <?php if (empty($bookedCars)) : ?>
            <div class="col-md-12">
                <div class="alert alert-info" role="alert">
                    No cars have been booked by customers.
                </div>
            </div>
        <?php else : ?>
            <?php foreach ($bookedCars as $bookedCar) : ?>
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header" style="background-color: #5cb85c; color: white;">
                            <h5 class="card-title"><?= $bookedCar['car']['vehicle_model']; ?></h5>
                            <p class="card-text">Vehicle Number: <?= $bookedCar['car']['vehicle_number']; ?></p>
                            <p class="card-text">Seating Capacity: <?= $bookedCar['car']['seating_capacity']; ?></p>
                            <p class="card-text">Rent per Day: $<?= $bookedCar['car']['rent_per_day']; ?></p>
                        </div>
                        <div class="card-body">
                            <h6 class="card-subtitle mb-3">Bookings:</h6>
                            <?php if (isset($bookedCar['booking'])) : ?>
                                <p>Customer Name: <?= $bookedCar['booking']['customer_name']; ?></p>
                                <p>Start Date: <?= date('Y-m-d', strtotime($bookedCar['booking']['start_date'])); ?></p>
                                <p>Number of Days: <?= $bookedCar['booking']['days']; ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?= $this->endsection() ?>