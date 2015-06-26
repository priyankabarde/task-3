<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;

use yii\db\ActiveRecord;

class Coupon extends ActiveRecord
{
    public function getWebsite() {
        return $this->hasOne(Website::className(), ['WebsiteID'=>'WebsiteID']);
        
    }
    
    public function getCouponCategories()
    {
        return $this->hasMany(CouponCategories::className(), ['CategoryID' => 'CategoryID'])
            ->viaTable('CouponCategoryInfo', ['CouponID' => 'CouponID']);
    }
    
}

