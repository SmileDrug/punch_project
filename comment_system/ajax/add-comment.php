<?php
extract($_POST);
if($_POST['act'] == 'add-com'):
	$name = htmlentities($name);
    $skill = htmlentities($skill);
    $comment = htmlentities($comment);

    // Connect to the database
	include('../config.php'); 
	
	// Get gravatar Image 
	// https://fr.gravatar.com/site/implement/images/php/
	$default = "mm";
	$size = 35;
	$grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $skill ) ) ) . "?d=" . $default . "&s=" . $size;

	if(strlen($name) <= '1'){ $name = 'Guest';}
    //insert the comment in the database
    mysql_query("INSERT INTO comments (name, skill, comment, id_post)VALUES( '$name', '$skill', '$comment', '$id_post')");
    if(!mysql_errno()){
?>

    <div class="cmt-cnt">
    	<img src="<?php echo $grav_url; ?>" alt="" />
		<div class="thecom">
	        <h5><?php echo $name; ?></h5>


	        <span  class="com-dt"><?php echo date('H:i'); ?></span>
	        <span  class="com-dt">&nbsp;&nbsp;&nbsp;<b>Skills</b> : <?php echo $skill; ?></span>
	        <br/>
	       	<p><?php echo $comment; ?></p>
	    </div>
	</div><!-- end "cmt-cnt" -->

	<?php } ?>
<?php endif; ?>