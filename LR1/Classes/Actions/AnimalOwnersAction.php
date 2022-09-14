<?php

    class AnimalOwnersAction
    {
        # Получение данных по отдельному владельцу животного
        public static function GetRecord($id_owner) : ?array{
            if (is_numeric($id_owner) && AnimalOwnersTable::CheckRecord($id_owner))
                return AnimalOwnersTable::GetRecord($id_owner);
            else
                return NULL;
        }

        # Удаление владельца и всех его животных
        public static function DeleteRecord($id_owner) : bool{
            if (is_numeric($id_owner) && AnimalOwnersTable::CheckRecord($id_owner))
                return AnimalOwnersTable::DeleteRecord($id_owner);
            else
                return false;
        }

        # Добавление клиента в базу данных
        public static function AddRecord($name) : ?array{
            $error_messages = self::GeneralValidation($name);

            if (count($error_messages) == 0)
                return array(AnimalOwnersTable::AddRecord($name));
            else
                return $error_messages;
        }

        # Изменение данных клиента
        public static function EditRecord($id_owner, $name) : ?array{
            $error_messages = self::GeneralValidation($name);

            if (count($error_messages) == 0)
                return array(AnimalOwnersTable::EditRecord($id_owner, $name));
            else
                return $error_messages;
        }

        # Проверка введенных пользователем значений
        private static function GeneralValidation($name) :?array{
            $error_messages = array();
            $pattern = '/[а-яёА-ЯЁa-zA-Z0-9&\s.,-]+$/u';

            if (empty($name))
                $error_messages['name'] = "Вы не ввели имя клиента";
            else if (!preg_match($pattern, $name))
                $error_messages['name'] = "ФИО клиента содержит неподходящие символы";

            return $error_messages;
        }
    }