<?php

    class AnimalsTable
    {
        # Получение всех данных по животным
        public static function GetRecords() : ?array{
            $sql = "SELECT animals.id, animals.name, animal_owners.name as name_owner, id_owner, description, year_of_birth, img_path ".
                "FROM animals JOIN animal_owners ".
                "ON id_owner = animal_owners.id ORDER BY animals.id";

            $result = Database::connection()->query($sql);

            // Для видимости объявляем массив тут
            $data = array();

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

        # Получение данных по отдельному животному
        public static function GetRecord($id) : ?array{
            $sql = "SELECT animals.id, animals.name, animal_owners.name as name_owner, id_owner, description, year_of_birth, img_path ".
                "FROM animals JOIN animal_owners ".
                "ON id_owner = animal_owners.id WHERE animals.id = :id";

            $statement = Database::connection()->prepare($sql);
            $statement->execute(array('id' => $id));

            return $statement->fetch(PDO::FETCH_ASSOC);
        }

        # Добавление животного в базу данных
        public static function AddRecord($id_owner, $name, $description, $year_of_birth, $img_path) : bool{
            $sql =  "INSERT INTO animals(id_owner, name, description, year_of_birth, img_path) ".
                "VALUES(:id_owner, :name, :description, :year_of_birth, :img_path)";

            $statement = Database::connection()->prepare($sql);
            return $statement->execute(array(
                'id_owner' => $id_owner,
                'name' => $name,
                'description' => $description,
                'year_of_birth' => $year_of_birth,
                'img_path' => $img_path
            ));
        }

        # Изменение данных
        public static function EditRecord($id, $id_owner, $name, $description, $year_of_birth, $img_path = NULL) : bool{
            $sql =  "UPDATE animals ".
                "SET name = :name, description = :description, id_owner = :id_owner, year_of_birth = :year_of_birth";

            $content = array(
                'id' => $id,
                'id_owner' => $id_owner,
                'name' => $name,
                'description' => $description,
                'year_of_birth' => $year_of_birth,
            );

            # Если при изменении добавили новую картинку
            if ($img_path != NULL)
            {
                # Удаление прошлой фотографии животного с сервера
                {
                    # Поиск названия картинки в базе данных
                    $req = "SELECT img_path FROM animals WHERE id = :id";

                    $statement = Database::connection()->prepare($req);
                    $statement->execute(array('id' => $id));

                    $path = $statement->fetch(PDO::FETCH_ASSOC);
                    $images_dir = $_SERVER['DOCUMENT_ROOT'] . "/LR1/Source/Images/" . $path['img_path'];
                    # Удаление
                    unlink($images_dir);
                }
                $sql .= ", img_path = :path";
                $content['path'] = $img_path;
            }

            $sql .= " WHERE id = :id";

            $statement = Database::connection()->prepare($sql);
            return $statement->execute($content);
        }

        # Удаление животного из базы данных
        public static function DeleteRecord($id) : bool{
            # Удаление фотографии животного с сервера
            {
                # Поиск названия картинки в базе данных
                $sql = "SELECT img_path FROM animals WHERE id = :id";

                $statement = Database::connection()->prepare($sql);
                $statement->execute(array('id' => $id));

                $path = $statement->fetch(PDO::FETCH_ASSOC);
                $images_dir = $_SERVER['DOCUMENT_ROOT'] . "/LR1/Source/Images/" . $path['img_path'];
                // Удаление
                unlink($images_dir);
            }
            # Удаление записи животного из базы данных
            {
                $sql = "DELETE FROM animals WHERE id = :id";
                $statement = Database::connection()->prepare($sql);
                return $statement->execute(array('id' => $id));
            }
        }

        # Проверка существования записи с указанным номером в базе данных
        public static function CheckRecord($id) : bool{
            $sql = "SELECT id FROM animals WHERE id = :id";

            $statement = Database::connection()->prepare($sql);
            $statement->execute(array('id' => $id));

            return $statement->rowCount() == 1;
        }
    }
