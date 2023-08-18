<?php

namespace App\Entity;

use App\Doctrine\ManufacturerListener;
use App\Repository\ManufacturerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ManufacturerRepository::class)]
#[ORM\EntityListeners(
    [
        ManufacturerListener::class
    ]
)]
class Manufacturer
{
    #[ORM\Id]
//    #[ORM\GeneratedValue]
    #[ORM\Column]
    public ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $brandName = null;

    private ?string $tempData = null;

    #[ORM\OneToMany(mappedBy: 'manufacturer', targetEntity: VehicleModel::class, fetch: 'EXTRA_LAZY', orphanRemoval: true)]
    private Collection $vehicleModels;

    public function __construct()
    {
        $this->vehicleModels = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBrandName(): ?string
    {
        return $this->brandName;
    }

    public function setBrandName(string $brandName): static
    {
        $this->brandName = $brandName;

        return $this;
    }

    /**
     * @return Collection<int, VehicleModel>
     */
    public function getVehicleModels(): Collection
    {
        return $this->vehicleModels;
    }

    public function addVehicleModel(VehicleModel $vehicleModel): static
    {
        if (!$this->vehicleModels->contains($vehicleModel)) {
            $this->vehicleModels->add($vehicleModel);
            $vehicleModel->setManufacturer($this);
        }

        return $this;
    }

    public function removeVehicleModel(VehicleModel $vehicleModel): static
    {
        if ($this->vehicleModels->removeElement($vehicleModel)) {
            // set the owning side to null (unless already changed)
            if ($vehicleModel->getManufacturer() === $this) {
                $vehicleModel->setManufacturer(null);
            }
        }

        return $this;
    }

    public function getTempData(): ?string
    {
        return $this->tempData;
    }

    public function setTempData(?string $tempData): static
    {
        $this->tempData = $tempData;

        return $this;
    }
}
