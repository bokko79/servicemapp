<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="col-md-12 landing__left-col">
	<div class="va-middle">
		<div class="col-sm-7 landing__step-content">
			<strong class="landing__step-number text-base text-branding text-light-gray">
				<span data-reactid=".1vno1zrltkw.1.0.0.$=1$false.0.2:$step-1.0.0.0.0.0.0.0.0">Step 1</span>
			</strong>
			<div class="h3 landing__step-content-title landing__subtitle-width">Start with the basics</div>
			<div class="landing__step-content-subtitle">Beds, bathrooms, amenities, and more</div>
			<span>
				<span class="" style="transition-delay:0ms;display:inline-block;">
					<?= Html::a(Yii::t('app', 'Start'), Url::to(['/presentation/'.slug($service->tName), 'trigger'=>true]), ['class'=>'btn btn-info order_service',]) ?>
				</span>
			</span>
		</div>
		<div class="col-sm-2 lys-vertical-align-middle">
			<span>
				<div class="text-center" style="transition-delay:1200ms;transition-duration:250ms;" >
					<i class="fa fa-check"></i>
				</div>
			</span>
		</div>
		<hr>
		<div>
			<div class="landing-step-collection">
				<div class="row row-condensed lys-vertical-align-middle-container">
					<div class="col-sm-10">
						<div class="va-container va-container-v va-container-h">
							<div class="va-middle">
								<div class="landing__step-content" style="transition-delay:600ms;">
									<strong class="landing__step-number text-base text-branding text-light-gray">	
									<span>Step 2</span>
									</strong>
									<div class="h3 landing__step-content-title landing__subtitle-width">Set the scene</div>
									<div class="landing__step-content-subtitle">Photos, short description, title</div>
									<div class="progress landing__progress space-top-2" role="progressbar" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100">
										<div class="progress-bar progress-bar-babu landing__progress-bar" style="width:66%;"></div>
									</div>
									<span>
										<span class="" style="transition-delay:600ms;display:inline-block;">
											<div>
												<a class="" href="/become-a-host/13569257/photos">
													<button class="btn btn-babu space-top-1 text-large"><span>Add Photos</span></button>
												</a>
											</div>
										</span>
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-2 lys-vertical-align-middle">
						<span></span>
					</div>
				</div>
			</div>
			<hr>
		</div>
		<div>
			<div class="landing-step-collection">
				<div class="row row-condensed lys-vertical-align-middle-container">
					<div class="col-sm-10">
						<div class="va-container va-container-v va-container-h">
							<div class="va-middle">
								<div class="landing__step-content" style="transition-delay: 0ms;">
									<strong class="landing__step-number text-base text-branding text-light-gray">
										<span>Step 3</span>
									</strong>
									<div class="h3 landing__step-content-title landing__subtitle-width">Get ready for guests</div>
									<div class="landing__step-content-subtitle">Price, calendar, booking settings</div>
									<div class="progress landing__progress space-top-2" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
										<div class="progress-bar progress-bar-babu landing__progress-bar" style="width:40%;"></div>
									</div>
									<span>
										<span class="" style="transition-delay: 0ms; display: inline-block;">
											<div>
												<a class="" href="/become-a-host/13569257/price">
													<button class="btn btn-babu space-top-1 text-large">
														<span>Continue</span>
													</button>
												</a>
											</div>
										</span>
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-2 lys-vertical-align-middle">
						<span></span>
					</div>
				</div>
			</div>
			<hr>
		</div>
		<span></span>
	</div>
</div>