<?php

    class AnimalOwnersTable
    {
        # Получение всех данных по всем владельцам животных
        public static function GetRecords() : ?array{
            $sql = "SELECT id, name FROM animal_owners";

            $result = Database::connection()->query($sql);

            // Для видимости объявляем массив тут
            $data = array();

            for($i = 0; $value = $result->fetch(PDO::FETCH_ASSOC); $i++){
                $data[$i]['id'] = $value['id'];
                $data[$i]['name'] = $value['name'];
            }

            return $data;
        }

        # Получение данных по отдельному владельцу животного
        public static function GetRecord($id_owner) : ?array{
            $sql = "SELECT id, name FROM animal_owners WHERE id = :id_owner";

            $statement = Database::connection()->prepare($sql);
            $statement->execute(array('id_owner' => $id_owner));

            return $statement->fetch(PDO::FETCH_ASSOC);
        }

        # Добавление нового владельца в базу данных
        public static function AddRecord($name) : bool{
            $sql =  "INSERT INTO animal_owners(name) ".
                "VALUES(:name)";

            $statement = Database::connection()->prepare($sql);
            return $statement->execute(array('name' => $name));
        }

        # Изменение данных владельца
        public static function EditRecord($id_owner, $name) : bool{
            $sql =  "UPDATE animal_owners ".
                "SET name = :name WHERE id = :id_owner";

            $content = array(
                'id_owner' => $id_owner,
                'name' => $name
            );

            $statement = Database::connection()->prepare($sql);
            return $statement->execute($content);
        }

        # Удаление владельца и всех его животных
        public static function DeleteRecord($id_owner) : bool{
            AnimalsAndOwnersTable::DeleteAnimalsWithOwners($id_owner);

            $sql = "DELETE FROM animal_owners WHERE id = :id_owner";
            $statement = Database::connection()->prepare($sql);
            return $statement->execute(array('id_owner' => $id_owner));
        }

        # Проверка существования записи с указанным номером в базе данных
        public static function CheckRecord($id_owner) : bool{
            $sql = "SELECT id FROM animal_owners WHERE id = :id_owner";

            $statement = Database::connection()->prepare($sql);
            $statement->execute(array('id_owner' => $id_owner));

            return $statement->rowCount() == 1;
        }
    }