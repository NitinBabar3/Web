<?php

$type=$_GET["type"];

if($type=="MCQ")
{
    for($i=0;$i<4;$i++)
    {
    
        $checkbox = "<input type='checkbox' name='MCQoption[$i]'/>";
        $input="<input type='text' name='MCQtext[$i]'/><br/>";
        echo $checkbox.$input;
    }
}
if($type=="T/F")
{
    for($i=0;$i<2;$i++)
    {
    
        $checkbox = "<input type='radio' name='T/Foption' />";
        $input="<input type='text' name='T/Ftext[$i]'/><br/>";
        echo $checkbox.$input;
    }
}
?>
