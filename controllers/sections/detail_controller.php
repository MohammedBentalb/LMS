<?php
require_once('./models/sections_model.php');

if(!isset($section_id)) header('Location: index.php');

$foundSection = getSingleSection($section_id);
require_once('./views/sections/section_detail.php');