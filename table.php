<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User table</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>
</head>
<!-- Duotas masyvas su žmonių vardais, amžiumi ir profesijomis. Reikia susikurti naują puslapį jau esamame mūsų serveryje ir atlikti šias užduotis:

1. Sukurti lentelę, kuri atvaizduoja žmonių informaciją pagal pavyzdį. Kaip ID stulpelį galime panaudoti einamojo masyvo elemento indeksą.

2. Pagal paskaitos medžiagą, sukurti formą, kuri leistų pridėti naujus žmones.

3. Patobulinti lentelės atvaizdavimą taip, kad būtų rodomi tik žmonės, kurių amžius yra virš 30 metų.

4. Pridėti formą, kurioje bus vienas laukas “Amžius nuo”, kurią išsiuntus, lentelėje būtų rodomi žmonės nuo įvesto amžiaus. 
Atkreipkite dėmesį, kad po formos išsiuntimo, paskutinio įvesto amžiaus reikšmė lieka įvedimo lauke.

5. BONUS: Pridėti mygtuką “Ištrinti” prie kiekvieno studento. -->
<body>
    <?php

        $person1 = array(
            "vardas" => "Tadas",
            "amžius" => "23",
            "profesija" => "Studentas",
        );
        $person2 = array(
            "vardas" => "Jonas",
            "amžius" => "33",
            "profesija" => "Mechanikas",
        );
        $person3 = array(
            "vardas" => "Gabija",
            "amžius" => "27",
            "profesija" => "Buhalterė",
        );
        $person4 = array(
            "vardas" => "Tomas",
            "amžius" => "48",
            "profesija" => "Santechnikas",
        );
        $person5 = array(
            "vardas" => "Petras",
            "amžius" => "37",
            "profesija" => "Vadybininkas",
        );
        $person6 = array(
            "vardas" => "Ieva",
            "amžius" => "21",
            "profesija" => "Studentė",
        );
        $person7 = array(
            "vardas" => "Kęstutis",
            "amžius" => "30",
            "profesija" => "Programuotojas",
        );

        if(!isset($_COOKIE['list'])) {
            $list = [$person1, $person2, $person3, $person4, $person5, $person6, $person7];
            $list = json_encode($list, true);
            setcookie("list", $list, time() + (86400*30), "table.php");
            header("Location: table.php");
        }
    ?>
<div class="container">
<h1 class="text-center mb-5">Table in PHP</h1>
    <div class="row">
        <div class="col">
                <div class="form mt-3">
            <form method="POST" action="table.php">
                <div class="mb-3">
                    <label class="form-label">Vardas</label>
                    <input class="form-control" name="vardas"/>
                </div>
                <div class="mb-3">
                    <label class="form-label">Amžius</label>
                    <input class="form-control" name="amzius"/>
                </div>
                <div class="mb-3">
                    <label class="form-label">Profesija</label>
                    <input class="form-control" name="profesija"/>
                </div>
                <button class="btn btn-primary" type="submit" name="patvirtinti">Įrašyti</button>
            </form>
        </div>
    </div>
    <div class="col">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Vardas</th>
                    <th>Amžius</th>
                    <th>Profesija</th>
                </tr>
            </thead>
            <tbody>  
            <?php 
            $list = json_decode($_COOKIE["list"], true);
            foreach($list as $people) {
                $key = array_search($people, $list);
                $key++;
                    echo "<td>".$key."</td>";
                    echo "<td>".$people["vardas"]."</td>";
                    echo "<td>".$people["amžius"]."</td>";
                    echo "<td>".$people["profesija"]."</td>";
                echo "</tr>";
            }

            if(isset($_POST['patvirtinti'])) {
                if($_POST['vardas']!="" && $_POST['amzius']!="" && $_POST['profesija']!="") {
                    if($_POST['amzius'] > 140 || $_POST['amzius'] < 0 || !is_numeric($_POST['amzius'])) {
                        echo "<div class='alert alert-warning' role='alert'>Įveskite tinkamą amžių!</div>";
                    } else {
                        $vardas = $_POST['vardas'];
                        $amzius = $_POST['amzius'];
                        $profesija = $_POST['profesija'];
                        $newperson = array(
                            "vardas" => $vardas,
                            "amžius" => $amzius,
                            "profesija" => $profesija
                        );
                        $newlist = $_COOKIE['list'];
                        $newlistdecoded = json_decode($newlist, true);
                        $newlistdecoded [] = $newperson;
                        $newlist = json_encode($newlistdecoded, true);
                        setcookie("list", $newlist, time() + (86400*30), "table.php");
                        header("Location: table.php"); 
                    }
                } else {
                    echo "<div class='alert alert-warning' role='alert'>Užpildykite visus laukelius!</div>";
                }
            }
            // https://www.phptutorial.net/php-tutorial/php-checkbox/
            ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>