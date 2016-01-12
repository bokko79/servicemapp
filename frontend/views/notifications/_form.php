<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Notifications */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="notifications-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'code')->dropDownList([ 'new_req' => 'New req', 'new_req_1' => 'New req 1', 'upd_req' => 'Upd req', 'del_req' => 'Del req', 'exp_req' => 'Exp req', 'exp_req_1' => 'Exp req 1', 'succ_req' => 'Succ req', 'succ_req_1' => 'Succ req 1', 'succ_req_2' => 'Succ req 2', 'new_bid' => 'New bid', 'new_bid_1' => 'New bid 1', 'upd_bid' => 'Upd bid', 'upd_bid_1' => 'Upd bid 1', 'del_bid' => 'Del bid', 'rej_bid' => 'Rej bid', 'rep_bid' => 'Rep bid', 'awa_bid' => 'Awa bid', 'new_rev' => 'New rev', 'new_rate' => 'New rate', 'new_rate_1' => 'New rate 1', 'new_comm' => 'New comm', 'new_comm_1' => 'New comm 1', 'new_rcmnd' => 'New rcmnd', 'new_deal' => 'New deal', 'subs_deal' => 'Subs deal', 'upd_deal' => 'Upd deal', 'exp_deal' => 'Exp deal', 'del_deal' => 'Del deal', 'upd_memb' => 'Upd memb', 'exp_memb' => 'Exp memb', 'jubilee' => 'Jubilee', 'del_bid_1' => 'Del bid 1', 'exp_bid' => 'Exp bid', 'new_comm_2' => 'New comm 2', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alias2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'is_read')->textInput() ?>

    <?= $form->field($model, 'notification_time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
