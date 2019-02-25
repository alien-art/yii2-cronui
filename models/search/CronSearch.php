<?php

namespace alien\cronui\models\search;

use yii\data\ArrayDataProvider;
use yii2tech\crontab\CronJob;
use yii2tech\crontab\CronTab;

/**
 * PageSearch represents the model behind the search form about `common\models\Page`.
 */
class CronSearch extends CronJob
{

    public function rules()
    {
        return parent::rules();
    }

    public function scenarios()
    {
        return parent::scenarios();
    }

    /**
     * @param $params
     * @return ArrayDataProvider
     */
    public function search($params)
    {
        $cronTab = new CronTab();
        $cronTab->binPath = '/usr/bin/crontab';
        $lines = $cronTab->getCurrentLines();
        $jobs = [];
        foreach ($lines as $line){
            $job = new CronJob();
            $job->setLine($line);
            $jobs[] = $job;
        }

        $pageSize = isset($params['per-page']) ? intval($params['per-page']) : \Yii::$app->params['defaultPageSize'];
        $dataProvider = new ArrayDataProvider([
            'allModels' => $jobs,
            'pagination' => ['pageSize' => ($pageSize != -1)?$pageSize:false],
        ]);

        return $dataProvider;
    }
}
