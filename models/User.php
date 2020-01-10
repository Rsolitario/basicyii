<?php

namespace app\models;
use yii;
use app\models\Usuario;

class User extends \yii\base\Object implements \yii\web\IdentityInterface
{
	public $id;
	public $email;		//por ahora es el unico que uso.
	public $foto;
	public $nombre;
	public $apellido;
	public $dni;
	public $direccion;
	public $ciudad;
	public $telefono;
	public $cuentaAlipay;
	public $qqTempay;
	public $usuarioVenmon;
	public $balance;
	public $nacimiento;
	public $saldoDiferido;
	public $authKey;
    	public $password;
	public $activo;
    	
    

    /**
     * {@inheritdoc}
     */
      /* busca la identidad del usuario a través de su $id 
	   * function usada por Yii::app->user->login(*) para determinar el usuario
	   * sobreescritura de metodo en la identityInterface usado por Yii::$app->user->isGuest() para obtener la identidad actual.
	   * */

    public static function findIdentity($id)
    {
        
        $user = Usuario::find()
                ->where("activo=:activo", [":activo" => 1])
                ->andWhere("id=:id", ["id" => $id])
                ->one();
        
        return isset($user) ? new static($user) : null;
    }
    /* Busca la identidad del usuario a través de su token de acceso */
    /**
     * {@inheritdoc}
     */
     /* Busca la identidad del usuario a través de su token de acceso */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        
        $users = Users::find()
                ->where("activate=:activate", [":activate" => 1])
                ->andWhere("accessToken=:accessToken", [":accessToken" => $token])
                ->all();
        
        foreach ($users as $user) {
            if ($user->accessToken === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
   /* Busca la identidad del usuario a través del username */		//por ahora ésta función y validatePassword estan activas.
    public static function findByUsername($email)
    { $table = new Usuario();
        $users = $table->find()
                ->where(['activo' => 1])
		->andWhere(['email' => $email])
                ->all();
       
	   
        foreach ($users as $user) {
            if (strcasecmp($user->email, $email) === 0) {
                return new static($user);
            }
        }

        return null;
       
	}

    /**
     * {@inheritdoc}
	 * funtion usada por Yii::app->user->login(*) para determinar el id
	 *sobreescribimos el metodo de la interfaz para obtener la id.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password, $email)
    {	$user = Usuario::find()
    					->where(['email' => $email])
						->one();
						echo "</br></br></br></br>".$user->password;
    	if(crypt($password, Yii::$app->params["salt"]) == $user->password){
    		return $password;
    	}
        
    }
}
