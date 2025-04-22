<?php


if (isset($thisView) && $thisView->isset('post-list-intro')) {
    echo '<p>';
    echo $thisView->get('post-list-intro');
    echo '</p>' . PHP_EOL;
}
?>


<ul class="post-list">
    <?php

    if (isset($thisView) && $thisView instanceof \FFPerera\Cubo\View) {
        $posts = $thisView->get('posts');
    } else {
        $posts = [];
    }

    if (is_array($posts)) {
        $post = $posts;
    } else {
        $post = [];
    }

    foreach ($post as $item) {

        if ($item instanceof App\Pub\Post\Model\Post) {
            printf('<li>%s</li>', $item->getTitle());
        }
    }

    ?>
</ul>