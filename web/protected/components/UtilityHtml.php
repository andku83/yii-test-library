<?php

class UserIdentity extends CUserIdentity
{
    public static function getAdminImage($image, $path) {

        if ($image != '' && file_exists(YiiBase::getPathOfAlias('webroot') . $path . $image)) {
            return Yii::app()->request->baseUrl . $path . $image;
        } else {
            return Yii::app()->request->baseUrl . $path . 'images.jpg';
        }
    }

}