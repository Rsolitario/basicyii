<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = "couldTM.com | tu cajero en la nube";
$this->params['breadcrumbs'][] = $this->title;

?>
   <?php
	if(isset($msn)){
		echo "<h1>".Html::encode($msn)."</h1>";
		}
	?>
<div class="site-register">
	<?php $form = ActiveForm::begin([
		'method' 				=> 'post',
		'id' 					=> 'registro',
		'enableClientValidation'=> false,
		'enableAjaxValidation'	=> true,
	]);?>
		<?= $form->field($model,'nombre') ?>
		
		<?= $form->field($model,'apellido') ?>
		
		<?= $form->field($model,'email') ?>
		
		<?= $form->field($model, 'password')->passwordInput() ?>
		
		<?= $form->field($model,'confirmarPassword') ->passwordInput()?>
	<div class="form-group">
		<?= Html::submitButton('enviar', ['class' => 'btn btn-primary']) ?>
	</div> 
	<?php ActiveForm::end(); ?>
</div>
   
