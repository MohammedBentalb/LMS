<?php
require_once('./models/sections_model.php');

if(!isset($_GET['section_id'])) header('Location: index.php');

$foundSection = getSingleSection($_GET['section_id']);
require_once('./views/sections/section_detail.php');