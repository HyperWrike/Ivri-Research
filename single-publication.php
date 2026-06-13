<?php
/**
 * Single Publication Template
 */
get_header();

// Breadcrumbs
$archive_url = get_post_type_archive_link( 'publication' );

// ACF Fields
$authors   = get_field( 'publication_authors' );
$journal   = get_field( 'publication_journal' );
$pub_date  = get_field( 'publication_date' );
$abstract  = get_field( 'publication_abstract' );
$doi       = get_field( 'publication_doi' );
$pdf       = get_field( 'publication_pdf' );
$genre     = get_field( 'publication_genre' );
$featured  = get_field( 'publication_featured' );

$display_date = $pub_date ? date( 'F Y', strtotime( $pub_date ) ) : get_the_date( 'F Y' );
?>

<main class="pt-28 pb-24">
    <article class="max-w-4xl mx-auto px-margin-desktop">

        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 font-label-sm text-label-sm text-secondary mb-8">
            <a href="<?php echo esc_url( home_url('/') ); ?>" class="hover:text-primary transition-colors">Home</a>
            <span class="material-symbols-outlined text-sm">chevron_right</span>
            <a href="<?php echo esc_url( $archive_url ); ?>" class="hover:text-primary transition-colors">Publications</a>
            <span class="material-symbols-outlined text-sm">chevron_right</span>
            <span class="text-primary truncate max-w-xs"><?php the_title(); ?></span>
        </nav>

        <!-- Publication Header -->
        <header class="border-b border-outline-variant pb-8 mb-8">
            <div class="flex flex-wrap items-center gap-2 mb-4">
                <?php if ( $featured ) : ?>
                <span class="bg-primary text-white text-[10px] px-2 py-0.5 font-bold tracking-tighter">FEATURED</span>
                <?php endif; ?>
                <?php if ( $genre ) : ?>
                <span class="bg-surface-container-high text-primary px-3 py-1 font-label-sm text-label-sm"><?php echo esc_html( $genre ); ?></span>
                <?php endif; ?>
                <?php if ( $journal ) : ?>
                <span class="font-label-sm text-label-sm text-secondary"><?php echo esc_html( $journal ); ?></span>
                <?php endif; ?>
            </div>

            <h1 class="font-display-lg text-display-lg text-primary leading-tight mb-6">
                <?php the_title(); ?>
            </h1>

            <!-- Metadata row -->
            <dl class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-sm">
                <?php if ( $authors ) : ?>
                <div>
                    <dt class="font-label-sm text-label-sm text-secondary uppercase tracking-widest mb-1">Authors</dt>
                    <dd class="font-body-sm text-on-surface"><?php echo esc_html( $authors ); ?></dd>
                </div>
                <?php endif; ?>
                <?php if ( $display_date ) : ?>
                <div>
                    <dt class="font-label-sm text-label-sm text-secondary uppercase tracking-widest mb-1">Published</dt>
                    <dd class="font-body-sm text-on-surface"><?php echo esc_html( $display_date ); ?></dd>
                </div>
                <?php endif; ?>
                <?php if ( $doi ) : ?>
                <div>
                    <dt class="font-label-sm text-label-sm text-secondary uppercase tracking-widest mb-1">DOI</dt>
                    <dd class="font-body-sm">
                        <a href="https://doi.org/<?php echo esc_attr( $doi ); ?>" target="_blank" class="text-primary hover:underline font-mono"><?php echo esc_html( $doi ); ?></a>
                    </dd>
                </div>
                <?php endif; ?>
            </dl>
        </header>

        <!-- Thumbnail -->
        <?php if ( has_post_thumbnail() ) : ?>
        <figure class="mb-8 overflow-hidden rounded-lg border border-outline-variant">
            <?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-64 object-cover' ) ); ?>
        </figure>
        <?php endif; ?>

        <!-- Abstract -->
        <?php if ( $abstract ) : ?>
        <section class="bg-surface-container-low border border-outline-variant p-8 mb-8">
            <h2 class="font-label-md text-label-md text-secondary uppercase tracking-widest mb-4">Abstract</h2>
            <p class="font-body-lg text-body-lg text-on-surface-variant leading-relaxed"><?php echo esc_html( $abstract ); ?></p>
        </section>
        <?php endif; ?>

        <!-- Full Content from Editor -->
        <?php if ( get_the_content() ) : ?>
        <section class="prose max-w-none font-body-md text-body-md text-on-surface leading-relaxed mb-8">
            <?php the_content(); ?>
        </section>
        <?php endif; ?>

        <!-- Action Buttons -->
        <div class="flex flex-wrap gap-4 border-t border-outline-variant pt-8 mt-8">
            <?php if ( $pdf ) : ?>
            <a href="<?php echo esc_url( $pdf ); ?>" target="_blank" class="flex items-center gap-2 bg-primary text-on-primary px-8 py-3 rounded-lg font-label-md text-label-md hover:opacity-90 transition-opacity">
                <span class="material-symbols-outlined">download</span> Download PDF
            </a>
            <?php endif; ?>
            <?php if ( $doi ) : ?>
            <a href="https://doi.org/<?php echo esc_attr( $doi ); ?>" target="_blank" class="flex items-center gap-2 border border-primary text-primary px-8 py-3 rounded-lg font-label-md text-label-md hover:bg-primary hover:text-white transition-all">
                <span class="material-symbols-outlined">open_in_new</span> View on DOI
            </a>
            <?php endif; ?>
            <a href="<?php echo esc_url( $archive_url ); ?>" class="flex items-center gap-2 border border-outline-variant text-secondary px-8 py-3 rounded-lg font-label-md text-label-md hover:border-primary hover:text-primary transition-all">
                <span class="material-symbols-outlined">arrow_back</span> Back to Publications
            </a>
        </div>

    </article>
</main>

<?php get_footer(); ?>
