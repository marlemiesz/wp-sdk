<?php

namespace Marlemiesz\WpSDK\Entities;

class Post implements EntityInterface
{

    private int    $id;
    private string $date;
    private string $slug;
    private string $status;
    private string $type;
    private string $link;
    private string $title;
    private string $content;
    private string $excerpt;
    private int    $author;
    private array  $categories;
   
    private function __construct(
        int    $id,
        string $date,
        string $slug,
        string $status,
        string $type,
        string $link,
        string $title,
        string $content,
        string $excerpt,
        int    $author,
        array  $categories
    ) {
        $this->id         = $id;
        $this->date       = $date;
        $this->slug       = $slug;
        $this->status     = $status;
        $this->type       = $type;
        $this->link       = $link;
        $this->title      = $title;
        $this->content    = $content;
        $this->excerpt    = $excerpt;
        $this->author     = $author;
        $this->categories = $categories;
    }
    public static function fromPrimitive(array $primitive): self
    {
        return new self(
            $primitive['id'],
            $primitive['date'],
            $primitive['slug'],
            $primitive['status'],
            $primitive['type'],
            $primitive['link'],
            $primitive['title']['rendered'],
            $primitive['content']['rendered'],
            $primitive['excerpt']['rendered'],
            $primitive['author'],
            $primitive['categories']
        );
    }
    
    public function toPrimitive(): array
    {
        return [
            'id' => $this->id,
            'date' => $this->date,
            'slug' => $this->slug,
            'status' => $this->status,
            'type' => $this->type,
            'link' => $this->link,
            'title' => $this->title,
            'content' => $this->content,
            'excerpt' => $this->excerpt,
            'author' => $this->author,
            'categories' => $this->categories
        ];
    }
    
    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
    
    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }
    
    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }
    
    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }
    
    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
    
    /**
     * @return string
     */
    public function getLink(): string
    {
        return $this->link;
    }
    
    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }
    
    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }
    
    /**
     * @return string
     */
    public function getExcerpt(): string
    {
        return $this->excerpt;
    }
    
    /**
     * @return int
     */
    public function getAuthor(): int
    {
        return $this->author;
    }
    
    /**
     * @return array
     */
    public function getCategories(): array
    {
        return $this->categories;
    }
    
    /**
     * @param string $date
     */
    public function setDate(string $date): void
    {
        $this->date = $date;
    }
    
    /**
     * @param string $slug
     */
    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }
    
    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }
    
    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
    
    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }
    
    /**
     * @param string $excerpt
     */
    public function setExcerpt(string $excerpt): void
    {
        $this->excerpt = $excerpt;
    }
    
    /**
     * @param int $author
     */
    public function setAuthor(int $author): void
    {
        $this->author = $author;
    }
    
    /**
     * @param array $categories
     */
    public function setCategories(array $categories): void
    {
        $this->categories = $categories;
    }
    
    
    
}
