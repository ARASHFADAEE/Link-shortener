<?php
require_once ('./config/loader.php');


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Link shortener</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="./assets/style.css">
</head>
<body>
<div class="container">

    <div class="box">
        <h1>Link shortener pro</h1>
        <div class="link-box">
            <form action="">

            <input class="input" type="text" placeholder="add your link">
            <br>
            
            <input class="input" type="text" value="https://localhst/app2">
            <br>
            <select class="select-fe" name="" id="">
                <option value="">directly</option>
                <option value="">indirect</option>

            </select>
            <br>
            <button class="button-submit">save</button>
        </form>

        </div>
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