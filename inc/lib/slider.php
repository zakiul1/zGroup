<?php
function create_slider_post_type()
{
    register_post_type('slider',
        array(
            'labels' => array(
                'name' => __('Sliders'),
                'singular_name' => __('Slider'),
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('title', 'editor', 'thumbnail'),
        )
    );
}
add_action('init', 'create_slider_post_type');
function slider_with_tailwind_flowbite_shortcode()
{
    ob_start(); // Start output buffering

    $args = array(
        'post_type' => 'slider',
        'posts_per_page' => 10,
    );
    $query = new WP_Query($args);

    // Unique ID for the slider
    $slider_id = 'slider-' . rand();

    ?>

    <!-- Slider container -->
    <div id="<?php echo $slider_id; ?>" class="slider w-full overflow-hidden relative">
        <div class="slide-track">
            <?php
            $slide_count = 0;
            while ($query->have_posts()):
                $query->the_post();
                $slide_count++;
                ?>
                <!-- Slide -->
                <div class="slide w-full flex-none">
                    <?php if (has_post_thumbnail()): ?>
                        <img src="<?php the_post_thumbnail_url(); ?>" class="w-full" alt="<?php the_title(); ?>">
                        <div class="slide-content absolute transform -translate-x-1/2 -translate-y-1/2 left-1/2 top-1/2">
                            <h2 class="text-2xl text-white">
                                <?php the_title(); ?>
                            </h2>
                            <p class="text-white">
                                <?php the_excerpt(); ?>
                            </p>
                        </div>
                    <?php endif; ?>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
            ?>
        </div>
    </div>

    <!-- Slider controls -->
    <?php if ($slide_count > 1): ?>
        <div class="slider-controls flex justify-center w-full py-2 gap-2">
            <?php for ($i = 0; $i < $slide_count; $i++): ?>
                <button type="button" class="slider-btn btn btn-xs" data-slide="<?php echo $i; ?>">
                    <?php echo $i + 1; ?>
                </button>
            <?php endfor; ?>
        </div>
    <?php endif; ?>

    <!-- Slider JavaScript -->
    <script>
        (function () {
            var slider = document.getElementById('<?php echo $slider_id; ?>');
            var track = slider.querySelector('.slide-track');
            var slides = track.children;
            var buttons = slider.nextElementSibling.querySelectorAll('.slider-btn');
            var width = slider.offsetWidth;
            var index = 0;
            var interval = 3000; // Change this to whatever interval you want

            function update() {
                track.style.transform = 'translateX(' + (-width * index) + 'px)';
                Array.from(slides).forEach(slide => slide.classList.remove('active')); // Hide all slide contents
                slides[index].classList.add('active'); // Show current slide content
                Array.from(buttons).forEach(button => button.classList.remove('active'));
                buttons[index].classList.add('active');
            }

            function autoplay() {
                index = (index + 1) % slides.length; // Loop back to start
                update();
            }

            var play = setInterval(autoplay, interval);

            Array.from(buttons).forEach((button, i) => {
                button.addEventListener('click', function () {
                    index = i;
                    update();
                    clearInterval(play); // Stop the autoplay when user clicks button
                    play = setInterval(autoplay, interval); // Start it again
                });
            });

            window.addEventListener('resize', function () {
                width = slider.offsetWidth;
                update();
            });

            // Initialize the first slide as active
            slides[0].classList.add('active');
        })();
    </script>

    <style>
        .slider {
            position: relative;
        }

        .slide-track {
            display: flex;
            transition: transform 0.3s ease;
        }

        .slide {
            flex: 0 0 auto;
            width: 100%;
        }

        .slide-content {
            display: none;
            position: absolute;
        }

        .slide.active .slide-content {
            display: block;
        }

        .slider-controls {
            text-align: center;
        }

        .slider-btn.active {
            background-color: #333;
        }
    </style>

    <?php

    return ob_get_clean(); // Return the buffered output
}
add_shortcode('zSlider', 'slider_with_tailwind_flowbite_shortcode');