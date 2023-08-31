<div class="job-result-content">
    <div class="job-result-thumb">
    <p><img loading="lazy" width="500" height="300" src="https://sandbox.olympiacamps.com/wp-content/uploads/logo-1.png"></p>
	</div>
    <div class="job-result-info">
        <h2><a href="<?php esc_url( the_permalink() ); ?>"><?php the_title(); ?></a></h2>
        <p class="job-category"><a href="javascript:void" rel="tag">Full-Time</a></p>
        <div class="job-result-excerpt">
            <?php the_excerpt(); ?>                        
            <a href="<?php esc_url( the_permalink() ); ?>">read more</a>
        </div>
    </div>
    <div class="job-result-button">
        <button class="see-job"><a href="<?php esc_url( the_permalink() ); ?>">See Job</a></button>
    </div>  
</div>