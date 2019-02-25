# yii2-cronui

Модуль Web интерфейса для управления системным cron

Установка
------------

Предпочтительно устанавливать через [composer](http://getcomposer.org/download/).

Выедите в командной строке

```
php composer.phar require --prefer-dist alien/yii2-cronui "*"
```

или добавьте

```
"alien/yii2-cronui": "*"
```

в секцию require  вашего `composer.json` файла.

Подключаем данный модуль в приложение и пользуемся интерфейс доступен по даресу
`cron\tasks` при наличии настроеного UrlManager