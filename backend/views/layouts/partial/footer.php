<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
?>
<!-- //////////////////////////////////////////////////////////////////////////// -->

    <!-- START FOOTER -->
    <footer id="footer" class="page-footer">
        <div class="container">
            <div class="row section">
                <div class="col l6 s12">
                    <h5 class="white-text">World Market</h5>
                    <?= Html::a('<i class="fa fa-facebook fa-lg"></i>', 'https://www.facebook.com/servicemapp', ['class'=>'btn btn-link', 'target'=>'_blank']) ?>
			        <?= Html::a('<i class="fa fa-twitter fa-lg"></i>', 'https://twitter.com/servicemappSRB', ['class'=>'btn btn-link', 'style'=>'padding: 0 10px;', 'target'=>'_blank']) ?>
			        <?= Html::a('<i class="fa fa-google-plus fa-lg"></i>', 'https://plus.google.com/111378181200148646566/', ['class'=>'btn btn-link', 'target'=>'_blank'])  ?>
                </div>
                <div class="col l4 offset-l2 s12">
                    <h5 class="white-text">Sales by Country</h5>
                    <p class="grey-text text-lighten-4">A sample polar chart to show sales by country.</p>
                    <ul class="">
						<li><?= Html::a('Services', ['/index'], ['class'=>'', 'target'=>'_blank']) ?></li>
						<li><?= Html::a('Market', ['/index'], ['class'=>'', 'target'=>'_blank']) ?></li>
						<li><?= Html::a('Providers', ['/index'], ['class'=>'', 'target'=>'_blank']) ?></li>
						<li><?= Html::a('Info', ['/index'], ['class'=>'', 'target'=>'_blank']) ?></li>
						<li><?= Html::a('Kontakt', ['/site/contact-us'], ['class'=>'', 'target'=>'_blank']) ?></li>
					</ul>
					<?= Html::img(Yii::$app->homeUrl.'images/logo/logo46.png', ['alt'=>'Servicemapp Logo', 'width'=>80]) ?>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container">
                Copyright &copy; <?php echo date('Y'); ?> by Masterplan ARC. All rights reserved.                
            </div>
        </div>
    </footer>
    <!-- END FOOTER -->