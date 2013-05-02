<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Project Title</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta charset="utf-8">


        <?= $_styles ?>
        <link href="<?= base_url("assets/css/bootstrap.min.css") ?>" rel="stylesheet" />
        <link href="<?= base_url("assets/css/bootstrap-responsive.min.css") ?>" rel="stylesheet" />
        <!--

        <script type="text/javascript" src="js/bootstrap.min.js"></script> -->
        <script type="text/javascript" src="<?php echo base_url('assets/js/common.js'); ?>"></script>
        <script type="text/javascript"> var path = '<?php echo base_url(); ?>';</script>
        <style type="text/css">
            html,
            body {
                height: 100%;
                margin:0;
                /* The html and body elements cannot have any padding or margin. */
            }

            #header {
                color:#fff;
                background-color: #264E72;
                padding:    0;
                border-bottom:           #999 1px solid;
                margin-bottom: -2px;
                margin-left:-20px;
				margin-right:-20px;
            }
            #wrapper  {
                min-height: 100%;
                height: auto !important;
                height: 100%;
                margin: 0 auto -50px;
            }
            #header h2 {
                font-weight:normal;
                font-family:serif;

            }
            /*footer */
            #push{
                height: 50px;
            }
            #footer {
				min-height:50px;
                color:#fff;
                clear:both;
                border-top:           #999 1px solid;
                background-color:#333333;
                padding-left:40px;
                margin-left:-20px;
				margin-right:-20px;
            }

            #footer .container {
                border-top:           #999 1px solid;
                background-color:#333333;
            }
            #footer ul>li:first-child {
                font-weight:bold;
            }
            #footer a {
                color:#fff;
            }

            .align_center {
                text-align:center;
            }
            /*clear float*/
            .clear_left {
                clear:left;
            }
            .clear_float {
                clear:both;
            }

            .top_padding1 {
                padding-top:10px;
            }
            .top_padding1 li {
                padding-top:10px;
            }
            .profile {
                margin-top: 25px;
            }
            .profile img {
                border: 3px solid #FFFFFF;
                border-radius: 3px 3px 3px 3px;
                box-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
                height: 85px;
                width: 85px;
            }
            #msg {
                display:none;
                font-family:Arial,Helvetica,sans-serif;
                position:fixed;
                top:0px;
                left:0px;
                width:100%;
                z-index:105;
                text-align:center;
                font-weight:bold;
                font-size:12pt;
                color:white;
                padding:10px 0px 10px 0px;
            }

            #msg span {
                text-align: center;
                width: 95%;
                float:left;
            }

            #msg .close-notify {
                white-space: nowrap;
                float:right;
                margin-right:10px;
                color:#fff;
                text-decoration:none;
                border:2px #fff solid;
                padding-left:3px;
                padding-right:3px
            }

            #msg .close-notify a {
                color: #fff;
            }
            .message_success {
                background-color:#06560C;
            }

            .message_error {
                background-color:#8E1609;
            }
        </style>
    </head>
    <body>

        <div id="wrapper">

            <div id="header">

                <div class="container">
                    <h2>Project Name</h2>
                </div>
            </div><!--header-->
            <?= $menu ?>
            <div id="content" class="row-fluid">
                <div id="leftspan" class="span12">
                    <div class="container">
                        <?= $this->session->flashdata('message') ?>
                        <?= $content ?>
                    </div>
                </div>
            </div>

            <div id="push"></div>

        </div><!--container-->

        <div id="footer">
           footer
        </div><!--footer-->

        <!-- Placed at the end of the document so the pages load faster -->
        <script src="<?= base_url('assets/js/jquery.js') ?>"></script>
        <script src="<?= base_url('assets/js/bootstrap-dropdown.js') ?>"></script>
        <script src="<?= base_url('assets/js/bootstrap-transition.js') ?>"></script>
        <script src="<?= base_url('assets/js/bootstrap-alert.js') ?>"></script>
        <script src="<?= base_url('assets/js/bootstrap-modal.js') ?>"></script>
        <script src="<?= base_url('assets/js/bootstrap-dropdown.js') ?>"></script>
        <script src="<?= base_url('assets/js/bootstrap-scrollspy.js') ?>"></script>
        <script src="<?= base_url('assets/js/bootstrap-tab.js') ?>"></script>
        <script src="<?= base_url('assets/js/bootstrap-tooltip.js') ?>"></script>
        <script src="<?= base_url('assets/js/bootstrap-popover.js') ?>"></script>
        <script src="<?= base_url('assets/js/bootstrap-button.js') ?>"></script>
        <script src="<?= base_url('assets/js/bootstrap-collapse.js') ?>"></script>
        <script src="<?= base_url('assets/js/bootstrap-carousel.js') ?>"></script>
        <script src="<?= base_url('assets/js/bootstrap-typeahead.js') ?>"></script>
        <script>
            $(document).ready(function() {
                $('.dropdown-toggle').dropdown();
            });
        </script>
        <?= $_scripts ?>

    </body>
</html>
