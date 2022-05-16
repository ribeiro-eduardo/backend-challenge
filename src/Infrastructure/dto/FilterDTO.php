<?php

namespace App\Infrastructure\dto;

class FilterDTO 
{
    public string $storageMin;
    public string $storageMax;
    public string $ram;
    public string $hddType;
    public string $location;

    public function __construct($storageMin, $storageMax, $ram, $hddType, $location) {
        $this->storageMin = $storageMin;
        $this->storageMax = $storageMax;
        $this->ram = $ram;
        $this->hddType = $hddType;
        $this->location = $location;
    }
}