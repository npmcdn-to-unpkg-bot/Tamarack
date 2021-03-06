<?php
get_header(); ?>

<main id="main" class="site-main" role="main">

    <div class="trail-full">
      <div class="container">

          <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

            <div class="trail-half">
              <div class="trail-title">
                <h2><?php the_title(); ?></h2>
              </div>
              <div class="trail-description">
                <?php the_content(); ?>
              </div>
              <div class="trail-social">
                <div class="trail-share-icon">
                    Tell your friends:
                </div>
                <div class="trail-share-icon">
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo str_replace(":", "%3A", get_permalink()); ?>"><i class="fa fa-facebook"></i></a>
                </div>
                <div class="trail-share-icon">
                    <a href="https://twitter.com/home?status=<?php echo str_replace(":", "%3A", get_permalink()); ?>"><i class="fa fa-twitter"></i></a>
                </div>
                    <!-- <div class="share-icon">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php // echo str_replace(":", "%3A", get_permalink()); ?>"><i class="fa fa-pinterest"></i> Share</a>
                    </div>
                    <div class="share-icon">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php // echo str_replace(":", "%3A", get_permalink()); ?>"><i class="fa fa-fancy"></i> Share</a>
                    </div> -->


              </div>
            </div>
            <div class="trail-half">
              <div class="trail-map">
                <div class="trail-map-container">
                  <?php echo get_field('trail_map'); ?>
                </div>
              </div>
            </div>

          <?php endwhile; ?>

      </div>
    </div>

    <div id="trailstops">

      <?php

      // check if the repeater field has rows of data
      if( have_rows('trail_stops') ):

        $i = 0;

       	// loop through the rows of data
          while ( have_rows('trail_stops') ) : the_row();
          ?>

            <?php

            $rand = rand(1, 4);

            if($rand == 1) {
              $color = "trail-blue";
            }
            elseif($rand == 2) {
              $color = "trail-purple";
            }
            elseif($rand == 3) {
              $color = "trail-red";
            }
            elseif($rand == 4) {
              $color = "trail-dark-gray";
            }
            else {

            }

            $i++;
            $trail_stop = get_sub_field('trail_stop');

            ?>

              <div class="trail-third trailstop <?php echo $color; ?>">
                <div class="trailstop-inner">
                  <div class="trailstop-number">
                    <?php echo $i; ?>
                  </div>
                  <h3><?php echo get_the_title($trail_stop->ID); ?></h3>
                  <div class="trailstop-type">
                    <?php
                      $space = get_field('space_that_includes', $trail_stop->ID);
                      if ($space == 'retail-shop') {
                        echo "Retail Shop";
                      }
                      elseif ($space == 'studio') {
                        echo "Studio";
                      }
                      elseif ($space == "both") {
                        echo "Retail Shop, Studio";
                      }
                    ?>
                  </div>
                  <div class="trailstop-inner-1"><hr></div>
                  <div class="trailstop-address">
                    <?php echo get_field('shop_or_studio_address', $trail_stop->ID); ?>
                  </div>
                  <div class="trailstop-city">
                    <?php echo get_field('city_state_zip', $trail_stop->ID); ?>
                  </div>
                  <div class="trailstop-hours">
                    <?php

                      if (get_field('by_appointment_only', $trail_stop->ID) == "Yes") {
                        echo "By appointment only";
                      }
                      else {
                        echo get_field('hours_open', $trail_stop->ID);
                      }

                    ?>
                  </div>
                  <div class="trailstop-inner-2"><hr></div>
                  <div class="trailstop-content">
                    <?php

                        $content_post = get_post($trail_stop->ID);
                        $content = $content_post->post_content;
                        $content = apply_filters('the_content', $content);
                        $content = str_replace(']]>', ']]&gt;', $content);
                        echo $content;

                    ?>
                  </div>
                  <div class="trailstop-image">
                    <?php
                      $image = get_field('space_image_1', $trail_stop->ID);
                      $thumb = $image['sizes']['large'];
                    ?>
                    <img src="<?php echo $thumb; ?>" />
                  </div>
                </div>
              </div>

          <?php
          endwhile;

      else :

          // no rows found

      endif;

      ?>

    </div>




</main><!-- #main -->

<script>

if( $(window).width() > 768) {
  $(function() {
      jQuery('.trailstop').matchHeight({
          byRow: false,
          property: 'height',
          target: null,
          remove: false
      });
  });
}


$( window ).resize(function() {
  if( $(window).width() > 768) {
    $(function() {
        jQuery('.trailstop').matchHeight({
            byRow: false,
            property: 'height',
            target: null,
            remove: false
        });
    });
  } else {
    $(function() {
        jQuery('.trailstop').matchHeight({
            remove: true
        });
    });
  }
});


</script>

<?php get_footer(); ?>
