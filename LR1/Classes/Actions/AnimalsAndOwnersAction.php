<?php

    class AnimalsAndOwnersAction
    {
        # Получение данных животных по отдельному владельцу
        public static function GetAnimalsWithOwners($id_owner) : ?array{
            if (is_numeric($id_owner) && AnimalOwnersTable::CheckRecord($id_owner))
                return AnimalsAndOwnersTable::GetAnimalsWithOwners($id_owner);
            else
                return null;
        }

        # Удаление всех животных одного клиента
        public static function DeleteAnimalsWithOwners($id_owner) : ?array{
            if (is_numeric($id_owner) && AnimalOwnersTable::CheckRecord($id_owner))
                return AnimalsAndOwnersTable::DeleteAnimalsWithOwners($id_owner);
            else
                return null;
        }
    }