<!doctype html>
<link rel="stylesheet" href="style.css">
<a href="index.php">Main</a>
<a href="message.php">Message</a>

<div class="container">
    <?php

    if (file_exists('input.json')) {
        $content = file_get_contents('input.json');
        $input = json_decode($content, true);

        if (is_array($input)) {

    ?>
            <table>
                <tr>
                    <th>Test Condition 1</th>
                    <th>Test Condition 2</th>
                    <th>Test Condition 3</th>
                    <th>Test Condition 4</th>
                    <th>Test Condition 5</th>
                </tr>
        <?php

            foreach ($input as $array) {
                echo "<tr>";

                echo "<td>";
                testCondition1($array);
                echo "</td>";

                echo "<td>";
                testCondition2($array);
                echo "</td>";

                echo "<td>";
                testCondition3($array);
                echo "</td>";

                echo "<td>";
                testCondition4($array);
                echo "</td>";

                echo "<td>";
                testCondition5($array);
                echo "</td>";

                echo "</tr>";
            }

            echo "</table>";
        }
    }


    function testCondition1($array) // Cik objektus satur masīvs?
    {
        $size = count($array);
        for ($i = 0; $i < $size; $i++) { // parastā for pārbaude, lai izietu cauri visiem array elementiem, jo $i < $size
            if ($size == $array[$i]) // ja array length sakrīt ar kādu no tajā esošajiem skaitļiem, tad to izvadīt 
            {
                echo $size;
                return;
            }
        }
        echo "False";
        // echo testCondition1($array); // Pēc ciklu izpildes jāizsauc funkcija, lai tā izpildītos
    }


    /* 2.uzd apraksts
    Divu skaitļu summa ir vienāda ar citu skaitli;
    $array = [1, -2, 5, 10, 3, 1, 90, -3];
    (1 + (-3) === (-2)) == TRUE
    return -2;
    */

    function testCondition2($array) // Lai divu skaitļu summa ir vienāda ar citu skaitli!
    {
        $count = count($array);
        for ($k = 0; $k < $count - 1; $k++) {
            for ($i = $k + 1; $i < $count; $i++) {
                $v1 = $array[$k];
                $v2 = $array[$i];
                $sum = $v1 + $v2;
                if (in_array($sum, $array)) {
                    echo $v1 . "+" . $v2 . " = " . $sum;
                    return;
                }
            }
        }

        echo "FALSE";
        //echo testCondition2($array);
    }

    /* 3.uzd
        Vai skaitļu pieauguma solis ir vienāds;
        [-3, 0, 3, 6, 9] == TRUE
        [-3, 1, 3, 6, 9] == FALSE
        [-3, 9, -6, 0, 9, 3] == TRUE
        [-2, 0, 2, 4, 6] == TRUE
    
        $array = [-3, 9, -6, 0, 9, 3];
        sort($array);
    
        $array === [-6, -3, 0, 3, 6, 9];
    }
    */
    function testCondition3($array) // Uzd: Pārbaudit vai masīvā skaitļu pieauguma solis ir vienāds
    {
        $count = count($array);
        sort($array); //Sarindo masīvu augošā secībā(skaitļiem)
        $last_diff = false;
        for ($i = 0; $i <= $count - 2; $i++) {
            $diff = $array[$i + 1] - $array[$i];
            if ($last_diff === false) {
                $last_diff = $diff;
            } elseif ($last_diff !== $diff) {
                echo "FALSE";
                return;
            }
        }

        echo $last_diff;
    }

    /* 4.uzd
    Vai trīs skaitļu summa ir vienāda ar skaitļu daudzumu
        $array = [1, 3, 4, 10, 3, 90, 2];
        $array[4] + $array[5] + $array[6] !== count($array);
        $array[0] + $array[1] + $array[4] === count($array);
        1 + 3 + 3 === 7;
        */
    function testCondition4($array)
    {
        $count = count($array);
        for ($i = 0; $i <= $count - 3; $i++) {
            $v1 = $array[$i];
            for ($k = $i + 1; $k <= $count - 2; $k++) {
                $v2 = $array[$k];
                for ($j = $k + 1; $j <= $count - 1; $j++) {
                    $v3 = $array[$j];
                    $sum = $v1 + $v2 + $v3;
                    if ($sum === $count) {
                        echo $v1 . "+" . $v2 . "+" . $v3 . " = " . $sum;
                        return;
                    }
                }
            }
        }
        echo "FALSE";
    }

    function testCondition5($array)
    {
        /* 5.uzd
        Vai skaitļus var sarindot fibonačī virknē?
            1, 1, 2, 3, 5, 8, 13, ...
            3, 8, 11, 
        */
        $count = count($array);
        $num_1 = 1; // Initialize variable, ar kuru sāk virkni
        $num_2 = 0;
        for ($r = 0; $r <= $count; $r++) {
            $array = $num_1 + $num_2; // Katru for izpildes reizi saskaita $num_1 & $num_2
            $num_1 = $num_2; // Pievieno pēdējo vērtību priekšpēdējai
            $num_2 = $array; // Pievieno rezultāta vērtību pēdējai
            // if ($array === $count) {
            echo $num_1 . "+" . $num_2 . " = " . $array;
            return;
            // }
        }
        echo "FALSE";
    }
        ?>
</div>