<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use App\Models\AgencyModel;
use App\Models\CarModel;
use App\Models\BookingModel;

class CustomerDashboardController extends BaseController
{
    public function index()
    {
    }

    public function rent()
    {
        $session = session();

        $car_id = $this->request->getVar("car_id");
        $customer_id = $session->customer_id;
        $start_date = $this->request->getVar("start_date");
        $days = $this->request->getVar("days");

        $rdata = [
            "car_id" => $car_id,
            "customer_id" => $customer_id,
            "start_date" => $start_date,
            "days" => $days,
        ];

        $model = new BookingModel();
        $model->insert($rdata);
        return redirect()->to(base_url());
    }
}
