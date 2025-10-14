<?php

namespace LaravelShirtigo\Models;

class OrderComment extends BaseModel
{
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function getCreatedAt(): ?string
    {
        return $this->created_at;
    }

    public function isInternal(): bool
    {
        return $this->is_internal ?? false;
    }
}