<?php
    require_once "Core/Core.php";
    require_once "Templates/nav.php";

    if ($_POST){
        $error_messages = AnimalOwnersAction::AddRecord(trim($_POST['name']));
        if (isset($error_messages[0]) && $error_messages[0] === true){
            echo "<script type='text/javascript'>
                            alert('Запись успешно добавлена');
                            window.location.replace('/LR1/');
                      </script>";
        }
    }


    require_once "Templates/AnimalOwner/Add.php";

    require_once "Templates/footer.php";