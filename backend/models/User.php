<?php

namespace backend\models;

use backend\modules\rbac\models\AuthAssignmentModel;
use common\models\Category;
use common\models\Note;
use common\models\Post;
use Yii;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "admin".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $last_enter
 *
 * @property Category[] $categories
 * @property Category[] $categories0
 * @property Note[] $notes
 * @property Note[] $notes0
 * @property Post[] $posts
 * @property Post[] $posts0
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    const STATUS_IN_ACTIVE = 0;
    const STATUS_ACTIVE = 1;

    public $password;
    public $confirm_password;
    public $list_roles;

    static $list_status = [];

    public function init()
    {
        parent::init();

        self::$list_status = [
            self::STATUS_IN_ACTIVE => Yii::t('app', 'Not active'),
            self::STATUS_ACTIVE    => Yii::t('app', 'Active'),
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_IN_ACTIVE]],

            [['username', 'email'], 'required'],
            [['email'], 'email'],
            [['email'], 'unique'],
            [['username', 'email'], 'string', 'max' => 255],

            ['password', 'required', 'on' => ['create', 'login']],
            //['confirm_password', 'confirmPassword', 'skipOnEmpty' => true, 'on' => ['update', 'last_enter']],
            [
                ['confirm_password'], 'compare', 'compareAttribute' => 'password',
                                                 'when' => function ($model) {
                                                     return $model->password;
                                                 },
                                                 'whenClient' => "function(attribute, value) {
                    return $('#user-password').val() !== '';
                }",
                                                 'on' => ['create', 'update']
            ],
            [
                ['confirm_password'], 'required',
                'when' => function ($model) {
                    return !empty($model->password) && !$model->isNewRecord;
                },
                'whenClient' => "function (attribute, value) {
                    return $('#user-password').val() != '';
                }",
                'except' => 'last_enter'
            ],

            [['created_at', 'updated_at', 'list_roles', 'password', 'last_enter'], 'safe'],
        ];
    }

    /**
     * @param $attribute
     */
    public function confirmPassword($attribute)
    {
        if ($this->password !== $this->confirm_password) {
            $this->addError($attribute, Yii::t('app', 'Passwords do not match'));
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'               => Yii::t('app', 'ID'),
            'username'         => Yii::t('app', 'Username'),
            'email'            => Yii::t('app', 'Email'),
            'status'           => Yii::t('app', 'Status'),
            'password'         => Yii::t('app', 'Password'),
            'confirm_password' => Yii::t('app', 'Confirm password'),
            'created_at'       => Yii::t('app', 'Date created'),
            'updated_at'       => Yii::t('app', 'Date updated'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['creator_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories0()
    {
        return $this->hasMany(Category::className(), ['editor_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotes()
    {
        return $this->hasMany(Note::className(), ['creator_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotes0()
    {
        return $this->hasMany(Note::className(), ['editor_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['creator_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts0()
    {
        return $this->hasMany(Post::className(), ['editor_id' => 'id']);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by username
     *
     * @param string $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status'               => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int)substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * @return \yii\rbac\Role[]
     */
    public static function getAllRoles()
    {
        return Yii::$app->authManager->getRoles();
    }

    /**
     * @inheritdoc
     */
    public function setListRoles()
    {
        foreach ($this->roles as $role) {
            $this->list_roles[$role->item_name] = $role->item_name;
        }
    }

    /**
     * @param bool $insert
     * @return bool
     * @throws \yii\base\Exception
     * @throws \yii\base\InvalidConfigException
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->setPassword($this->password);
                $this->generateAuthKey();
                $this->created_at = time();
            } else {
                if ($this->scenario === 'update' && !empty($this->password)) {
                    $this->setPassword($this->password);
                    unset($this->password);
                }

                $this->updated_at = time();
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param bool $insert
     * @param array $changedAttributes
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::AfterSave($insert, $changedAttributes);

        if (Yii::$app->controller->id === 'administrator' || $this->scenario !== 'last_enter') {
            AuthAssignmentModel::deleteAll(['user_id' => $this->id]);

            if (is_array($this->list_roles)) {
                foreach ($this->list_roles as $role) {
                    $this->setAssignment($role);
                }
            } else {
                $this->setAssignment($this->list_roles);
            }
        }
    }

    /**
     * @return bool
     */
    public function saveDateLastEnter()
    {
        $this->scenario = 'last_enter';
        $this->last_enter = time();

        return $this->save();
    }

    /**
     * @param $role
     */
    protected function setAssignment($role)
    {
        $model = new AuthAssignmentModel();
        $model->item_name = $role;
        $model->user_id = (string)$this->id;
        $model->created_at = time();
        $model->save();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoles()
    {
        return $this->hasMany(AuthAssignmentModel::className(), ['user_id' => 'id']);
    }
}
