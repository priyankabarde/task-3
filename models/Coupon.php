<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;

use yii\db\ActiveRecord;
use yii\data\Pagination;

class Coupon extends ActiveRecord
{
    public function getWebsite()
    {
        return $this->hasOne(Website::className(), ['WebsiteID'=>'WebsiteID']);
        
    }
    
    public function getCouponCategories()
    {
        return $this->hasMany(CouponCategories::className(), ['CategoryID' => 'CategoryID'])
            ->viaTable('CouponCategoryInfo', ['CouponID' => 'CouponID']);
    }
    
    public static function getFilterResult($filter,$value)
    {
        $result1 = Coupon::find();
        switch($filter)
        {
            case 'type':        $result = $result1
                                        ->where("IsDeal=$value")
                                        ->limit(60)
                                        ->all();
                break;
            
            case 'store':       $result = $result1
                                        ->where("WebsiteID=$value") 
                                        ->with('website')  
                                        ->joinWith('couponCategories')
                                        ->limit(60)
                                        ->all();
                break;
            
            case 'category':    
                                $result = $result1
                                        ->where("CouponCategories.CategoryID=$value")
                                        ->with('website')
                                        ->joinWith('couponCategories')
                                        ->limit(60)
                                        ->all();
                break;
            
            default: $result = $result1
                               ->limit(60)
                               ->all();
            
        }
        return $result;
    }
    
    public static function getAllCoupons($pageSize = '100')
    {
        $coupons1 = Coupon::find();
        
        $pagination = new Pagination([
            'defaultPageSize' => $pageSize,
            'totalCount' => $coupons1->count(),
        ]);
        
        $coupons = $coupons1
                   ->with('website')
                   ->joinWith('couponCategories')
                   ->offset($pagination->offset)
                   ->limit($pagination->limit)
                   ->all(); //this one works and to display just 60 coupons on the main page
        
        return ([
                    'coupons'=>$coupons,
                    'pagination'=>$pagination
            ]);
    }
}

