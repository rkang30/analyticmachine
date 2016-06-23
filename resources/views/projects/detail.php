<?php 
$view_path = base_path().'/resources/views/layouts';
require($view_path.'/header.php'); 
require($view_path.'/nav.php'); 
?>

<div class="row">
    <div class="container">
        <h1><?php echo $name; ?></h1>
        <div id="app"></div>
    </div>
</div>
<script src="<?php echo asset('clients.js'); ?>"></script>

<?php 
require($view_path.'/scripts.php'); 
require($view_path.'/footer.php'); 
?>