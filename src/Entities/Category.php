<?php

namespace Marlemiesz\WpSDK\Entities;
class Category implements EntityInterface
{
    private int    $id;
    private string $name;
    private string $slug;
    private int    $parent;
    private string $description;
    private string $link;
    private function __construct(
        int    $id,
        string $name,
        string $slug,
        int    $parent,
        string $description,
        string $link
    ) {
        $this->id          = $id;
        $this->name        = $name;
        $this->slug        = $slug;
        $this->parent      = $parent;
        $this->description = $description;
        $this->link        = $link;
    }
    public static function fromPrimitive(array $primitive): self
    {
        return new self(
            $primitive['id'],
            $primitive['name'],
            $primitive['slug'],
            $primitive['parent'],
            $primitive['description'],
            $primitive['link']
        );
    }
    
    public function toPrimitive(): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'slug'        => $this->slug,
            'parent'      => $this->parent,
            'description' => $this->description,
            'link'        => $this->link,
        ];
    }
    
    public function getId(): int
    {
        return $this->id;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getSlug(): string
    {
        return $this->slug;
    }
    public function getParent(): int
    {
        return $this->parent;
    }
    public function getDescription(): string
    {
        return $this->description;
    }
    public function getLink(): string
    {
        return $this->link;
    }
    
    //Please prepare setters
    public function setName(string $name): void
    {
        $this->name = $name;
    }
    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }
    public function setParent(int $parent): void
    {
        $this->parent = $parent;
    }
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
    public function setLink(string $link): void
    {
        $this->link = $link;
    }
    
    
    
}
