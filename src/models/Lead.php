<?php

namespace webaze\modulelp\models;

use webaze\modulelp\helpers\App;
use webaze\modulelp\helpers\NumberHelper;
use Yii;
use yii\helpers\Json;

/**
 * This is the model class for table "lead".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $message
 * @property int|null $accept_marketing_email
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $metadata
 *
 * @property string|null $phoneFormatted
 */
class Lead extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lead';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['accept_marketing_email', 'send'], 'integer'],
            [['created_at', 'updated_at', 'phoneFormatted'], 'safe'],
            [['email'], 'email'],
            [['metadata'], 'string'],
            [['name', 'email'], 'string', 'max' => 150],
            [['phone'], 'string', 'max' => 20],
            [['message'], 'string', 'max' => 1024],
            [['phoneFormatted', 'message', 'name', 'email'], 'required']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nome',
            'phone' => 'Celular/Whatsapp',
            'phoneFormatted' => 'Celular/Whatsapp',
            'email' => 'Seu melhor E-mail',
            'message' => 'Mensagem',
            'accept_marketing_email' => 'Aceita receber atualizações',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'metadata' => 'Metadata',
        ];
    }

    public function beforeSave($insert)
    {
        if ($insert) {
            $this->created_at = date('Y-m-d h:i:s');
        }

        $this->updated_at = date('Y-m-d h:i:s');
        return parent::beforeSave($insert);
    }

    public function afterFind()
    {
        $this->metadata = Json::decode($this->metadata);

        parent::afterFind();
    }

    public function getPhoneFormatted()
    {
        if (!$this->phone) {
            return null;
        }

        return App::mask('(##) #####-####', $this->phone);
    }

    public function setPhoneFormatted($value)
    {
        $this->phone = NumberHelper::numbersOnly($value);
    }
}
