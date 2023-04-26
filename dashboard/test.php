<?php
include "../include/connection.php";
include "../include/function.php";
?>
Test page<br>
Test page<br>
Test page<br>
Test page<br>
Test page<br>
<pre>
<?php
print_r($_SESSION);
?>
</pre>
<br>
<?php
echo $_SESSION['ses_login_userData_val_' . $config['projectname']]->name;
?>