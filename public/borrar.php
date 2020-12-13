<?php

if(isset($_GET["borrar"])){
    unlink('img/'.$_GET['borrar']);
}