<?php
namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Usuario;

class Login extends \yii\base\Object implements \yii\web\IdentityInterface 
{
	public $id;
	public $nombre;
	public $apellido;
	public $email;
	public $image;
	public $password;
	public $activo;
	
	public static function findIdentity($porEmail)
	{
		$user = Login::find()
				->where("email=:email", [":email" => $porEmail])
				->one();
		return isset($user) ? new static( $user ) : NULL;			
	}
}
