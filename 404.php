<?php get_header(); ?>
							<?php 
                                $tmp = explode('?v=', get_field('video_link'));
								echo end ($tmp);
								$video_link = get_field('video_link');
								$linked = 'youtube';
								$pos = strpos($video_link,$linked);
								if ($pos = true) {
									echo
									'<iframe width="100%" height="450px" src="https://www.youtube.com/embed/<?php echo end ($tmp);?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
								} else {
									echo 'dont work';
								}

							?>



<iframe width="100%" height="450px" src="https://www.youtube.com/embed/hjkEAETRyjw" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							<?php 
								$tmp = explode('?v=', get_field('video_link'));
								echo end ($tmp);
								?>
<?php get_footer(); ?>