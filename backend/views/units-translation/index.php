<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\CsUnitsTranslationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cs Units Translations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cs-units-translation-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Cs Units Translation', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'unit_id',
            'lang_code',
            'name',
            'name_gen',
            // 'name_imp',
            // 'oznaka',
            // 'oznaka_imp',
            // 'ozn_htmlfree',
            // 'ozn_htmlfree_imp',
            // 'orig_name',
            // 'description',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
