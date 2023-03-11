<?php
    try
    {
        //подключаемся к базе данных
        $user = 'u52864';
        $password = '3567354';
        $database = new PDO('mysql:host=localhost;dbname=u52864',
        $user,$password,[PDO::ATTR_PERSISTENT => true]);

        //проверка полей на заполненность
        if (empty($_POST['name'])) exit ("Поле не заполнено!");
        if (empty($_POST['email'])) exit ("Поле не заполнено!");
        if ($_POST['date'] == "гггг-мм-дд") exit ("Поле не заполнено!");
        if ($_POST['gender'] == false) exit ("Ничего не выбрано!");
        if ($_POST['limb'] == false) exit ("Ничего не выбрано!");
        if (empty($_POST['superpowers'])) exit ("Ничего не выбрано!");
        if (empty($_POST['biography'])) exit ("Поле не заполнено!");
        if ($_POST['contract'] == false) exit ("Кнопка не нажата!");

        //отправка данных в базу
        $statement = $database->prepare("INSERT INTO dff1 (name,email,date,gender,limb,biography,contract) VALUES (:name,:email,:date,:gender,:limb,:biography,:contract)");
        $statement -> execute(['name'=>$_POST['name'], 'email'=>$_POST['email'], 'date'=>$_POST['date'], 'gender'=>$_POST['gender'], 'limb'=>$_POST['limb'], 'biography'=>$_POST['biography'], 'contract'=>$_POST['contract']]);
        $send_id = $database->lastInsertId();
        $statement = $database->prepare("INSERT INTO dff2 (superpower1,superpower2,superpower3,task_id) VALUES (:superpower1,:superpower2,:superpower3,:task_id)");
        $statement->execute(['superpower1'=>$_POST['superpower1'], 'superpower2'=>$_POST['superpower2'], 'superpower3'=>$_POST['superpower3'], 'task_id'=>$send_id]);
    }

    //проверяем наличие ошибок
    catch (PDOException $e)
    {
        print('Error: ' .$e->getMessage());
        exit();
    }
?>