<?php 

    require_once ('config.php'); 

    $gSettings = new Settings;
    $gSettings->GetGeneralSetting(['status', '=', 1]);
    $query  = $gSettings->query;
    $result = $query->fetch_assoc();
    $footer = (isset($result['footer_text'])) ? $result['footer_text'] : null;
    
?>
<div class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
                           <?php echo $footer;?>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                            <div class="text-md-right footer-links d-none d-sm-block">
                                <a href="javascript: void(0);">About</a>
                                <a href="javascript: void(0);">Support</a>
                                <a href="javascript: void(0);">Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>