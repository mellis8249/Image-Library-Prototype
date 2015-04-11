<?php
//Requires classes?
require_once 'classes/Db.class.php';
require_once 'classes/Image.class.php';
//Create an instance of Db
$db = new DB();
//Create an instance of Blog
$Image = new Image($db);
//Calls Blog displayBlog() method
$Image->searchImages();
?>
<!--Used with Pure CSS for forms/buttons-->
<style>
form {
	display:inline;
}

p.msg, p.error{
 display:inline;
 text-align:left;
 position: relative;
 color: red;
}
 .button-search,
        .button-secondary {
            color: white;
            text-shadow: 0 0px 0px rgba(0, 0, 0, 0.2);
        }

        .button-search {
            background: #23353e; /* this is a green */
        }

        .test {
        	color:red;
        	display:inline;
        }


</style>
<!--Search Form-->

<form class="pure-form" id="search" method="GET" action="">
	<fieldset>
		<input type="text" name="searchImages" id="searchImages" />
		<button id="button-search" type="submit" name="search" value="Search" class="button-search pure-button">Search</button>
			    <span id="test"/>
		<?php $Image->display_errors(); ?>
		<?php $Image->display_info(); ?>
		</span>
	</fieldset>
</form>
