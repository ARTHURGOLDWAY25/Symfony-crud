<?php

namespace App\Entity;

use App\Repository\StockManagementRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StockManagementRepository::class)]
class StockManagement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $ProductDescription = null;

    #[ORM\Column]
    private ?int $AvailableQuantity = null;

    #[ORM\Column]
    private ?float $PricePerItem = null;

    #[ORM\Column(length: 255)]
    private ?string $ProductCategory = null;

    #[ORM\Column(length: 255)]
    private ?string $Supplier = null;

    #[ORM\Column(length: 255)]
    private ?string $sku = null;

    #[ORM\Column(length: 255)]
    private ?string $location = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $CreationDate = null;

    #[ORM\Column]
    private ?int $MinimumStock = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $LastPurchased = null;

    #[ORM\Column]
    private ?float $TotalValue = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getProductDescription(): ?string
    {
        return $this->ProductDescription;
    }

    public function setProductDescription(string $ProductDescription): static
    {
        $this->ProductDescription = $ProductDescription;

        return $this;
    }

    public function getAvailableQuantity(): ?int
    {
        return $this->AvailableQuantity;
    }

    public function setAvailableQuantity(int $AvailableQuantity): static
    {
        $this->AvailableQuantity = $AvailableQuantity;

        return $this;
    }

    public function getPricePerItem(): ?float
    {
        return $this->PricePerItem;
    }

    public function setPricePerItem(float $PricePerItem): static
    {
        $this->PricePerItem = $PricePerItem;

        return $this;
    }

    public function getProductCategory(): ?string
    {
        return $this->ProductCategory;
    }

    public function setProductCategory(string $ProductCategory): static
    {
        $this->ProductCategory = $ProductCategory;

        return $this;
    }

    public function getSupplier(): ?string
    {
        return $this->Supplier;
    }

    public function setSupplier(string $Supplier): static
    {
        $this->Supplier = $Supplier;

        return $this;
    }

    public function getSku(): ?string
    {
        return $this->sku;
    }

    public function setSku(string $sku): static
    {
        $this->sku = $sku;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): static
    {
        $this->location = $location;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->CreationDate;
    }

    public function setCreationDate(\DateTimeInterface $CreationDate): static
    {
        $this->CreationDate = $CreationDate;

        return $this;
    }

    public function getMinimumStock(): ?int
    {
        return $this->MinimumStock;
    }

    public function setMinimumStock(int $MinimumStock): static
    {
        $this->MinimumStock = $MinimumStock;

        return $this;
    }

    public function getLastPurchased(): ?\DateTimeInterface
    {
        return $this->LastPurchased;
    }

    public function setLastPurchased(\DateTimeInterface $LastPurchased): static
    {
        $this->LastPurchased = $LastPurchased;

        return $this;
    }

    public function getTotalValue(): ?float
    {
        return $this->TotalValue;
    }

    public function setTotalValue(float $TotalValue): static
    {
        $this->TotalValue = $TotalValue;

        return $this;
    }
}
