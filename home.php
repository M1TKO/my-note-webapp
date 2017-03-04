<?php 
session_start();
if(isset($_POST['log-out'])){

    session_destroy();
    header('Location: ./');
}
?>

<form method="POST"> 
    <input type="submit" name="log-out" value="log-out"> 
</form>