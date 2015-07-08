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
    public static $lastresult=null;
    
    public function getWebsite()
    {
        return $this->hasOne(Website::className(), ['WebsiteID'=>'WebsiteID']);
        
    }
    
    public function getCouponCategories()
    {
        return $this->hasMany(CouponCategories::className(), ['CategoryID' => 'CategoryID'])
            ->viaTable('CouponCategoryInfo', ['CouponID' => 'CouponID']);
    }
    
    public function getFilterResult($filter,$value)
    {
        $filterValue;
        switch($filter)
        {
            case 'type':        $filterValue = 'IsDeal';
                                break;
            
            case 'store':       $filterValue = 'WebsiteID';
                                break;
            
            case 'category':    $filterValue = 'CouponCategories.CategoryID';
                                break;
            
            default:            $result = $this->getAllCoupons();
                                return $result['coupons'];
                        
            
        }
        $result = Coupon::findByCondition(["$filterValue" => $value])
                        ->with('website')
                        ->joinWith('couponCategories')
                        ->limit(60)
                        ->all();
        
        return $result;
    }
    
    //cannot make this function static because updating class attribute in it.
    public function getAllCoupons($pageSize = '100')
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
        
         //$this->lastresult = $coupons;
        return ([
                    'coupons'=>$coupons,
                    'pagination'=>$pagination
            ]);
    }
}

