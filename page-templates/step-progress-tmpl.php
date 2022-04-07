<?php
/*
Template Name:Step Progress
*/

?>

<?php get_header();?>
<div id="page" class="full-width-page">
<?php $term = get_queried_object();?>
<style>
	
ul.yani-flex-column {
    padding: 50px 0;
    margin: 0 auto ;
    display: grid;
    grid-template-columns: repeat(3,1fr);
    grid-column-gap: 10px;
    width: 90%;
    font-size: 14px;
}

ul.yani-flex-column li {
    display: flex;
    align-items: center;
    height: 30px;
    white-space: nowrap;
  	overflow: hidden;
  	text-overflow: ellipsis;
  	max-width: 80%;
}

.navbar .post_type a {
    font-size: 14px;
}
</style>
<main >
	<nav class="navbar navbar-expand-lg navbar-light bg-primary">
		<a class="navbar-brand text-white"><?php echo $term->name;?> (<?php echo $term->count;?>)</a>
		<div class="collapse navbar-collapse post_type" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item"><a class="nav-link text-white" href="?pt=plugin_post">Plugin Development</a></li>
				<li class="nav-item"><a class="nav-link text-white" href="?pt=yani_component">Components</a></li>
				<li class="nav-item"><a class="nav-link text-white" href="?pt=niche">Niche</a></li>
				<li class="nav-item"><a class="nav-link text-white" href="?pt=systems">Systems</a></li>
				<li class="nav-item"><a class="nav-link text-white" href="?pt=services">Services</a></li>
				<li class="nav-item"><a class="nav-link text-white" href="?pt=employer">Employers</a></li>
				<li class="nav-item"><a class="nav-link text-white" href="?pt=challenge">Challenges</a></li>
			</ul>
		</div>
	</nav>
	
	<div class="bg-dark">	
	<?php
		if(isset($_GET['pt'])){
			$post_type = $_GET['pt'];
		}else{
			$post_type = "plugin_post";
		}
			if(post_type_exists($post_type)){
				$query = new WP_Query( array(
					'post_type' => $post_type,
					'posts_per_page' => -1,
					'orderby' => 'ID',
    				'order'   => 'ASC',
					'tax_query' => array(
						array(
					    'taxonomy' => 'step',
					    'field' => 'term_id',
					    'terms' => array($term->term_id)
						)
					)
				));
			}
		
	?>
		<?php if( $query->have_posts()){ ?>
				<ul class="yani-flex-column">

					<?php
					while ( $query->have_posts() ) {
						$query->the_post();
		    			?>
		    			<li>
		    				<a class="text-white" href="<?php echo get_the_permalink();?>">		    					
		    					<?php echo get_the_title();?>
		    				</a>
		    					
		    			</li>
					<?php }
					wp_reset_postdata();
					?>
				</ul>
				<?php }else{ ?>
					<div class="text-center">
						<h2 class="text-danger">Empty</h2>
					</div>
				<?php }  ?>
	</div>
</main>

</div>

<?php get_footer();?>