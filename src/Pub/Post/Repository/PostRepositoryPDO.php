<?php

declare(strict_types=1);

namespace App\Pub\Post\Repository;

use App\Pub\Post\Repository\IPostRepository;
use App\Pub\Post\Model\Post;

class PostRepositoryPDO implements IPostRepository
{
    // private ?\PDO $pdo;

    /**
     * @var array<int,mixed>
     */
    private $fakePostData = [
        1 => [
            'title' => 'Title 1',
            'content' => 'This is the content of post 1',
        ],
        2 => [
            'title' => 'Title 2',
            'content' => 'This is the content of post 2',
        ],
        3 => [
            'title' => 'Title 3',
            'content' => 'This is the content of post 3',
        ],
        4 => [
            'title' => 'Title 4',
            'content' => 'This is the content of post 4',
        ],
        5 => [
            'title' => 'Title 5',
            'content' => 'This is the content of post 5',
        ],
        6 => [
            'title' => 'Title 6',
            'content' => 'This is the content of post 6',
        ],
    ];

    public function __construct() {}

    /**
     * @param array <string,mixed> $options
     */
    public function init(array $options = []): void
    {
        // if (!isset($options['PDO'])) {
        //     throw new \InvalidArgumentException('PDO instance is required');
        // }
        // if (!($options['PDO'] instanceof \PDO)) {
        //     throw new \InvalidArgumentException('Invalid PDO instance');
        // }
        // $this->pdo = $options['PDO'];

    }

    public function getPosts(array $options = []): array
    {
        // Example query to fetch posts
        // $stmt = $this->pdo->query("SELECT * FROM posts");
        // return $stmt->fetchAll(\PDO::FETCH_CLASS, Post::class);

        $posts = [];

        foreach ($this->fakePostData as $id => $postData) {
            $post = new Post($postData['title'], $postData['content']);
            $posts[$id] = $post;
        }

        return $posts;
    }

    public function getPostById(int $id): ?Post
    {
        // Example query to fetch a single post by ID
        // $stmt = $this->pdo->prepare("SELECT * FROM posts WHERE id = :id");
        // $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        // $stmt->execute();
        // return $stmt->fetchObject(Post::class) ?: null;

        if (isset($this->fakePostData[$id])) {
            $postData = $this->fakePostData[$id];
            return new Post($postData['title'], $postData['content']);
        }
        return null;
    }
}
