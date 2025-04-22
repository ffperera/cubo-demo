<?php

declare(strict_types=1);

namespace App\Pub\Post\Repository;

use App\Pub\Post\Model\Post;

interface IPostRepository
{
    /**
     * @param array <string,mixed> $options
     */
    public function init(array $options = []): void;


    /**
     * @param array <string,mixed> $options
     * @return array <int,Post> 
     */
    public function getPosts(array $options = []): array;

    public function getPostById(int $id): ?Post;
}
