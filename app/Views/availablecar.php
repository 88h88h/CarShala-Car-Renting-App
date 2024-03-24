<?= $this->extend('public_layout') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
    <h2 class="text-center">Available Cars to Rent</h2>
    <?php $session = session(); ?>
    <div class="row">
        <?php foreach ($cars as $car) : ?>
            <?php
            // Check if car is already booked
            $alreadyBooked = false;
            foreach ($bookings as $booking) {
                if ($booking['car_id'] == $car['id']) {
                    $alreadyBooked = true;
                    break;
                }
            }
            ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $car['vehicle_model']; ?></h5>
                        <p class="card-text">Vehicle Number: <?php echo $car['vehicle_number']; ?></p>
                        <p class="card-text">Seating Capacity: <?php echo $car['seating_capacity']; ?></p>
                        <p class="card-text">Rent per Day: $<?php echo $car['rent_per_day']; ?></p>
                        <?php if ($alreadyBooked) : ?>
                            <p class="card-text text-danger">Already Booked</p>
                        <?php else : ?>
                            <form action="<?= base_url('rent'); ?>" method="post">
                                <?php if ($session->loggedin == "yes" && $session->role == "customer") : ?>
                                    <div class="form-group">
                                        <label for="days">Number of Days:</label>
                                        <select class="form-control" id="days" name="days">
                                            <option value="1">1 day</option>
                                            <option value="2">2 days</option>
                                            <option value="3">3 days</option>
                                            <!-- Add more options as needed -->
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="start_date">Start Date:</label>
                                        <input type="date" class="form-control" id="start_date" name="start_date">
                                    </div>
                                    <input type="hidden" name="car_id" value="<?php echo $car['id']; ?>">
                                <?php endif; ?>
                                <button type="submit" class="btn btn-success mt-3" <?= ($session->role == "agency") ? "disabled" : "" ?>>Rent Car</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?= $this->endsection() ?>