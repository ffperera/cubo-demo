<?php

use FFPerera\Cubo\View;


// the about page could be only HTML content, no code needed
// I left the code here to show how to use the view object
// to get the error and success messages

$errorMsg = '';
$successMsg = '';


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
}

?>

<?php echo $errorMsg; ?>
<?php echo $successMsg; ?>

<p>Cubo is a lightweight PHP framework designed for building web applications with simplicity and flexibility.</p>
<p>It provides a minimalist but solid foundation for the development process, with zero hidden magic features, and avoiding overengineered techniques, while ensuring a clean and modular architecture.</p>


<h2>Features</h2>
<ul>
    <li><strong>Lightweight and Fast</strong>: Minimal overhead for optimal performance.</li>
    <li><strong>Modular Design</strong>: Easily extendable and customizable.</li>
    <li><strong>Queue of Actions</strong>: Queue-based workflow where requests are processed through sequential actions (<em>controller-like</em> components).</li>
    <li><strong>PSR-4 Autoloading</strong>: Follows modern PHP standards for autoloading.</li>
    <li><strong>View Rendering</strong>: Built-in support for rendering views and layouts.</li>
    <li><strong>HTTP Response Handling</strong>: Simplifies response management.</li>
</ul>

<h2>Installation</h2>
<pre>composer install ffperera/cubo</pre>

<h2>More Information</h2>
<p>For more information about Cubo, please visit the <a href="https://github.com/ffperera/cubo">GitHub repository</a>.</p>