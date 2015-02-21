<div class='twelve large-12 columns space testimonials-box medium'>
  <div style='background:$color'>
    <span class='box-title anim'><?php  get_option('box2') ?></span>
    <ul class='testimonials'><?php
      $loop = new WP_Query( array( 'post_type' => 'testimonials', 'posts_per_page' => 10 ) );
      while ( $loop->have_posts() ) : $loop->the_post(); ?>
      
      <li>
        <blockquote>
          <p><?php the_excerpt(); ?></p>
          <cite><?php the_title(); ?></cite>
        </blockquote>
      </li>";
       <?php endwhile; ?>
    </ul>
  </div>
</div>