<?php
/**
 * Template Name: Services
 * Description: Page template for the Services page.
 */
get_header();

$hero_title = get_field( 'services_hero_title' ) ?: 'Specialized Services for Modern Research';
$hero_desc  = get_field( 'services_hero_description' ) ?: 'We provide a robust infrastructure for academic and corporate scientific endeavors, ensuring rigorous standards and global reach through our specialized support pillars.';
$services = get_field( 'services_list' );
?>

<main class="pt-24 md:pt-32 pb-stack-lg">
    <!-- Hero Section -->
    <section class="max-w-container-max mx-auto px-4 md:px-margin-desktop mb-12 md:mb-24 relative">
        <div class="absolute -top-12 -left-12 w-64 h-64 bg-primary-fixed opacity-10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="relative z-10 max-w-2xl">
            <h1 class="font-display-lg text-headline-lg md:text-display-lg mb-stack-md text-primary">
                <?php echo esc_html( $hero_title ); ?>
            </h1>
            <p class="font-body-md md:font-body-lg text-body-md md:text-body-lg text-secondary leading-relaxed">
                <?php echo esc_html( $hero_desc ); ?>
            </p>
        </div>
    </section>

    <!-- Services Grid -->
    <section class="max-w-container-max mx-auto px-4 md:px-margin-desktop custom-grid-pattern py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-gutter">

            <?php if ( $services && have_rows( 'services_list' ) ) :
                while ( have_rows( 'services_list' ) ) : the_row();
                    $title   = get_sub_field( 'service_title' );
                    $desc    = get_sub_field( 'service_description' );
                    $icon    = get_sub_field( 'service_icon' ) ?: 'query_stats';
                    $bullets_raw = get_sub_field( 'service_bullets' );
                    $bullets = $bullets_raw ? array_filter( array_map( 'trim', explode( "\n", $bullets_raw ) ) ) : array();
                    ?>
                    <div class="service-card group bg-surface-container-lowest border border-outline-variant p-stack-lg flex flex-col transition-all duration-300 hover:border-primary hover:shadow-xl">
                        <div class="mb-stack-md">
                            <span class="service-icon material-symbols-outlined text-4xl text-primary transition-transform duration-300"><?php echo esc_html( $icon ); ?></span>
                        </div>
                        <h3 class="font-headline-md text-headline-md text-primary mb-stack-sm"><?php echo esc_html( $title ); ?></h3>
                        <p class="font-body-md text-body-md text-secondary mb-stack-lg flex-grow"><?php echo esc_html( $desc ); ?></p>
                        <?php if ( ! empty( $bullets ) ) : ?>
                        <ul class="space-y-2 border-t border-outline-variant pt-stack-md">
                            <?php foreach ( $bullets as $bullet ) : ?>
                            <li class="flex items-center gap-2 text-label-sm font-label-sm text-on-surface-variant">
                                <span class="material-symbols-outlined text-sm">check_circle</span>
                                <?php echo esc_html( $bullet ); ?>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>
                    </div>
                <?php endwhile;
            else :
                $default_services = array(
                    array( 'query_stats', 'Research Consultation', 'Strategic guidance on research methodology, statistical validation, and conceptual frameworks tailored to complex organizational objectives.', array('Methodological Audits', 'Data Strategy Planning') ),
                    array( 'public', 'International Collaborations', 'Bridging geographic divides by connecting researchers with global institutions, facilitating cross-border knowledge exchange and joint ventures.', array('Global Network Access', 'Partnership Agreements') ),
                    array( 'groups', 'Conferences', 'Comprehensive management of scientific symposiums and academic conferences, from abstract management to venue logistics and publication.', array('Event Orchestration', 'Speaker Management') ),
                    array( 'menu_book', 'Scholarly Publications', 'End-to-end editorial support, including peer-review coordination, professional formatting, and indexing across major scientific databases.', array('Journal Placements', 'DOI Registration') ),
                    array( 'model_training', 'Capacity Building', 'Empowering the next generation of scholars through intensive workshops, grant-writing seminars, and technical training modules.', array('Skill Development', 'Mentorship Programs') ),
                    array( 'account_tree', 'Project Management', 'Rigorous administrative oversight for large-scale research projects, ensuring milestones are met on time and within resource parameters.', array('Milestone Tracking', 'Resource Optimization') ),
                );
                foreach ( $default_services as $svc ) : ?>
                <div class="service-card group bg-surface-container-lowest border border-outline-variant p-stack-lg flex flex-col transition-all duration-300 hover:border-primary hover:shadow-xl">
                    <div class="mb-stack-md">
                        <span class="service-icon material-symbols-outlined text-4xl text-primary transition-transform duration-300"><?php echo esc_html( $svc[0] ); ?></span>
                    </div>
                    <h3 class="font-headline-md text-headline-md text-primary mb-stack-sm"><?php echo esc_html( $svc[1] ); ?></h3>
                    <p class="font-body-md text-body-md text-secondary mb-stack-lg flex-grow"><?php echo esc_html( $svc[2] ); ?></p>
                    <ul class="space-y-2 border-t border-outline-variant pt-stack-md">
                        <?php foreach ( $svc[3] as $bullet ) : ?>
                        <li class="flex items-center gap-2 text-label-sm font-label-sm text-on-surface-variant">
                            <span class="material-symbols-outlined text-sm">check_circle</span>
                            <?php echo esc_html( $bullet ); ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endforeach;
            endif; ?>
        </div>
    </section>

    <!-- Bespoke CTA Section -->
    <section class="max-w-container-max mx-auto px-4 md:px-margin-desktop mt-12 md:mt-24">
        <div class="bg-surface-container p-6 md:p-stack-lg rounded-xl flex flex-col md:flex-row items-start md:items-center gap-gutter">
            <div class="flex-1">
                <h2 class="font-headline-lg text-headline-md md:text-headline-lg text-primary mb-stack-sm">Need a bespoke research solution?</h2>
                <p class="font-body-md text-body-md text-secondary">Our team specializes in creating custom workflows for multi-disciplinary initiatives that require specific scientific rigor.</p>
            </div>
            <div class="flex flex-col sm:flex-row gap-4 flex-wrap">
                <button data-contact-trigger class="px-8 py-3 bg-primary text-on-primary font-label-md text-label-md rounded-lg hover:opacity-90 transition-opacity">Request Consultation</button>
                <button class="px-8 py-3 border border-primary text-primary font-label-md text-label-md rounded-lg hover:bg-surface-container-high transition-colors">View Case Studies</button>
            </div>
        </div>
    </section>

    <!-- Atmosphere Section -->
    <section class="w-full mt-12 md:mt-24 min-h-[280px] md:h-[400px] relative overflow-hidden bg-primary-container">
        <div class="absolute inset-0 flex items-center justify-center text-center p-6 md:p-margin-desktop">
            <div class="max-w-xl">
                <h3 class="font-display-lg text-headline-md md:text-headline-lg text-surface-container-lowest mb-stack-md">Advancing the Frontiers of Scientific Inquiry</h3>
                <div class="flex flex-wrap justify-center gap-2 md:gap-4 text-surface-container-lowest/80 font-label-md text-label-md uppercase tracking-widest">
                    <span>Precision</span><span class="opacity-50">/</span>
                    <span>Integrity</span><span class="opacity-50">/</span>
                    <span>Global Impact</span>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
