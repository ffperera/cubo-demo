<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php
            if (isset($thisView)) {
                echo $thisView->get('metatitle');
            } ?></title>
    <meta name="description" content="<?php
                                        if (isset($thisView)) {
                                            echo $thisView->get('metadesc');
                                        } ?>" />
    <link rel="canonical" href="<?php
                                if (isset($thisView)) {
                                    echo $thisView->get('canonical');
                                } ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=3.0, user-scalable=yes" />
    <link rel="stylesheet" href="/assets/pub/css/style.css">

</head>

<body>

    <div class="container">

        <header>
            <?php
            if (isset($this)) {
                $this->block('menu');
            }
            ?>
        </header>

        <h1><?php
            if (isset($thisView)) {
                echo $thisView->get('title');
            } ?></h1>


        <?php
        if (isset($this)) {
            $this->block('main');
        }
        ?>

        <footer class="row">

            <p>This is the footer</p>

        </footer>


    </div>

</body>

</html>