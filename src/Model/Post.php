<?php
namespace App\Model;

class Post
{
    private int   $id;
    private string $title;
    private string $content;

    public function __construct(int $id, string $title, string $content)
    {
        $this->id      = $id;
        $this->title   = $title;
        $this->content = $content;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function toArray(): array
    {
        return [
            'id'      => $this->id,
            'title'   => $this->title,
            'content' => $this->content,
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self($data['id'], $data['title'], $data['content']);
    }
}
