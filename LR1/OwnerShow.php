<?php
    require_once "Core/Core.php";
    require_once "Templates/nav.php";

    $Owners = AnimalOwnersTable::GetRecords();
    require_once "Templates/AnimalOwner/Show.php";

    require_once "Templates/footer.php";