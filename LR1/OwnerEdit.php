<?php
    require_once "Core/Core.php";

    $Owner = AnimalOwnersAction::GetRecord(trim($_GET['id']));
    if ($Owner == null)
    {
        echo "<script type='text/javascript'>
                                alert('Ошибка выбора записи для изменения');
                                window.location.replace('/LR1/');
                          </script>";
    }

    require_once "Templates/nav.php";

    if ($_POST){
        $error_messages = AnimalOwnersAction::EditRecord(trim($_GET['id']), trim($_POST['name']));
        if (isset($error_messages[0]) && $error_messages[0] === true){
            echo "<script type='text/javascript'>
                                alert('Запись успешно изменена');
                                window.location.replace('/LR1/');
                          </script>";
        }
    }

    require_once "Templates/AnimalOwner/Edit.php";

    require_once "Templates/footer.php";