<?php
$username = '';
$password = '';

/**
 * @var \FFPerera\Cubo\Render $this
 */

if (isset($thisView) && $thisView->isset('username')) {
    $username = 'value="' . $thisView->get('username') . '"';
}

$errorMsg = '';
if (isset($thisView) && $thisView->isset('error-msg')) {
    $errorMsg =  '<div class="error-msg">';
    $errorMsg .=  $thisView->get('error-msg');
    $errorMsg .= '</div>' . PHP_EOL;
}

$successMsg = '';
if (isset($thisView) && $thisView->isset('success-msg')) {
    $successMsg =  '<div class="success-msg">';
    $successMsg .=  $thisView->get('success-msg');
    $successMsg .= '</div>' . PHP_EOL;
}

?>

<div class="login-form">
    <form action="/login/" method="post">
        <?php echo $errorMsg; ?>
        <?php echo $successMsg; ?>

        <h2>User Login</h2>
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" <?php echo $username; ?> name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="form-group">
            <button class="btn btn-primary" type="submit">Login</button>
        </div>
    </form>
</div>