<!DOCTYPE html>
<html class="light" <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <?php wp_head(); ?>

    <!-- Tailwind Configuration -->
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "outline": "#76777d",
                        "secondary-fixed-dim": "#c4c7c9",
                        "on-tertiary-container": "#75859d",
                        "on-primary-container": "#7c839b",
                        "secondary": "#5c5f61",
                        "error-container": "#ffdad6",
                        "tertiary-fixed-dim": "#b7c8e1",
                        "primary": "#000000",
                        "surface-tint": "#565e74",
                        "surface-container-low": "#f6f3f5",
                        "surface-bright": "#fcf8fa",
                        "on-error": "#ffffff",
                        "on-surface-variant": "#45464d",
                        "on-secondary-fixed": "#191c1e",
                        "inverse-surface": "#303032",
                        "inverse-on-surface": "#f3f0f2",
                        "tertiary-fixed": "#d3e4fe",
                        "surface-dim": "#dcd9db",
                        "on-tertiary-fixed": "#0b1c30",
                        "primary-fixed": "#dae2fd",
                        "on-secondary-container": "#626567",
                        "surface-container-high": "#eae7e9",
                        "surface-container": "#f0edef",
                        "on-tertiary": "#ffffff",
                        "tertiary-container": "#0b1c30",
                        "outline-variant": "#c6c6cd",
                        "surface-variant": "#e4e2e4",
                        "background": "#fcf8fa",
                        "secondary-fixed": "#e0e3e5",
                        "on-secondary-fixed-variant": "#444749",
                        "on-primary-fixed": "#131b2e",
                        "on-primary-fixed-variant": "#3f465c",
                        "on-secondary": "#ffffff",
                        "tertiary": "#000000",
                        "surface-container-lowest": "#ffffff",
                        "on-surface": "#1b1b1d",
                        "on-primary": "#ffffff",
                        "secondary-container": "#e0e3e5",
                        "surface": "#fcf8fa",
                        "primary-container": "#131b2e",
                        "error": "#ba1a1a",
                        "inverse-primary": "#bec6e0",
                        "surface-container-highest": "#e4e2e4",
                        "primary-fixed-dim": "#bec6e0",
                        "on-tertiary-fixed-variant": "#38485d",
                        "on-background": "#1b1b1d",
                        "on-error-container": "#93000a",
                        "brand-emerald": "#10B981",
                        "brand-navy": "#0F172A"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                    "spacing": {
                        "unit": "4px",
                        "margin-desktop": "48px",
                        "stack-sm": "8px",
                        "gutter": "24px",
                        "stack-md": "16px",
                        "stack-lg": "32px",
                        "margin-mobile": "16px",
                        "container-max": "1280px"
                    },
                    "fontFamily": {
                        "label-md": ["Inter"],
                        "display-lg": ["Plus Jakarta Sans"],
                        "headline-lg-mobile": ["Plus Jakarta Sans"],
                        "headline-md": ["Plus Jakarta Sans"],
                        "body-lg": ["Inter"],
                        "headline-lg": ["Plus Jakarta Sans"],
                        "body-md": ["Inter"],
                        "label-sm": ["Inter"],
                        "body-sm": ["Inter"]
                    },
                    "fontSize": {
                        "label-md": ["14px", {"lineHeight": "1", "letterSpacing": "0.05em", "fontWeight": "600"}],
                        "display-lg": ["48px", {"lineHeight": "1.1", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "headline-lg-mobile": ["24px", {"lineHeight": "1.2", "fontWeight": "600"}],
                        "headline-md": ["24px", {"lineHeight": "1.3", "fontWeight": "600"}],
                        "body-lg": ["18px", {"lineHeight": "1.6", "fontWeight": "400"}],
                        "headline-lg": ["32px", {"lineHeight": "1.2", "letterSpacing": "-0.01em", "fontWeight": "600"}],
                        "body-md": ["16px", {"lineHeight": "1.5", "fontWeight": "400"}],
                        "label-sm": ["12px", {"lineHeight": "1", "fontWeight": "500"}],
                        "body-sm": ["14px", {"lineHeight": "1.5", "fontWeight": "400"}]
                    }
                },
            },
        }
    </script>
</head>
<body <?php body_class( 'min-h-screen' ); ?>>

<!-- Top Navigation Bar -->
<nav class="bg-surface-container-lowest dark:bg-surface-container-high border-b border-outline-variant dark:border-outline fixed top-0 left-0 right-0 z-50">
    <div class="flex justify-between items-center px-margin-desktop py-4 w-full max-w-container-max mx-auto">
        <!-- Logo / Brand Title -->
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="font-headline-md text-headline-md font-bold text-primary dark:text-primary-fixed hover:opacity-90">
            Ivri Research
        </a>

        <!-- Desktop Navigation Items -->
        <div class="hidden md:flex items-center space-x-stack-lg">
            <?php
            $locations = get_nav_menu_locations();
            $menu_items = array();
            if ( isset( $locations['primary-menu'] ) ) {
                $menu = wp_get_nav_menu_object( $locations['primary-menu'] );
                if ( $menu ) {
                    $menu_items = wp_get_nav_menu_items( $menu->term_id );
                }
            }

            if ( ! empty( $menu_items ) ) {
                // Renders custom WP menu dynamically
                $current_url = home_url( add_query_arg( array(), $wp->request ) );
                foreach ( $menu_items as $item ) {
                    $is_active = ( trailingslashit( $item->url ) === trailingslashit( $current_url ) || $item->object_id == get_queried_object_id() );
                    $link_class = $is_active 
                        ? 'text-primary dark:text-primary-fixed font-bold border-b-2 border-primary dark:border-primary-fixed pb-1 font-label-md text-label-md' 
                        : 'text-secondary dark:text-secondary-fixed-dim hover:text-primary dark:hover:text-primary-fixed transition-colors font-label-md text-label-md';
                    
                    echo '<a class="' . esc_attr( $link_class ) . '" href="' . esc_url( $item->url ) . '">' . esc_html( $item->title ) . '</a>';
                }
            } else {
                // Fallback static links matching mockup pages
                $pages = array(
                    'home.html'           => 'Home',
                    'about-us.html'       => 'About Us',
                    'research-areas.html' => 'Research Areas',
                    'publications.html'   => 'Publications',
                    'conferences.html'    => 'Conferences',
                    'services.html'       => 'Services'
                );

                $current_file = basename( $_SERVER['PHP_SELF'] );
                // Fallback check based on requested templates
                foreach ( $pages as $file => $name ) {
                    // Check active menu item
                    $is_active = false;
                    if ( is_front_page() && $file === 'home.html' ) {
                        $is_active = true;
                    } elseif ( is_page_template( 'template-about.php' ) && $file === 'about-us.html' ) {
                        $is_active = true;
                    } elseif ( is_page_template( 'template-research-areas.php' ) && $file === 'research-areas.html' ) {
                        $is_active = true;
                    } elseif ( ( is_post_type_archive( 'publication' ) || is_singular( 'publication' ) ) && $file === 'publications.html' ) {
                        $is_active = true;
                    } elseif ( ( is_post_type_archive( 'conference' ) || is_singular( 'conference' ) ) && $file === 'conferences.html' ) {
                        $is_active = true;
                    } elseif ( is_page_template( 'template-services.php' ) && $file === 'services.html' ) {
                        $is_active = true;
                    }

                    $link_class = $is_active 
                        ? 'text-primary dark:text-primary-fixed font-bold border-b-2 border-primary dark:border-primary-fixed pb-1 font-label-md text-label-md' 
                        : 'text-secondary dark:text-secondary-fixed-dim hover:text-primary dark:hover:text-primary-fixed transition-colors font-label-md text-label-md';

                    $url = home_url( '/' );
                    if ( $file === 'about-us.html' ) {
                        $url = home_url( '/about-us/' );
                    } elseif ( $file === 'research-areas.html' ) {
                        $url = home_url( '/research-areas/' );
                    } elseif ( $file === 'publications.html' ) {
                        $url = home_url( '/publications/' );
                    } elseif ( $file === 'conferences.html' ) {
                        $url = home_url( '/conferences/' );
                    } elseif ( $file === 'services.html' ) {
                        $url = home_url( '/services/' );
                    }

                    echo '<a class="' . esc_attr( $link_class ) . '" href="' . esc_url( $url ) . '">' . esc_html( $name ) . '</a>';
                }
            }
            ?>
        </div>

        <!-- Contact Trigger Button -->
        <button data-contact-trigger class="bg-primary text-on-primary px-6 py-2 rounded-lg font-label-md text-label-md hover:bg-opacity-90 transition-all duration-300">
            Contact
        </button>
    </div>
</nav>
