<?php

namespace app\models;

use app\components\behaviors\CacheBehavior;
use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property int $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $authKey
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string $role
 * @property string $password write-only password
 * @property Activity[] $activities
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
    const EVENT_PASS_GEN = 'passgen';

    public function init()
    {
        $this->on(self::EVENT_PASS_GEN, [$this, 'generatePassword']);
        parent::init();
    }

    public function generatePassword($event)
    {
        $password = \Yii::$app->security->generateRandomString(8);
        //добавить отправку
        $this->setPassword($password);

    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%users}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            CacheBehavior::class => [
                'class'=>CacheBehavior::class,
                'cacheKey'=>self::TableName()
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            [['username', 'email'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'email', 'role'], 'string', 'max' => 255],
            [['email'], 'unique'],
        ];
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
     * Finds user by id
     *
     * @param int $id
     * @return static|null
     */
    public static function findById($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
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
        return $this->authKey;
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
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     * @param $password
     * @throws \yii\base\Exception
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
        $this->authKey = Yii::$app->security->generateRandomString();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivities()
    {
        return $this->hasMany(Activity::class, ['user_id' => 'id']);
    }

    public static function findOne($condition)
    {

        if (\Yii::$app->cache->exists(self::tableName() . "_" . $condition) === false) {
            $result = parent::findOne($condition);
            \Yii::$app->cache->set(self::tableName() . "_" . $condition, $result);
            return $result;
        } else {
            return \Yii::$app->cache->get(self::tableName() . "_" . $condition);
        }
    }
}
