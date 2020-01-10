<?php

namespace app\models;

use yii\base\Model;
use app\models\Usuario;

class Registro extends Model
{
	public $nombre;
	public $apellido;
	public $email;
	public $password;
	public $confirmarPassword;
	
	public function rules()
	{	return [
			[['nombre','apellido', 'email', 'password', 'confirmarPassword'],'required', 'message' => 'Campo requerido'],
			['nombre', 'string', 'max' => 20, 'message' => 'Limite maximo de 20 caracteres'],
			['nombre','match','pattern'=> '/^[a-záéíóúñ\s]+$/i','message' => 'solo se acepta letras'],
			['apellido', 'string', 'max' => 20, 'message' => 'limite maximo de 20 caracteres'],
			['apellido','match','pattern'=> '/^[a-záéíóúñ\s]+$/i','message' => 'solo se acepta letras'],
			['email','email','message' => 'Email no valido'],
			['email','email_existe'],
			['password','string','min' => 8 ,'max' => 15, 'message' => 'La clave debe tener entre 8 y 15 caracteres'],
			['confirmarPassword','compare','compareAttribute' => 'password', 'message' => 'Los password no coinciden'],
		];
		//versiones alternativas de validaciòn de atributos.
		//['confirmarPassword','validatePassword'],
	}
	public function validatePassword($attribute, $params)							
	{ 
		if( $this->confirmarPassword == $this->password ){
			
			$this->addError($attribute,"Las contraseñas no coinciden.");
		}
	}
	public function email_existe($attribute, $params)
	{
		$table = Usuario::find()->where("email=:email", [":email" => $this->email]);
		if ($table->count() == 1){
			$this->addError($attribute, "El email ya se encuentra registrado");
		}
	}
}
