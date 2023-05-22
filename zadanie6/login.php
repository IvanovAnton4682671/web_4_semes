<?php
    header('Content-Type: text/html; charset=UTF-8');

    session_start();

    if (!empty($_SESSION['login']))
    {
        session_destroy();
        header('Location: ./');
    }

    if ($_SERVER['REQUEST_METHOD'] == 'GET')
    {
        ?>

        <head>
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" type="text/css" href="style.css">
        </head>
        <body>
            <div class = "signup-form">
                <form action = "" method = "POST">
                    <h1>Авторизация</h1>
                    <input name = "User_Login" type = "text" placeholder = "Логин" class = "txtb sf_input">
                    <input name = "User_Password" type = "text" placeholder = "Пароль" class = "txtb sf_input">
                    <input type = "submit" value = "Войти" class = "signup-btn sf_input">
                </form>
            </div>
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
        $user = 'u52864';
        $password = '3567354';
        $database = new PDO('mysql:host=localhost;dbname=u52864', $user, $password, [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

        if ($_POST['User_Login'] == 'Admin' && md5($_POST['User_Password']) == md5('4682671'))
        {
            header('Location: ./admin.php');
        }

        else
        {
            $user_login = $_POST['User_Login'];
            $user_password = md5($_POST['User_Password']);
            $statement = $database -> prepare("SELECT ID_User FROM User_Information WHERE User_Login = ? AND User_Password = ?");
            $statement -> execute([$user_login, $user_password]);
            $user_id = $statement -> fetch(PDO::FETCH_COLUMN);

            if ($user_id)
            {
                $_SESSION['login'] = $_POST['User_Login'];
                $_SESSION['uid'] = $user_id;
                $_COOKIE['debug_' . session_name()] = "session_true";
                header('Location: ./');
            }

            else
            {
                print('Неправильная комбинация логина и пароля!');
            }
        }
    }
?>