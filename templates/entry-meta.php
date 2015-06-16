<?php if(function_exists('get_field')):
	
	$lead_in = get_field('lead_in', $post->ID);
	if($lead_in):
		echo '<h2>'.$lead_in.'</h2>';
	endif;
endif; ?>