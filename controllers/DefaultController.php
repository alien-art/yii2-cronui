<?php

namespace alien\cronui\controllers;

use alien\cronui\models\search\CronSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii2tech\crontab\CronJob;
use yii2tech\crontab\CronTab;

class DefaultController extends Controller
{

    /** @inheritdoc */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class'   => VerbFilter::class,
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CronSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }

    /**
     * @return mixed
     */
    public function actionCreate()
    {
        $job = new CronJob();

        if ($job->load(Yii::$app->request->post()) && $job->validate()) {

            $cronTab = new CronTab();
            $cronTab->binPath = '/usr/bin/crontab';
            $cronTab->setJobs([
                $job
            ]);

            if ($cronTab->apply()) {
                if (Yii::$app->request->isAjax) {
                    return true;
                } else {
                    return $this->redirect(['index']);
                }
            }
        }

        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('_ajaxForm', [
                'model'   => $job,
                'is_ajax' => true,
            ]);
        } else {
            return $this->render('create', [
                'model'   => $job,
                'is_ajax' => false,
            ]);
        }
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $cronTab = new CronTab();
        $cronTab->binPath = '/usr/bin/crontab';
        $lines = $cronTab->getCurrentLines();

        $job = new CronJob();
        $job->setLine($lines[$id]);
        $lastJob = new CronJob();
        $lastJob->setLine($lines[$id]);

        if ($job->load(Yii::$app->request->post()) && $job->validate()) {
            $cronTab = new CronTab();
            $cronTab->binPath = '/usr/bin/crontab';
            $cronTab->setJobs([
                $job
            ]);

            if ($cronTab->apply()) {
              $cronTab->setJobs([
                    $lastJob
                ]);
                $cronTab->remove();
                if (Yii::$app->request->isAjax) {
                    return true;
                } else {
                    return $this->redirect(['index']);
                }
            }
        }

        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('_ajaxForm', [
                'model'   => $job,
                'is_ajax' => true,
            ]);
        } else {
            return $this->render('update', [
                'model'   => $job,
                'is_ajax' => false,
            ]);
        }
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $cronTab = new CronTab();
        $cronTab->binPath = '/usr/bin/crontab';

        $lines = $cronTab->getCurrentLines();
        $job = new CronJob();
        $job->setLine($lines[$id]);
        $cronTab->setJobs([$job]);
        $cronTab->remove();

        return $this->redirect(['index']);
    }
}
