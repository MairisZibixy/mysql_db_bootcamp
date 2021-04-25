<?php // Izvada php errorus mājaslapā
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<!doctype html>
<link rel="stylesheet" href="style.css">
<a href="index.php">Main</a>
<a href="number_in_list.php">Number in list</a>

<div class="container-message">
    <form action="">
        <?php
        include 'DB.php'; // izsaucās fails no kura tiek iegūtas funkcijas
        $db = new DB('localhost', 'root', 'root', 'mysql_db'); // izveidojam objektu no klases 'new DB'
        $db->fetchAll('messages'); // Kopēts no index.php, nezinu vai šeit vajadzīgs
        //fetchAll satur visas vērtības un tās ieraksta mainīgajā

        if (array_key_exists('update', $_GET)) {
            // Pārbaude - ja adrešu joslā ir update, tad formā pievienojam 'h3' un 'input' laukus
            $id = $_GET['update'];
            $user = $db->find($id); // Lai iegūtu vērtību izmantojam 'find'
            if ($user !== []) {
                echo "<h3><a href='/'>&lt;-</a> Atjauninam ierakstu ar id $id</h3>";
                echo "<input type='hidden' name='update-id' value='$id'>";
            }
        } else {
            $user = [];
        }
        ?>

        <label for="email">Email: </label>
        <input type="email" name="email" id="email" value="<?= text(@$user['email']); ?>">
        <!-- value: formā tiek ievietota user vērtība ar atslēgu email. 
        'text' funkcija pārbauda vai netiek ievietoti neatļauti html tagi -->


        <label for="phone">Phone: </label>
        <input type="tel" name="phone" id="phone" value="<?= text(@$user['phone']); ?>">

        <label for="description">Description: </label>
        <textarea name="description" id="description" value="<?= text(@$user['description']); ?>"></textarea>

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
        if (
            array_key_exists('update-id', $_GET) &&
            is_numeric($_GET['update-id'])
        ) {
            $db->update( // update funkcijas izsaukšana
                'messages',
                [
                    'id' => $_GET['update-id'],
                    'email' => $_GET['email'],
                    'phone' => $_GET['phone'],
                    'description' => $_GET['description']
                ]
            );
        } else {
            $db->add( // add funkcijas izsaukšana
                'messages',
                [
                    'email' => $_GET['email'],
                    'phone' => $_GET['phone'],
                    'description' => $_GET['description']
                ]
            );
        }
    }
    print_r($_GET); // Mājaslapā izvada to ko satur masīvs $_GET(url joslas)

    if (array_key_exists('delete', $_GET)) { // sadaļā kurā izdzēšam ierakstus
        $id = (int) $_GET['delete'];
        $db->delete('messages', $id); // tiek izsaukta DB delete funckija
    }

    // Sadaļa kurā izvadās visi ieraksti izmantojot getAll funkciju
    foreach ($db->getAll() as $row) {
        echo "<p>";
        echo "<b>" . $row['id'] . "</b>";
        echo " email: " . text($row['email']);
        echo " phone: " . text($row['phone']);
        echo " description: " . text($row['description']);
        echo " <a href='?delete=" . $row['id'] . "'>delete</a>";
        echo " <a href='?update=" . $row['id'] . "'>update</a>";
        echo "</p>";
    }

    // Tiek definēta funkcija 'text', kura neatļauj mājaslapas lietotājam ievadīt html tagus
    function text($string)
    {
        return htmlentities($string);
    }
    ?>
</div>