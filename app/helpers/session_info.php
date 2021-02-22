<?php

session_start();

define('USER_ID', 'USER_ID_SESSION');
define('IS_LOGGED_IN', 'IS_LOGGED_IN_SESSION');

function create_session_info($user)
{
    if (get_is_loggedin()) {
        session_destroy();
    }

    $_SESSION[USER_ID] = $user->id;
    set_is_loggedin(true);
}
function delete_session_info()
{
    session_unset(USER_ID);
    session_unset(IS_LOGGED_IN);
    session_destroy();
    set_is_loggedin(false);
}

function set_is_loggedin($is_loggedin)
{
    if ($is_loggedin) {
        $_SESSION[IS_LOGGED_IN] = 'true';
    } else {
        session_unset($_SESSION[IS_LOGGED_IN]);
    }
}

function get_is_loggedin()
{
    return isset($_SESSION[IS_LOGGED_IN]);
}

function get_current_user_id(){

    if(get_is_loggedin()){
        return $_SESSION[USER_ID];
    } else {
        return null;
    }
}
