<?php
    header('Content-Type: text/html; charset=UTF-8');
?>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class = "signup-form" style = "width: 65%;">
        <h1 style = "color: darkcyan;">Данные пользователей</h1>
        <div name = "Database_text" class = "txtb sf_input" style = "width: 100%; height: 624px; overflow-y: auto;">
        <?php
            $user = 'u52864';
            $password = '3567354';
            $database = new PDO('mysql:host=localhost;dbname=u52864', $user, $password, [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
            $result = $database -> query('SELECT * FROM Information');
            while($row = $result -> fetch())
            {
                echo '<p>ID_Record '.$row['ID_Record'].' Name '.$row['Name'].' Email '.$row['Email'].' Date '.$row['Date'].' Gender '.$row['Gender'].' Limb '.$row['Limb'].' Biography '.$row['Biography'].' Contract '.$row['Contract'].'</p>';
            }
        ?>
        </div>
    </div>
</body>