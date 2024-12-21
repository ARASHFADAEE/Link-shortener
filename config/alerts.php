
<?php if(isset($_GET['haslink']) && $_GET['haslink']=='ok'):?>
    <div class="alert alert-danger alert_custom " >
        <p>This link is already registered</p>
    </div>
<?php endif;?>

<?php if(isset($_GET['empty']) && $_GET['empty']=='true'):?>
    <div class="alert alert-danger alert_custom " >
        <p>Please fill in all fields</p>
    </div>
<?php endif;?>

<?php if(isset($_GET['link']) && $_GET['link']=='created'):?>
    <div class="alert alert-success alert_custom " >
        <p>link created</p>
        <a href="<?php echo $_GET['url_set']?>"><?php echo $_GET['url_set']?></a>
    </div>
<?php endif;?>
