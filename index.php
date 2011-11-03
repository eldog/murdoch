<?php
    get_header();
    ?>
<script>

$(document).ready(function() {	

	//Show Banner
	$(".main_image .desc").show(); //Show Banner
	$(".main_image .block").animate({ opacity: 0.85 }, 1 ); //Set Opacity

	//Click and Hover events for thumbnail list
	$(".image_thumb ul li:first").addClass('active'); 
	$(".image_thumb ul li").hover(function(){ 
		//Set Variables
		var imgAlt = $(this).find('img').attr("alt"); //Get Alt Tag of Image
		var imgTitle = $(this).find('a').attr("href"); //Get Main Image URL
		var linkHref = $(this).find('.link').attr("href"); // Get the article link
		var imgDesc = $(this).find('.block').html(); 	//Get HTML of block
		var imgDescHeight = $(".main_image").find('.block').height();	//Calculate height of block	
		
		if ($(this).is(".active")) {  //If it's already active, then...
			return false; // Don't click through
		} else {
			//Animate the Teaser				
			$(".main_image .block").animate({ opacity: 0, marginBottom: -imgDescHeight }, 250 , function() {
				$(".main_image .block").html(imgDesc).animate({ opacity: 0.85,	marginBottom: "0" }, 250 );
				$(".main_image img").attr({ src: imgTitle , alt: imgAlt});
				$(".main_image .main-link").attr({ href: linkHref });
			});
		}
		
		$(".image_thumb ul li").removeClass('active'); //Remove class of 'active' on all lists
		
		$(this).addClass('hover'); //Add class "hover" on hover 
		
    }, function() {
        $(this).removeClass('hover'); //Remove class "hover" on hover out
		
	}) .click(function(){
		window.location = $(this).find('.link').attr("href");
		});
			
	//Toggle Teaser
	$("a.collapse").click(function(){
		$(".main_image .block").slideToggle();
		$("a.collapse").toggleClass("show");
	});
	
});//Close Function
</script>


    <div class="feature">
       <?php
        /* Get all Sticky Posts */
        $sticky = get_option( 'sticky_posts' );
        /* Sort Sticky Posts, newest at the top */
        rsort( $sticky );
        /* Get top 3 Sticky Posts */
        $sticky = array_slice( $sticky, 0, 5 );
        $the_query = new WP_Query( array( 'post__in' => $sticky, 'ignore_sticky_posts' => 1 ) );
        $printed_articles_id = array();
        if ($the_query->have_posts()) : ?>
        <?php if(has_post_thumbnail()) : 
            $the_query->the_post(); 
            array_push($printed_articles_id, get_the_ID());?>
                            <div class="main_image">
                                <a class="main-link" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
                                    <?php the_post_thumbnail('title-image'); ?>
                                </a>
                                <div class="desc">
                                    <div class="block">
                                        <h2> <a class="link" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                                        <?php the_excerpt(); ?>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
        <div class="image_thumb">
        <ul>
        <li>                
                   
                        <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'title-image' ); ?>
                        <a href="<?php echo $image[0] ?>"><?php the_post_thumbnail('feature-thumb-image'); ?><a>
                        <div class="block">
                        <h1>
                            <a class="link" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h1>
                        <p><?php the_excerpt(); ?></p>
                        </div>
                    
                </li>
            <?php while ($the_query->have_posts()) :
                $the_query->the_post();
                array_push($printed_articles_id, get_the_ID());
        ?>
                <li>                
                   
                        <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'title-image' ); ?>
                        <a href="<?php echo $image[0] ?>"><?php the_post_thumbnail('feature-thumb-image'); ?><a>
                        <div class="block">
                        <h1>
                            <a class="link" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h1>
                        <p><?php the_excerpt(); ?></p>
                        </div>
                    
                </li>
        <?php
            endwhile; ?>
            </ul>
            </div>
            
                            <div class="cl"></div>
            
        <?php endif;
        wp_reset_postdata();
        ?>

    </div>
    <div class="cl"></div>
    <div id="index-content">
    <div id="section">
        <div class="section-left">
            <div id="news-section" class="section">
                <?php murdoch_get_pyramid_column( 'news', $printed_articles_id, 5 ); ?>
            </div>
            <div id="politics-and-analysis-section" class="section">
                <?php murdoch_get_pyramid_column( 'politics-and-analysis', $printed_articles_id ); ?>
            </div>
            <div id="business-and-finance-section" class="section">
                <?php murdoch_get_pyramid_column( 'business-and-finance', $printed_articles_id ); ?>
            </div>
            <div id="food-drink-section" class="section">
                <?php murdoch_get_pyramid_column( 'food-drink', $printed_articles_id ); ?>
            </div>
            <div id="literature-section" class="section">
                <?php murdoch_get_pyramid_column( 'literature', $printed_articles_id ); ?>
            </div>
            <div id="societies-section" class="section">
                <?php murdoch_get_pyramid_column( 'societies', $printed_articles_id ); ?>
            </div>
            <div id="music-section" class="section">
                <?php murdoch_get_pyramid_column( 'music', $printed_articles_id ); ?>
            </div>
            
        </div><!-- section-left -->
        <div class="section-right">
            <div id="comment-and-debate-section" class="section">
                <?php murdoch_get_pyramid_column( 'comment-and-debate', $printed_articles_id ); ?>
            </div>
            <div id="features-section" class="section">
                <?php murdoch_get_pyramid_column( 'features', $printed_articles_id ); ?>
            </div>
            <div id="film-section" class="section">
                <?php murdoch_get_pyramid_column( 'film', $printed_articles_id ); ?>
            </div>
            <div id="theatre-section" class="section">
                <?php murdoch_get_pyramid_column( 'theatre', $printed_articles_id ); ?>
            </div>
            <div id="fashion-beauty-section" class="section">
                <?php murdoch_get_pyramid_column( 'fashion-beauty', $printed_articles_id ); ?>
            </div>
            <div id="lifestyle-section" class="section">
                <?php murdoch_get_pyramid_column( 'lifestyle', $printed_articles_id ); ?>
            </div>
            <div id="arts-and-culture-section" class="section">
                <?php murdoch_get_pyramid_column( 'arts-and-culture', $printed_articles_id ); ?>
            </div>
            
        </div><!-- section-right -->
        <div class="cl"></div>
    </div><!-- section -->
</div>
<?php
    get_sidebar();
    ?>
<div class="cl"></div>
<?php
    get_footer();
?>
