<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="<?= base_url('assets/'); ?>img/logo/logo-dark.png" rel="icon">
    <title><?= SITE_NAME; ?> - <?= $title; ?></title>
    <link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/'); ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/'); ?>vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/'); ?>vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/'); ?>vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>vendor/datatables.net-fixedheader-bs4/css/fixedHeader.bootstrap4.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>vendor/datatables.net-responsive/css/dataTables.responsive.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>vendor/datatables.net-select/css/dataTables.select.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>vendor/datatables.net-buttons/css/buttons.dataTables.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>css/katapanda.css" rel="stylesheet">
    <!-- style -->
    <style>
    body { padding-right: 0 !important }
    
    @media (max-width: 600px) {
        .katapanda-hide-element {
            display: none;
        }
    }

    @media (min-width: 1200px) {
        .katapanda-desktop-hide-element {
            display: none;
        }
    }

    #events {
        margin-bottom: 1em;
        padding: 1em;
        background-color: #f6f6f6;
        border: 1px solid #999;
        border-radius: 3px;
        height: 100px;
        overflow: auto;
    }

    /* Just add this CSS to your project */

    .dropzone {
        border: 2px dashed #dedede;
        border-radius: 5px;
        background: #f5f5f5;
    }

    .dropzone i{
    font-size: 5rem;
    }

    .dropzone .dz-message {
        color: rgba(0,0,0,.54);
        font-weight: 500;
        font-size: initial;
        text-transform: uppercase;
    }

    </style>

    <!-- script -->
    <script src="<?= base_url('assets/'); ?>vendor/jquery/dist/jquery.min.js"></script>
</head>

<body id="page-top">
    <div id="wrapper">