<link rel="stylesheet" href="style.css">

<div class="container">
    <form action="">
        <label for="email">Epasts</label>
        <input id="email" type="email" name="email">
        <label for="username">Lietotājvārds</label>
        <input id="username" type="text" name="username">

        <button type="submit">submit</button>
    </form>

    <?php

    include 'DB.php';
    $db = new DB('localhost', 'root', 'root', 'mysql_db');

    if (
        array_key_exists('username', $_GET) &&
        array_key_exists('email', $_GET) &&
        is_string($_GET['username']) &&
        is_string($_GET['email'])
    ) {
        $db->add(
            'users',
            [
                'username' => @$_GET['username'],
                'email' => @$_GET['email']
            ]
        );
    }

    foreach ($db->getAll('users') as $row) {
        echo "<p><b>" . $row['id'] . "</b> username:" . text($row['username']) . ", email:" . text($row['email']) .  "</p>";
    }

    function text($string)
    {
        return htmlentities($string);
    }

    ?>

</div>