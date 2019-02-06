<?php
    header('Content-Type: application/json');
    session_start();
    if(!isset($_SESSION['auth'])){
        if(!isset($_POST['login'])){
            echo json_encode(array(
                "login" => 'error'
            ));
            exit();
        } else {
            $fields = http_build_query($_POST);
            $ch = curl_init($_POST['requestURL']);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST'); 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "Content-Type: application/x-www-form-urlencoded",
                "Content-Length: ".strlen($fields),
                "X-Requested-With: XMLHttpRequest",
            )); 
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields); 
            $response = json_decode(curl_exec($ch));
            $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            
            if(isset($response->success)){
                $_SESSION['auth'] = $response->success->token;
                echo json_encode(array(
                    "login" => 'success',
                    "token" => md5($_SESSION['auth'])
                ));
            } else {
                echo json_encode(array(
                    "login" => 'failed',
                    "error" => $response->error
                ));
            }
            exit();
        }
    } else {
        if(isset($_POST['checkToken'])){
            if($_POST['checkToken'] == md5($_SESSION['auth'])){
                echo json_encode(array(
                    "login" => 'success',
                    "token" => md5($_SESSION['auth']),
                ));
                exit();
            } else {
                echo json_encode(array(
                    "login" => 'error'
                ));
                exit();
            }
        } else if(isset($_POST['logout'])){
            session_destroy();
            echo json_encode(array(
                "logout" => 'success'
            ));
            exit();
        }
    }
?>