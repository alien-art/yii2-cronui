<?php

namespace alien\cronui;

/**
 * article module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'alien\cronui\controllers';

    public $urlPrefix = 'cron';

    public $urlRules = [
        'tasks'             => 'tasks/index',
        'tasks/<action>'     => 'tasks/<action>',
    ];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
