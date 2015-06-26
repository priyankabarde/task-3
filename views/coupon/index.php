<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
//use PHPExcel;
?>
<head>
    <script>
        var filter = '';
        var value = -1;
        
        function handleClick(cb) {
           
            if (cb.value === "")
            {
                document.getElementById("data").innerHTML = "no value now";
                return;
            }
            else
            {   
                if (window.XMLHttpRequest)
                {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } 
                else
                {
                    // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function()
                {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                    {
                        document.getElementById("data").innerHTML = xmlhttp.responseText;
                        document.getElementById("defaultdata").innerHTML = '';
                    }
                    /*else
                    {
                        document.getElementById("data").innerHTML = "NO response received yet";
                    }*/
                }
                
                //updating global variables as well
                filter = cb.parentNode.getAttribute('name');
                value = cb.value;
                
                xmlhttp.open("GET","index.php?r=coupon/loaddata&filter="+filter+"&value="+value,true);
                xmlhttp.send();
             }
        }
        
        function downloadCoupons()
        {
                if (window.XMLHttpRequest)
                {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } 
                else
                {
                    // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function()
                {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                    {
                        alert("Coupons Downloaded Successfully!");
                    }
                    
                }
                
                //updating global variables as well
              
                
                xmlhttp.open("GET","index.php?r=coupon/download&filter="+filter+"&value="+value,true);
                xmlhttp.send();
             
        }
       
    </script>
</head>
<body onload="">
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="container-fluid">
                                    <div class="row">
                                            <div class="col-md-12">
                                                    <div class="page-header">
                                                            <h1>
                                                                    CouponDunia
                                                            </h1>
                                                    </div>
                                                
                                                    <div class="carousel slide" id="carousel-118396">
                                                            <ol class="carousel-indicators">
                                                                    <li data-slide-to="0" data-target="#carousel-118396">
                                                                    </li>
                                                                    <li data-slide-to="1" data-target="#carousel-118396" class="active">
                                                                    </li>
                                                                    <li data-slide-to="2" data-target="#carousel-118396">
                                                                    </li>
                                                            </ol>
                                                            <div class="carousel-inner">
                                                                    <div class="item">
                                                                            <img alt="Carousel Bootstrap First" src="http://cdn01-s3.coupondunia.in/sitespecific/in/jewels/599e14512c11f2c3fc7c5da55a77c9e3/cover-1140x355.jpg?449939" />
                                                                            <div class="carousel-caption">
                                                                                    <div class="page-header">
                                                                                            <h1>
                                                                                                    CouponDunia
                                                                                            </h1>
                                                                                    </div>
                                                                                    <h4></h4>
                                                                                    <p></p>
                                                                            </div>
                                                                    </div>
                                                                    <div class="item active">
                                                                            <img alt="Carousel Bootstrap Second" src="http://cdn01-s3.coupondunia.in/sitespecific/in/jewels/81a87aa805648e7665473b675fb480f2/cover-1140x355.jpg?574924" />
                                                                            <div class="carousel-caption">
                                                                                    <h4></h4>
                                                                                    <p></p>
                                                                            </div>
                                                                    </div>
                                                                    <div class="item">
                                                                            <img alt="Carousel Bootstrap Third" src="http://cdn01-s3.coupondunia.in/sitespecific/in/jewels/3a53b9a0192fd7611a660a8acaa3d5e1/cover-1140x355.jpg?313875" />
                                                                            <div class="carousel-caption">
                                                                                    <h4></h4>
                                                                                    <p></p>
                                                                            </div>
                                                                    </div>
                                                            </div> <a class="left carousel-control" href="#carousel-118396" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a> <a class="right carousel-control" href="#carousel-118396" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
                                                    </div>
                                                
                                            </div>
                                    </div>
                            </div>

			<div class="row">
				<div class="col-md-2">
                                        <div class="row" value="default" style='padding-bottom: 8px;border-left: solid;border-left-color: #F9F9F9;border-left-width: 4px;border-bottom: solid;border-bottom-color:#F9F9F9;border-bottom-width: 2px '>
						<div class="col-md-12" value="default" name="default"><h3>FILTERS</h3><br/>
                                                    <input type="radio" name="filter" value ="none" onclick="handleClick(this);"/>&nbsp;&nbsp;SHOW ALL<br />
						</div>
					</div>
					<div class="row" value="type" style='padding-bottom: 8px;border-left: solid;border-left-color: #F9F9F9;border-left-width: 4px;border-bottom: solid;border-bottom-color:#F9F9F9;border-bottom-width: 2px '>
						<div class="col-md-12" value="Type" name="type"><h4>TYPE</h4><br/>
                                                    <input type="radio" name="filter" value ="0" onclick="handleClick(this);"/>&nbsp;&nbsp;Coupons<br />
                                                    <input type="radio" name="filter" value ="1" onclick="handleClick(this);"/>&nbsp;&nbsp;Deals<br />
						</div>
					</div>
					<div class="row" value="store" style='padding-bottom: 8px;border-left: solid;border-left-color: #F9F9F9;border-left-width: 4px;border-bottom: solid;border-bottom-color:#F9F9F9;border-bottom-width: 2px ''>
						<div class="col-md-12" value="Store" name="store"><h4>STORE</h4><br/>	
                                                    <?php foreach ($websites as $website) {?>
                                                    <input type="radio" name="filter" value ="<?php echo $website->WebsiteID ?>" onclick="handleClick(this)";/>&nbsp;&nbsp;<?php echo $website->WebsiteName ?><br />
                                                    <?php } ?>
                                                    <!--input type="radio" name="filter" value ="1" onclick="handleClick(this)";/>&nbsp;&nbsp;Flipkart<br />
                                                    <input type="radio" name="filter" value ="17" onclick="handleClick(this)";/>&nbsp;&nbsp;Myntra<br />
                                                    <input type="radio" name="filter" value ="289" onclick="handleClick(this)"/>&nbsp;&nbsp;Amazon<br />
                                                    <input type="radio" name="filter" value ="80" onclick="handleClick(this)"/>&nbsp;&nbsp;Snapdeal<br />
                                                    <input type="radio" name="filter" value ="129" onclick="handleClick(this)"/>&nbsp;&nbsp;Make My Trip<br />
                                                    <input type="radio" name="filter" value ="159" onclick="handleClick(this)"/>&nbsp;&nbsp;GoIbibo<br />
                                                    <input type="radio" name="filter" value ="167" onclick="handleClick(this)"/>&nbsp;&nbsp;Yebhi<br />
                                                    <input type="radio" name="filter" value ="477" onclick="handleClick(this)"/>&nbsp;&nbsp;FoodPanda<br /-->
						</div>
					</div>
					<div class="row" value="category" style='padding-bottom: 8px;border-left: solid;border-left-color: #F9F9F9;border-left-width: 4px;border-bottom: solid;border-bottom-color:#F9F9F9;border-bottom-width: 2px ''>
						<div class="col-md-12" value="Category" name="category"><h4>CATEGORY</h4><br/>
                                                    <?php foreach ($categories as $category) {?>
                                                    <input type="radio" name="filter" value ="<?php echo $category->CategoryID ?>" onclick="handleClick(this)";/>&nbsp;&nbsp;<?php echo $category->Name ?><br />
                                                    <?php } ?>
                                                    <!--input type="radio" name="filter" value ="1" onclick="handleClick(this)"/>&nbsp;&nbsp;Fashion<br />
                                                    <input type="radio" name="filter" value ="8" onclick="handleClick(this)"/>&nbsp;&nbsp;Appliances<br >
                                                    <input type="radio" name="filter" value ="2" onclick="handleClick(this)"/>&nbsp;&nbsp;Travel<br >
                                                    <input type="radio" name="filter" value ="11" onclick="handleClick(this)"/>&nbsp;&nbsp;Entertainment<br >
                                                    <input type="radio" name="filter" value ="13" onclick="handleClick(this)"/>&nbsp;&nbsp;Beauty & Health<br >
                                                    <input type="radio" name="filter" value ="20" onclick="handleClick(this)"/>&nbsp;&nbsp;Recharge<br >
                                                    <input type="radio" name="filter" value ="15" onclick="handleClick(this)"/>&nbsp;&nbsp;Flowers & Gifts<br >
                                                    <input type="radio" name="filter" value ="17" onclick="handleClick(this)"/>&nbsp;&nbsp;Miscellaneous<br /-->
						</div>
					</div>
				</div>
				<div class="col-md-10" name="containermain">
                                        <div name="data" id="data">
                                        </div>
                                        <div id="defaultdata">
                                            <?php
                                            echo '<div class="container-fluid">
                                                    <table style="border-collapse: separate;border-spacing: 10px;">';
                                            foreach($coupons as $coupon) {
                                            echo '  <tr style="padding:3px"><td>
                                                    <div class="row" style="border-style:dotted;background-color:#F5F5F5">
                                                        <div class="col-md-8">
                                                                <div class="row">
                                                                        <div class="col-md-12">
                                                                                <h3>'.$coupon->website->WebsiteName.'
                                                                                </h3>
                                                                        </div>
                                                                </div>
                                                                <blockquote>
                                                                        <p>'.$coupon->Title.'
                                                                        </p> <small>'.$coupon->Description.'</small>
                                                                </blockquote>
                                                        </div>
                                                        <div class="col-md-4">

                                                                <button type="button" class="btn btn-lg btn-block" style="background-color:#0066FF;position:relative;margin-top:30%;" onclick="window.location.href=\''.$coupon->Link.'\'">
                                                                        Grab Deal!
                                                                </button>
                                                        </div>
                                                    </div>
                                                    </td></tr>';
                                            }
                                           echo"   
                                                </table>
                                            </div>'";
                                           
                                           ?>
                                            
                                           <?= LinkPager::widget(['pagination' => $pagination]) ?>
                                        </div>
                                    	<div class="col-md-1" style="position:relative;margin-left: 80%">
                                                <button type="button" class="btn btn-primary" id="downlaod" style="position:relative;" onclick="downloadCoupons()">Download Coupons</button>
                                        </div>
				</div>
                                
			</div>
                        
		</div>
	</div>
</div>
</body>