<?php
    require_once "Core/Core.php";

    if (AnimalOwnersTable::CheckRecord(intval($_GET['id']))){
        $state = AnimalsAndOwnersAction::DeleteAnimalsWithOwners(intval($_GET['id']));
        AnimalOwnersAction::DeleteRecord(intval($_GET['id']));
        echo "<script type='text/javascript'>
                                alert('Запись владельца и ещё " . $state['success'] . " его животных успешно удалены');
                                window.location.replace('/LR1/OwnerShow.php');
                          </script>";
    }
    else{
        echo "<script type='text/javascript'>
                                alert('Ошибка удаления записи');
                                window.location.replace('/LR1/OwnerShow.php');
                          </script>";
    }