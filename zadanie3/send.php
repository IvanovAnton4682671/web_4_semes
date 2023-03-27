<?php
    try
    {
        //подключаемся к базе данных
        $user = 'u52864';
        $password = '3567354';
        $database = new PDO('mysql:host=localhost;dbname=u52864', $user, $password, [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

        //проверка полей на заполненность
        //имя
        if (empty($_POST['Name']) || is_numeric($_POST['Name']) || !preg_match('/^([А-ЯЁ]{1}[а-яё])|([A-Z]{1}[a-z])+$/u', $_POST['Name'])) exit("Заполните поле Имя корректно.");
        //почта
        if (empty($_POST['Email']) || is_numeric($_POST['Email']) || !preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-])*@[a-z0-9-]+(\.[a-z0-9-])*(\.[a-z]{2,4})$/', $_POST['Email'])) exit("Заполните поле Почта корректно.");
        //дата
        if ($_POST['Date'] == "0001-01-01") exit("Заполните поле Дата корректно.");
        //пол
        if ($_POST['Gender'] != "Male" && $_POST['Gender'] != "Female") exit ("Выберите Пол.");
        //конечности
        if ($_POST['Limb'] != 3 && $_POST['Limb'] != 4 && $_POST['Limb'] != 5) exit ("Выберите кол-во Конечностей.");
        //суперспособности
        $superpowers = (int) $_POST['Superpowers'];
        if ($superpowers < 1 || $superpowers > 3)
        {
            $superpowersErr = "Выберите Суперспособность(и)!";
        }
        if ($superpowers == null) exit("Выберите Суперспособность(и)!");
        //биография
        if (empty($_POST['Biography']) || is_numeric($_POST['Biography']) || !preg_match('/^[a-zA-Zа-яёА-ЯЁ0-9]/', $_POST['Biography'])) exit("Заполните поле Биография корректо.");
        //контракт
        if ($_POST['Contract'] == null) exit ("Нажмите кнопку Контракт!");

        //отправка данных в базу
        $statement = $database -> prepare("INSERT INTO Information (Name, Email, Date, Gender, Limb, Biography, Contract) VALUES (:Name, :Email, :Date, :Gender, :Limb, :Biography, :Contract)");
        $statement -> execute(['Name' => $_POST['Name'], 'Email' => $_POST['Email'], 'Date' => $_POST['Date'], 'Gender' => $_POST['Gender'], 'Limb' => $_POST['Limb'], 'Biography' => $_POST['Biography'], 'Contract' => $_POST['Contract']]);
        $id_connection = $database -> lastInsertId();
        $statement = $database -> prepare("INSERT INTO Connection (ID_Record, ID_Superpower) VALUES (:ID_Record, :ID_Superpower)");
        foreach ($_POST['Superpowers'] as $superpowers)
        {
            if ($superpowers != false)
            {
                $statement -> execute(['ID_Record' => $id_connection, 'ID_Superpower' => $superpowers]);
            }
        }
    }

    //проверяем наличие ошибок
    catch (PDOException $e)
    {
        print('Error: ' .$e -> getMessage());
        exit();
    }
?>