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

    foreach ($db->getAll('users') as $row) {
        echo "<p> username:" . $row['username'] . ", email:" . $row['email'] . "</p>";
    }

    echo $db->add(
        'users',
        [
            'username' => 'zibixy',
            'email' => 'zibixy@example.com'
        ]
    );

    ?>

</div>