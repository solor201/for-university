<?php
    require_once "Core/Core.php";
    $Owners = AnimalOwnersTable::GetRecords();

    if (count($Owners) == 0){
        echo "<script type='text/javascript'>
                        alert('Для начала добавьте владельцев');
                        window.location.replace('/LR1/');
                  </script>";
    }

    require_once "Templates/nav.php";

    if ($_POST){
        $error_messages = AnimalsActions::AddRecord(trim($_POST['owner']), trim($_POST['name']), trim($_POST['description']), trim($_POST['year_of_birth']));
        if (isset($error_messages[0]) && $error_messages[0] === true){
            echo "<script type='text/javascript'>
                        alert('Запись успешно добавлена');
                        window.location.replace('/LR1/');
                  </script>";
        }
    }


    require_once "Templates/Animal/Add.php";

    require_once "Templates/footer.php";