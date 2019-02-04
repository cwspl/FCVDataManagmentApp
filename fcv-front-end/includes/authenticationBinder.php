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
            $url = $_POST['requestURL'];
            $options = array(
                'http' => array(
                    'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method'  => 'POST',
                    'content' => http_build_query($_POST)
                )
            );
            $context  = stream_context_create($options);
            $response = json_decode(file_get_contents($url, false, $context));
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