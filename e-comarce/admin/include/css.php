<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/libs/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/libs/css/ckeditor.css">
    <link rel="stylesheet" href="assets/libs/css/style.css">
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    
    <?php 
        $current_page = basename($_SERVER['PHP_SELF']);

        if($current_page == 'dashboard.php'){
    ?>
    <link rel="stylesheet" href="assets/vendor/charts/chartist-bundle/chartist.css">
    <link rel="stylesheet" href="assets/vendor/charts/morris-bundle/morris.css">
    <link rel="stylesheet" href="assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendor/charts/c3charts/c3.css">
    <link rel="stylesheet" href="assets/vendor/fonts/flag-icon-css/flag-icon.min.css">
    <?php } ?>

     <?php

        $gSettings = new Settings;
        $gSettings->GetGeneralSetting();
        $query = $gSettings->query;
        $row = $query->fetch_assoc();
        $db_title  = $row['header_text'];
    ?>
    <title><?php echo $db_title; ?></title>