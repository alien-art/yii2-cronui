<?php
namespace app\commands;

use app\models\Task;
use mult1mate\crontab\TaskRunner;
use yii\console\Controller;

class CronController extends Controller
{
    public function actionCheckTasks()
    {
        TaskRunner::checkAndRunTasks(Task::getAll());
    }
}
