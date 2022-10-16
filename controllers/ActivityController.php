<?php

namespace UF1\Controllers;

use UF1\Models\Activity;

class ActivityController
{
    public function create($title,$date,$city,$type,$paymentMethod,$description): Activity
    {
        return new Activity($title, $date, $city, $type, $paymentMethod, $description);
    }
}
