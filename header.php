<header id="fh5co-header" role="banner">
    <div class="container">
        <div class="header-inner">
            <h1><a href="index.html">Diwash</a></h1>
            <nav role="navigation">


				<?php
				wp_nav_menu(
					array(
						'menu'           => 'primary',
						'container'      => '',
						'theme_location' => 'primary',
                        'items_wrap' => '<ul id="" class="">%3$s</ul>',
					)
				);
				?>
            </nav>
        </div>
    </div>
</header>