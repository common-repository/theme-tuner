<?php

$tt=new ttCss();
$tt->add($_REQUEST);
echo $tt->render();

?>