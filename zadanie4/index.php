<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
        <form action = "send.php" method = "POST">
            <h1>Форма</h1>
            <input name = "Name" type = "text" placeholder = "Имя" class = "txtb sf_input" <?php if ($errors['Name']) {print 'class="error"';} ?>>
            <input name = "Email" type = "text" placeholder = "Почта" class = "txtb sf_input" <?php if ($errors['Email']) {print 'class="error"';} ?>>
            <input name = "Date" type = "date" value = "0001-01-01" class = "txtb sf_input" <?php if ($errors['Date']) {print 'class="error"';} ?>>
            <label>Пол</br><input name = "Gender" type = "radio" value = "Male" class = "txtb" <?php if ($errors['Gender']) {print 'class="error"';} ?>>Мужской</label>
            <label><input name = "Gender" type = "radio" value = "Female" class = "txtb">Женский</label>
            <label></br>Кол-во конечностей</br><input name = "Limb" type = "radio" value = "3" class = "txtb" <?php if ($errors['Limb']) {print 'class="error"';} ?>>3</label>
            <label><input name = "Limb" type = "radio" value = "4" class = "txtb">4</label>
            <label><input name = "Limb" type = "radio" value = "5" class = "txtb">5</label>
            <select name = "Superpowers[]" multiple = "multiple" class = "txtb sf_input" <?php if ($errors['Superpowers']) {print 'class="error"';} ?>>
                <option value = "1">Бессмертие</option>
                <option value = "2">Прохождение сквозь стены</option>
                <option value = "3">Левитация</option>
            </select>
            <textarea name = "Biography" placeholder = "Биография" class = "txtb sf_input" <?php if ($errors['Biography']) {print 'class="error"';} ?>></textarea>
            <label><input name = "Contract" value = "Checked" type = "checkbox" class = "txtb" <?php if ($errors['Contract']) {print 'class="error"';} ?>>С контрактом ознакомлен(а)</label>
            </br>
            <input type = "submit" value = "Отправить данные" class = "signup-btn sf_input">
        </form>
    </div>
</body>
</html>