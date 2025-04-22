<?php
$username = '';
$password = '';



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


<div class="register-form">
    <form action="/register/" method="post">

        <?php echo $errorMsg; ?>
        <?php echo $successMsg; ?>
        <h2>User registration</h2>

        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" <?php echo $username; ?> name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="form-group">
            <button class="btn btn-primary" type="submit">Register</button>
        </div>
        <div class="form-group">
            <a href="/login/">Already have an account? Login here</a>
        </div>
    </form>
</div>