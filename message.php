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

    <?php
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
    print_r($_GET); // parāda ko satur masīvs $_GET(url joslas)
    foreach ($db->getAll() as $row) {
        echo "<p>";
        echo "<b>" . $row['id'] . "</b>";
        echo "username:" . text($row['username']);
        echo " email:" . text($row['email']);
        echo " <a href='?delete=" . $row['id'] . "'>delete</a>";
        echo " <a href='?update=" . $row['id'] . "'>update</a>";
        echo "</p>";
    }

    ?>
</div>