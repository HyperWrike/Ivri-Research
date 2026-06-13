<?php
/**
 * Single Conference Template
 */
get_header();

$archive_url   = get_post_type_archive_link( 'conference' );
$conf_date     = get_field( 'conference_display_date' );
$sort_date     = get_field( 'conference_sort_date' );
$conf_location = get_field( 'conference_location' );
$conf_reg_link = get_field( 'conference_registration_link' );
$conf_status   = get_field( 'conference_status' );
$conf_badge    = get_field( 'conference_badge' );
$badge_items   = $conf_badge ? array_filter(array_map('trim', explode(',', $conf_badge))) : array();

$display_date = $conf_date ?: get_the_date( 'F j, Y' );
$is_upcoming  = $conf_status === 'upcoming';
$status_label = $is_upcoming ? 'Upcoming' : 'Past Event';
$status_class = $is_upcoming ? 'bg-emerald-100 text-emerald-800' : 'bg-surface-container-high text-secondary';
?>

<main class="pt-28 pb-24">
    <article class="max-w-5xl mx-auto px-margin-desktop">

        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 font-label-sm text-label-sm text-secondary mb-8">
            <a href="<?php echo esc_url( home_url('/') ); ?>" class="hover:text-primary transition-colors">Home</a>
            <span class="material-symbols-outlined text-sm">chevron_right</span>
            <a href="<?php echo esc_url( $archive_url ); ?>" class="hover:text-primary transition-colors">Conferences</a>
            <span class="material-symbols-outlined text-sm">chevron_right</span>
            <span class="text-primary truncate max-w-xs"><?php the_title(); ?></span>
        </nav>

        <!-- Hero Image -->
        <?php if ( has_post_thumbnail() ) : ?>
        <figure class="mb-8 overflow-hidden rounded-xl border border-outline-variant h-72 lg:h-96 relative">
            <?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-full object-cover' ) ); ?>
            <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
            <div class="absolute bottom-6 left-6">
                <span class="<?php echo esc_attr($status_class); ?> text-xs font-bold px-3 py-1 rounded-full uppercase tracking-widest">
                    <?php echo esc_html( $status_label ); ?>
                </span>
            </div>
        </figure>
        <?php endif; ?>

        <!-- Conference Header -->
        <header class="border-b border-outline-variant pb-8 mb-8">
            <div class="flex flex-wrap items-center gap-3 mb-4">
                <?php if ( ! has_post_thumbnail() ) : ?>
                <span class="<?php echo esc_attr($status_class); ?> text-xs font-bold px-3 py-1 rounded-full uppercase tracking-widest">
                    <?php echo esc_html( $status_label ); ?>
                </span>
                <?php endif; ?>
                <?php foreach ( $badge_items as $badge ) : ?>
                <span class="px-3 py-1 bg-surface-container-high text-secondary font-label-sm text-[10px] rounded uppercase tracking-tighter"><?php echo esc_html($badge); ?></span>
                <?php endforeach; ?>
            </div>

            <h1 class="font-display-lg text-display-lg text-primary leading-tight mb-6">
                <?php the_title(); ?>
            </h1>

            <!-- Metadata Grid -->
            <dl class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div class="flex items-start gap-3">
                    <span class="material-symbols-outlined text-[#10B981] text-2xl mt-0.5">calendar_today</span>
                    <div>
                        <dt class="font-label-sm text-label-sm text-secondary uppercase tracking-widest mb-1">Date</dt>
                        <dd class="font-body-md text-on-surface"><?php echo esc_html( $display_date ); ?></dd>
                    </div>
                </div>
                <?php if ( $conf_location ) : ?>
                <div class="flex items-start gap-3">
                    <span class="material-symbols-outlined text-[#10B981] text-2xl mt-0.5">location_on</span>
                    <div>
                        <dt class="font-label-sm text-label-sm text-secondary uppercase tracking-widest mb-1">Location</dt>
                        <dd class="font-body-md text-on-surface"><?php echo esc_html( $conf_location ); ?></dd>
                    </div>
                </div>
                <?php endif; ?>
                <div class="flex items-start gap-3">
                    <span class="material-symbols-outlined text-[#10B981] text-2xl mt-0.5">radio_button_checked</span>
                    <div>
                        <dt class="font-label-sm text-label-sm text-secondary uppercase tracking-widest mb-1">Status</dt>
                        <dd class="font-body-md text-on-surface"><?php echo esc_html( $status_label ); ?></dd>
                    </div>
                </div>
            </dl>
        </header>

        <!-- Full Description from Editor -->
        <section class="font-body-lg text-body-lg text-on-surface-variant leading-relaxed mb-10">
            <?php
            if ( get_the_content() ) {
                the_content();
            } else {
                echo '<p>' . esc_html( get_the_excerpt() ) . '</p>';
            }
            ?>
        </section>

        <!-- Action Buttons -->
        <div class="flex flex-wrap gap-4 border-t border-outline-variant pt-8">
            <?php if ( $conf_reg_link && $is_upcoming ) : ?>
            <a href="<?php echo esc_url( $conf_reg_link ); ?>" target="_blank" class="flex items-center gap-2 bg-primary text-on-primary px-8 py-3 rounded-lg font-label-md text-label-md hover:opacity-90 transition-opacity">
                <span class="material-symbols-outlined">how_to_reg</span> Register Now
            </a>
            <?php endif; ?>
            <?php if ( $is_upcoming ) : ?>
            <button data-contact-trigger class="flex items-center gap-2 bg-[#10B981] text-white px-8 py-3 rounded-lg font-label-md text-label-md hover:brightness-90 transition-all">
                <span class="material-symbols-outlined">mail</span> Request Sponsorship
            </button>
            <?php endif; ?>
            <a href="<?php echo esc_url( $archive_url ); ?>" class="flex items-center gap-2 border border-outline-variant text-secondary px-8 py-3 rounded-lg font-label-md text-label-md hover:border-primary hover:text-primary transition-all">
                <span class="material-symbols-outlined">arrow_back</span> Back to Conferences
            </a>
        </div>

    </article>
</main>

<?php get_footer(); ?>
