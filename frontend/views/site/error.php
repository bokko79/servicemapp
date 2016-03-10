<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        Greška iznad se pojavila dok je server obrađivao Vaš zahtev.
    </p>
    <p>
        Molimo Vas da nas kontaktirate ukoliko smatrate da je ovo serverska greška. Hvala mnogo.
    </p>

</div>
