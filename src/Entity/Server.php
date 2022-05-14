<?php

namespace App\Entity;

use App\Repository\ServerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServerRepository::class)]
class Server
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $model;

    #[ORM\Column(type: 'string', length: 255)]
    private $ram;

    #[ORM\Column(type: 'string', length: 255)]
    private $hdd;

    #[ORM\Column(type: 'string', length: 255)]
    private $location;

    #[ORM\Column(type: 'string', length: 255)]
    private $price;

    #[ORM\Column(type: 'string', length: 5, nullable: true)]
    private $currency;

    #[ORM\Column(type: 'integer')]
    private $disks_qty;

    #[ORM\Column(type: 'integer')]
    private $disk_capacity;

    #[ORM\Column(type: 'string', length: 5)]
    private $capacity_unity;

    #[ORM\Column(type: 'string', length: 20)]
    private $disk_type;

    #[ORM\Column(type: 'integer')]
    private $memoryQty;

    #[ORM\Column(type: 'string', length: 10)]
    private $memoryClass;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getRam(): ?string
    {
        return $this->ram;
    }

    public function setRam(string $ram): self
    {
        $this->ram = $ram;

        return $this;
    }

    public function getHdd(): ?string
    {
        return $this->hdd;
    }

    public function setHdd(string $hdd): self
    {
        $this->hdd = $hdd;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(?string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    public function getDisksQty(): ?int
    {
        return $this->disks_qty;
    }

    public function setDisksQty(int $disks_qty): self
    {
        $this->disks_qty = $disks_qty;

        return $this;
    }

    public function getDiskCapacity(): ?int
    {
        return $this->disk_capacity;
    }

    public function setDiskCapacity(int $disk_capacity): self
    {
        $this->disk_capacity = $disk_capacity;

        return $this;
    }

    public function getCapacityUnity(): ?string
    {
        return $this->capacity_unity;
    }

    public function setCapacityUnity(string $capacity_unity): self
    {
        $this->capacity_unity = $capacity_unity;

        return $this;
    }

    public function getDiskType(): ?string
    {
        return $this->disk_type;
    }

    public function setDiskType(string $disk_type): self
    {
        $this->disk_type = $disk_type;

        return $this;
    }

    public function getMemoryQty(): ?int
    {
        return $this->memoryQty;
    }

    public function setMemoryQty(int $memoryQty): self
    {
        $this->memoryQty = $memoryQty;

        return $this;
    }

    public function getMemoryClass(): ?string
    {
        return $this->memoryClass;
    }

    public function setMemoryClass(string $memoryClass): self
    {
        $this->memoryClass = $memoryClass;

        return $this;
    }
}
