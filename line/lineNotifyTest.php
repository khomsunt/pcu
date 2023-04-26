<?php
include("./line.php");

// $token = "51QIm4qvlBwlZMm4AVoyugadtP0SKwUJaFR3g9IUce4";
if (isset($_POST['token'])) {
    $res = notify_message(($_POST['msg'])?$_POST['msg']:"ทดสอบ", $_POST['token']);
}
?>

<form actiont="" method="post">
    Line Token
    <input type="text" id="token" name="token" value="<?php echo $_POST['token']; ?>">
    <br>
    Message
    <input type="text" id="msg" name="msg" value="<?php echo $_POST['msg']; ?>">
    <br><br>
    <button type="submit" value="ทดสอบ Line Token">ทดสอบ Line Token</button>
</form>