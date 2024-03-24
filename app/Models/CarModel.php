<?php

namespace App\Models;

use CodeIgniter\Model;

class CarModel extends Model
{
    protected $table      = 'cars';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';

    protected $allowedFields = ['agency_id', 'vehicle_model', 'vehicle_number', 'seating_capacity', 'rent_per_day'];
}
