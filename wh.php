<?php include('function.php') ?>
<!DOCTYPE html>
<html>

<head>
            <title>welcome </title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
            <link rel="stylesheet" href="backgroundimage.css">
        </head>
<body>
<div class="container">
<form action="" method="post">

<label for="exampleInputTitle">Package Title</label>
    <div class="form-group">
    <input  type="text" class="form-control " id="exampleInputTitle" placeholder="Title" name="Title"  >
    </div>
    <div class="form-group">
	<button name="click" type="submit"> source validation</button>
    </div>
    
</form>


<form action="" method="post">
    <div class="form-group">
	<button name="onhold" type="submit"> on hold</button>
    </div>
    
</form>


<form action="" method="post">
    <div class="form-group">
	<button name="packaging" type="submit"> back to packaging</button>
    </div>
    
</form>
</div >



<?php

if(isset($_POST['click']))
	{
        $Title= ($_POST['Title']);
    $svstart= date('Y-m-d H:i:s');
    $totalhours=24;
    $days=intval($totalhours/9);
    $remaininghour=$totalhours%9;
    $finishtime=date('Y-m-d H:i:s',strtotime('+'.$days.'day +'.$remaininghour.' hour ',strtotime($svstart)) );
    $svend=date('Y-m-d H:i:s',strtotime('+4 hour ',strtotime($svstart)) );

    $d = strtotime($finishtime);
    $endhour=date('H',$d);
    
    if($endhour >=19){
       $finalhour=15;
        $finishtime=date('Y-m-d H:i:s',strtotime('+'.$finalhour.' hour ',strtotime($finishtime)) );
      // $finishtime=date('Y-m-d H:i:s',strtotime(' +'.$finalhour.' hour ',strtotime($finishtime)) );
    }
    elseif($endhour <10){
        $finalhour=15;
        $finishtime=date('Y-m-d H:i:s',strtotime('+'.$finalhour.' hour ',strtotime($finishtime)) );
      // $finishtime=date('Y-m-d H:i:s',strtotime(' +'.$finalhour.' hour ',strtotime($finishtime)) );
    }


    echo " source validation starts with time ".$svstart."<br>" ;
    echo " packaging ends at time ".$finishtime."<br>" ;



    $query2 = "INSERT INTO wh (Title, svstart , finishtime) 
					  VALUES('$Title' , '$svstart' , '$finishtime' )";
			mysqli_query($db, $query2);
}

if(isset($_POST['onhold']))
	{
        
    $onholdtime= date('Y-m-d H:i:s');
   
    echo "on hold time start with time ".$onholdtime."<br>" ;

    $q = ("UPDATE wh SET onholdtime='$onholdtime' WHERE Title='adobe' ");
		mysqli_query($db,$q);
}


        if(isset($_POST['packaging']))
	{
        
             $onholdend= date('Y-m-d H:i:s');
            $q1="SELECT onholdtime, finishtime FROM wh ";
            $result = mysqli_query($db, $q1);
            $row = mysqli_fetch_assoc($result);

            $onholdtime=$row["onholdtime"];
            $finishtime=$row["finishtime"];

             echo "on hold time ends with time  ".$onholdend."<br>" ;
        

             $dteStart = new DateTime($onholdtime); 
             $dteEnd   = new DateTime($onholdend); 

             $dteDiff  = $dteStart->diff($dteEnd); 
            $hours= $dteDiff->format("%H"); 
            $minutes= $dteDiff->format("%I"); 

            echo $dteDiff->format("%H:%I:%S"); 

                $finishtime=date('Y-m-d H:i:s',strtotime('+'.$hours.' hour +'.$minutes.' minutes  ',strtotime($finishtime)) );

                $d = strtotime($finishtime);
                $endhour=date('H',$d);
                //$endmin=date('i',$d);
               
                
            
                if($endhour >=19){
                   $finalhour=15;
                    $finishtime=date('Y-m-d H:i:s',strtotime('+'.$finalhour.' hour ',strtotime($finishtime)) );
                  // $finishtime=date('Y-m-d H:i:s',strtotime(' +'.$finalhour.' hour ',strtotime($finishtime)) );
                }
                elseif($endhour <10){
                    $finalhour=15;
                    $finishtime=date('Y-m-d H:i:s',strtotime('+'.$finalhour.' hour ',strtotime($finishtime)) );
                  // $finishtime=date('Y-m-d H:i:s',strtotime(' +'.$finalhour.' hour ',strtotime($finishtime)) );
                }

    
                echo "packaging ends at time  ".$finishtime."<br>" ;

                $q = ("UPDATE wh SET finishtime='$finishtime' WHERE Title='adobe' ");
		mysqli_query($db,$q);
        }

  
 ?>   




</body>
</html>
