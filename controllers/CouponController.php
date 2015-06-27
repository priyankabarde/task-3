<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * attwmpts with actionLoaddata:
 * 
 * //$result = Coupon::find()->where(['IsDeal'=>0]);
 * //$result = Coupon::findAll(array('IsDeal'=>$isdeal,'WebsiteID'=>$websiteid));  //this one works
        //$result = Coupon::find()->all();  //this one works :D
        //echo Json::encode($result);  will understand and then implement later on
 * 
 * 
 *  ////
        $criteria = new CDbCriteria;
        $criteria->condition='IsDeal=:isdeal AND WebsiteID=:websiteid';
        $criteria->params=array(':isdeal'=>$isdeal, ':websiteid'=>$websiteid);
        $result = Coupon::findAll($criteria);
 * 
        
        /*$result=Coupon::find(array('condition'=>'IsDeal=:isdeal AND WebsiteID=:websiteid',
        'params'=>array(':isdeal'=>$isdeal, ':websiteid'=>$websiteid),
        ));//
 * 
         * 
         *   //this is working for find()->all()  as it returns assoc array
       /* echo "<table>
        <tr>
        <th>CouponID</th>
        <th>Title</th>
        <th>Description</th>
        <th>Deal</th>
        </tr>";
        //while($row = mysqli_fetch_array($result)) {
        foreach($result as $row) {
            echo "<tr>";
            echo "<td>" . $row['CouponID'] . "</td>";
            echo "<td>" . $row['Title'] . "</td>";
            echo "<td>" . $row['Description'] . "</td>";
            echo "<td>" . $row['IsDeal'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";  
               
 */

namespace app\controllers;

use yii\web\Controller;
use app\models\Coupon;
use app\models\CouponCategoryInfo;
use app\models\Website;
use app\models\CouponCategories;
use yii\helpers\Json;
use yii\data\Pagination;
use PHPExcel;
//use app\models\CDbCriteria;


class CouponController extends \yii\web\Controller
{
    public function actionIndex()
    {
        /*
        $coupons1 = Coupon::find();
        $websites1 = \app\models\Website::find();
        $categories1 = \app\models\CouponCategories::find();
        
        $pagination = new Pagination([
            'defaultPageSize' => 60,
            'totalCount' => $coupons1->count(),
        ]);
        
        $coupons = $coupons1
                   ->with('website')
                   ->joinWith('couponCategories')
                   ->offset($pagination->offset)
                   ->limit($pagination->limit)
                   ->all(); //this one works and to display just 60 coupons on the main page
        
        $websites = $websites1
                   ->limit(15) //showing only 15 
                   ->all();
        
        $categories = $categories1
                      ->limit(10)  //showing only 10
                      ->all();
       */
        
        $pageSize = 60;
        $result = Coupon::getAllCoupons($pageSize);
        $coupons = $result['coupons'];
        $pagination = $result['pagination'];
        
        $websites = Website::getAllWebsites();
        $categories = CouponCategories::getAllCouponCategories();
       
              
        return $this->render('index',['coupons'=>$coupons,'pagination' => $pagination,'websites'=>$websites,'categories'=>$categories]);
    }
    
    
    public function actionLoaddata()        
    {
        $value='none'; 
        $filter = 'default';
        
        if(isset($_GET['filter']))
            $filter = strval($_GET['filter']);
        
        if(isset($_GET['value']))
            $value = intval($_GET['value']);
        
        /*
        $result1 = Coupon::find();
        
        // PENDING : Removing this as pagination is not working
        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $result1->count(),
        ]);
        
        switch($filter)
        {
            case 'type':        $result = $result1
                                        ->where("IsDeal=$value")
                                        //->offset($pagination->offset)   //  PENDING : Removing this as pagination is not working
                                        //->limit($pagination->limit)     //  PENDING : Removing this as pagination is not working
                                        ->limit(60)
                                        ->all();
                break;
            
            case 'store':       $result = $result1
                                        ->where("WebsiteID=$value") 
                                        ->with('website')  
                                        ->joinWith('couponCategories')
                                        //->offset($pagination->offset)     //  PENDING : Removing this as pagination is not working
                                        //->limit($pagination->limit)       //  PENDING : Removing this as pagination is not working
                                        ->limit(60)
                                        ->all();
                break;
            
            case 'category':    
                                $result = $result1
                                        ->where("CouponCategories.CategoryID=$value")
                                        ->with('website')
                                        ->joinWith('couponCategories')
                                        //->offset($pagination->offset)     //  PENDING : Removing this as pagination is not working
                                        //->limit($pagination->limit)       //  PENDING : Removing this as pagination is not working
                                        ->limit(60)
                                        ->all();
                break;
            
            default: $result = $result1
                               //->offset($pagination->offset)              //  PENDING : Removing this as pagination is not working
                               //->limit($pagination->limit)                //  PENDING : Removing this as pagination is not working
                               ->limit(60)
                               ->all();
            
        }*/
       
        $result = Coupon::getFilterResult($filter,$value);
        //return $this->renderPartial('loaddata',['result'=>$result,'pagination' => $pagination]);
        return $this->renderPartial('loaddata',['result'=>$result]);
        
    }
   
    public function actionDownload()
    {
        if(isset($_GET['filter']))
            $filter = strval($_GET['filter']);
        
        if(isset($_GET['value']))
            $value = intval($_GET['value']);
        
        $result = Coupon::getFilterResult($filter,$value);
        
        /*
        $result1 = Coupon::find();
        switch($filter)
        {
            case 'type':        $result = $result1
                                        ->where("IsDeal=$value")
                                        //->offset($pagination->offset)   //  PENDING : Removing this as pagination is not working
                                        //->limit($pagination->limit)     //  PENDING : Removing this as pagination is not working
                                        ->limit(60)
                                        ->all();
                break;
            
            case 'store':       $result = $result1
                                        ->where("WebsiteID=$value") 
                                        ->with('website')  
                                        ->joinWith('couponCategories')
                                        //->offset($pagination->offset)     //  PENDING : Removing this as pagination is not working
                                        //->limit($pagination->limit)       //  PENDING : Removing this as pagination is not working
                                        ->limit(60)
                                        ->all();
                break;
            
            case 'category':    
                                $result = $result1
                                        ->where("CouponCategories.CategoryID=$value")
                                        ->with('website')
                                        ->joinWith('couponCategories')
                                        //->offset($pagination->offset)     //  PENDING : Removing this as pagination is not working
                                        //->limit($pagination->limit)       //  PENDING : Removing this as pagination is not working
                                        ->limit(60)
                                        ->all();
                break;
            
            default: $result = $result1
                               //->offset($pagination->offset)              //  PENDING : Removing this as pagination is not working
                               //->limit($pagination->limit)                //  PENDING : Removing this as pagination is not working
                               ->limit(60)
                               ->all();
            
        }
        */
        // Instantiate a new PHPExcel object
        $objPHPExcel = new \PHPExcel(); 
        // Set the active Excel worksheet to sheet 0
        $objPHPExcel->setActiveSheetIndex(0); 
        
        // Iterate through each result from the SQL query in turn
        // We fetch each database result row into $row in turn
        
        
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(40);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(40);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(40);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(40);
        //Make Headings
        $objPHPExcel->getActiveSheet()
                    ->setCellValue('A1', 'S.No')
                    ->setCellValue('B1', 'Vendor')
                    ->setCellValue('C1', 'Coupon Title')
                    ->setCellValue('D1', 'Coupon Details');
        
        // Initialise the Excel row number
        $rowCount = 2; 
        foreach ($result as $row) 
        { 
            // Set cell An to the "name" column from the database (assuming you have a column called name)
            //    where n is the Excel row number (ie cell A1 in the first row)
            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $rowCount); 
            // Set cell Bn to the "age" column from the database (assuming you have a column called age)
            //    where n is the Excel row number (ie cell A1 in the first row)
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $row->website->WebsiteName);
            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $row->Title);
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $row->Description);
            // Increment the Excel row counter
            $rowCount++; 
        } 

        // Instantiate a Writer to create an OfficeOpenXML Excel .xlsx file
        $objWriter = new \PHPExcel_Writer_Excel2007($objPHPExcel); 
        // Write the Excel file to filename some_excel_file.xlsx in the current directory
        $objWriter->save('CouponData.xlsx'); 
    }
    
    
}
