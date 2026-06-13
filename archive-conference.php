<?php
/**
 * Archive template for Conferences CPT
 */
get_header();

$today = date('Y-m-d');

// Query Upcoming Conferences
$upcoming_args = array(
    'post_type'      => 'conference',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'meta_query'     => array(
        'relation' => 'OR',
        array(
            'key'     => 'conference_status',
            'value'   => 'upcoming',
            'compare' => '='
        ),
        array(
            'key'     => 'conference_sort_date',
            'value'   => $today,
            'compare' => '>='
        ),
    ),
    'orderby'  => 'meta_value',
    'meta_key' => 'conference_sort_date',
    'order'    => 'ASC',
);
$upcoming_query = new WP_Query( $upcoming_args );

// Query Past Conferences
$past_args = array(
    'post_type'      => 'conference',
    'posts_per_page' => 6,
    'post_status'    => 'publish',
    'meta_query'     => array(
        'relation' => 'AND',
        array(
            'key'     => 'conference_status',
            'value'   => 'past',
            'compare' => '='
        ),
    ),
    'orderby'  => 'meta_value',
    'meta_key' => 'conference_sort_date',
    'order'    => 'DESC',
);
$past_query = new WP_Query( $past_args );
?>

<main class="pt-32 pb-stack-lg px-margin-desktop max-w-container-max mx-auto">

    <!-- Hero Section -->
    <section class="mb-20">
        <div class="max-w-3xl">
            <h1 class="font-display-lg text-display-lg text-primary mb-stack-md">Global Knowledge Exchange</h1>
            <p class="font-body-lg text-body-lg text-on-surface-variant leading-relaxed">
                Ivri Research convenes the world's leading minds to bridge the gap between theoretical science and corporate strategy. Explore our schedule of upcoming summits and historical proceedings.
            </p>
        </div>
    </section>

    <!-- Upcoming Conferences -->
    <section class="mb-24">
        <div class="flex items-center justify-between mb-stack-lg">
            <h2 class="font-headline-lg text-headline-lg text-primary flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">event_upcoming</span>
                Upcoming Events
            </h2>
            <div class="h-px flex-grow mx-stack-lg bg-outline-variant"></div>
        </div>

        <?php if ( $upcoming_query->have_posts() ) : ?>
        <div class="bento-grid">
            <?php
            $up_index = 0;
            while ( $upcoming_query->have_posts() ) : $upcoming_query->the_post();
                $conf_date     = get_field( 'conference_display_date' );
                $conf_location = get_field( 'conference_location' );
                $conf_reg_link = get_field( 'conference_registration_link' );
                $is_first      = $up_index === 0;
                ?>
                <?php if ( $is_first ) : ?>
                <!-- Featured/First Upcoming Conference -->
                <div class="col-span-12 lg:col-span-8 group relative overflow-hidden rounded-xl border border-outline-variant bg-surface-container-lowest conference-card">
                    <div class="flex flex-col md:flex-row h-full">
                        <div class="md:w-1/2 relative h-64 md:h-auto">
                            <?php if ( has_post_thumbnail() ) : ?>
                            <?php the_post_thumbnail( 'large', array( 'class' => 'absolute inset-0 w-full h-full object-cover grayscale-[20%] group-hover:grayscale-0 transition-all duration-500' ) ); ?>
                            <?php else : ?>
                            <div class="absolute inset-0 bg-primary-container flex items-center justify-center">
                                <span class="material-symbols-outlined text-[80px] text-white opacity-30">calendar_today</span>
                            </div>
                            <?php endif; ?>
                            <div class="absolute top-4 left-4 bg-primary text-on-primary px-4 py-1 font-label-sm text-label-sm rounded-full">Featured</div>
                        </div>
                        <div class="md:w-1/2 p-stack-lg flex flex-col justify-between">
                            <div>
                                <div class="flex items-center gap-2 text-on-surface-variant mb-stack-sm font-label-md text-label-md uppercase tracking-wider">
                                    <span class="material-symbols-outlined text-[18px]">calendar_today</span>
                                    <?php echo esc_html( $conf_date ?: get_the_date('F j, Y') ); ?>
                                </div>
                                <h3 class="font-headline-md text-headline-md text-primary mb-stack-md"><?php the_title(); ?></h3>
                                <?php if ( $conf_location ) : ?>
                                <div class="flex items-center gap-2 text-secondary mb-stack-md font-body-sm text-body-sm">
                                    <span class="material-symbols-outlined text-[18px]">location_on</span>
                                    <?php echo esc_html( $conf_location ); ?>
                                </div>
                                <?php endif; ?>
                                <p class="text-on-surface-variant font-body-md text-body-md mb-stack-lg line-clamp-3">
                                    <?php the_excerpt(); ?>
                                </p>
                            </div>
                            <a href="<?php echo esc_url( $conf_reg_link ?: get_permalink() ); ?>" class="w-fit border border-primary text-primary px-8 py-3 rounded-lg font-label-md text-label-md hover:bg-primary hover:text-on-primary transition-all group-hover:shadow-lg <?php echo $conf_reg_link ? '' : 'cursor-pointer'; ?>">
                                <?php echo $conf_reg_link ? 'Register Now' : 'View Details'; ?>
                            </a>
                        </div>
                    </div>
                </div>
                <?php else : ?>
                <!-- Secondary Upcoming Conference -->
                <div class="col-span-12 lg:col-span-4 rounded-xl border border-outline-variant bg-surface-container-lowest p-stack-lg flex flex-col justify-between conference-card">
                    <div>
                        <div class="flex items-center gap-2 text-on-surface-variant mb-stack-sm font-label-md text-label-md">
                            <span class="material-symbols-outlined text-[18px]">calendar_today</span>
                            <?php echo esc_html( $conf_date ?: get_the_date('F j, Y') ); ?>
                        </div>
                        <h3 class="font-headline-md text-headline-md text-primary mb-stack-md"><?php the_title(); ?></h3>
                        <?php if ( $conf_location ) : ?>
                        <div class="flex items-center gap-2 text-secondary mb-stack-md font-body-sm text-body-sm">
                            <span class="material-symbols-outlined text-[18px]">location_on</span>
                            <?php echo esc_html( $conf_location ); ?>
                        </div>
                        <?php endif; ?>
                        <p class="text-on-surface-variant font-body-md text-body-md line-clamp-3">
                            <?php the_excerpt(); ?>
                        </p>
                    </div>
                    <div class="mt-stack-lg pt-stack-md border-t border-outline-variant">
                        <a class="flex items-center gap-2 text-primary font-label-md text-label-md hover:underline" href="<?php echo esc_url( $conf_reg_link ?: get_permalink() ); ?>">
                            <?php echo $conf_reg_link ? 'Register Now' : 'View Syllabus'; ?>
                            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                        </a>
                    </div>
                </div>
                <?php endif; ?>
            <?php $up_index++; endwhile; wp_reset_postdata(); ?>
        </div>

        <?php else : ?>
        <!-- Fallback: Static Mockup Upcoming Events -->
        <div class="bento-grid">
            <!-- Global Innovation Summit 2024 - static fallback -->
            <div class="col-span-12 lg:col-span-8 group relative overflow-hidden rounded-xl border border-outline-variant bg-surface-container-lowest conference-card">
                <div class="flex flex-col md:flex-row h-full">
                    <div class="md:w-1/2 relative h-64 md:h-auto">
                        <img class="absolute inset-0 w-full h-full object-cover grayscale-[20%] group-hover:grayscale-0 transition-all duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDXQIp6dFEce4MPaK9Wm2MWl5qCQFHLVRbeSq_W17RuNEFza9IER5ZrTqoLKgCCeWsZHQdbFYg_4NRdGbwrCgT57okOV7D4uv3_lEniet-zdbpmJXYGHm2g9FJ_0JMpB1k-TDaOdeb4qg7GcM_gDS3ys-pCF3Fq3j4HR6sWbZjb3ysFCUeA09FdTWPMN_ASTdyLgoB8qhV2FDZ9N3TARKPO5Izrojko-Ii6pXgr0DN49Zfn57TTgGaiEb1kxHbvdhi7Sgy50iQTgRA" alt="Conference Hall"/>
                        <div class="absolute top-4 left-4 bg-primary text-on-primary px-4 py-1 font-label-sm text-label-sm rounded-full">Featured</div>
                    </div>
                    <div class="md:w-1/2 p-stack-lg flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-2 text-on-surface-variant mb-stack-sm font-label-md text-label-md uppercase tracking-wider">
                                <span class="material-symbols-outlined text-[18px]">calendar_today</span>
                                October 14-16, 2024
                            </div>
                            <h3 class="font-headline-md text-headline-md text-primary mb-stack-md">Global Innovation Summit 2024</h3>
                            <div class="flex items-center gap-2 text-secondary mb-stack-md font-body-sm text-body-sm">
                                <span class="material-symbols-outlined text-[18px]">location_on</span>
                                Zurich, Switzerland
                            </div>
                            <p class="text-on-surface-variant font-body-md text-body-md mb-stack-lg">The flagship event for Ivri Research, focusing on the convergence of artificial intelligence, renewable energy systems, and global economic resilience.</p>
                        </div>
                        <button data-contact-trigger class="w-fit border border-primary text-primary px-8 py-3 rounded-lg font-label-md text-label-md hover:bg-primary hover:text-on-primary transition-all">Register Now</button>
                    </div>
                </div>
            </div>
            <!-- Agri-Tech Workshop -->
            <div class="col-span-12 lg:col-span-4 rounded-xl border border-outline-variant bg-surface-container-lowest p-stack-lg flex flex-col justify-between conference-card">
                <div>
                    <div class="flex items-center gap-2 text-on-surface-variant mb-stack-sm font-label-md text-label-md">
                        <span class="material-symbols-outlined text-[18px]">calendar_today</span> November 02, 2024
                    </div>
                    <h3 class="font-headline-md text-headline-md text-primary mb-stack-md">Agri-Tech Frontiers Workshop</h3>
                    <div class="flex items-center gap-2 text-secondary mb-stack-md font-body-sm text-body-sm">
                        <span class="material-symbols-outlined text-[18px]">location_on</span> Nairobi, Kenya
                    </div>
                    <p class="text-on-surface-variant font-body-md text-body-md">An intensive technical workshop exploring climate-resilient crop engineering and autonomous agricultural infrastructure.</p>
                </div>
                <div class="mt-stack-lg pt-stack-md border-t border-outline-variant">
                    <a class="flex items-center gap-2 text-primary font-label-md text-label-md hover:underline" href="#">View Syllabus <span class="material-symbols-outlined text-[18px]">arrow_forward</span></a>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </section>

    <!-- Conference Archive -->
    <section class="mb-24">
        <div class="flex items-center justify-between mb-stack-lg">
            <h2 class="font-headline-lg text-headline-lg text-primary flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">history</span>
                Conference Archive
            </h2>
            <div class="h-px flex-grow mx-stack-lg bg-outline-variant"></div>
        </div>

        <?php if ( $past_query->have_posts() ) : ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-gutter">
            <?php while ( $past_query->have_posts() ) : $past_query->the_post();
                $conf_date  = get_field( 'conference_display_date' );
                $conf_badge = get_field( 'conference_badge' );
                $badge_items = $conf_badge ? array_filter(array_map('trim', explode(',', $conf_badge))) : array();
                ?>
            <div class="group p-stack-lg rounded-xl border border-outline-variant bg-surface-container-high/30 hover:bg-surface-container-high transition-colors">
                <div class="text-secondary font-label-sm text-label-sm mb-stack-sm"><?php echo esc_html( strtoupper($conf_date ?: get_the_date('F Y')) ); ?></div>
                <h4 class="font-headline-md text-[20px] text-primary mb-stack-sm"><?php the_title(); ?></h4>
                <p class="text-on-surface-variant font-body-sm text-body-sm mb-stack-md"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                <div class="flex flex-wrap gap-stack-sm">
                    <?php foreach ( $badge_items as $badge ) : ?>
                    <span class="px-3 py-1 bg-surface-container text-on-surface font-label-sm text-[10px] rounded uppercase tracking-tighter"><?php echo esc_html( $badge ); ?></span>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <?php else : ?>
        <!-- Fallback: Static Past Conferences -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-gutter">
            <?php
            $past_defaults = array(
                array('MARCH 2024', 'Quantum Materials Symposium', 'Proceedings on superconductivity at room temperature and topological insulators.', array('Physics', 'PDF Available')),
                array('JANUARY 2024', 'Urban Logistics 2024', 'Redefining city transit through decentralized swarm intelligence and drone corridors.', array('Infrastructure', 'Video')),
                array('NOVEMBER 2023', 'The Ethical AI Summit', 'A critical discourse on algorithmic bias and the governance of large-scale models.', array('Ethics', 'Summary')),
            );
            foreach ( $past_defaults as $pc ) : ?>
            <div class="group p-stack-lg rounded-xl border border-outline-variant bg-surface-container-high/30 hover:bg-surface-container-high transition-colors">
                <div class="text-secondary font-label-sm text-label-sm mb-stack-sm"><?php echo esc_html($pc[0]); ?></div>
                <h4 class="font-headline-md text-[20px] text-primary mb-stack-sm"><?php echo esc_html($pc[1]); ?></h4>
                <p class="text-on-surface-variant font-body-sm text-body-sm mb-stack-md"><?php echo esc_html($pc[2]); ?></p>
                <div class="flex gap-stack-sm">
                    <?php foreach ( $pc[3] as $badge ) : ?>
                    <span class="px-3 py-1 bg-surface-container text-on-surface font-label-sm text-[10px] rounded uppercase tracking-tighter"><?php echo esc_html($badge); ?></span>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <div class="mt-stack-lg text-center">
            <button class="text-secondary font-label-md text-label-md hover:text-primary flex items-center gap-2 mx-auto transition-colors">
                View Full Archive (2012 — <?php echo date('Y'); ?>)
                <span class="material-symbols-outlined">expand_more</span>
            </button>
        </div>
    </section>

    <!-- Call for Speakers CTA -->
    <section class="rounded-2xl bg-primary-container p-12 text-center relative overflow-hidden">
        <div class="relative z-10 max-w-2xl mx-auto">
            <h2 class="font-headline-lg text-headline-lg text-white mb-stack-md">Call for Speakers <?php echo date('Y') + 1; ?></h2>
            <p class="text-on-primary-container font-body-lg text-body-lg mb-stack-lg">
                Submit your research abstracts for our upcoming annual sessions. We prioritize novel methodology and cross-disciplinary impact.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <button data-contact-trigger class="bg-white text-primary px-8 py-3 rounded-lg font-label-md text-label-md hover:bg-on-primary-container transition-colors">Submit Abstract</button>
                <button data-contact-trigger class="border border-on-primary-container text-on-primary-container px-8 py-3 rounded-lg font-label-md text-label-md hover:bg-white/10 transition-colors">Sponsorship Inquiries</button>
            </div>
        </div>
        <div class="absolute top-0 right-0 w-64 h-64 bg-secondary-fixed-dim/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
    </section>

</main>

<?php get_footer(); ?>
