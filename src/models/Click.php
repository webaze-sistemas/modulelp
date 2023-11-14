<?php

namespace webaze\modulelp\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Cookie;
use yii\web\Session;

/**
 * This is the model class for table "click".
 *
 * @property int $id
 * @property string|null $metadata
 * @property int|null $lead_id
 * @property string|null $created_at
 */
class Click extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'click';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['metadata'], 'safe'],
            [['lead_id'], 'string'],
            [['created_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'metadata' => 'Metadata',
            'lead_id' => 'Lead ID',
            'created_at' => 'Created At',
        ];
    }

    public function beforeSave($insert)
    {
        if ($insert) {
            $this->created_at = date('Y-m-d h:i:s');
        }

        $this->metadata = Json::encode($this->metadata);
        return parent::beforeSave($insert);
    }

    public function afterFind()
    {
        $this->metadata = Json::decode($this->metadata);

        parent::afterFind();
    }

    public static function getOrSetCookie($value = '')
    {
        $request = Yii::$app->request->cookies;
        $visitorId = $request->getValue('visitor_id');

        if ($visitorId !== null && !$value) {
            return  $visitorId;
        }

        if (!$value) {
            $value = (string) rand();
        }

        $cookies = Yii::$app->response->cookies;
        $cookies->add(new Cookie([
            'name' => 'visitor_id',
            'value' => $value,
            'expire' => time() + 3600
        ]));

        return $value;
    }

    public static function saveClick($params, $update = false)
    {
        $cookie = self::getOrSetCookie();

        if (count($params) == 0) {
            $params['utm_source'] = 'organico';
            if (!$update) {
                $params['lead_id'] = $cookie;
            }
        }

        if ($update) {
            self::getOrSetCookie($params['lead_id']);
        }

        $params['lead_id'] = $cookie;

        $params['ip'] = $_SERVER['REMOTE_ADDR'] ?? '';

        if (!$model = self::findOne(['lead_id' => $cookie])) {
            $model = new Click();
        }

        $clickLoad = [];
        $clickLoad['metadata'] = array_merge($params, $model->metadata ?? []);
        $clickLoad['lead_id'] = $params['lead_id'];

        $model->load($clickLoad, '');
        $model->save();
    }
}
