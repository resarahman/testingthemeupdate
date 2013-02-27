<?php
/** Themify Default Variables
 @var object */
	global $themify; ?>
	
		<?php themify_layout_after(); //hook ?>
        <div id="footerwrap">
		
			<?php themify_footer_before(); //hook ?>
			<div id="footer">
            	<?php themify_footer_start(); //hook ?>
		
				<?php get_template_part( 'includes/footer-widgets'); ?>
			
				<div class="footer-text credits">
					<div class="one"><?php if(themify_get('setting-footer_text_left') != ""){ echo themify_get('setting-footer_text_left'); } else { echo apply_filters('themify_footer_text_one', '&copy; <a href="'.home_url().'">'.get_bloginfo('name').'</a> '.date('Y')); } ?></div>
					<div class="two"><?php if(themify_get('setting-footer_text_right') != ""){ echo themify_get('setting-footer_text_right'); } else { echo 'Powered by <a href="http://wordpress.org">WordPress</a>  &bull; <a href="http://themify.me">Themify WordPress Themes</a>'; } ?></div>
				</div>
				<!-- /.footer-text -->
				<?php themify_footer_end(); //hook ?>
			</div>
			<!--/footer -->
            <?php themify_footer_after(); //hook ?>
            
		</div>
        <!--/footerwrap -->
        
	</div>
	<!--/pagewrap -->

</div>
<!-- /#bg -->

<?php
/**
 *  Stylesheets and Javascript files are enqueued in theme-functions.php
 */
?>

<?php wp_footer(); ?>

<?php themify_body_end(); //hook ?>
</body>
</html>
