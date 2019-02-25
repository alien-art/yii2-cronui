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

    public $urlPrefix = 'content';

    public $urlRules = [
        'cron'             => 'default/index',
        'cron/<action>'     => 'default/<action>',
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
