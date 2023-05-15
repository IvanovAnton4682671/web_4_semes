<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Permanent+Marker">
    <title>Form & Database</title>
</head>
<body>
    <?php
    if (!empty($messages)) {
    print('<div id="messages">');
    foreach ($messages as $message) {
        print($message);
    }
    print('</div>');
    }
    ?>
    <div class = "signup-form">
        <form action = "" method = "POST">
            <h1>Форма</h1>
            <input name = "Name" type = "text" placeholder = "Имя" <?php if ($errors['Name']) {print 'class = "txtb_error sf_input"';} else {print 'class = "txtb sf_input"';} ?> value="<?php print $values['Name']; ?>">
            <input name = "Email" type = "text" placeholder = "Почта" <?php if ($errors['Email']) {print 'class = "txtb_error sf_input"';} else {print 'class = "txtb sf_input"';} ?> value="<?php print $values['Email']; ?>">
            <input name = "Date" type = "date" <?php if ($errors['Date']) {print 'class = "txtb_error sf_input"';} else {print 'class = "txtb sf_input"';} ?> value="<?php print $values['Date']; ?>">
            <div <?php if ($errors['Gender']) {print 'class = "txtb_error"';} else {print 'class = "txtb"';} ?>><label>Пол</br><input name = "Gender" type = "radio" value = "Male" <?php if ($values['Gender'] == 'Male') {print 'checked = "checked"';}?>>Мужской</label>
            <label><input name = "Gender" type = "radio" value = "Female" <?php if ($values['Gender'] == 'Female') {print 'checked = "checked"';}?>>Женский</label></div>
            <div <?php if ($errors['Limb']) {print 'class = "txtb_error"';} else {print 'class = "txtb"';} ?>><label></br>Кол-во конечностей</br><input name = "Limb" type = "radio" value = 3 <?php if ($values['Limb'] == 3) {print 'checked = "checked"';}?>>3</label>
            <label><input name = "Limb" type = "radio" value = 4 <?php if ($values['Limb'] == 4) {print 'checked = "checked"';}?>>4</label>
            <label><input name = "Limb" type = "radio" value = 5 <?php if ($values['Limb'] == 5) {print 'checked = "checked"';}?>>5</label></div>
            <select name = "Superpowers[]" multiple = "multiple" <?php if ($errors['Superpowers']) {print 'class = "txtb_error sf_input"';} else {print 'class = "txtb sf_input"';} ?>>
                <option value = 1 <?php if ($values['Superpowers'] == 1) {print 'selected = "selected"';}?>>Бессмертие</option>
                <option value = 2 <?php if ($values['Superpowers'] == 2) {print 'selected = "selected"';}?>>Прохождение сквозь стены</option>
                <option value = 3 <?php if ($values['Superpowers'] == 3) {print 'selected = "selected"';}?>>Левитация</option>
            </select>
            <textarea name = "Biography" placeholder = "Биография" <?php if ($errors['Biography']) {print 'class = "txtb_error sf_input"';} else {print 'class = "txtb sf_input"';} ?>><?php print $values['Biography']; ?></textarea>
            <div <?php if ($errors['Contract']) {print 'class = "txtb_error"';} else {print 'class = "txtb"';} ?>><label><input name = "Contract" value = "Checked" type = "checkbox" <?php if ($values['Contract'] == 'Checked') {print 'checked="checked"';} ?>>С контрактом ознакомлен(а)</label></div>
            </br>
            <input type = "submit" value = "Отправить данные" class = "signup-btn sf_input">
        </form>
    </div>
    <a class = "txtb sf_input" style = "width: 10%; height: 2%; text-align: center; margin-left: 30px;" href = "login.php">Авторизоваться</a>
    <?php
        if (!empty($messages))
        {
            if (!empty($_SESSION['login']))
            printf($_SESSION['login'], $_SESSION['uid']);
        }
    ?>
</body>
</html>