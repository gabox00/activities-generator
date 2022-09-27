<?php

namespace UF1\Models;

use UF1\Enums\ActivityPaymentMethod;
use UF1\Enums\ActivityType;

class Activity
{
    public function __construct(
        public string $title,
        public string $date,
        public string $city,
        public ActivityType $type,
        public ActivityPaymentMethod $paymentMethod,
        public string $description
    ) {}
}