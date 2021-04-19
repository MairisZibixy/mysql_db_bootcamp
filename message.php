<!doctype html>
<link rel="stylesheet" href="style.css">
<a href="index.php">Main</a>
<a href="number_in_list.php">Number in list</a>

<div class="container message">
    <form action="">
        <?php
        include 'DB.php';
        $db = new DB('localhost', 'root', 'root', 'mysql_db');
        ?>

        <label for="email">Email: </label>
        <input type="text" name="email" id="email">

        <label for="phone">Phone: </label>
        <input type="text" name="phone" id="phone">

        <label for="description">Description: </label>
        <textarea name="description" id="description"></textarea>

        <button type="submit">Submit</button>
    </form>
</div>

<?php
print_r($_GET);
if (
    array_key_exists('email', $_GET) &&
    array_key_exists('phone', $_GET) &&
    array_key_exists('description', $_GET) &&
    is_string($_GET['email']) &&
    is_string($_GET['phone']) &&
    is_string($_GET['description'])
) {
    $db->add(
        'messages',
        [
            'email' => $_GET['email'],
            'phone' => $_GET['phone'],
            'description' => $_GET['description']
        ]
    );
}
?>