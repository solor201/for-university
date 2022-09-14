<?php
    require_once "Core/Core.php";
    require_once "Templates/nav.php";

    if(isset($_GET['id']) && AnimalOwnersTable::CheckRecord(intval($_GET['id'])))
        $Animals = AnimalsAndOwnersAction::GetAnimalsWithOwners(intval($_GET['id']));
    else
        $Animals = AnimalsTable::GetRecords();
    require_once "Templates/Animal/Show.php";

    require_once "Templates/footer.php";