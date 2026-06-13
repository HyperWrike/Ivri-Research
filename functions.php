<?php
/**
 * Ivri Research Theme Functions
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/* ==========================================================================
   1. Theme Setup
   ========================================================================== */
function ivri_research_setup() {
    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    // Let WordPress manage the document title.
    add_theme_support( 'title-tag' );

    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support( 'post-thumbnails' );

    // Switch default core markup for search form, comment form, and comments to output valid HTML5.
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ) );

    // Register Nav Menus
    register_nav_menus( array(
        'primary-menu' => esc_html__( 'Primary Header Menu', 'ivri-research' ),
        'footer-menu'  => esc_html__( 'Footer Menu', 'ivri-research' ),
    ) );
}
add_action( 'after_setup_theme', 'ivri_research_setup' );

/* ==========================================================================
   2. Enqueue Scripts & Styles
   ========================================================================== */
function ivri_research_scripts() {
    // Google Fonts & Material Symbols
    wp_enqueue_style( 'ivri-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Plus+Jakarta+Sans:wght@100..900&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap', array(), null );

    // Theme main stylesheet
    wp_enqueue_style( 'ivri-style', get_stylesheet_uri(), array(), '1.0.0' );

    // Tailwind CSS CDN - Loaded in header to prevent Flash of Unstyled Content (FOUC)
    wp_enqueue_script( 'tailwind-cdn', 'https://cdn.tailwindcss.com?plugins=forms,container-queries', array(), null, false );

    // Custom main theme interactions script
    wp_enqueue_script( 'ivri-main', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0.0', true );

    // Contact modal AJAX script
    wp_enqueue_script( 'ivri-contact-modal', get_template_directory_uri() . '/assets/js/contact-modal.js', array(), '1.0.0', true );

    // Pass AJAX URL to contact modal script
    wp_localize_script( 'ivri-contact-modal', 'ivri_theme_params', array(
        'ajax_url' => admin_url( 'admin-ajax.php' )
    ) );
}
add_action( 'wp_enqueue_scripts', 'ivri_research_scripts' );

/* ==========================================================================
   3. Custom Post Types Registration
   ========================================================================== */
function ivri_register_custom_post_types() {
    // 1. Publications CPT
    $pub_labels = array(
        'name'               => _x( 'Publications', 'post type general name', 'ivri-research' ),
        'singular_name'      => _x( 'Publication', 'post type singular name', 'ivri-research' ),
        'menu_name'          => _x( 'Publications', 'admin menu', 'ivri-research' ),
        'name_admin_bar'     => _x( 'Publication', 'add new on admin bar', 'ivri-research' ),
        'add_new'            => _x( 'Add New', 'publication', 'ivri-research' ),
        'add_new_item'       => __( 'Add New Publication', 'ivri-research' ),
        'new_item'           => __( 'New Publication', 'ivri-research' ),
        'edit_item'          => __( 'Edit Publication', 'ivri-research' ),
        'view_item'          => __( 'View Publication', 'ivri-research' ),
        'all_items'          => __( 'All Publications', 'ivri-research' ),
        'search_items'       => __( 'Search Publications', 'ivri-research' ),
        'not_found'          => __( 'No publications found.', 'ivri-research' ),
        'not_found_in_trash' => __( 'No publications found in Trash.', 'ivri-research' )
    );

    $pub_args = array(
        'labels'             => $pub_labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'publications' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-book-alt',
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        'show_in_rest'       => true,
    );
    register_post_type( 'publication', $pub_args );

    // 2. Conferences CPT
    $conf_labels = array(
        'name'               => _x( 'Conferences', 'post type general name', 'ivri-research' ),
        'singular_name'      => _x( 'Conference', 'post type singular name', 'ivri-research' ),
        'menu_name'          => _x( 'Conferences', 'admin menu', 'ivri-research' ),
        'name_admin_bar'     => _x( 'Conference', 'add new on admin bar', 'ivri-research' ),
        'add_new'            => _x( 'Add New', 'conference', 'ivri-research' ),
        'add_new_item'       => __( 'Add New Conference', 'ivri-research' ),
        'new_item'           => __( 'New Conference', 'ivri-research' ),
        'edit_item'          => __( 'Edit Conference', 'ivri-research' ),
        'view_item'          => __( 'View Conference', 'ivri-research' ),
        'all_items'          => __( 'All Conferences', 'ivri-research' ),
        'search_items'       => __( 'Search Conferences', 'ivri-research' ),
        'not_found'          => __( 'No conferences found.', 'ivri-research' ),
        'not_found_in_trash' => __( 'No conferences found in Trash.', 'ivri-research' )
    );

    $conf_args = array(
        'labels'             => $conf_labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'conferences' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 6,
        'menu_icon'          => 'dashicons-groups',
        'supports'           => array( 'title', 'editor', 'thumbnail' ),
        'show_in_rest'       => true,
    );
    register_post_type( 'conference', $conf_args );
}
add_action( 'init', 'ivri_register_custom_post_types' );

/* ==========================================================================
   4. ACF Custom Fields Registration via PHP
   ========================================================================== */
if ( function_exists('acf_add_local_field_group') ) {

    // A. Homepage & Contact Fields
    acf_add_local_field_group(array(
        'key' => 'group_homepage',
        'title' => 'Homepage & Contact Settings',
        'fields' => array(
            // Hero
            array(
                'key' => 'field_hero_tab',
                'label' => 'Hero Section',
                'type' => 'tab',
            ),
            array(
                'key' => 'field_hero_title',
                'label' => 'Hero Title',
                'name' => 'hero_title',
                'type' => 'text',
                'default_value' => 'Ivri Research: Advancing Research Innovation',
            ),
            array(
                'key' => 'field_hero_description',
                'label' => 'Hero Description',
                'name' => 'hero_description',
                'type' => 'textarea',
                'default_value' => 'Our mission is to solve humanity\'s most complex challenges through rigorous scientific inquiry, cross-disciplinary collaboration, and the relentless pursuit of intellectual clarity.',
            ),
            array(
                'key' => 'field_hero_image',
                'label' => 'Hero Image',
                'name' => 'hero_image',
                'type' => 'image',
                'return_format' => 'url',
            ),
            array(
                'key' => 'field_hero_btn1_text',
                'label' => 'Button 1 Text',
                'name' => 'hero_btn1_text',
                'type' => 'text',
                'default_value' => 'View Publications',
            ),
            array(
                'key' => 'field_hero_btn1_link',
                'label' => 'Button 1 Link',
                'name' => 'hero_btn1_link',
                'type' => 'text',
                'default_value' => '/publications/',
            ),
            array(
                'key' => 'field_hero_btn2_text',
                'label' => 'Button 2 Text',
                'name' => 'hero_btn2_text',
                'type' => 'text',
                'default_value' => 'Learn More',
            ),
            array(
                'key' => 'field_hero_btn2_link',
                'label' => 'Button 2 Link',
                'name' => 'hero_btn2_link',
                'type' => 'text',
                'default_value' => '/about-us/',
            ),
            // About Us Bento Block
            array(
                'key' => 'field_about_tab',
                'label' => 'About Us Summary',
                'type' => 'tab',
            ),
            array(
                'key' => 'field_about_title',
                'label' => 'About Title',
                'name' => 'about_title',
                'type' => 'text',
                'default_value' => 'About Us',
            ),
            array(
                'key' => 'field_about_description',
                'label' => 'About Description',
                'name' => 'about_description',
                'type' => 'textarea',
                'default_value' => 'Founded on the principles of precision and foresight, Ivri Research provides strategic consulting and scientific analysis for global enterprises. We bridge the gap between laboratory results and corporate strategy.',
            ),
            array(
                'key' => 'field_about_papers_counter',
                'label' => 'Papers Counter Number',
                'name' => 'about_papers_counter',
                'type' => 'text',
                'default_value' => '142+',
            ),
            array(
                'key' => 'field_about_papers_label',
                'label' => 'Papers Counter Label',
                'name' => 'about_papers_label',
                'type' => 'text',
                'default_value' => 'Published Papers 2024',
            ),
            // Mission & Vision
            array(
                'key' => 'field_mission_vision_tab',
                'label' => 'Mission & Vision (Global)',
                'type' => 'tab',
            ),
            array(
                'key' => 'field_mission_title',
                'label' => 'Mission Title',
                'name' => 'mission_title',
                'type' => 'text',
                'default_value' => 'Our Mission',
            ),
            array(
                'key' => 'field_mission_description',
                'label' => 'Mission Description',
                'name' => 'mission_description',
                'type' => 'textarea',
                'default_value' => 'Our mission is to accelerate the pace of innovation by fostering a global network of elite researchers. We provide the infrastructure, funding, and intellectual framework necessary to translate complex data into actionable strategies that solve the world\'s most pressing technical and social challenges.',
            ),
            array(
                'key' => 'field_vision_title',
                'label' => 'Vision Title',
                'name' => 'vision_title',
                'type' => 'text',
                'default_value' => 'Our Vision',
            ),
            array(
                'key' => 'field_vision_description',
                'label' => 'Vision Description',
                'name' => 'vision_description',
                'type' => 'textarea',
                'default_value' => 'To become the global cornerstone of cross-disciplinary research, where groundbreaking discoveries serve as the foundation for a more resilient and technologically advanced society. We envision a world where every strategic decision is rooted in empirical truth and scientific excellence.',
            ),
            // Quotes
            array(
                'key' => 'field_quote_tab',
                'label' => 'Quotes Section',
                'type' => 'tab',
            ),
            array(
                'key' => 'field_quote_text',
                'label' => 'Quote Text',
                'name' => 'quote_text',
                'type' => 'textarea',
                'default_value' => '"Precision is not an option; it is the fundamental requirement for innovation that lasts."',
            ),
            array(
                'key' => 'field_quote_author',
                'label' => 'Quote Author',
                'name' => 'quote_author',
                'type' => 'text',
                'default_value' => 'Dr. Elara Ivri, Director of Research',
            ),
            // Contact Information
            array(
                'key' => 'field_contact_tab',
                'label' => 'Contact Information',
                'type' => 'tab',
            ),
            array(
                'key' => 'field_contact_email',
                'label' => 'Contact Email',
                'name' => 'contact_email',
                'type' => 'text',
                'default_value' => 'info@ivriresearch.com',
            ),
            array(
                'key' => 'field_contact_phone',
                'label' => 'Contact Phone',
                'name' => 'contact_phone',
                'type' => 'text',
                'default_value' => '+91 86183 88731',
            ),
            array(
                'key' => 'field_contact_address',
                'label' => 'Office Address',
                'name' => 'contact_address',
                'type' => 'textarea',
                'default_value' => 'Zurich Headquarters, Switzerland',
            ),
            array(
                'key' => 'field_contact_hours',
                'label' => 'Working Hours',
                'name' => 'contact_hours',
                'type' => 'text',
                'default_value' => 'Monday – Friday: 9:00 AM to 6:00 PM (IST)',
            ),
            // Socials
            array(
                'key' => 'field_social_linkedin',
                'label' => 'LinkedIn Link',
                'name' => 'social_linkedin',
                'type' => 'text',
                'default_value' => '#',
            ),
            array(
                'key' => 'field_social_twitter',
                'label' => 'Twitter/X Link',
                'name' => 'social_twitter',
                'type' => 'text',
                'default_value' => '#',
            ),
            array(
                'key' => 'field_social_facebook',
                'label' => 'Facebook Link',
                'name' => 'social_facebook',
                'type' => 'text',
                'default_value' => '#',
            ),
            array(
                'key' => 'field_social_youtube',
                'label' => 'YouTube Link',
                'name' => 'social_youtube',
                'type' => 'text',
                'default_value' => '#',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_type',
                    'operator' => '==',
                    'value' => 'front_page',
                ),
            ),
        ),
    ));

    // B. Publications fields
    acf_add_local_field_group(array(
        'key' => 'group_publications',
        'title' => 'Publication Specifications',
        'fields' => array(
            array(
                'key' => 'field_pub_authors',
                'label' => 'Authors',
                'name' => 'publication_authors',
                'type' => 'text',
            ),
            array(
                'key' => 'field_pub_journal',
                'label' => 'Journal Name',
                'name' => 'publication_journal',
                'type' => 'text',
            ),
            array(
                'key' => 'field_pub_date',
                'label' => 'Publication Date',
                'name' => 'publication_date',
                'type' => 'date_picker',
                'display_format' => 'F Y',
                'return_format' => 'Y-m-d',
            ),
            array(
                'key' => 'field_pub_abstract',
                'label' => 'Abstract / Summary',
                'name' => 'publication_abstract',
                'type' => 'textarea',
            ),
            array(
                'key' => 'field_pub_doi',
                'label' => 'DOI Reference',
                'name' => 'publication_doi',
                'type' => 'text',
            ),
            array(
                'key' => 'field_pub_pdf',
                'label' => 'PDF URL/Link',
                'name' => 'publication_pdf',
                'type' => 'text',
            ),
            array(
                'key' => 'field_pub_genre',
                'label' => 'Journal Category / Genre',
                'name' => 'publication_genre',
                'type' => 'select',
                'choices' => array(
                    'AI' => 'AI & Machine Learning',
                    'Quantum' => 'Quantum Computing',
                    'Bio-Engineering' => 'Bio-Engineering',
                    'HCI' => 'HCI',
                    'Hardware' => 'Hardware',
                    'Finance' => 'Finance',
                    'Physics' => 'Physics',
                    'Infrastructure' => 'Infrastructure',
                    'Ethics' => 'Quantum Ethics',
                    'Sustainability' => 'Sustainability',
                ),
                'default_value' => 'AI',
            ),
            array(
                'key' => 'field_pub_featured',
                'label' => 'Mark as Featured',
                'name' => 'publication_featured',
                'type' => 'true_false',
                'message' => 'Check to display this publication at the top of the archive page.',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'publication',
                ),
            ),
        ),
    ));

    // C. Conferences fields
    acf_add_local_field_group(array(
        'key' => 'group_conferences',
        'title' => 'Conference Details',
        'fields' => array(
            array(
                'key' => 'field_conf_display_date',
                'label' => 'Display Date Text',
                'name' => 'conference_display_date',
                'type' => 'text',
                'placeholder' => 'e.g. October 14-16, 2024',
            ),
            array(
                'key' => 'field_conf_sort_date',
                'label' => 'Sorting Date',
                'name' => 'conference_sort_date',
                'type' => 'date_picker',
                'display_format' => 'Y-m-d',
                'return_format' => 'Y-m-d',
            ),
            array(
                'key' => 'field_conf_location',
                'label' => 'Location',
                'name' => 'conference_location',
                'type' => 'text',
                'placeholder' => 'e.g. Zurich, Switzerland',
            ),
            array(
                'key' => 'field_conf_registration_link',
                'label' => 'Registration / Details Link',
                'name' => 'conference_registration_link',
                'type' => 'text',
            ),
            array(
                'key' => 'field_conf_status',
                'label' => 'Event Status',
                'name' => 'conference_status',
                'type' => 'select',
                'choices' => array(
                    'upcoming' => 'Upcoming Event',
                    'past' => 'Past / Archived',
                ),
                'default_value' => 'upcoming',
            ),
            array(
                'key' => 'field_conf_badge',
                'label' => 'Badge Labels',
                'name' => 'conference_badge',
                'type' => 'text',
                'placeholder' => 'e.g. Physics, Video, Summary',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'conference',
                ),
            ),
        ),
    ));

    // D. About Page fields (Timeline & Objectives)
    acf_add_local_field_group(array(
        'key' => 'group_about_page',
        'title' => 'About Us Template Settings',
        'fields' => array(
            array(
                'key' => 'field_about_content_tab',
                'label' => 'Hero & Page Content',
                'type' => 'tab',
            ),
            array(
                'key' => 'field_about_page_hero_title',
                'label' => 'Hero Title',
                'name' => 'about_hero_title',
                'type' => 'text',
                'default_value' => 'Defining the Future through Rigorous Inquiry',
            ),
            array(
                'key' => 'field_about_page_hero_desc',
                'label' => 'Hero Description',
                'name' => 'about_hero_description',
                'type' => 'textarea',
                'default_value' => 'Ivri Research is a global catalyst for intellectual advancement, bridging the gap between theoretical science and industrial application.',
            ),
            array(
                'key' => 'field_about_page_mission_title',
                'label' => 'Mission Title',
                'name' => 'about_mission_title',
                'type' => 'text',
                'default_value' => 'Our Mission',
            ),
            array(
                'key' => 'field_about_page_mission_desc',
                'label' => 'Mission Description',
                'name' => 'about_mission_description',
                'type' => 'textarea',
                'default_value' => 'Our mission is to accelerate the pace of innovation by fostering a global network of elite researchers. We provide the infrastructure, funding, and intellectual framework necessary to translate complex data into actionable strategies that solve the world\'s most pressing technical and social challenges.',
            ),
            array(
                'key' => 'field_about_page_vision_title',
                'label' => 'Vision Title',
                'name' => 'about_vision_title',
                'type' => 'text',
                'default_value' => 'Our Vision',
            ),
            array(
                'key' => 'field_about_page_vision_desc',
                'label' => 'Vision Description',
                'name' => 'about_vision_description',
                'type' => 'textarea',
                'default_value' => 'To become the global cornerstone of cross-disciplinary research, where groundbreaking discoveries serve as the foundation for a more resilient and technologically advanced society. We envision a world where every strategic decision is rooted in empirical truth and scientific excellence.',
            ),
            array(
                'key' => 'field_about_timeline_tab',
                'label' => 'Legacy Timeline',
                'type' => 'tab',
            ),
            array(
                'key' => 'field_about_timeline',
                'label' => 'Legacy Timeline',
                'name' => 'about_timeline',
                'type' => 'repeater',
                'layout' => 'row',
                'button_label' => 'Add Timeline Year',
                'sub_fields' => array(
                    array(
                        'key' => 'field_timeline_year',
                        'label' => 'Year',
                        'name' => 'timeline_year',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_timeline_title',
                        'label' => 'Title',
                        'name' => 'timeline_title',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_timeline_description',
                        'label' => 'Description',
                        'name' => 'timeline_description',
                        'type' => 'textarea',
                    ),
                    array(
                        'key' => 'field_timeline_image',
                        'label' => 'Image',
                        'name' => 'timeline_image',
                        'type' => 'image',
                        'return_format' => 'url',
                    ),
                ),
            ),
            array(
                'key' => 'field_about_objectives',
                'label' => 'Core Objectives',
                'name' => 'about_objectives',
                'type' => 'repeater',
                'layout' => 'row',
                'button_label' => 'Add Objective',
                'sub_fields' => array(
                    array(
                        'key' => 'field_objective_number',
                        'label' => 'Objective Number',
                        'name' => 'objective_number',
                        'type' => 'text',
                        'placeholder' => 'Objective 01',
                    ),
                    array(
                        'key' => 'field_objective_icon',
                        'label' => 'Material Icon Name',
                        'name' => 'objective_icon',
                        'type' => 'text',
                        'placeholder' => 'analytics',
                    ),
                    array(
                        'key' => 'field_objective_title',
                        'label' => 'Objective Title',
                        'name' => 'objective_title',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_objective_description',
                        'label' => 'Objective Description',
                        'name' => 'objective_description',
                        'type' => 'textarea',
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'template-about.php',
                ),
            ),
        ),
    ));

    // E. Research Areas fields
    acf_add_local_field_group(array(
        'key' => 'group_research_areas_page',
        'title' => 'Research Areas Settings',
        'fields' => array(
            array(
                'key' => 'field_research_page_hero_title',
                'label' => 'Hero Title',
                'name' => 'research_hero_title',
                'type' => 'text',
                'default_value' => 'Advancing Human Understanding Through Multi-Disciplinary Rigor.',
            ),
            array(
                'key' => 'field_research_page_hero_desc',
                'label' => 'Hero Description',
                'name' => 'research_hero_description',
                'type' => 'textarea',
                'default_value' => 'Ivri Research operates across seven strategic domains, combining empirical science with innovative technology to address the most pressing challenges of the 21st century.',
            ),
            array(
                'key' => 'field_areas_list',
                'label' => 'Research Domains',
                'name' => 'areas_list',
                'type' => 'repeater',
                'layout' => 'row',
                'button_label' => 'Add Research Area',
                'sub_fields' => array(
                    array(
                        'key' => 'field_area_title',
                        'label' => 'Domain Name',
                        'name' => 'area_title',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_area_description',
                        'label' => 'Domain Description',
                        'name' => 'area_description',
                        'type' => 'textarea',
                    ),
                    array(
                        'key' => 'field_area_icon',
                        'label' => 'Material Icon Name',
                        'name' => 'area_icon',
                        'type' => 'text',
                        'placeholder' => 'biotech',
                    ),
                    array(
                        'key' => 'field_area_badge',
                        'label' => 'Badge Label',
                        'name' => 'area_badge',
                        'type' => 'text',
                        'placeholder' => 'Core Domain',
                    ),
                    array(
                        'key' => 'field_area_image',
                        'label' => 'Image (If featured/large)',
                        'name' => 'area_image',
                        'type' => 'image',
                        'return_format' => 'url',
                    ),
                    array(
                        'key' => 'field_area_bullets',
                        'label' => 'Bullet Points (One per line)',
                        'name' => 'area_bullets',
                        'type' => 'textarea',
                        'placeholder' => 'Neural Networks\nEthical Algorithms',
                    ),
                    array(
                        'key' => 'field_area_is_large',
                        'label' => 'Display as Large Card?',
                        'name' => 'area_is_large',
                        'type' => 'true_false',
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'template-research-areas.php',
                ),
            ),
        ),
    ));

    // F. Services fields
    acf_add_local_field_group(array(
        'key' => 'group_services_page',
        'title' => 'Services Settings',
        'fields' => array(
            array(
                'key' => 'field_services_page_hero_title',
                'label' => 'Hero Title',
                'name' => 'services_hero_title',
                'type' => 'text',
                'default_value' => 'Specialized Services for Modern Research',
            ),
            array(
                'key' => 'field_services_page_hero_desc',
                'label' => 'Hero Description',
                'name' => 'services_hero_description',
                'type' => 'textarea',
                'default_value' => 'We provide a robust infrastructure for academic and corporate scientific endeavors, ensuring rigorous standards and global reach through our specialized support pillars.',
            ),
            array(
                'key' => 'field_services_list',
                'label' => 'Service Offerings',
                'name' => 'services_list',
                'type' => 'repeater',
                'layout' => 'row',
                'button_label' => 'Add Service Card',
                'sub_fields' => array(
                    array(
                        'key' => 'field_service_title',
                        'label' => 'Service Title',
                        'name' => 'service_title',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_service_description',
                        'label' => 'Service Description',
                        'name' => 'service_description',
                        'type' => 'textarea',
                    ),
                    array(
                        'key' => 'field_service_icon',
                        'label' => 'Material Icon Name',
                        'name' => 'service_icon',
                        'type' => 'text',
                        'placeholder' => 'query_stats',
                    ),
                    array(
                        'key' => 'field_service_bullets',
                        'label' => 'Details List (One per line)',
                        'name' => 'service_bullets',
                        'type' => 'textarea',
                        'placeholder' => 'Methodological Audits\nData Strategy Planning',
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'template-services.php',
                ),
            ),
        ),
    ));
}

/* ==========================================================================
   5. AJAX Contact Form Submission Handler
   ========================================================================== */
function ivri_handle_contact_form() {
    // 1. Verify CSRF security nonce
    if ( ! isset( $_POST['security'] ) || ! wp_verify_nonce( $_POST['security'], 'contact_form_nonce' ) ) {
        wp_send_json_error( array( 'message' => esc_html__( 'Security check failed. Please refresh and try again.', 'ivri-research' ) ) );
    }

    // 2. Sanitize and validate inputs
    $name    = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
    $email   = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
    $subject = isset( $_POST['subject'] ) ? sanitize_text_field( wp_unslash( $_POST['subject'] ) ) : '';
    $message = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';

    if ( empty( $name ) || empty( $email ) || empty( $subject ) || empty( $message ) ) {
        wp_send_json_error( array( 'message' => esc_html__( 'All fields are required.', 'ivri-research' ) ) );
    }

    if ( ! is_email( $email ) ) {
        wp_send_json_error( array( 'message' => esc_html__( 'Please provide a valid email address.', 'ivri-research' ) ) );
    }

    // 3. Compose Email
    $to = get_option( 'admin_email' );
    $email_subject = sprintf( '[Ivri Contact Form] %s - %s', $subject, $name );
    
    $email_body  = "You have received a new message from the Ivri Research website contact form:\n\n";
    $email_body .= "Name: " . $name . "\n";
    $email_body .= "Email: " . $email . "\n";
    $email_body .= "Subject: " . $subject . "\n\n";
    $email_body .= "Message:\n" . $message . "\n";

    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'From: Ivri Research <' . $to . '>',
        'Reply-To: ' . $name . ' <' . $email . '>'
    );

    // 4. Send email notice
    $mail_sent = wp_mail( $to, $email_subject, $email_body, $headers );

    if ( $mail_sent ) {
        wp_send_json_success( array( 'message' => esc_html__( 'Thank you! Your message has been sent successfully.', 'ivri-research' ) ) );
    } else {
        wp_send_json_error( array( 'message' => esc_html__( 'Failed to send your email. Please try again later.', 'ivri-research' ) ) );
    }
}
add_action( 'wp_ajax_submit_contact_form', 'ivri_handle_contact_form' );
add_action( 'wp_ajax_nopriv_submit_contact_form', 'ivri_handle_contact_form' );
