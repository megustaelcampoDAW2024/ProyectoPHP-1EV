<?php
    function miUrl(String $url){
        return "http://localhost/ProyectoPHP-1EV/public/" . $url;
    }

    function myRedirect($url){
        header('Location: http://localhost/ProyectoPHP-1EV/public/' . $url);
        exit();
    }