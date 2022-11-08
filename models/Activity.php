<?php

namespace UF1\Models;

use UF1\Enums\ActivityPaymentMethod;
use UF1\Enums\ActivityType;
use UF1\Config\Database;

class Activity
{
    private $db;

    public function __construct(
        public string $title,
        public string $date,
        public string $city,
        public ActivityType $type,
        public ActivityPaymentMethod $paymentMethod,
        public string $description,
    ) {
        $this->db = Database::Connect();
    }

    public function getActivities(): array
    {
        $activities = $this->db->query("SELECT * FROM activities ORDER BY id DESC");
        return $activities->fetch_all(MYSQLI_ASSOC);
    }

    public function save(): bool
    {
        $sql = "INSERT INTO activities VALUES(NULL, '{$this->title}', '{$this->date}', '{$this->city}', '{$this->type}', '{$this->paymentMethod}', '{$this->description}')";
        return $this->db->query($sql);
    }
}