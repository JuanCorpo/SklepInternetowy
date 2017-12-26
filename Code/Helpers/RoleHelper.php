<?php
function IsInRole($roleId){
    if (isset($_SESSION['user']) && $_SESSION['user'] != null) {
        $session = unserialize($_SESSION['user']);
        if ($session->UserRole == $roleId) {

            return true;
        }
    }
    header("Location: /");
}