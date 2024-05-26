<?php

require 'function.php';

if(isset($_SESSION['login'])){
    //kalau sudah login ya udah
}else{
    //belum login
    header('location:login.php');
}

?>