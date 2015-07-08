
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
                filter = cb.parentNode.getAttribute('value');
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
       
