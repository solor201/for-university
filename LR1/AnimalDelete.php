<?php
    require_once "Core/Core.php";

    if (AnimalsTable::CheckRecord(intval($_GET['id'])) && AnimalsActions::DeleteRecord(intval($_GET['id']))){
        echo "<script type='text/javascript'>
                            alert('Запись успешно удалена');
                            window.location.replace('/LR1/');
                      </script>";
    }
    else{
        echo "<script type='text/javascript'>
                            alert('Ошибка удаления записи');
                            window.location.replace('/LR1/');
                      </script>";
    }