<?php //dd("working"); ?>
@extends('themes.main-theme.layouts.home')
<?php
if(isset($settings['site_title'])) {
    $title = $settings['site_title'];
}else {
    $title = "no title";
}
?>
@section('title',$title)
