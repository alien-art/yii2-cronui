<?php

use yii\grid\GridView;
use yii\helpers\Html;
use common\components\accessControl\Helper;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\web\View;


/**
 * @var $this         yii\web\View
 * @var $searchModel  \backend\models\search\PageSearch
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $model        common\models\Page
 */

$this->title = Yii::t('message', 'Cron');

$this->params['breadcrumbs'][] = $this->title;

\yii\widgets\ActiveFormAsset::register($this);
?>

<p>
    <?= (Helper::checkRoute(Url::toRoute(['create']))) ? Html::a("<i class=\"fa fa-plus\" aria-hidden=\"true\"></i>
 ".Yii::t('mesages', 'Create'), ['create'], ['class' => 'btn btn-success',
        'data' => [
            'target' => '#cronModalForm',
            'toggle' => 'modal',
        ]]) : ''?>
</p>

<?php Pjax::begin(['id' => 'cronData', 'enablePushState' => false, 'timeout' => 30000]) ?>
<?php echo GridView::widget([
    'id' => 'cronTable',
    'dataProvider' => $dataProvider,
    'options' => [
        'class' => 'grid-view table-responsive',
    ],
    'filterSelector' => "select[name='".$dataProvider->getPagination()->pageSizeParam."'],input[name='".$dataProvider->getPagination()->pageParam."']",
    'layout' => "<div id=\"datatable2_filter\" class=\"dataTables_filter\">{summary}</div>\n{items}\n{pager}",
    'pager' => [
        'class' => \alien\PageSize\PageSize::class,
    ],
    'columns' => [
        [
            'attribute' => 'min',
        ],
        [
            'attribute' => 'hour',
        ],
        [
            'attribute' => 'day',
        ],
        [
            'attribute' => 'month',
        ],
        [
            'attribute' => 'weekDay',
        ],
        [
            'attribute' => 'year',
        ],
        [
            'attribute' => 'command',
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => Helper::filterActionColumn('{update} {delete}'),
            'buttons' => [
                'update' => function ($url, $model, $key) {
                    $options = [
                        'title' => Yii::t('yii', 'Update'),
                        'aria-label' => Yii::t('yii', 'Update'),
                        'data-pjax' => '0',
                        'data' => [
                            'target' => '#cronModalForm',
                            'toggle' => 'modal',
                        ]
                    ];
                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, $options);
                },
            ],
        ],
    ],
]);
Pjax::end();
echo \backend\widgets\dynamicModal\DynModalWidget::widget(['id' => 'cronModalForm']);

$customJs = <<< JS
$("body").on("hidden.bs.modal", "#cronModalForm", function() {
    $(this).data("bs.modal", null);
    var modal = $(this);
    $.pjax.reload({container: "#cronData"});
    
});
JS;

$this->registerJs($customJs, View::POS_END);
?>
