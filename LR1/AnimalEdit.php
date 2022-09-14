<?php
    require_once "Core/Core.php";

    $Animal = AnimalsActions::GetRecord(trim($_GET['id']));
    if ($Animal == null)
    {
        echo "<script type='text/javascript'>
                            alert('Ошибка выбора записи для изменения');
                            window.location.replace('/LR1/');
                      </script>";
    }

    require_once "Templates/nav.php";

    if ($_POST){
        $error_messages = AnimalsActions::EditRecord(trim($_GET['id']), trim($_POST['owner']), trim($_POST['name']), trim($_POST['description']), trim($_POST['year_of_birth']));
        if ($error_messages[0] === true){
            echo "<script type='text/javascript'>
                            alert('Запись успешно изменена');
                            window.location.replace('/LR1/');
                      </script>";
        }
    }


    $Owners = AnimalOwnersTable::GetRecords();

    require_once "Templates/Animal/Edit.php";

    require_once "Templates/footer.php";