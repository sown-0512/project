<?php
get_header();

if (is_tax()) {
   get_template_part('archive');
} else {
   get_template_part('template-parts/content/content', 'single');
}
get_footer();
