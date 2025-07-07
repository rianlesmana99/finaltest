<?php
session_start();

if (!isset($_SESSION["customers"])) {
    header("Location: ../../index.php");
}