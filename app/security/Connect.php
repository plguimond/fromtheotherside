<?php function isConnect()
{
    if (!isset($_SESSION['firstname'])){
        return false;
    }else{
        return true;
    };
}
