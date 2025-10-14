<?php

namespace LaravelShirtigo\Models;

class OrderProduct extends BaseModel
{
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductId(): ?int
    {
        return $this->product_id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function getDesign(): ?array
    {
        return $this->design;
    }

    public function getCustomization(): ?array
    {
        return $this->customization;
    }

    public function getTotalPrice(): ?float
    {
        return $this->quantity * $this->price;
    }
}