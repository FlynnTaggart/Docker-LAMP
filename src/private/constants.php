<?php

class LANGUAGE {
    public static $RU = "ru";
    public static $EN = "en";
}

class THEME {
    public static $LIGHT = "light";
    public static $DARK = "dark";
}

abstract class ABS_DICTIONARY {
    public $TITLE;

    public $SETTINGS;
    public $THEME;
    public $LIGHT;
    public $DARK;
    public $LANGUAGE;
    public $NICKNAME;
    public $SAVE;

    public $RESTAURANT_TITLE;
    public $ADD_ORDER_TITLE;
    public $CLIENT_NAME;
    public $FIRST;
    public $SECOND;
    public $DRINK;
    public $COST;
    public $ADD;
    public $DELETE_ORDER_TITLE;
    public $DELETE;
    public $ID;

    public $EXEC_TITLE;
    public $COMMAND;
    public $EXECUTE;
    public $ERROR;

    public $UPLOAD_FILE_TITLE;
    public $CHOOSE;
    public $SUBMIT_FILE;
    public $UPLOADED_FILES;
    public $FILE_ERROR;
}

class RU_DICTIONARY extends ABS_DICTIONARY {
    public $TITLE = "Панель администратора";

    public $SETTINGS = "Настройки";
    public $THEME = "Тема";
    public $LIGHT = "Светлая";
    public $DARK = "Тёмная";
    public $LANGUAGE = "Язык";
    public $NICKNAME = "Никнейм";
    public $SAVE = "Сохранить";

    public $RESTAURANT_TITLE = "Ресторан";
    public $ADD_ORDER_TITLE = "Добавить заказ";
    public $CLIENT_NAME = "Имя клиента";
    public $FIRST = "Первое блюдо";
    public $SECOND = "Второе блюдо";
    public $DRINK = "Напиток";
    public $COST = "Цена";
    public $ADD = "Добавить";
    public $DELETE_ORDER_TITLE = "Удалить заказ";
    public $DELETE = "Удалить";
    public $ID = "ИД";

    public $EXEC_TITLE = "Выполение команд";
    public $COMMAND = "Введите команду";
    public $EXECUTE = "Выполнить";
    public $ERROR = "Неизвестная или неверная команда";

    public $UPLOAD_FILE_TITLE = "Загрузить файлы";
    public $CHOOSE = "Выбрать";
    public $SUBMIT_FILE = "Загрузить";
    public $UPLOADED_FILES = "Загруженные файлы";
    public $FILE_ERROR = "Попытка взлома";
}


class EN_DICTIONARY extends ABS_DICTIONARY {
    public $TITLE = "Admin panel";

    public $SETTINGS = "Settings";
    public $THEME = "Theme";
    public $LIGHT = "Light";
    public $DARK = "Dark";
    public $LANGUAGE = "Language";
    public $NICKNAME = "Nickname";
    public $SAVE = "Save";

    public $RESTAURANT_TITLE = "Restaurant";
    public $ADD_ORDER_TITLE = "Add order";
    public $CLIENT_NAME = "Client name";
    public $FIRST = "First dish";
    public $SECOND = "Second dish";
    public $DRINK = "Drink";
    public $COST = "Cost";
    public $ADD = "Add";
    public $DELETE_ORDER_TITLE = "Delete order";
    public $DELETE = "Delete";
    public $ID = "ID";

    public $EXEC_TITLE = "Command executor";
    public $COMMAND = "Enter Command";
    public $EXECUTE = "Execute";
    public $ERROR = "Wrong or not allowed command";

    public $UPLOAD_FILE_TITLE = "Upload files";
    public $CHOOSE = "Choose";
    public $SUBMIT_FILE = "Upload";
    public $UPLOADED_FILES = "Uploaded files";
    public $FILE_ERROR = "Violation attempt";
}

$DICTIONARY = [
    "ru" => new RU_DICTIONARY,
    "en" => new EN_DICTIONARY,
];

$uploaddir = '/var/www/my-html/uploads/';


