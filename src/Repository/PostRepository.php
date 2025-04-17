<?php
namespace App\Repository;

use App\Model\Post;

class PostRepository
{
    private string $file;

    public function __construct(string $dataFile)
    {
        $this->file = $dataFile;
    }

    /**
     * @return Post[]
     */
    public function getAll(): array
    {
        $raw = file_get_contents($this->file);
        $arr = json_decode($raw, true, 512, JSON_THROW_ON_ERROR);
        return array_map(Post::fromArray(...), $arr);
    }

    public function add(Post $post): void
    {
        $all = $this->getAll();
        $all[] = $post;
        file_put_contents(
            $this->file,
            json_encode(
                array_map(fn(Post $p): array => $p->toArray(), $all),
                JSON_PRETTY_PRINT|JSON_THROW_ON_ERROR
            )
        );
    }
}
