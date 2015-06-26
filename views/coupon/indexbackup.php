<head>
    <script>
        
        
      /*  function handleClick(cb)
        {
            if(cb.checked)
            {
                loadType(cb);
                document.getElementById("defaultdata").innerHTML = 'Checked';
            }
           
        }*/
        
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
                //name: filter to be selected
                //value: filter value
                
                xmlhttp.open("GET","index.php?r=coupon/loaddata&filter="+cb.parentNode.getAttribute('name')+"&value="+cb.value,true);
                //xmlhttp.open("GET","index.php?r=coupon/loaddata&value="+cb.value,true); //works
                //xmlhttp.open("GET","index.php?r=coupon/loaddata",true);
                //parentNode.getAttribute('name')
                xmlhttp.send();
             }
        }
    </script>
</head>
<body onload="">
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="jumbotron" style="height:2%">
				<h4>
					Hello!<br />
                                        Welcome to CouponDunia!!
				</h4>
				
			</div>
			<div class="row">
				<div class="col-md-2">
                                        <div class="row" value="default" style="padding:5px">
						<div class="col-md-12" value="default" name="default">FILTERS<br/>
                                                    <input type="radio" name="filter" value ="none" onclick="handleClick(this);"/>&nbsp;&nbsp;SHOW ALL<br />
						</div>
					</div>
					<div class="row" value="type" style="padding:5px">
						<div class="col-md-12" value="Type" name="type">TYPE<br/>
                                                    <input type="radio" name="filter" value ="0" onclick="handleClick(this);"/>&nbsp;&nbsp;Coupons<br />
                                                    <input type="radio" name="filter" value ="1" onclick="handleClick(this);"/>&nbsp;&nbsp;Deals<br />
						</div>
					</div>
					<div class="row" value="store" style="padding:5px">
						<div class="col-md-12" value="Store" name="store">STORE<br/>	
                                                    <!-- have hardcoded website ID now. should fetch from database. -->
                                                    <input type="radio" name="filter" value ="1" onclick="handleClick(this)";/>&nbsp;&nbsp;Flipkart<br />
                                                    <input type="radio" name="filter" value ="17" onclick="handleClick(this)";/>&nbsp;&nbsp;Myntra<br />
                                                    <input type="radio" name="filter" value ="289" onclick="handleClick(this)"/>&nbsp;&nbsp;Amazon<br />
                                                    <input type="radio" name="filter" value ="80" onclick="handleClick(this)"/>&nbsp;&nbsp;Snapdeal<br />
						</div>
					</div>
					<div class="row" value="category" style="padding:5px">
						<div class="col-md-12" value="Category" name="category">CATEGORY<br/>
                                                    <input type="radio" name="filter" value ="1" onclick="handleClick(this)"/>&nbsp;&nbsp;Fashion<br />
                                                    <input type="radio" name="filter" value ="8" onclick="handleClick(this)"/>&nbsp;&nbsp;Appliances<br >
                                                    <input type="radio" name="filter" value ="17" onclick="handleClick(this)"/>&nbsp;&nbsp;Miscellaneous<br />
						</div>
					</div>
				</div>
				<div class="col-md-10" name="containermain">
                                        <div name="data" id="data">
                                        </div>
                                        <div id="defaultdata">
                                            <table class="table table-hover">
                                                    <thead>
                                                            <tr>
                                                                    <th>
                                                                            CouponID
                                                                    </th>
                                                                    <th>
                                                                            Title
                                                                    </th>
                                                                    <th>
                                                                            Description
                                                                    </th>
                                                                    <th>
                                                                            Category
                                                                    </th>
                                                                    <th>
                                                                            Website
                                                                    </th>
                                                            </tr>
                                                    </thead>
                                                    <tbody>
                                                   <?php 
                                                    foreach($coupons as $coupon)
                                                    {
                                                        echo "<tr >";
                                                        echo "  <td>";
                                                        echo $coupon->CouponID;
                                                        echo "  </td>";
                                                        echo "  <td>";
                                                        echo $coupon->Title;
                                                        echo "  </td>";
                                                        echo "  <td>";
                                                        echo $coupon->Description;
                                                        echo "  </td>";
                                                        echo "  <td>";
                                                        //echo $coupon->couponCategories->CategoryID;
                                                        //print_r($coupon);
                                                        echo "  </td>";
                                                        echo "  <td>";
                                                        echo $coupon->website->WebsiteName;
                                                        echo "  </td>";
                                                        echo "</tr>";
                                                    }
                                                   ?> 
                                                    <!--	<tr>
                                                                    <td>
                                                                            1
                                                                    </td>
                                                                    <td>
                                                                            TB - Monthly
                                                                    </td>
                                                                    <td>
                                                                            01/04/2012
                                                                    </td>
                                                                    <td>
                                                                            Default
                                                                    </td>
                                                            </tr>
                                                            <tr class="active">
                                                                    <td>
                                                                            1
                                                                    </td>
                                                                    <td>
                                                                            TB - Monthly
                                                                    </td>
                                                                    <td>
                                                                            01/04/2012
                                                                    </td>
                                                                    <td>
                                                                            Approved
                                                                    </td>
                                                            </tr>
                                                            <tr class="success">
                                                                    <td>
                                                                            2
                                                                    </td>
                                                                    <td>
                                                                            TB - Monthly
                                                                    </td>
                                                                    <td>
                                                                            02/04/2012
                                                                    </td>
                                                                    <td>
                                                                            Declined
                                                                    </td>
                                                            </tr>
                                                            <tr class="warning">
                                                                    <td>
                                                                            3
                                                                    </td>
                                                                    <td>
                                                                            TB - Monthly
                                                                    </td>
                                                                    <td>
                                                                            03/04/2012
                                                                    </td>
                                                                    <td>
                                                                            Pending
                                                                    </td>
                                                            </tr>
                                                            <tr class="danger">
                                                                    <td>
                                                                            4
                                                                    </td>
                                                                    <td>
                                                                            TB - Monthly
                                                                    </td>
                                                                    <td>
                                                                            04/04/2012
                                                                    </td>
                                                                    <td>
                                                                            Call in to confirm
                                                                    </td>
                                                            </tr>
                                                         -->
                                                    </tbody>
                                            </table>
                                        </div>
					<ul class="pagination">
						<li>
							<a href="#">Prev</a>
						</li>
						<li>
							<a href="#">1</a>
						</li>
						<li>
							<a href="#">2</a>
						</li>
						<li>
							<a href="#">3</a>
						</li>
						<li>
							<a href="#">4</a>
						</li>
						<li>
							<a href="#">5</a>
						</li>
						<li>
							<a href="#">Next</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
</body>


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
						<img alt="Carousel Bootstrap First" src="http://lorempixel.com/output/sports-q-c-1600-500-1.jpg" />
						<div class="carousel-caption">
							<h4>
								First Thumbnail label
							</h4>
							<p>
								Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.
							</p>
						</div>
					</div>
					<div class="item active">
						<img alt="Carousel Bootstrap Second" src="http://lorempixel.com/output/sports-q-c-1600-500-2.jpg" />
						<div class="carousel-caption">
							<h4>
								Second Thumbnail label
							</h4>
							<p>
								Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.
							</p>
						</div>
					</div>
					<div class="item">
						<img alt="Carousel Bootstrap Third" src="http://lorempixel.com/output/sports-q-c-1600-500-3.jpg" />
						<div class="carousel-caption">
							<h4>
								Third Thumbnail label
							</h4>
							<p>
								Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.
							</p>
						</div>
					</div>
				</div> <a class="left carousel-control" href="#carousel-118396" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a> <a class="right carousel-control" href="#carousel-118396" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
			</div>
		</div>
	</div>
</div>
