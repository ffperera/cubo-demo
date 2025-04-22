<?php

use FFPerera\Cubo\View;

$errorMsg = '';
$successMsg = '';
$saludo = '';


if (isset($thisView) && $thisView instanceof View) {

    if ($thisView->isset('error-msg')) {
        $errorMsg =  '<div class="error-msg">';
        $errorMsg .=  $thisView->get('error-msg');
        $errorMsg .= '</div>' . PHP_EOL;
    }

    if ($thisView->isset('success-msg')) {
        $successMsg =  '<div class="success-msg">';
        $successMsg .=  $thisView->get('success-msg');
        $successMsg .= '</div>' . PHP_EOL;
    }

    if ($thisView->isset('saludo')) {
        $saludo = sprintf('<p style="color: brown;"><b>%s</b></p>', $thisView->get('saludo'));
    }
}

?>

<?php echo $errorMsg; ?>
<?php echo $successMsg; ?>


<h2>Welcome</h2>
<p>Welcome to the home page!</p>
<p>This is the main content of the home page.</p>

<?php echo $saludo; ?>

<h2>List of Posts</h2>
<?php
if (isset($this)) {
    $this->block('post_list');
}
?>