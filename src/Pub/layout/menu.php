<ul class="navegacion">
    <?php

    if (isset($thisView) && $thisView instanceof \FFPerera\Cubo\View) {
        $menu = $thisView->get('menu');
    } else {
        $menu = [];
    }

    foreach ($menu as $item) {
        printf('<li><a href="%s">%s</a></li>', $item['url'], $item['label']);
    }

    ?>
</ul>