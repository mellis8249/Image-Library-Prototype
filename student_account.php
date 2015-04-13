<?php  require 'includes/head.php'; //Requires head.php
//Checks if any Session variables are set
if (!isset($_SESSION['id'])){
    header('location:protectedpage.php');
    }
    if($_SESSION['type'] != 2){
    header('location:protectedpage.php');
    exit();
    }
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    <?php
    require 'includes/skeletonhead.php'; ?><!--Requires skeletonhead.php-->
</head>
<body>
    <div class="band header"><!--Div class for band header-->
        <div class="container"><!--Div class for container-->
            <div class="six columns">
                <?php
                require 'includes/header.php'; ?><!--Requires header.php-->
            </div>
            <div class="six columns"><!--Div class for ten columns-->
                <?php
                require 'includes/nav.php'; ?><!--Requires nav.php-->
            </div><!--End Div for sixteen columns-->
            <div class="four columns"><!--Div for four columns-->
                <?php
                require 'login/loginInfo.php'; ?><!--Requires loginInfo.php-->
            </div><!--End div for four columns-->
            <div class="container slides"><!--Div class for container slides-->
                <ul class="rslides clearfix"><!--ul class for rslides-->
                    <li><img alt="" src="assets/images/1.jpg"></li>
                    <li><img alt="" src="assets/images/2.jpg"></li>
                    <li><img alt="" src="assets/images/3.jpg"></li>
                </ul><!--End ul for rslides-->
                <h2></h2>
            </div><!--End Div for container slides-->
        </div><!--End Div for container-->
    </div><!--End Div for band header-->
            <div class="band title">
        <div class="container">
            <div class="sixteen columns">
            <h2> Student Account </h2>
            </div>
        </div>
    </div>
    <div class="band content"><!--Div class for band content-->
        <div class="container"><!--Div class for container-->
            <div class="ten columns"><!--Div class for ten columns-->
                <?php 
                  require 'includes/deleteImage.php';
                  require 'includes/displayStudentImages.php'; ?>
            </div><!--End Div for ten columns-->
            <div class="six columns"><!--Div for six columns-->
                <?php 
             require 'login/updatePassword.php'; ?><!--Requires content.php-->
            </div><!--End Div for six columns-->
        </div><!--End Div for container-->
    </div><!--End Div for band content-->
    <div class="band slideshow"><!--Div class for band slideshow-->
        <div class="container"><!--Div class for container-->
            <div class="sixteen columns"><!--Div class for sixteen columns-->
                <div class="es-carousel-wrapper" id="carousel"><!--Div class for es-carousel-wrapper with an id of carousel-->
                    <div class="es-carousel"><!--Div class for es-carousel-->
                        <h2>Thumbnails</h2>
                        <ul>
                            <?php 
                            require 'includes/slideshow.php'; ?><!--Requires slideshow.php-->
                        </ul>
                    </div><!--End Div for es-carousel-->
                </div><!--End Div for es-carousel-wrapper-->
            </div><!--End Div for sixteen columns-->
        </div><!--End Div for container-->
    </div><!--End Div for band slideshow-->
    <div class="band footer"><!--Div class for band footer-->
        <div class="container"><!--Div class for container-->
            <div class="sixteen columns"><!--Div class for sixteen columns-->
                <?php
                require 'includes/footer.php'; ?><!--Requires footer.php-->
                <?php
                require 'includes/nav.php'; ?><!--Requires nav.php-->
            </div><!--End Div for sixteen columns-->
        </div><!--End Div for container-->
    </div><!--End Div for band footer-->
    <div class="band bottom"><!--Div for band bottom-->
        <div class="container"><!--Div for container-->
            <div class="eight columns"><!--Div for eight columns-->
                <?php
                require 'includes/bottom.php'; ?><!--Requires bottom.php-->
            </div><!--End Div for eight columns-->
            <div class="eight columns"><!--Div for eight columns-->
                <?php
                require 'includes/bottom2.php'; ?><!--Requires bottom2.php-->
            </div><!--End Div for eight columns-->
        </div><!--End Div for container-->
    </div><!--End Div for band bottom-->
    <?php 
    require 'assets/js/drop_down_menu.js'; ?><!--Requires drop_down_menu.js-->
    <?php 
    require 'assets/js/drop_down_bottom_menu.js'; ?><!--Requires drop_down_bottom_menu.js-->
    <script src="assets/js/jquery.slides.min.js"></script><!--Links jquery.slides.min.js-->
    <script src="assets/js/responsiveslides.min.js"></script><!--Links responsiveslides.min.js-->
    <script src="assets/js/jquery.easing.1.3.js"></script><!--Links jquery.easing.1.3.js-->
    <script src="assets/js/jquery.elastislide.js"></script><!--Links jquery.elastislide.js-->
    <script>
    $(function () {
        $(".rslides").responsiveSlides({
        pager: true,  
        nav: true
        });
        $('#carousel').elastislide({
        imageW  : 300,
        minItems    : 3
        });      
        });
    </script>
</body>
</html>