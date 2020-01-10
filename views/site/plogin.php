<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][]= $this->title;
?>
<div class="site-login">
	<?php $form = ActiveForm::begin()	?>
	
	<?= $form->field($model, 'email')->Input('logo')?>
	
	<?php ActiveForm::end(); ?>
	
</div>
