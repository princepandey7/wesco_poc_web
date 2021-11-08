<?php
echo "Username: ". preg_replace('#[^0-9a-z]#i', '', $_GET['u']);
?>