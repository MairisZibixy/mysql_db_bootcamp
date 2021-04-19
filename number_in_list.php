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
            foreach ($input as $array) {
                testCondition1($array);
                testCondition2($array);
                testCondition3($array);

                echo "<br>";
            }
        }
    }

    function testCondition1($array)
    {
        $array = [1, 3, 5, 10, 3, 90, 7];
        $size = count($array);
        for ($i = 0; $i < $size; $i++) { // parastā for pārbaude, lai izietu cauri visiem array elementiem, jo $i < $size
            if ($size == $array[$i]) // ja array length sakrīt ar kādu no tajā esošajiem skaitļiem, tad to izvadīt 
            {
                echo $size;
                return;
            }
        }
        echo "Condition isn't met";
    }
    echo testCondition1($array); // Pēc ciklu izpildes jāizsauc funkcija, lai tā izpildītos


    function testCondition2($array) // Divu skaitļu summa ir vienāda ar citu skaitli;
    {
        $array = [1, 3, 7, 10, 3, 1, 90, 2];
        $size = count($array);
        /*
         * $sum = $array[$i] + $array[$k];
         * if (in_array($sum, $array)) {
         *      return 'second condition is true';
         * }
         *  1 + 3 = 4; === false
         *  1 + 7 = 8; === false
         *  1 + 10 = 11; === false
         *  ...
         *  7 + 10 = 17;
         *  7 + 3 = 10;
         * 
         *  $array[0] + $array[1] = 4;
         *  $array[0] + $array[2] = 7;
         *  $array[0] + $array[3] = 11;
         * 
         *  $array[2] + $array[3] = 17;
         *  $array[2] + $array[4] = 10
         */

        for ($i = 0; $i < $size - 1; $i++) { // parastā for pārbaude, lai izietu cauri visiem masīva elementiem, jo $i < $size
            for ($k = $i + 1; $k < $size; $k++) {
                $sum = $array[$i] + $array[$k];
                if (in_array($sum, $array)) { // jāveic pārbaude vai divu skaitļu summa sakrīt ar citu skaitli masīvā
                    echo $sum;
                    return;
                }
            }
        }
        echo "Condition isn't met";
        echo testCondition2($array);
    }


    function testCondition3($array)
    {
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

        /* 4.uzd
    Vai trīs skaitļu summa ir vienāda ar skaitļu daudzmu
        $array = [1, 3, 4, 10, 3, 90, 2];
        $array[0] + $array[1] + $array[4] === count($array);
        1 + 3 + 3 === 7;
        */
    }
    ?>
</div>