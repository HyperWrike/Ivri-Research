<?php
/**
 * Front Page Template - Homepage
 */
get_header();

$page_id = get_the_ID();

// Hero fields
$hero_title      = get_field( 'hero_title' ) ?: 'Ivri Research: Advancing Research Innovation';
$hero_desc       = get_field( 'hero_description' ) ?: 'Our mission is to solve humanity\'s most complex challenges through rigorous scientific inquiry, cross-disciplinary collaboration, and the relentless pursuit of intellectual clarity.';
$hero_image      = get_field( 'hero_image' );
$hero_btn1_text  = get_field( 'hero_btn1_text' ) ?: 'View Publications';
$hero_btn1_link  = get_field( 'hero_btn1_link' ) ?: '/publications/';
$hero_btn2_text  = get_field( 'hero_btn2_text' ) ?: 'Learn More';
$hero_btn2_link  = get_field( 'hero_btn2_link' ) ?: '/about-us/';

// About bento fields
$about_title       = get_field( 'about_title' ) ?: 'About Us';
$about_desc        = get_field( 'about_description' ) ?: 'Founded on the principles of precision and foresight, Ivri Research provides strategic consulting and scientific analysis for global enterprises. We bridge the gap between laboratory results and corporate strategy.';
$papers_counter    = get_field( 'about_papers_counter' ) ?: '142+';
$papers_label      = get_field( 'about_papers_label' ) ?: 'Published Papers 2024';

// Quote
$quote_text   = get_field( 'quote_text' ) ?: '"Precision is not an option; it is the fundamental requirement for innovation that lasts."';
$quote_author = get_field( 'quote_author' ) ?: 'Dr. Elara Ivri, Director of Research';

// URLs
$about_url      = get_page_link( get_page_by_path( 'about-us' ) );
$research_url   = get_page_link( get_page_by_path( 'research-areas' ) );
$services_url   = get_page_link( get_page_by_path( 'services' ) );
$pub_url        = get_post_type_archive_link( 'publication' );
?>

<main class="min-h-screen">
    <!-- Hero Section -->
    <header class="relative pt-20 md:pt-24 min-h-[60vh] md:min-h-[85vh] flex items-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <?php if ( $hero_image ) : ?>
                <img alt="Ivri Research Laboratory" class="w-full h-full object-cover" src="<?php echo esc_url( $hero_image ); ?>"/>
            <?php else : ?>
                <img alt="Ivri Research Laboratory" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida/AP1WRLs7PLOSQX9Idm1TD3IsFoEyYBHyuwMuj6m9P_ykKGqVDTxYUOwGFCQc5y3XGQGvFZEJT1gwzX-1WMmsWUlvf8S5njgfgY2OJ14xfDGzBDtEc63eP5hHxrHjmnWvLY0mGjOfHRebOu_j_8QTgxCRymBDpTMfkyCo2IilLezODqwkfqNmkoviw1kse_zQ9VUZGz4BitvSxFVIfXxOWIrEv7gE1vmORgFmoMx3_LhiDYMnpLJIykdReeSF1mA"/>
            <?php endif; ?>
            <div class="absolute inset-0 hero-gradient"></div>
        </div>
        <div class="relative z-10 w-full max-w-container-max mx-auto px-4 md:px-margin-desktop">
            <div class="max-w-2xl">
                <div class="inline-flex items-center space-x-2 bg-primary/5 px-3 py-1 rounded-full border border-primary/10 mb-stack-md">
                    <span class="material-symbols-outlined text-[18px] text-primary">science</span>
                    <span class="font-label-sm text-label-sm text-primary uppercase tracking-widest">Global Intelligence Platform</span>
                </div>
                <h1 class="font-display-lg text-headline-lg md:text-display-lg text-primary mb-stack-md">
                    <?php echo esc_html( $hero_title ); ?>
                </h1>
                <p class="font-body-lg text-body-lg text-on-surface-variant mb-stack-lg max-w-xl">
                    <?php echo esc_html( $hero_desc ); ?>
                </p>
                <div class="flex flex-wrap gap-stack-md">
                    <a href="<?php echo esc_url( $hero_btn1_link ?: $pub_url ); ?>" class="bg-[#10B981] text-white px-8 py-3 rounded-lg font-label-md text-label-md hover:brightness-95 transition-all duration-300">
                        <?php echo esc_html( $hero_btn1_text ); ?>
                    </a>
                    <a href="<?php echo esc_url( $hero_btn2_link ?: $about_url ); ?>" class="border border-primary text-primary px-8 py-3 rounded-lg font-label-md text-label-md hover:bg-primary hover:text-white transition-all duration-300">
                        <?php echo esc_html( $hero_btn2_text ); ?>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Bento Grid Section -->
    <section class="py-stack-lg scientific-grid">
        <div class="max-w-container-max mx-auto px-4 md:px-margin-desktop">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-gutter">
                <!-- About Us Card -->
                <div class="md:col-span-8 bg-surface-container-lowest border border-outline-variant p-stack-lg flex flex-col justify-between group hover:border-primary transition-colors duration-300">
                    <div>
                        <div class="flex justify-between items-start mb-stack-md">
                            <span class="material-symbols-outlined text-[32px] text-primary">corporate_fare</span>
                            <span class="font-label-sm text-label-sm text-outline">01 / PERSPECTIVE</span>
                        </div>
                        <h2 class="font-headline-lg text-headline-lg text-primary mb-stack-sm"><?php echo esc_html( $about_title ); ?></h2>
                        <p class="font-body-md text-body-md text-secondary max-w-lg">
                            <?php echo esc_html( $about_desc ); ?>
                        </p>
                    </div>
                    <a href="<?php echo esc_url( $about_url ?: home_url('/about-us/') ); ?>" class="mt-stack-lg flex items-center group-hover:translate-x-2 transition-transform duration-300">
                        <span class="font-label-md text-label-md text-primary mr-2">Our History &amp; Values</span>
                        <span class="material-symbols-outlined">trending_flat</span>
                    </a>
                </div>

                <!-- Research Counter Card -->
                <div class="md:col-span-4 bg-primary text-on-primary p-stack-lg flex flex-col justify-center items-center text-center">
                    <div class="font-display-lg text-display-lg mb-2"><?php echo esc_html( $papers_counter ); ?></div>
                    <div class="font-label-md text-label-md uppercase tracking-tighter opacity-70"><?php echo esc_html( $papers_label ); ?></div>
                </div>

                <!-- Research Areas Card -->
                <div class="md:col-span-4 bg-surface-container-low border border-outline-variant p-stack-lg group hover:bg-surface-container transition-colors duration-300">
                    <div class="bg-surface-container-lowest w-12 h-12 flex items-center justify-center rounded-lg border border-outline-variant mb-stack-md">
                        <span class="material-symbols-outlined text-primary">biotech</span>
                    </div>
                    <h2 class="font-headline-md text-headline-md text-primary mb-stack-sm">Research Areas</h2>
                    <p class="font-body-sm text-body-sm text-secondary mb-stack-md">
                        From computational genomics to quantum logistics, we explore the boundaries of possible.
                    </p>
                    <ul class="space-y-2 mb-stack-lg">
                        <li class="flex items-center text-label-sm font-label-sm"><span class="w-1.5 h-1.5 bg-[#10B981] rounded-full mr-2"></span> Biotechnology</li>
                        <li class="flex items-center text-label-sm font-label-sm"><span class="w-1.5 h-1.5 bg-[#10B981] rounded-full mr-2"></span> Quantum Systems</li>
                        <li class="flex items-center text-label-sm font-label-sm"><span class="w-1.5 h-1.5 bg-[#10B981] rounded-full mr-2"></span> Materials Science</li>
                    </ul>
                    <a class="font-label-sm text-label-sm text-primary underline decoration-primary/30 underline-offset-4" href="<?php echo esc_url( $research_url ?: home_url('/research-areas/') ); ?>">Explore Domain</a>
                </div>

                <!-- Services Card -->
                <div class="md:col-span-8 relative overflow-hidden bg-surface-container-lowest border border-outline-variant p-stack-lg group">
                    <div class="relative z-10">
                        <h2 class="font-headline-lg text-headline-lg text-primary mb-stack-sm">Our Services</h2>
                        <p class="font-body-md text-body-md text-secondary mb-stack-lg max-w-md">
                            Tailored analytical solutions for high-stakes environments. We provide the data, you make the decision.
                        </p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-stack-md">
                            <a href="<?php echo esc_url( $services_url ?: home_url('/services/') ); ?>" class="p-stack-md bg-background border border-outline-variant hover:border-primary transition-all">
                                <span class="material-symbols-outlined text-primary mb-2">monitoring</span>
                                <div class="font-label-md text-label-md">Strategic Audits</div>
                            </a>
                            <a href="<?php echo esc_url( $services_url ?: home_url('/services/') ); ?>" class="p-stack-md bg-background border border-outline-variant hover:border-primary transition-all">
                                <span class="material-symbols-outlined text-primary mb-2">analytics</span>
                                <div class="font-label-md text-label-md">Data Modeling</div>
                            </a>
                        </div>
                    </div>
                    <div class="absolute right-0 bottom-0 opacity-5 pointer-events-none translate-x-1/4 translate-y-1/4 group-hover:scale-110 transition-transform duration-700">
                        <span class="material-symbols-outlined text-[300px]">hub</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Quote / Mission Break -->
    <section class="py-12 md:py-24 bg-surface-container-lowest border-y border-outline-variant">
        <div class="max-w-container-max mx-auto px-4 md:px-margin-desktop text-center">
            <span class="material-symbols-outlined text-primary text-[48px] opacity-20 mb-stack-md">format_quote</span>
            <blockquote class="font-display-lg text-headline-md md:text-headline-lg text-primary max-w-4xl mx-auto mb-stack-lg italic">
                <?php echo esc_html( $quote_text ); ?>
            </blockquote>
            <div class="flex items-center justify-center space-x-2">
                <div class="h-[1px] w-12 bg-outline-variant"></div>
                <cite class="font-label-md text-label-md text-secondary uppercase tracking-widest not-italic">
                    <?php echo esc_html( $quote_author ); ?>
                </cite>
                <div class="h-[1px] w-12 bg-outline-variant"></div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
