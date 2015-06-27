<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;

use yii\db\ActiveRecord;

class Website extends ActiveRecord
{

    public static function getAllWebsites()
    {
       $websites = Website::find()
                            ->limit(15)  //limiting it to only 15
                            ->all();
       return $websites;
    }
}

?>


