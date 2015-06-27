<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>

<?php
    //Show empty results with a message
    if(count($result)<=0)
    { ?>
        <blockquote>
                                    <p>
                                    <h1> Sorry. No coupons available right now. </h1> 
                                    </p> 
                                    <h3>
                                        Will have some soon :)  
                                    </h3>
        </blockquote>
   <?php }
    else {
 ?>

<div class="container-fluid">
       <table style="border-collapse: separate;border-spacing: 10px;">
       <?php foreach($result as $row) { ?>
              <tr style="padding:3px"><td>
                <div class="row" style="border-style:dotted;background-color:#F5F5F5;" onmouseover="highlight(this);">
                    <div class="col-md-8">
                            <div class="row">
                                    <div class="col-md-12">
                                            <h3>
                                                <?= Html::encode($row->website->WebsiteName) ?>
                                            </h3>
                                    </div>
                            </div>
                            <blockquote>
                                    <p>
                                        <?= Html::encode($row->Title);  ?>
                                    </p> 
                                    <small>
                                        <?= Html::encode($row->Description);  ?>
                                    </small>
                            </blockquote>
                    </div>
                    <div class="col-md-4" >

                            <button type="button" class="btn btn-success btn-lg btn-block" style="position:relative;margin-top:30%;" onclick=<?= Html::encode("window.location.href='".$row->Link."'"); ?>>
                                    Grab Deal!
                            </button>
                    </div>
                </div>
                 </td></tr>
        <?php }  ?>
         
            </table>
</div>

    <?php } //end of else condition?>
       