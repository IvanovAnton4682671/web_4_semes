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
            <input name = "Name" type = "text" placeholder = "Имя" class = "txtb sf_input" <?php if ($errors['Name']) {print 'error';} ?> value="<?php print $values['Name']; ?>">
            <input name = "Email" type = "text" placeholder = "Почта" class = "txtb sf_input" <?php if ($errors['Email']) {print 'error';} ?> value="<?php print $values['Email']; ?>">
            <input name = "Date" type = "date" value = "0001-01-01" class = "txtb sf_input" <?php if ($errors['Date']) {print 'error';} ?> value="<?php print $values['Date']; ?>">
            <label>Пол</br><input name = "Gender" type = "radio" value = "Male" class = "txtb" <?php if ($errors['Gender']) {print 'error';} ?> <?php if ($values['Gender'] == 'Male') {print 'checked="checked"';}?>>Мужской</label>
            <label><input name = "Gender" type = "radio" value = "Female" class = "txtb" <?php if ($values['Gender'] == 'Female') {print 'checked="checked"';}?>>Женский</label>
            <label></br>Кол-во конечностей</br><input name = "Limb" type = "radio" value = 3 class = "txtb" <?php if ($errors['Limb']) {print 'error';} ?> <?php if ($values['Limb'] == 3) {print 'checked="checked"';}?>>3</label>
            <label><input name = "Limb" type = "radio" value = 4 class = "txtb" <?php if ($values['Limb'] == 4) {print 'checked="checked"';}?>>4</label>
            <label><input name = "Limb" type = "radio" value = 5 class = "txtb" <?php if ($values['Limb'] == 5) {print 'checked="checked"';}?>>5</label>
            <select name = "Superpowers[]" multiple = "multiple" class = "txtb sf_input" <?php if ($errors['Superpowers']) {print 'error';} ?>>
                <option value = 1 <?php if ($values['Superpowers'] == 1) {print 'selected="selected"';}?>>Бессмертие</option>
                <option value = 2 <?php if ($values['Superpowers'] == 2) {print 'selected="selected"';}?>>Прохождение сквозь стены</option>
                <option value = 3 <?php if ($values['Superpowers'] == 3) {print 'selected="selected"';}?>>Левитация</option>
            </select>
            <textarea name = "Biography" placeholder = "Биография" class = "txtb sf_input" <?php if ($errors['Biography']) {print 'error';} ?> <?php print $values['Biography']; ?>></textarea>
            <label><input name = "Contract" value = "Checked" type = "checkbox" class = "txtb" <?php if ($errors['Contract']) {print 'error';} ?> <?php if ($values['Contract'] == 'Checked') {print 'checked="checked"';} ?>>С контрактом ознакомлен(а)</label>
            </br>
            <input type = "submit" value = "Отправить данные" class = "signup-btn sf_input">
        </form>
    </div>
</body>
</html>