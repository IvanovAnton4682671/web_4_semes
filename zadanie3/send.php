<?php
    try
    {
        //подключаемся к базе данных
        $user = 'u52864';
        $password = '3567354';
        $database = new PDO('mysql:host=localhost;dbname=u52864', $user, $password, [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

        //проверка полей на заполненность
        //имя
        function validate_name($name)
        {
            $Err = "";
            if (strlen($name)<2 || strlen($name)>50)
            $Err = "Длина имени должна быть от 2 до 50 символов!";
            if (preg_match('/[^(\w)|(\x7F-\xFF)|(\s)]/', $name))
            $Err = "В написании имени допустимы только буквы латинского и русского алфавита,цифры, символ подчеркивания и пробел!";
            if (!empty($Err))
            return ($Err);
        }
        $Name = validate_name($_POST['Name']);
        if (empty($_POST['Name'])) exit ("Введите корректное Имя!");
        //почта
        function validate_email($data)
        {
            $err ="";
            if(strlen($data)<3 || strlen($data)>50)
                $err = "Email должен быть от 3 до 50 символов";
             if(!preg_match('/^([\w]+\.?)+(?<!\.)@(?!\.)[a-zа-я0-9ё\.-]+\.?[a-zа-яё]{2,}$ui/', $data))
               $err = $err . "Недопустимый формат email-адреса!"; 
            if(!empty($err)) 
                return($err);
        }
        $Email = validate_email($_POST['Email']);
        if (empty($_POST['Email'])) exit ("Введите корректную Почту!");
        //дата
        function validateDate($date, $format = 'Y-m-d')
        {
            $d = DateTime::createFromFormat($format, $date);
            return $d && $d -> format($format) == $date;
        }
        if (var_dump(validateDate($_POST['Date'])) == false)
        {
            $dateErr = "Введите корректную Дату!";
        }
        //пол
        if ($_POST['Gender'] == 'Male'||'Female')
        {
            $gender = ($_POST['Gender']);
        }
        else if ($_POST['Gender'] == null)
        {
            $genderErr = "Выберите Пол!";
        }
        //конечности
        if ($_POST['Limb'] == '3'||'4'||'5')
        {
            $limb = ($_POST['Limb']);
        }
        else if ($_POST['Limb'] == null)
        {
            $limbErr = "Выберите Кол-во Конечностей!";
        }
        //суперспособности
        $superpowers = (int) $_POST['Superpowers'];
        if ($superpowers < 1 || $superpowers > 3)
        {
            $superpowersErr = "Выберите Суперспособность(и)!";
        }
        if ($superpowers == null)
        {
            exit("Выберите Суперспособность(и)!");
        }
        //биография
        if (empty($_POST['Biography'])) exit ("Введите Биографию!");
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