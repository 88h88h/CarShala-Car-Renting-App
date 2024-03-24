<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use App\Models\AgencyModel;
use App\Models\CarModel;
use App\Models\BookingModel;

class AgencyDashboardController extends BaseController
{
    public function index()
    {
        // echo "Agency Dashboard";
        // $model = new AgencyModel();
        // $agencies = $model->findAll();
        return view("agency_dashboard/dashboard");
    }

    public function addcar($carId = null)
    {
        if ($this->request->is('post')) {
            $vehicle_model = $this->request->getVar("vehicle_model");
            $vehicle_number = $this->request->getVar("vehicle_number");
            $seating_capacity = $this->request->getVar("seating_capacity");
            $rent_per_day = $this->request->getVar("rent_per_day");

            $model = new CarModel();
            $session = session();
            $car_id = $session->car_id;
            $record = $model->where("id", $car_id)->first();
            $data = [
                "agency_id" => $session->agency_id,
                "vehicle_model" => $vehicle_model,
                "vehicle_number" => $vehicle_number,
                "seating_capacity" => $seating_capacity,
                "rent_per_day" => $rent_per_day,
            ];

            if (!is_null($record)) {
                // update
                $model->update($car_id, $data);
                $session->remove("car_id");
            } else {
                // insert
                $model->insert($data);
            }
            return redirect()->to(base_url());
        } else if ($this->request->is('get')) {
            $session = session();
            $session->car_id = $carId;
            return view("agency_dashboard/addcar");
        }
    }

    public function allcars()
    {
        // Load the CarModel
        $carModel = new CarModel();

        // Get the current agency's ID from the session
        $session = session();
        $agencyId = $session->agency_id;

        // Retrieve all cars added by the agency
        $cars = $carModel->where('agency_id', $agencyId)->findAll();

        // Pass the cars data to the view
        return view('agency_dashboard/allcars', ['cars' => $cars]);
    }

    public function bookedcars()
    {
        // Load the necessary models
        $carModel = new CarModel();
        $bookingModel = new BookingModel();
        $customerModel = new CustomerModel(); // Load CustomerModel

        // Get the current agency's ID from the session
        $session = session();
        $agencyId = $session->agency_id;

        // Retrieve all cars added by the agency
        $cars = $carModel->where('agency_id', $agencyId)->findAll();

        // Initialize an empty array to store booked cars and their bookings
        $bookedCars = [];

        // Iterate through each car to find its bookings
        foreach ($cars as $car) {
            // Retrieve bookings associated with the current car
            $bookings = $bookingModel->where('car_id', $car['id'])->findAll();

            // If bookings exist, store the car and its bookings in the $bookedCars array
            if (!empty($bookings)) {
                $carDetails = [
                    'vehicle_model' => $car['vehicle_model'],
                    'vehicle_number' => $car['vehicle_number'],
                    'seating_capacity' => $car['seating_capacity'],
                    'rent_per_day' => $car['rent_per_day']
                ];

                foreach ($bookings as $booking) {
                    // Retrieve customer details using customer_id
                    $customer = $customerModel->find($booking['customer_id']);
                    if ($customer) {
                        // If customer found, add customer_name to booking
                        $booking['customer_name'] = $customer['full_name'];
                    }

                    // Store each booking along with car details in $bookedCars array
                    $bookedCars[] = [
                        'car' => $carDetails,
                        'booking' => $booking
                    ];
                }
            }
        }

        // Pass the booked cars data to the view
        return view("agency_dashboard/bookedcars", ['bookedCars' => $bookedCars]);
    }
}
