<?php 
echo $model->activity->user->username . '<br><br>';

//echo Yii::$app->user->role;

echo '<pre>';
$auth = Yii::$app->authManager;
print_r($auth->getRolesByUser(Yii::$app->user->id));
echo '</pre>';
?>