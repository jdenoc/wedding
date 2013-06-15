<?php // cancel.php
session_name('rsvp');
@session_start();
@session_destroy();
header('location:../index.php');