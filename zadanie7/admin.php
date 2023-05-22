<?php
    header('Content-Type: text/html; charset=UTF-8');

    session_start();

    if (!empty($_SESSION['login']))
    {
        session_destroy();
        header('Location: ./');
    }

    $user = 'u52864';
    $password = '3567354';
    $database = new PDO('mysql:host=localhost;dbname=u52864', $user, $password, [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    if ($_SERVER['REQUEST_METHOD'] == 'GET')
    {
        ?>

        <head>
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" type="text/css" href="style.css">
        </head>
        <body>
            <form action = "" method = "POST">
                <div class = "signup-form" style = "width: 65%;">
                    <h1 style = "color: darkcyan;">Данные пользователей</h1>
                    <div name = "Database_text" class = "txtb sf_input" style = "width: 100%; height: 624px; overflow-y: auto;">
                    <?php
                        $result = $database -> query("SELECT * FROM Information");
                        echo '<p>Данные пользователей из таблицы Information</p>';
                        echo '<p>↓ ↓ ↓</p>';
                        while ($row = $result -> fetch())
                        {
                            echo '<p>'.$row['ID_Record'].' | '.$row['Name'].' | '.$row['Email'].' | '.$row['Date'].' | '.$row['Gender'].' | '.$row['Limb'].' | '.$row['Biography'].' | '.$row['Contract'].'</p>';
                        }
                        echo '<p>Статистика пользователей по суперспособностям</p>';
                        echo '<p>↓ ↓ ↓</p>';
                        $result1 = $database -> query("SELECT COUNT(*) FROM Connection WHERE ID_Superpower = 1");
                        $result2 = $database -> query("SELECT COUNT(*) FROM Connection WHERE ID_Superpower = 2");
                        $result3 = $database -> query("SELECT COUNT(*) FROM Connection WHERE ID_Superpower = 3");
                        $result4 = $database -> query("SELECT COUNT(*) FROM Connection");
                        $row1 = $result1 -> rowCount();
                        $row2 = $result2 -> rowCount();
                        $row3 = $result3 -> rowCount();
                        $row4 = $result4 -> rowCount();
                        echo '<p>Бессмертие - '.$row1.', Прохождение сквозь стены - '.$row2.', Левитация - '.$row3.', Всего пользователей с суперспособностями - '.$row4.'</p>';
                    ?>
                    <input name = "User_Record" type = "text" placeholder = "ID пользователя (число слева от имени)" class = "txtb sf_input">
                    <input type = "submit" value = "Редактировать" class = "signup-btn sf_input">
                    </div>
                </div>
            </form>
        </body>

        <?php
        if (!empty($_GET['none']))
        {
            $message = "Неверные данные!";
            print($message);
        }
    }

    else
    {
        $user_record = $_POST['User_Record'];
        $_SESSION['login'] = 'Admin';
        $_SESSION['uid'] = $user_record;
        header('Location: ./');
    }
?>