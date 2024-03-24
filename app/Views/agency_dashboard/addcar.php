<?= $this->extend('public_layout') ?>
<?= $this->section('content') ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card bg-light">
                <div class="card-body">
                    <h2 class="text-center mb-4">Add a New Car/Edit a Car</h2>
                    <?php

                    use App\Models\CarModel;

                    $model = new CarModel();
                    $session = session();
                    $car_id = $session->car_id;
                    $record = $model->where("id", $car_id)->first();
                    ?>
                    <form action="<?= base_url("addcar") ?>" method="post">
                        <div class="mb-3">
                            <label for="vehicle_model" class="form-label">Vehicle Model</label>
                            <input type="text" class="form-control" name="vehicle_model" id="vehicle_model" value="<?= !is_null($record) ? $record["vehicle_model"] : '' ?>">
                        </div>
                        <div class="mb-3">
                            <label for="vehicle_number" class="form-label">Vehicle Number</label>
                            <input type="text" class="form-control" name="vehicle_number" id="vehicle_number" value="<?= !is_null($record) ? $record["vehicle_number"] : '' ?>">
                        </div>
                        <div class="mb-3">
                            <label for="seating_capacity" class="form-label">Seating Capacity</label>
                            <input type="number" class="form-control" name="seating_capacity" id="seating_capacity" value="<?= !is_null($record) ? $record["seating_capacity"] : '' ?>">
                        </div>
                        <div class="mb-3">
                            <label for="rent_per_day" class="form-label">Rent per Day</label>
                            <input type="number" class="form-control" name="rent_per_day" id="rent_per_day" value="<?= !is_null($record) ? $record["rent_per_day"] : '' ?>">
                        </div>
                        <div class="text-center my-2">
                            <button type="submit" class="btn btn-success">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endsection() ?>