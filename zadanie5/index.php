<?php
    header('Content-Type: text/html; charset=UTF-8');
    try
    {
        //работа с coockie
        if ($_SERVER['REQUEST_METHOD'] == 'GET')
        {
            $messages = array();

            if (!empty($_COOKIE['save']))
            {
                setcookie('save', '', time() + 60 * 60 * 24);
                setcookie('login', '', time() + 60 * 60 * 24);
                setcookie('password', '', time() + 60 * 60 * 24);
                $messages[] = 'Данные были сохранены!';
                if (!empty($_COOKIE['password']))
                {
                    $messages[] = sprintf('<div style = "margin-left: 30px;">Вы можете войти с этими данными для изменения внесённых ранее:</div>
                    <div style = "margin-left: 30px;">Логин: %s</div>
                    <div style = "margin-left: 30px;">Пароль: %s</div>',
                    strip_tags($_COOKIE['login']),
                    strip_tags($_COOKIE['password'])
                    );
                }
            }

            $errors = array();
            $errors['Name'] = !empty($_COOKIE['Name_error']);
            $errors['Email'] = !empty($_COOKIE['Email_error']);
            $errors['Date'] = !empty($_COOKIE['Date_error']);
            $errors['Gender'] = !empty($_COOKIE['Gender_error']);
            $errors['Limb'] = !empty($_COOKIE['Limb_error']);
            $errors['Superpowers'] = !empty($_COOKIE['Superpowers_error']);
            $errors['Biography'] = !empty($_COOKIE['Biography_error']);
            $errors['Contract'] = !empty($_COOKIE['Contract_error']);

            if ($errors['Name']) { setcookie('Name_error', '', time() + 60 * 60 * 24); $messages[] = '<div class="error">Проверьте поле Имя!</div>'; }
            if ($errors['Email']) { setcookie('Email_error', '', time() + 60 * 60 * 24); $messages[] = '<div class="error">Проверьте поле Почта!</div>'; }
            if ($errors['Date']) { setcookie('Date_error', '', time() + 60 * 60 * 24); $messages[] = '<div class="error">Проверьте поле Дата!</div>'; }
            if ($errors['Gender']) { setcookie('Gender_error', '', time() + 60 * 60 * 24); $messages[] = '<div class="error">Выберите Пол!</div>'; }
            if ($errors['Limb']) { setcookie('Limb_error', '', time() + 60 * 60 * 24); $messages[] = '<div class="error">Выберите кол-во Конечностей!</div>'; }
            if ($errors['Superpowers']) { setcookie('Superpowers_error', '', time() + 60 * 60 * 24); $messages[] = '<div class="error">Выберите Суперспособность(и)!</div>'; }
            if ($errors['Biography']) { setcookie('Biography_error', '', time() + 60 * 60 * 24); $messages[] = '<div class="error">Проверьте поле Биография!</div>'; }
            if ($errors['Contract']) { setcookie('Contract_error', '', time() + 60 * 60 * 24); $messages[] = '<div class="error">Поставьте галочку Ознакомления!</div>'; }

            if (!empty($_COOKIE[session_name()]) && session_start() && !empty($_SESSION['login']))
            {
                $user = 'u52864';
                $password = '3567354';
                $database = new PDO('mysql:host=localhost;dbname=u52864', $user, $password, [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

                $statement = $database -> prepare("SELECT * FROM Information WHERE ID_Record = ?");
                $statement -> execute([$_SESSION['uid']]);
                $line = $statement -> fetch(PDO::FETCH_ASSOC);

                $values = array();
                $values['Name'] = $line['Name'];
                $values['Email'] = $line['Email'];
                $values['Date'] = $line['Date'];
                $values['Gender'] = $line['Gender'];
                $values['Limb'] = $line['Limb'];
                $values['Superpowers'] = $line['Superpowers'];
                $values['Biography'] = $line['Biography'];
                $values['Contract'] = $line['Contract'];
                $messages[] = sprintf('<div style = "margin-left: 30px;">Вы вошли с этими данными:</div>
                    <div style = "margin-left: 30px;">Ваш логин: %s</div>
                    <div style = "margin-left: 30px;">Ваш номер: %s</div>',
                    strip_tags($_SESSION['login']),
                    strip_tags($_SESSION['uid'])
                    );
            }

            else
            {
                $values = array();
                $values['Name'] = empty($_COOKIE['Name_value']) ? '' : $_COOKIE['Name_value'];
                $values['Email'] = empty($_COOKIE['Email_value']) ? '' : $_COOKIE['Email_value'];
                $values['Date'] = empty($_COOKIE['Date_value']) ? '' : $_COOKIE['Date_value'];
                $values['Gender'] = empty($_COOKIE['Gender_value']) ? '' : $_COOKIE['Gender_value'];
                $values['Limb'] = empty($_COOKIE['Limb_value']) ? '' : $_COOKIE['Limb_value'];
                $values['Superpowers'] = empty($_COOKIE['Superpowers_value']) ? '' : $_COOKIE['Superpowers_value'];
                /*$values['Superpowers1'] = empty($_COOKIE['Superpowers_value1']) ? '' : $_COOKIE['Superpowers_value1'];
                $values['Superpowers2'] = empty($_COOKIE['Superpowers_value2']) ? '' : $_COOKIE['Superpowers_value2'];
                $values['Superpowers3'] = empty($_COOKIE['Superpowers_value3']) ? '' : $_COOKIE['Superpowers_value3'];*/
                $values['Biography'] = empty($_COOKIE['Biography_value']) ? '' : $_COOKIE['Biography_value'];
                $values['Contract'] = empty($_COOKIE['Contract_value']) ? '' : $_COOKIE['Contract_value'];
            }

            include('form.php');
        }

        else
        {
            $errors = FALSE;
            if (empty($_POST['Name'])) { setcookie('Name_error', '1', time() + 24 * 60 * 60); $errors = TRUE; }
            else
            {
                if (empty($_POST['Name']) || is_numeric($_POST['Name']) || !preg_match('/^([А-ЯЁ]{1}[а-яё])|([A-Z]{1}[a-z])+$/u', $_POST['Name']))
                {
                    setcookie('Name_error', '2', time() + 24 * 60 * 60);
                    $errors = TRUE;
                }
                else setcookie('Name_value', $_POST['Name'], time() + 60 * 60 * 24 * 31);
            }
            if (empty($_POST['Email'])) { setcookie('Email_error', '1', time() + 24 * 60 * 60); $errors = TRUE; }
            else
            {
                if (empty($_POST['Email']) || is_numeric($_POST['Email']) || !preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-])*@[a-z0-9-]+(\.[a-z0-9-])*(\.[a-z]{2,4})$/', $_POST['Email']))
                {
                    setcookie('Email_error', '2', time() + 24 * 60 * 60);
                    $errors = TRUE;
                }
                else setcookie('Email_value', $_POST['Email'], time() + 60 * 60 * 24 * 31);
            }
            if (empty($_POST['Date'])) { setcookie('Date_error', '1', time() + 24 * 60 * 60); $errors = TRUE; }
            else
            {
                if ($_POST['Date'] == "0001-01-01" || empty($_POST['Date']))
                {
                    setcookie('Date_error', '2', time() + 24 * 60 * 60);
                    $errors = TRUE;
                }
                else setcookie('Date_value', $_POST['Date'], time() + 60 * 60 * 24 * 31);
            }
            if (empty($_POST['Gender'])) { setcookie('Gender_error', '1', time() + 24 * 60 * 60); $errors = TRUE; }
            else
            {
                if ($_POST['Gender'] != "Male" && $_POST['Gender'] != "Female")
                {
                    setcookie('Gender_error', '2', time() + 24 * 60 * 60);
                    $errors = TRUE;
                }
                else setcookie('Gender_value', $_POST['Gender'], time() + 60 * 60 * 24 * 31);
            }
            if (empty($_POST['Limb'])) { setcookie('Limb_error', '1', time() + 24 * 60 * 60); $errors = TRUE; }
            else
            {
                if ($_POST['Limb'] != 3 && $_POST['Limb'] != 4 && $_POST['Limb'] != 5)
                {
                    setcookie('Limb_error', '2', time() + 24 * 60 * 60);
                    $errors = TRUE;
                }
                else setcookie('Limb_value', $_POST['Limb'], time() + 60 * 60 * 24 * 31);
            }
            if (empty($_POST['Superpowers'])) { setcookie('Superpowers_error', '1', time() + 24 * 60 * 60); $errors = TRUE; }
            else
            {
                $superpowers = (int) $_POST['Superpowers'];
                if ($superpowers < 1 || $superpowers > 3 || $superpowers == null)
                {
                    setcookie('Superpowers_error', '2', time() + 24 * 60 * 60);
                    $errors = TRUE;
                }
                //else setcookie('Superpowers_value', $_POST['Superpowers'], time() + 60 * 60 * 24 * 31); !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
                /*{
                    setcookie('Superpowers_values1', $_POST['Superpowers[1]'], time() + 60 * 60 * 24 * 31);
                    setcookie('Superpowers_values2', $_POST['Superpowers[2]'], time() + 60 * 60 * 24 * 31);
                    setcookie('Superpowers_values3', $_POST['Superpowers[3]'], time() + 60 * 60 * 24 * 31);
                }*/
            }
            if (empty($_POST['Biography'])) { setcookie('Biography_error', '1', time() + 24 * 60 * 60); $errors = TRUE; }
            else
            {
                if (empty($_POST['Biography']) || is_numeric($_POST['Biography']) || !preg_match('/^[a-zA-Zа-яёА-ЯЁ0-9]/', $_POST['Biography']))
                {
                    setcookie('Biography_error', '2', time() + 24 * 60 * 60);
                    $errors = TRUE;
                }
                else setcookie('Biography_value', $_POST['Biography'], time() + 60 * 60 * 24 * 31);
            }
            if (empty($_POST['Contract'])) { setcookie('Contract_error', '1', time() + 24 * 60 * 60); $errors = TRUE; }
            else
            {
                if ($_POST['Contract'] == null)
                {
                    setcookie('Contract_error', '2', time() + 24 * 60 * 60);
                    $errors = TRUE;
                }
                else setcookie('Contract_value', $_POST['Contract'], time() + 60 * 60 * 24 * 31);
            }

            if ($errors)
            {
                header('Location: index.php');
                exit();
            }
            else
            {
                setcookie('Name_error', '', time() + 24 * 60 * 60);
                setcookie('Email_error', '', time() + 24 * 60 * 60);
                setcookie('Date_error', '', time() + 24 * 60 * 60);
                setcookie('Gender_error', '', time() + 24 * 60 * 60);
                setcookie('Limb_error', '', time() + 24 * 60 * 60);
                setcookie('Superpowers_error', '', time() + 24 * 60 * 60);
                setcookie('Biography_error', '', time() + 24 * 60 * 60);
                setcookie('Contract_error', '', time() + 24 * 60 * 60);
            }

            //проверка полей на заполненность
            //имя
            //if (empty($_POST['Name']) || is_numeric($_POST['Name']) || !preg_match('/^([А-ЯЁ]{1}[а-яё])|([A-Z]{1}[a-z])+$/u', $_POST['Name'])) exit("Заполните поле Имя корректно.");
            //почта
            //if (empty($_POST['Email']) || is_numeric($_POST['Email']) || !preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-])*@[a-z0-9-]+(\.[a-z0-9-])*(\.[a-z]{2,4})$/', $_POST['Email'])) exit("Заполните поле Почта корректно.");
            //дата
            //if ($_POST['Date'] == "0001-01-01") exit("Заполните поле Дата корректно.");
            //пол
            //if ($_POST['Gender'] != "Male" && $_POST['Gender'] != "Female") exit ("Выберите Пол.");
            //конечности
            //if ($_POST['Limb'] != 3 && $_POST['Limb'] != 4 && $_POST['Limb'] != 5) exit ("Выберите кол-во Конечностей.");
            //суперспособности
            /*$superpowers = (int) $_POST['Superpowers'];
            if ($superpowers < 1 || $superpowers > 3)
            {
                $superpowersErr = "Выберите Суперспособность(и)!";
            }
            if ($superpowers == null) exit("Выберите Суперспособность(и)!");*/
            //биография
            //if (empty($_POST['Biography']) || is_numeric($_POST['Biography']) || !preg_match('/^[a-zA-Zа-яёА-ЯЁ0-9]/', $_POST['Biography'])) exit("Заполните поле Биография корректо.");
            //контракт
            //if ($_POST['Contract'] == null) exit ("Нажмите кнопку Контракт!");

            //подключаемся к базе данных
            $user = 'u52864';
            $password = '3567354';
            $database = new PDO('mysql:host=localhost;dbname=u52864', $user, $password, [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

            if (!empty($_COOKIE[session_name()]) && session_start() && !empty($_SESSION['login']))
            {
                $statement = $database -> prepare("UPDATE Information SET Name = ?, Email = ?, Date = ?, Gender = ?, Limb = ?, Biography = ?, Contract = ? WHERE ID_Record = ?");
                $statement -> execute([$_POST['Name'], $_POST['Email'], $_POST['Date'], $_POST['Gender'], $_POST['Limb'], $_POST['Biography'], $_POST['Contract'], $_SESSION['uid']]);
                $statement_sup = $database -> prepare("INSERT INTO Connection SET ID_Record = ?, ID_Superpower = ?");
                foreach($_POST['Superpowers'] as $superpowers)
                    $statement_sup -> execute([$_SESSION['uid'], $superpowers]);
            }

            else
            {
                $user_login = uniqid('', true);
                $user_password = rand(1, 1000);
                setcookie('login', $user_login);
                setcookie('password', $user_password);

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
                $statement = $database -> prepare("INSERT INTO User_Information SET ID_User = ?, User_Login = ?, User_Password = ?");
                $statement -> execute([$id_connection, $user_login, md5($user_password)]);
            }

            setcookie('save', '1');
            header('Location: index.php');
        }

    }
    //проверяем наличие ошибок
    catch (PDOException $e)
    {
        print('Error: ' .$e -> getMessage());
        exit();
    }

?>