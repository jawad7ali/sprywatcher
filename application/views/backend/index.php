<?php
$website_title = $this->db->get_where('settings' , array('type'=>'website_title'))->row()->description;
$user_details = $this->user_model->get_all_users($this->session->userdata('user_id'))->row_array();
$text_align     = $this->db->get_where('settings', array('type' => 'text_align'))->row()->description;
$logged_in_user_role = strtolower($this->session->userdata('role'));
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo get_phrase($page_title); ?> | <?php echo $website_title; ?></title>
    <!-- all the meta tags -->
    <?php include 'metas.php'; ?>
    <!-- all the css files -->
    <?php include 'includes_top.php'; 
    if($this->uri->segment('2') =='listing_add'){
        ?>


 <link href="<?php echo base_url();?>assets/frontend/css/style.css" rel="stylesheet">
  <?php } ?>
</head>
<body data-layout="detached">
    <!-- HEADER -->
    <?php 
    if($this->uri->segment('2') =='listing_add'){
        include APPPATH.'views/frontend/header_home.php';
    }else{
        include 'header.php';
    }
     ?>
    <div class="container-fluid">
        <div class="wrapper">
            <!-- BEGIN CONTENT -->
            <!-- SIDEBAR -->
            <?php 
             
            if($logged_in_user_role == 'admin' && $this->uri->segment('2') !='listing_add'){
            include $logged_in_user_role.'/'.'navigation.php'; } ?>
            <!-- PAGE CONTAINER-->
            <div class="content-page">
                <div class="content">
                    <!-- BEGIN PlACE PAGE CONTENT HERE -->
                    <?php 

                    if($this->uri->segment('2') =='listing_add'){
                        
                        include 'user/'.$page_name.'.php';
                    }else{
                        include $logged_in_user_role.'/'.$page_name.'.php';
                    }
                    ?>
                    <!-- END PLACE PAGE CONTENT HERE -->
                </div>
            </div>
            <!-- END CONTENT -->
        </div>
    </div>
    <!-- all the js files -->
    <?php include 'includes_bottom.php'; ?>
    <?php include 'modal.php'; ?>
</body>
</html>
