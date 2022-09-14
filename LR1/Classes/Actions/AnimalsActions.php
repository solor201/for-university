<?php

    class AnimalsActions
    {
        # Получение данных по отдельному животному
        public static function GetRecord($id) : ?array{
            if (is_numeric($id) && AnimalsTable::CheckRecord($id))
                return AnimalsTable::GetRecord($id);
            else
                return NULL;
        }

        # Удаление животного из базы данных
        public static function DeleteRecord($id) : bool{
            if (is_numeric($id) && AnimalsTable::CheckRecord($id))
                return AnimalsTable::DeleteRecord($id);
            else
                return false;
        }

        # Добавление животного в базу данных
        public static function AddRecord($id_owner, $name, $description, $year_of_birth) : ?array{
            $error_messages = self::GeneralValidation($id_owner, $name, $description, $year_of_birth);

            if (isset($_FILES['image'])){
                if (empty($_FILES['image']['tmp_name']))
                    $error_messages['image'] = "Вы не отправили файл";
                else if (!preg_match('/[а-яёА-ЯЁa-zA-Z0-9&_.,-]+(img|png|gif|jpg)$/u', $_FILES['image']['name']))
                    $error_messages['image'] = "Ожидалось расширение типа img|png|gif";
            }

            if (count($error_messages) == 0){
                # Сохранение загруженной фотографии на сервере
                self::SaveImage();
                return array(AnimalsTable::AddRecord($id_owner, $name, $description, $year_of_birth, $_FILES['image']['name']));
            }
            else
                return $error_messages;
        }

        # Изменение животного в базе данных
        public static function EditRecord($id, $id_owner, $name, $description, $year_of_birth) : ?array{
            $error_messages = self::GeneralValidation($id_owner, $name, $description, $year_of_birth);

            if (!empty($_FILES['image']['name'])){
                if (!preg_match('/[а-яёА-ЯЁa-zA-Z0-9&_.,-]+(img|png|gif|jpg)$/u', $_FILES['image']['name']))
                    $error_messages['image'] = "Ожидалось расширение типа img|png|gif";
            }

            if (count($error_messages) == 0){
                if (!empty($_FILES['image']['name']))
                    # Сохранение загруженной фотографии на сервере
                    self::SaveImage();

                return array(AnimalsTable::EditRecord($id, $id_owner, $name, $description, $year_of_birth, $_FILES['image']['name'] ?? null));
            }
            else
                return $error_messages;
        }

        # Сохранение изображения
        private static function SaveImage() {
            $upload_dir = $_SERVER['DOCUMENT_ROOT'] . "/LR1/Source/Images/";
            $new_name = $upload_dir . $_FILES['image']['name'];

            move_uploaded_file($_FILES['image']['tmp_name'], $new_name);

            $handle = fopen($new_name, 'r');
            $content = fread($handle, filesize($new_name));
            fclose($handle);
        }

        # Проверка введенных пользователем значений
        private static function GeneralValidation($id_owner, $name, $description, $year_of_birth) :?array{
            $error_messages = array();
            $pattern = '/[а-яёА-ЯЁa-zA-Z0-9&\s.,-]+$/u';

            if (!is_numeric($id_owner) || !AnimalOwnersTable::CheckRecord($id_owner))
                $error_messages['id_owner'] = "Вы выбрали неподходящего владельца";

            if (empty($name))
                $error_messages['name'] = "Вы не ввели кличку животного";
            else if (!preg_match($pattern, $name))
                $error_messages['name'] = "Кличка животного содержит неподходящие символы";

            if (empty($description))
                $error_messages['description'] = "Вы не описали животное";
            else if (!preg_match($pattern, $description))
                $error_messages['description'] = "Описание животного содержит неподходящие символы";

            if (empty($year_of_birth))
                $error_messages['year_of_birth'] =  "Вы не ввели дату рождения";
            else if (!is_numeric($year_of_birth))
                $error_messages['year_of_birth'] = "Ошибка, вы ввели не число";
            else if ($year_of_birth < 0)
                $error_messages['year_of_birth'] = "Ошибка, вы ввели отрицательное число";
            else if (intval($year_of_birth) > date("Y") ||
                date("Y") - intval($year_of_birth) > 30
            )
                $error_messages['year_of_birth'] = "Ошибка, неподходящий возраст";

            return $error_messages;
        }
    }