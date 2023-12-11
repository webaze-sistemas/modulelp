<?php

namespace webaze\modulelp\models\managers;

use webaze\modulelp\models\User;
use yii\helpers\ArrayHelper;
use yii\web\Cookie;

class LoginManager extends User
{

    /**
     * @return false|User
     */
    public function checkUser()
    {
        /** @var User $user */
        $user = self::find()->where(['user' => $this->user])
            ->andWhere(['pass' => md5($this->pass)])
            ->andWhere(['status' => self::STATUS_ACTIVE])
            ->one();

        if ($user) {
            return $user;
        }
        return false;
    }

    public function login()
    {
        /** @var User $user */
        $user = $this->checkUser();

        if ($user) {
            $session = \Yii::$app->session;

            self::registerCookie($user->attributes, 'user_lp');

            $session->open();
            $session->set('logged', true);
            $session->set('user', $user->user);
            $session->set('name', $user->name);

            return true;
        }

        return false;
    }

    public static function registerCookie($data, $name)
    {
        $user = \Yii::$app->request->cookies->getValue($name);
        if (isset($user)) {
            \Yii::$app->response->cookies->remove($name);
        }

        $cookie  = \Yii::$app->response->cookies;
        $cookie->add(new Cookie([
            'name' => $name,
            'value' => $data,
            'expire' => time() + (60 * 60 * 24 * 30) // 30 days
        ]));

        return \Yii::$app->request->cookies->getValue($name);
    }

    public static function getIdUserCurrent()
    {
        if (\Yii::$app->request->isConsoleRequest) {
            return -1;
        }

        $cookie = \Yii::$app->request->cookies->get('user');
        if (!$cookie) {
            return -1;
        }

        return ArrayHelper::getValue($cookie->value, 'id', -1);
    }

    public static function getNameUserCurrent()
    {
        if (\Yii::$app->request->isConsoleRequest) {
            return 'Sistema';
        }

        $cookie = \Yii::$app->request->cookies->get('user');
        if (!$cookie) {
            return 'Sistema';
        }

        return ArrayHelper::getValue($cookie->value, 'name', 'Sistema');
    }

    public static function getPropertyUserCurrent($property, $default)
    {
        if (\Yii::$app->request->isConsoleRequest) {
            return $default;
        }

        $cookie = \Yii::$app->request->cookies->get('user');
        if (!$cookie) {
            return $default;
        }

        return ArrayHelper::getValue($cookie->value, $property, $default);
    }

}