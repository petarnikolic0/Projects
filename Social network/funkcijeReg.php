<?php

    function nameV($name){
        
        if(empty($name)){
            return "Field cant be empty";
        }
        elseif(strlen($name) > 50){
            return "Name must be less than 50 characters";
        }
        elseif(ctype_alpha(str_replace(' ', '', $name)) === false){
            return "Name must contain leters and spaces only";
        }
        else{
            return false;
        }
    }
    function surnameV($surname){

        if(empty($surname)){
            return "Field cant be empty";
        }
        elseif(strlen($surname) > 50){
            return "Surname must be less than 50 characters";
        }
        elseif(ctype_alpha(str_replace(' ', '', $surname)) === false){
            return "Surname must contain leters and spaces only";
        }
        
        else{
            return false;
        }
    }
    function dateV($date){
        if(empty($date)){
            return false; 
        } 
        elseif($date < "1900-01-01"){
            return "Dates are available after 1900-01-01";
        } 
        else {
            return false;
        }
    }

    function usernameV($username, $conn){
        $sql = "SELECT username FROM users
        WHERE username LIKE '$username'";

        $result = $conn->query($sql);

        if(empty($username)){
            return "Field cant be empty";
        }
        elseif(strlen($username) < 5 || strlen($username) > 50){
            return "Username must be between 5 and 50 characters";
        }
        elseif(strpos($username, ' ') !== false){
            return "Username must not contain spaces or tabs";
        }
        elseif($result->num_rows){
            return "Username has been taken";
        }
        else{
            return false;
        }
    }
    
    function passwordV($password){
        if(empty($password)){
            return "Field cant be empty";
        }
        elseif(strlen($password) < 5 || strlen($password) > 25){
            return "Password must be between 5 and 25 characters";
        }
        elseif(strpos($password, ' ') !== false){
            return "Password must not contain spaces or tabs";
        }
        else{
            return false;
        }
    }

    function retypeV($retype , $password){
        if($retype != $password){
            return "Must be the same as password";
        }
        elseif(empty($retype)){
            return "Field cant be empty";
        }
        elseif(strlen($retype) < 5 || strlen($retype) > 25){
            return "Must be between 5 and 25 characters";
        }
        elseif(strpos($retype, ' ') !== false){
            return "Must not contain spaces or tabs";
        }
        else{
            return false;
        }
    }

    function newV($new, $old){
        if($new == $old){
            return "Must be different than old password";
        }
        elseif(empty($new)){
            return "Field cant be empty";
         }
        elseif(strlen($new) < 5 || strlen($new) > 25){
            return "Must be between 5 and 25 characters";
        }
        elseif(strpos($new, ' ') !== false){
            return "Must not contain spaces or tabs";
        }
        else{
            return false;
        }
    }

    function textareaV($textarea){
        if(empty($textarea)){
            return "Must not be empty";
        }
        else{
            return false;
        }
    }


?>