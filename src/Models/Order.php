<?php

namespace LaravelShirtigo\Models;

use Illuminate\Support\Collection;

class Order extends BaseModel
{
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function getTotalPrice(): ?float
    {
        return $this->total_price;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function getCreatedAt(): ?string
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->updated_at;
    }

    public function getCustomer(): ?array
    {
        return $this->customer;
    }

    public function getDeliveryAddress(): ?array
    {
        return $this->delivery_address;
    }

    public function getProducts(): Collection
    {
        $products = $this->products ?? [];
        return collect($products)->map(fn($product) => new OrderProduct($product));
    }

    public function getComments(): Collection
    {
        $comments = $this->comments ?? [];
        return collect($comments)->map(fn($comment) => new OrderComment($comment));
    }

    public function isPaid(): bool
    {
        return $this->payment_status === 'paid';
    }

    public function isShipped(): bool
    {
        return $this->shipping_status === 'shipped';
    }

    public function isDelivered(): bool
    {
        return $this->shipping_status === 'delivered';
    }

    public function isCancelled(): bool
    {
        return $this->status === 'cancelled';
    }

    public static function fromArray(array $data): static
    {
        return new static($data);
    }

    public static function fromCollection(Collection $collection): Collection
    {
        return $collection->map(fn($item) => static::fromArray($item));
    }
}