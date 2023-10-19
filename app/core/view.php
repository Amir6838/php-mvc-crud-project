<?php

function alert($type, $message)
{
    echo "<div class='alert alert-$type' role='alert'>
     $message
    </div>";
}
