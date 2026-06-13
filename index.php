<?php
/**
 * Index template - WordPress fallback
 */
get_header();
?>
<main class="pt-24 min-h-screen max-w-container-max mx-auto px-4 md:px-margin-desktop py-12">
    <h1 class="font-headline-lg text-headline-lg text-primary mb-stack-md">Latest Posts</h1>
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <article class="bg-surface-container-lowest border border-outline-variant p-stack-lg mb-gutter hover:border-primary transition-colors">
        <h2 class="font-headline-md text-headline-md text-primary mb-stack-sm">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h2>
        <div class="font-body-md text-secondary"><?php the_excerpt(); ?></div>
    </article>
    <?php endwhile; else : ?>
    <p class="font-body-lg text-secondary">No content found.</p>
    <?php endif; ?>
</main>
<?php get_footer(); ?>
