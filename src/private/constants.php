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
    public $EXEC_TITLE;
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
    public $EXEC_TITLE = "Выполение команд";
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
    public $EXEC_TITLE = "Command executor";
}

$DICTIONARY = [
    "ru" => new RU_DICTIONARY,
    "en" => new EN_DICTIONARY,
];

