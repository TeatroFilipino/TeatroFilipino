<?php

session_start();

session_destroy();

header("Location: dex.php");
exit;