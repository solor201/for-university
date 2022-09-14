<?php

    class AnimalsAndOwnersTable
    {
        # Получение данных животных по отдельному владельцу
        public static function GetAnimalsWithOwners($id_owner) : ?array{
            $sql = "SELECT animals.id, animals.name, animal_owners.name as name_owner, id_owner, description, year_of_birth, img_path ".
                "FROM animals JOIN animal_owners ".
                "ON id_owner = animal_owners.id WHERE animal_owners.id = :id";

            $data = array();

            $result = Database::connection()->prepare($sql);
            $result->execute(array('id' => $id_owner));

            for($i = 0; $value = $result->fetch(PDO::FETCH_ASSOC); $i++){
                $data[$i]['id'] = $value['id'];
                $data[$i]['name'] = $value['name'];
                $data[$i]['description'] = $value['description'];
                $data[$i]['year_of_birth'] = $value['year_of_birth'];
                $data[$i]['id_owner'] = $value['id_owner'];
                $data[$i]['name_owner'] = $value['name_owner'];
                $data[$i]['img_path'] = $value['img_path'];
            }

            return $data;
        }

        # Удаление всех животных одного клиента
        public static function DeleteAnimalsWithOwners($id_owner) : ?array{
            $sql = "SELECT id FROM animals WHERE id_owner = :id_owner";
            $state = array(
                # Общее количество записей
                'count' => 0,
                # Количество успешно удаленных записей
                'success' => 0
            );

            $statement = Database::connection()->prepare($sql);
            $statement->execute(array('id_owner' => $id_owner));

            while($result = $statement->fetch(PDO::FETCH_ASSOC)){
                if (AnimalsTable::DeleteRecord($result['id']))
                    $state['success']++;
                $state['count']++;
            }
            return $state;
        }
    }