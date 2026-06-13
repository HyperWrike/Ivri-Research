<?php
/**
 * Archive template for Publications CPT
 */
get_header();

// Handle search and filter
$search_query = isset( $_GET['pub_search'] ) ? sanitize_text_field( $_GET['pub_search'] ) : '';
$filter_year  = isset( $_GET['pub_year'] ) ? sanitize_text_field( $_GET['pub_year'] ) : '';
$filter_genre = isset( $_GET['pub_genre'] ) ? sanitize_text_field( $_GET['pub_genre'] ) : '';

// Build query args
$query_args = array(
    'post_type'      => 'publication',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'meta_query'     => array( 'relation' => 'AND' ),
);

if ( $search_query ) {
    $query_args['s'] = $search_query;
}
if ( $filter_year ) {
    $query_args['date_query'] = array(
        array( 'year' => intval( $filter_year ) )
    );
}
if ( $filter_genre ) {
    $query_args['meta_query'][] = array(
        'key'     => 'publication_genre',
        'value'   => $filter_genre,
        'compare' => '='
    );
}

$pub_query   = new WP_Query( $query_args );
$all_posts   = $pub_query->posts;

// Separate featured from rest
$featured_post = null;
$standard_posts = array();
foreach ( $all_posts as $post ) {
    if ( ! $featured_post && get_field( 'publication_featured', $post->ID ) ) {
        $featured_post = $post;
    } else {
        $standard_posts[] = $post;
    }
}
// If no featured explicitly set, use first
if ( ! $featured_post && ! empty( $all_posts ) ) {
    $featured_post = array_shift( $all_posts );
    $standard_posts = $all_posts;
}
?>

<main class="w-full max-w-container-max mx-auto px-4 md:px-margin-desktop py-stack-lg space-y-12 pt-24 md:pt-28">

    <!-- Hero & Integrity Statement -->
    <section class="grid grid-cols-1 lg:grid-cols-12 gap-gutter items-end border-b border-outline-variant pb-stack-lg">
        <div class="lg:col-span-8 space-y-stack-md">
            <span class="font-label-sm text-label-sm uppercase tracking-widest text-secondary">Scholarly Archive</span>
            <h1 class="font-display-lg text-headline-lg md:text-display-lg text-primary">Academic Publications</h1>
            <p class="font-body-lg text-body-lg text-secondary max-w-2xl">
                Our rigorous peer-review process ensures that every finding published by Ivri Research contributes meaningfully to the global scientific community.
            </p>
        </div>
        <div class="lg:col-span-4 bg-surface-container-high p-6 border border-outline-variant">
            <div class="flex items-start gap-3">
                <span class="material-symbols-outlined text-primary">verified_user</span>
                <div class="space-y-1">
                    <h3 class="font-label-md text-label-md text-primary">Integrity Statement</h3>
                    <p class="font-body-sm text-body-sm text-on-surface-variant">
                        Ivri Research adheres to the highest standards of publication ethics. We maintain strict neutrality and transparent methodology in all multi-domain AI and quantum frameworks.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Search & Filters -->
    <section>
        <form method="GET" action="<?php echo esc_url( get_post_type_archive_link('publication') ); ?>" class="flex flex-col md:flex-row justify-between items-start md:items-center gap-stack-md">
            <div class="relative w-full md:w-96">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline">search</span>
                <input class="w-full pl-10 pr-4 py-2 bg-surface-container border border-outline-variant focus:border-primary focus:ring-0 outline-none font-body-sm transition-all"
                       placeholder="Search publications by keyword..."
                       type="text" name="pub_search"
                       value="<?php echo esc_attr( $search_query ); ?>"/>
            </div>
            <div class="flex flex-wrap gap-stack-sm items-center">
                <span class="font-label-sm text-label-sm text-secondary">Filter by:</span>
                <select name="pub_year" class="bg-surface-container border-outline-variant font-label-sm text-label-sm py-1 px-3 outline-none focus:border-primary">
                    <option value="">Year</option>
                    <?php
                    $current_year = date('Y');
                    for ( $y = $current_year; $y >= 2020; $y-- ) {
                        $selected = selected( $filter_year, $y, false );
                        echo '<option value="' . esc_attr($y) . '" ' . $selected . '>' . esc_html($y) . '</option>';
                    }
                    ?>
                </select>
                <select name="pub_genre" class="bg-surface-container border-outline-variant font-label-sm text-label-sm py-1 px-3 outline-none focus:border-primary">
                    <option value="">Journal Type</option>
                    <option value="AI" <?php selected( $filter_genre, 'AI' ); ?>>AI &amp; Machine Learning</option>
                    <option value="Quantum" <?php selected( $filter_genre, 'Quantum' ); ?>>Quantum Computing</option>
                    <option value="Bio-Engineering" <?php selected( $filter_genre, 'Bio-Engineering' ); ?>>Bio-Engineering</option>
                    <option value="HCI" <?php selected( $filter_genre, 'HCI' ); ?>>HCI</option>
                    <option value="Hardware" <?php selected( $filter_genre, 'Hardware' ); ?>>Hardware</option>
                    <option value="Finance" <?php selected( $filter_genre, 'Finance' ); ?>>Finance</option>
                </select>
                <?php if ( $search_query || $filter_year || $filter_genre ) : ?>
                <a href="<?php echo esc_url( get_post_type_archive_link('publication') ); ?>" class="bg-surface-container border border-outline-variant px-3 py-1 font-label-sm text-label-sm hover:bg-surface-container-high transition-colors">Clear All</a>
                <?php else : ?>
                <button type="submit" class="bg-surface-container border border-outline-variant px-3 py-1 font-label-sm text-label-sm hover:bg-surface-container-high transition-colors">Apply Filters</button>
                <?php endif; ?>
            </div>
        </form>
    </section>

    <!-- Publications Grid -->
    <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-gutter">

        <?php if ( $pub_query->have_posts() ) : ?>

        <!-- Featured Publication -->
        <?php if ( $featured_post ) :
            $pub_journal  = get_field( 'publication_journal', $featured_post->ID );
            $pub_date     = get_field( 'publication_date', $featured_post->ID );
            $pub_year     = $pub_date ? date('Y', strtotime($pub_date)) : '';
            $pub_abstract = get_field( 'publication_abstract', $featured_post->ID ) ?: wp_trim_words( get_the_excerpt($featured_post), 40 );
            $pub_pdf      = get_field( 'publication_pdf', $featured_post->ID );
            $pub_genre    = get_field( 'publication_genre', $featured_post->ID );
            ?>
        <div class="md:col-span-2 lg:col-span-2 bg-white border border-outline-variant p-stack-lg paper-hover transition-all flex flex-col justify-between">
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <span class="bg-primary text-white text-[10px] px-2 py-0.5 font-bold tracking-tighter">FEATURED</span>
                    <span class="font-label-sm text-label-sm text-secondary">
                        <?php echo esc_html( $pub_journal ); ?>
                        <?php if ( $pub_year ) echo '(' . esc_html($pub_year) . ')'; ?>
                    </span>
                </div>
                <h2 class="font-headline-lg text-headline-lg text-primary mb-4 leading-tight">
                    <a href="<?php echo esc_url( get_permalink( $featured_post ) ); ?>"><?php echo esc_html( $featured_post->post_title ); ?></a>
                </h2>
                <p class="font-body-md text-body-md text-on-surface-variant mb-6 line-clamp-3">
                    <?php echo esc_html( $pub_abstract ); ?>
                </p>
            </div>
            <div class="flex justify-between items-center mt-6 pt-6 border-t border-outline-variant">
                <div class="flex gap-2">
                    <?php if ( $pub_genre ) : ?>
                    <span class="bg-surface-container-high text-primary px-2 py-1 font-label-sm text-label-sm"><?php echo esc_html($pub_genre); ?></span>
                    <?php endif; ?>
                </div>
                <?php if ( $pub_pdf ) : ?>
                <a class="flex items-center gap-1 font-label-md text-label-md text-primary hover:underline" href="<?php echo esc_url( $pub_pdf ); ?>" target="_blank">
                    Download PDF <span class="material-symbols-outlined text-sm">download</span>
                </a>
                <?php else : ?>
                <a class="flex items-center gap-1 font-label-md text-label-md text-primary hover:underline" href="<?php echo esc_url( get_permalink($featured_post) ); ?>">
                    View Publication <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </a>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- Standard Publications -->
        <?php foreach ( $standard_posts as $post ) :
            setup_postdata( $post );
            $pub_journal  = get_field( 'publication_journal', $post->ID );
            $pub_date     = get_field( 'publication_date', $post->ID );
            $pub_year     = $pub_date ? date('Y', strtotime($pub_date)) : get_the_date('Y', $post);
            $pub_abstract = get_field( 'publication_abstract', $post->ID ) ?: wp_trim_words( get_the_excerpt($post), 20 );
            $pub_doi      = get_field( 'publication_doi', $post->ID );
            $pub_genre    = get_field( 'publication_genre', $post->ID );
            ?>
        <div class="bg-surface-container p-stack-md border border-outline-variant paper-hover transition-all flex flex-col">
            <span class="font-label-sm text-label-sm text-secondary mb-2">
                <?php echo esc_html( $pub_journal ); ?><?php if ( $pub_year ) echo ' (' . esc_html($pub_year) . ')'; ?>
            </span>
            <h3 class="font-headline-md text-headline-md text-primary mb-4">
                <a href="<?php echo esc_url( get_permalink($post) ); ?>"><?php echo esc_html( $post->post_title ); ?></a>
            </h3>
            <p class="font-body-sm text-body-sm text-on-surface-variant flex-grow">
                <?php echo esc_html( $pub_abstract ); ?>
            </p>
            <div class="mt-6 flex justify-between items-center">
                <?php if ( $pub_genre ) : ?>
                <span class="bg-surface-container-highest text-primary px-2 py-1 font-label-sm text-label-sm"><?php echo esc_html( $pub_genre ); ?></span>
                <?php endif; ?>
                <a href="<?php echo esc_url( $pub_doi ? 'https://doi.org/' . $pub_doi : get_permalink($post) ); ?>" target="<?php echo $pub_doi ? '_blank' : '_self'; ?>" class="material-symbols-outlined text-primary hover:scale-110 transition-transform">open_in_new</a>
            </div>
        </div>
        <?php endforeach; wp_reset_postdata(); ?>

        <?php else : ?>
        <!-- No results found -->
        <div class="col-span-3 text-center py-24">
            <span class="material-symbols-outlined text-[64px] text-secondary opacity-40 mb-4">article</span>
            <p class="font-headline-md text-secondary">No publications found matching your criteria.</p>
            <?php if ( $search_query || $filter_year || $filter_genre ) : ?>
            <a href="<?php echo esc_url( get_post_type_archive_link('publication') ); ?>" class="mt-4 inline-block font-label-md text-primary underline">Clear filters and view all</a>
            <?php endif; ?>
        </div>
        <?php endif; ?>

    </section>

    <!-- Newsletter Subscribe -->
    <section class="bg-primary text-on-primary p-4 md:p-margin-desktop flex flex-col md:flex-row items-center justify-between gap-stack-lg">
        <div class="space-y-stack-sm max-w-xl">
            <h2 class="font-headline-lg text-headline-lg">Stay Informed</h2>
            <p class="font-body-md opacity-80">Subscribe to receive monthly digests of our latest peer-reviewed publications and white papers directly in your inbox.</p>
        </div>
        <div class="flex w-full md:w-auto gap-2">
            <input class="bg-white/10 border border-white/20 px-4 py-2 font-body-sm outline-none focus:border-white w-full md:w-64 placeholder:text-white/50" placeholder="Institutional email" type="email" id="newsletter-email"/>
            <button class="bg-white text-primary px-6 py-2 font-label-md whitespace-nowrap hover:bg-secondary-fixed transition-colors">Join Registry</button>
        </div>
    </section>

</main>

<?php get_footer(); ?>
