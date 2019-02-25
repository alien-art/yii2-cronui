<?php

namespace alien\cronui\assets;

use yii\web\AssetBundle;

class TasksAsset extends AssetBundle
{
    public $sourcePath = __DIR__;
    public $js = [
        'manager_actions.js',
    ];
}