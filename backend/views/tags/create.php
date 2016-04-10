<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CsTags */

$this->title = 'Create Cs Tags';
$this->params['breadcrumbs'][] = ['label' => 'Cs Tags', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cs-tags-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
