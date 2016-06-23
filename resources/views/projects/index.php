<?php 
$view_path = base_path().'/resources/views/layouts';
require($view_path.'/header.php'); 
require($view_path.'/nav.php'); 
?>
<div class="row">
	<div class="container" id="project_list"></div>
</div>
<script src="<?php echo asset('projects.js'); ?>"></script>
<?php 
require($view_path.'/scripts.php'); 
require($view_path.'/footer.php'); 
?>