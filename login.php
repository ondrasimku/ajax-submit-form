<?php

    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    $ok = true;
    $messages = array();

    if (!isset($username) || empty($username)) {
        $ok = false;
        $messages[] = 'Zadej uživatelské jméno!';
    }

    if ( !isset($password) || empty($password) ) {
        $ok = false;
        $messages[] = 'Zadej heslo!';
    }

    if ($ok) {
        if ($username === 'admin' && $password === 'admin') {
            $ok = true;
            $messages[] = 'Logged!';
        } else {
            $ok = false;
            $messages[] = 'Špatné jméno nebo heslo!';
        }
    }

    echo json_encode(
        array(
            'ok' => $ok,
            'messages' => $messages
        )
    );
