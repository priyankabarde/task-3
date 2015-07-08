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
        $model = new Coupon;
        $pageSize = 60;
        $couponData = $model->getAllCoupons($pageSize);
        $result = $couponData['coupons'];
        $pagination = $couponData['pagination'];
        
        $websites = Website::getAllWebsites();
        $categories = CouponCategories::getAllCouponCategories();
         
        //Coupon::$lastresult = $result;
        return $this->render('index',['coupons'=>$result,'pagination' => $pagination,'websites'=>$websites,'categories'=>$categories]);
    }
    
    
    public function actionLoaddata()        
    {
        $model = new Coupon;
        $value='none'; 
        $filter = 'default';
        
        if(isset($_GET['filter']))
            $filter = strval($_GET['filter']);
        
        if(isset($_GET['value']))
            $value = intval($_GET['value']);
        
        $result = $model->getFilterResult($filter,$value);
        //Coupon::$lastresult = $result;
        return $this->renderPartial('loaddata',['result'=>$result]);
        
    }
   
    public function actionDownload()
    {   
        $model = new Coupon;
        if(isset($_GET['filter']))
           $filter = strval($_GET['filter']);
        
        if(isset($_GET['value']))
          $value = intval($_GET['value']);
        
        $result = $model->getFilterResult($filter,$value);
        //$result = Coupon::$lastresult;
        // Instantiate a new PHPExcel object
        $objPHPExcel = new \PHPExcel(); 
        // Set the active Excel worksheet to sheet 0
        $objPHPExcel->setActiveSheetIndex(0); 
        
        // Iterate through each result from the SQL query in turn
        // We fetch each database result row into $row in turn
        
        
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(4);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
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
            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $rowCount-1); 
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
?>