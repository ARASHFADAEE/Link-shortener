<?php
require_once ('./config/loader.php');
$create_type=true;

if (isset($_GET['url'])) $create_type=false;
if(isset($_POST['submit'])){

    try {

        //get urls
        $custom_link=$_POST['custom_link'];
        $end_link=$_POST['end_link'];
        $type=$_POST['type_link'];

        //Verification of sent requests
        if(isset($custom_link) && isset($end_link)){

            //sql query for validate custom_link
            $query="SELECT * FROM links  WHERE custom_link=?";

            //stmt
            $stmt=$conn->prepare($query);

            //bind
            $stmt->bindValue(1,$custom_link);

            $stmt->execute();

            $haslink=$stmt->rowCount();

            if($haslink){

                header('location:index.php?haslink=ok');

            }else{


                $query2=" INSERT INTO LINKS SET custom_link=?, end_link=? ,type=?";

                $stmt2=$conn->prepare($query2);

                $stmt2->bindValue(1,$custom_link);
                $stmt2->bindValue(2,$end_link);
                $stmt2->bindValue(3,$type);


                $stmt2->execute();

                header('location:index.php?link=created&url_set='.$custom_link);
            }







        //If no value is entered in the inputs, the user will encounter the error fields are empty
        }else{
            header('location:index.php?empty=true');

        }


    }catch (Exception $e){
       echo $e->getMessage();
    }
}



if(isset($_GET['url'])){

    $url_request='http://localhost/php/Link-shortener?url='.$_GET['url'];

    try {

        $query3="SELECT * FROM links WHERE custom_link=?";

        $stmt3=$conn->prepare($query3);
        $stmt3->bindValue(1,$url_request);
        $stmt3->execute();
        $has_custom_link=$stmt3->rowCount();
        $end_link_url=$stmt3->fetch(PDO::FETCH_ASSOC);
        $has_type=$end_link_url['type'];
        $end_link_url_show=$end_link_url['end_link'];

        if($has_type=='directly'){

            header('location:'.$end_link_url_show);
        }



    }catch (Exception $e){
        echo $e->getMessage();
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Link shortener</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="./assets/style.css">
</head>
<body>
<div class="container">
<?php if ($create_type==true){?>
    <div class="box">
        <h1>Link shortener pro</h1>
        <div class="link-box">
            <form method="post">

            <input name="end_link" class="input" type="text" placeholder="add your link">
            <br>
            
            <input name="custom_link" class="input" type="text" value="http://localhost/php/Link-shortener?url=">
            <br>
            <select name="type_link" class="select-fe" name="" id="">
                <option value="directly">directly</option>
                <option value="indirect">indirect</option>

            </select>
            <br>
            <button type="submit" name="submit" class="button-submit">save</button>

                <?php require_once ('./config/alerts.php');?>


        </form>

        </div>
    </div>
<?php }else {?>

        <div class="container">
<?php

            if($has_custom_link):?>
            
            <div class="ads">
                <div class="ads1">
                    <img src="https://biz-cdn.varzesh3.com/banners/2024/12/11/D/oe0a1iur.gif" alt="">
                </div>
                <div class="ads2">
                    <img src="https://biz-cdn.varzesh3.com/banners/2024/12/08/C/hjot1pej.gif" alt="">

                </div>


            </div>

                <div class="end_link">
                    <a href="<?php echo $end_link_url_show?>">
                        <button class="button-end-link"  type="button"> برای نمایش لینک کلیک کنید</button>
                    </a>
                </div>


<?php
            endif;
?>

        </div>

    <?php }?>
    <div class="container" style="width: 350px ;">
        <p class="alert alert-info">Buy a subscription to display the link without ads:</p>
        <form method="post" action="./class/payment.php" >
            <label >
                7-day subscription(20,000 toman)
            </label>
            <input name="vip" type="radio" value="7">
            <br>
            <label >
                15-day subscription(30,000 toman)
            </label>
            <input name="vip" type="radio" value="15">
            <br>
            <label >
                30-day subscription(60,000 toman)
            </label>
            <input name="vip" type="radio" value="30">
            <br>

            <button class="button-subscription" type="submit" name="submitvip">Buy subscription</button>

        </form>
    </div>
</div>

</body>
</html>

<?php
//get url
//
// get shorted link
// shorted link  is in database url

// shorted link  in database = true   alert = url is not use

//shorted link  in database = false
//
//save link and show shortlink in page
//
//




?>