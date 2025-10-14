<?php

namespace LaravelShirtigo\Models;

use Illuminate\Support\Collection;
use JsonSerializable;

abstract class BaseModel implements JsonSerializable
{
    protected array $attributes = [];

    public function __construct(array $attributes = [])
    {
        $this->attributes = $attributes;
    }

    public function __get(string $key)
    {
        return $this->attributes[$key] ?? null;
    }

    public function __set(string $key, $value): void
    {
        $this->attributes[$key] = $value;
    }

    public function __isset(string $key): bool
    {
        return isset($this->attributes[$key]);
    }

    public function toArray(): array
    {
        return $this->attributes;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    public function toJson(int $options = 0): string
    {
        return json_encode($this->toArray(), $options);
    }

    protected static function fromArray(array $data): static
    {
        return new static($data);
    }

    protected static function fromCollection(Collection $collection): Collection
    {
        return $collection->map(fn($item) => static::fromArray($item));
    }
}