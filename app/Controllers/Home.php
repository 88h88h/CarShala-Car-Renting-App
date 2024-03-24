<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use App\Models\AgencyModel;
use App\Models\CarModel;
use App\Models\BookingModel;

class Home extends BaseController
{
    public function index(): string
    {
        return view('home');
    }

    public function registercustomer()
    {

        $data = [];
        if ($this->request->is('post')) {

            $rules = [
                "full_name" => [
                    "label" => "Name",
                    "rules" => "required",
                ],
                "email" => [
                    "label" => "Email",
                    "rules" => "required|valid_email",
                ],
                "phone_number" => [
                    "label" => "Contact No.",
                    "rules" => "required",
                ],
                "password" => [
                    "label" => "Password",
                    "rules" => "required|min_length[8]|max_length[20]",
                ],
                "cpassword" => [
                    "label" => "Confirm Password",
                    "rules" => "matches[password]",
                ],
            ];
            if ($this->validate($rules)) {
                // Submit the form
                $full_name = $this->request->getVar("full_name");
                $email = $this->request->getVar("email");
                $address = $this->request->getVar("address");
                $phone_number = $this->request->getVar("phone_number");
                $password = $this->request->getVar("password");

                $rdata = [
                    "full_name" => $full_name,
                    "email" => $email,
                    "address" => $address,
                    "phone_number" => $phone_number,
                    "password" => $password,
                ];

                $model = new CustomerModel();
                $model->insert($rdata);

                $session = session();
                $session->set("success_message", "Customer registered successfully");
                $session->markAsFlashdata("success_message");
                return view("registercustomer");
            } else {
                $data['validation'] = $this->validator;
                return view('registercustomer', $data);
            }
        } else if ($this->request->is('get')) {
            // Display the view
            return view('registercustomer');
        }
    }

    public function registeragency()
    {
        $data = [];
        if ($this->request->is('post')) {
            $rules = [
                "company_name" => [
                    "label" => "Agency Name",
                    "rules" => "required",
                ],
                "email" => [
                    "label" => "Email",
                    "rules" => "required|valid_email",
                ],
                "phone_number" => [
                    "label" => "Contact No.",
                    "rules" => "required",
                ],
                "password" => [
                    "label" => "Password",
                    "rules" => "required|min_length[8]|max_length[20]"
                ],
                "cpassword" => [
                    "label" => "Confirm Password",
                    "rules" => "matches[password]",
                ],
            ];
            if ($this->validate($rules)) {
                // Submit the form
                $company_name = $this->request->getVar("company_name");
                $contact_person = $this->request->getVar("contact_person");
                $email = $this->request->getVar("email");
                $address = $this->request->getVar("address");
                $phone_number = $this->request->getVar("phone_number");
                $password = $this->request->getVar("password");

                $rdata = [
                    "company_name" => $company_name,
                    "contact_person" => $contact_person,
                    "email" => $email,
                    "address" => $address,
                    "phone_number" => $phone_number,
                    "password" => $password,
                ];

                $model = new AgencyModel();
                $model->insert($rdata);

                $session = session();
                $session->set("success_message", "Agency registered successfully");
                $session->markAsFlashdata("success_message");
                return view("registercustomer");
            } else {
                $data['validation'] = $this->validator;
                return view('registeragency', $data);
            }
        } else if ($this->request->is('get')) {
            // Display the view
            return view('registeragency');
        }
    }

    public function login()
    {
        if ($this->request->is('post')) {
            $data = [];
            $rules = [

                "email" => [
                    "label" => "Email",
                    "rules" => "required|valid_email",
                ],

                "password" => [
                    "label" => "Password",
                    "rules" => "required"
                ],

            ];
            if ($this->validate($rules)) {
                if ($this->request->getVar("role") == "Customer") {
                    $model = new CustomerModel();
                    $record = $model->where("email", $this->request->getVar("email"))
                        ->where("password", $this->request->getVar("password"))
                        ->first();
                    $session = session();
                    if (!is_null($record)) {
                        // Data validated
                        $sess_data = [
                            "name" => $record["full_name"],
                            "email" => $record["email"],
                            "customer_id" => $record["id"],
                            "role" => "customer",
                            "loggedin" => "yes",

                        ];


                        $session->set($sess_data);

                        // Go to customer dashboard
                        $url = "customer_dashboard";
                        return redirect()->to(base_url(""));
                    } else {

                        $session->set("failed_message", "Incorrect Email or Password");
                        $session->markAsFlashdata("failed_message");
                        return view('login');
                    }
                } else if ($this->request->getVar("role") == "Agency") {
                    $model = new AgencyModel();
                    $record = $model->where("email", $this->request->getVar("email"))
                        ->where("password", $this->request->getVar("password"))
                        ->first();
                    $session = session();
                    if (!is_null($record)) {
                        // Data validated
                        $sess_data = [
                            "name" => $record["company_name"],
                            "email" => $record["email"],
                            "agency_id" => $record["id"],
                            "role" => "agency",
                            "loggedin" => "yes",

                        ];

                        $session->set($sess_data);

                        // Go to agency dashboard

                        return redirect()->to(base_url());
                    } else {

                        $session->set("failed_message", "Incorrect Email or Password");
                        $session->markAsFlashdata("failed_message");
                        return view('login');
                    }
                }
            } else {
                $data['validation'] = $this->validator;
                return view('login', $data);
            }
        } else if ($this->request->is('get')) {
            return view('login');
        }
    }

    public function logout()
    {
        $session = session();
        session_unset();
        session_destroy();
        return redirect()->to(base_url());
    }



    public function dashboard()
    {
        $session = session();
        if ($session->role == "agency") {
            return view("agency_dashboard/dashboard");
        }
        // Load the CarModel
        $carModel = new CarModel();
        $bookingModel = new BookingModel();

        // Retrieve all cars from the database
        $session = session();
        $cars = $carModel->findAll();
        $bookings = $bookingModel->where('customer_id', $session->customer_id)->findAll();

        // Pass the car data to the view
        return view("availablecar", ['cars' => $cars, 'bookings' => $bookings]);
    }

    public function cars()
    {

        // Load the CarModel
        $carModel = new CarModel();
        $bookingModel = new BookingModel();

        // Retrieve all cars from the database
        $session = session();
        $cars = $carModel->findAll();
        $bookings = $bookingModel->where('customer_id', $session->customer_id)->findAll();

        // Pass the car data to the view
        return view("availablecar", ['cars' => $cars, 'bookings' => $bookings]);
    }
}
