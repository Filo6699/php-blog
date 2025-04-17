<?php
namespace App\Model;

class Post
{
    private int   $id;
    private string $title;
    private string $content;
    private string $author;

    public static function validate(string $title, string $description): array {
        $errors = [];
        $source = 'Post validation';

        if (strlen($title) < 2 || strlen($title) > 64) {
            $errors[] = [
                'source'  => $source,
                'message' => 'The title length should be from 2 to 64 characters!',
            ];
        }

        if (strlen($description) < 2 || strlen($description) > 1024) {
            $errors[] = [
                'source'  => $source,
                'message' => 'The description length should be from 2 to 1024 characters!',
            ];
        }

        return $errors;
    }

    public function __construct(int $id, string $title, string $content, string $author)
    {
        $this->id      = $id;
        $this->title   = $title;
        $this->content = $content;
        $this->author  = $author;
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

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function toArray(): array
    {
        return [
            'id'      => $this->id,
            'title'   => $this->title,
            'content' => $this->content,
            'author'  => $this->author,
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            title: $data['title'],
            content: $data['content'],
            author: $data['author'],
        );
    }
}
