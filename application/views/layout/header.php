<!DOCTYPE html>
<html><head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">
        
        <base href="<?= $this->config->item('base_url')?>" />
        <title><?= $page_title?></title>                         
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css?ver=1.1">
        <link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.min.css?ver=1.1">
        <link rel="stylesheet" type="text/css" href="css/style.css?ver=1.2">
        
        <script src="js/jquery-1.9.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <?php if (isset($forms)){?>
        <script src="js/forms.min.js"></script>
        <?php if ($this->config->item('language')!='english'){?>
        <script src="js/jvalidation/messages_<?= $this->config->item('language')?>.js"></script>
        <?php }?>
        <?php }?>
        <?php if (isset($tables)){?>
        <script src="js/jquery.dataTables.1.6.0.min.js?ver=1.1"></script>
        <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.1.6.0.css?ver=1.1">
        <?php }?>
        <?php if (isset($magic_suggest)){?>
        <link rel="stylesheet" type="text/css" href="css/magicsuggest-1.2.3-min.css?ver=1.2"> 
        <script src="js/magicsuggest-1.2.3-min.js?ver=1.2"></script>
        <?php }?>
        <?php if ((isset($date_picker)) AND ($date_picker)){?>
        <link rel="stylesheet" type="text/css" href="css/datepicker.css">
        <?php if ($this->config->item('language')!='english'){?>
        <script src="js/datepicker/messages_<?= $this->config->item('language')?>.js"></script>
        <?php }?>
        <script src="js/bootstrap-datepicker.2.2.1.min.js?ver=1.2"></script>
        <?php }?>
        <?php if (isset($calendar_new) && $this->session->userdata('person_type')=='admin'){?>
        <link rel="stylesheet" type="text/css" href="css/calendario.1.0.css?ver=1.3"> 
        <script src="js/jquery.calendario.js?ver=1.3"></script>
        <?php }?>
        <?php if (isset($calendar_new)){?>
        <link rel="stylesheet" type="text/css" href="css/calendario.1.0.css?ver=1.3"> 
        <script src="js/jquery-calendrio.js"></script>
        <?php }?>
        
        <script src="js/scripts.js?ver=1.3"></script>
        <script>
            config={
                base_url:'<?= $this->config->item('base_url')?>'
            }
        </script>
			<script type="text/javascript" src="js/moment.min.js"></script>
            <script type="text/javascript" src="js/daterangepicker.js"></script>
            <script type="text/javascript" src="js/tooltip.js"></script>
            <link rel="stylesheet" type="text/css" href="css/daterangepicker-bs2.css" />    
            

                
    </head>
<body>