<?php
if(session_status() == PHP_SESSION_NONE){ session_start();}

require_once ('_Class/User.php');

User::Disconnect();
