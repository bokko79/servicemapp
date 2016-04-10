<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CsUnitsTranslation */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Cs Units Translations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cs-units-translation-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'unit_id',
            'lang_code',
            'name',
            'name_gen',
            'name_imp',
            'oznaka',
            'oznaka_imp',
            'ozn_htmlfree',
            'ozn_htmlfree_imp',
            'orig_name',
            'description',
        ],
    ]) ?>

</div>
