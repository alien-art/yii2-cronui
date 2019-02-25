<?php

namespace alien\cronui;

use Yii;
use yii\base\BootstrapInterface;
use yii\web\GroupUrlRule;

/**
 * Bootstrap class registers module and user application component. It also creates some url rules which will be applied
 * when UrlManager.enablePrettyUrl is enabled.
 *
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        /** @var Module $module */
        /** @var \yii\db\ActiveRecord $modelName */
        if ($app->hasModule('cron') && ($module = $app->getModule('cron')) instanceof Module) {

            $configUrlRule = [
                   'prefix' => $module->urlPrefix,
                    'rules'  => $module->urlRules,
                ];

                if ($module->urlPrefix != 'cron') {
                    $configUrlRule['routePrefix'] = 'cron';
                }

                $app->urlManager->addRules([new GroupUrlRule($configUrlRule)], false);
        }
    }
}
