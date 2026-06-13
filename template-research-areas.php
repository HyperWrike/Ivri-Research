<?php
/**
 * Template Name: Research Areas
 * Description: Page template for the Research Areas page.
 */
get_header();

$areas = get_field( 'areas_list' );
?>

<main class="w-full max-w-container-max mx-auto px-margin-desktop py-12 md:py-24 pt-32">
    <!-- Hero Section -->
    <section class="mb-20 max-w-3xl">
        <h1 class="font-display-lg text-display-lg text-brand-navy mb-stack-md">
            Advancing Human Understanding Through Multi-Disciplinary Rigor.
        </h1>
        <p class="font-body-lg text-body-lg text-secondary leading-relaxed">
            Ivri Research operates across seven strategic domains, combining empirical science with innovative technology to address the most pressing challenges of the 21st century.
        </p>
    </section>

    <!-- Research Areas Bento Grid -->
    <div class="grid grid-cols-1 md:grid-cols-12 gap-gutter">

        <?php if ( $areas && have_rows( 'areas_list' ) ) :
            $i = 0;
            while ( have_rows( 'areas_list' ) ) : the_row();
                $title    = get_sub_field( 'area_title' );
                $desc     = get_sub_field( 'area_description' );
                $icon     = get_sub_field( 'area_icon' ) ?: 'biotech';
                $badge    = get_sub_field( 'area_badge' );
                $img      = get_sub_field( 'area_image' );
                $is_large = get_sub_field( 'area_is_large' );
                $bullets_raw = get_sub_field( 'area_bullets' );
                $bullets = $bullets_raw ? array_filter( array_map( 'trim', explode( "\n", $bullets_raw ) ) ) : array();
                $span = $is_large ? 'md:col-span-8' : 'md:col-span-4';
                ?>
                <div class="<?php echo esc_attr($span); ?> area-card p-stack-lg flex flex-col justify-between <?php echo $is_large ? 'min-h-[400px]' : ''; ?>">
                    <div>
                        <div class="flex items-center justify-between mb-stack-md">
                            <span class="material-symbols-outlined text-brand-emerald text-4xl"><?php echo esc_html($icon); ?></span>
                            <?php if ( $badge ) : ?>
                            <span class="bg-surface-container text-brand-navy px-3 py-1 text-label-sm font-label-sm rounded-full"><?php echo esc_html($badge); ?></span>
                            <?php endif; ?>
                        </div>
                        <h3 class="font-headline-lg text-headline-lg text-brand-navy mb-stack-sm"><?php echo esc_html($title); ?></h3>
                        <p class="font-body-md text-body-md text-secondary"><?php echo esc_html($desc); ?></p>
                        <?php if ( ! empty($bullets) ) : ?>
                        <ul class="mt-stack-md space-y-2">
                            <?php foreach ( $bullets as $bullet ) : ?>
                            <li class="flex items-center text-label-sm font-label-sm text-brand-navy">
                                <span class="material-symbols-outlined text-xs mr-2">check_circle</span>
                                <?php echo esc_html($bullet); ?>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>
                    </div>
                    <?php if ( $is_large && $img ) : ?>
                    <div class="mt-8 overflow-hidden rounded-lg h-48 bg-slate-100">
                        <img alt="<?php echo esc_attr($title); ?>" class="w-full h-full object-cover" src="<?php echo esc_url($img); ?>"/>
                    </div>
                    <?php endif; ?>
                    <?php if ( ! $is_large ) : ?>
                    <div class="mt-8 border-t border-outline-variant pt-4">
                        <button class="flex items-center text-brand-emerald font-label-md text-label-md hover:underline">
                            View Research <span class="material-symbols-outlined ml-1">arrow_forward</span>
                        </button>
                    </div>
                    <?php endif; ?>
                </div>
            <?php $i++; endwhile;
        else : ?>

        <!-- Fallback: Static areas matching mockup exactly -->
        <!-- Life Sciences - Large Feature -->
        <div class="md:col-span-8 area-card p-stack-lg flex flex-col justify-between min-h-[400px]">
            <div>
                <div class="flex items-center justify-between mb-stack-md">
                    <span class="material-symbols-outlined text-brand-emerald text-4xl">biotech</span>
                    <span class="bg-surface-container text-brand-navy px-3 py-1 text-label-sm font-label-sm rounded-full">Core Domain</span>
                </div>
                <h3 class="font-headline-lg text-headline-lg text-brand-navy mb-stack-sm">Life Sciences</h3>
                <p class="font-body-md text-body-md text-secondary max-w-xl">
                    Our Life Sciences division investigates the fundamental mechanisms of biological systems. From genomic sequencing to neuro-pathology research, we provide the foundational data required for next-generation medical breakthroughs and pharmaceutical developments.
                </p>
            </div>
            <div class="mt-8 overflow-hidden rounded-lg h-48 bg-slate-100">
                <img alt="Microscope view" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDiFr91LJX3iJplaMW85fd6n6zeJ6sBYk3kQDIUC-y-4zi-Qi0ZiiFFFmORblakLrsP8Geo8XTm5FgGGDULJ2QL4ju9u16RCVAREWxcLamNGGFdQ37IZfLgXjIXATogXbcsk4lIa4q7MKE7oR7d0gXALC5565kY_NJqAjAgqsFGHgoFztN1-Z4sD8UHZvcF31RcmUrTrrJCy8T8tZz0hlPYVX2U0XYrfKnCFnj9QIidl8n2VaikMYUw4K1ao3QkY4mRjrcwAsVJT0U"/>
            </div>
        </div>
        <!-- AI & Tech -->
        <div class="md:col-span-4 area-card p-stack-lg flex flex-col justify-between">
            <div>
                <span class="material-symbols-outlined text-brand-emerald text-4xl mb-stack-md">memory</span>
                <h3 class="font-headline-lg text-headline-lg text-brand-navy mb-stack-sm">AI &amp; Tech</h3>
                <p class="font-body-md text-body-md text-secondary">Developing ethical AI frameworks and high-performance computing models for predictive analytics.</p>
                <ul class="mt-stack-md space-y-2">
                    <li class="flex items-center text-label-sm font-label-sm text-brand-navy"><span class="material-symbols-outlined text-xs mr-2">check_circle</span> Neural Networks</li>
                    <li class="flex items-center text-label-sm font-label-sm text-brand-navy"><span class="material-symbols-outlined text-xs mr-2">check_circle</span> Ethical Algorithms</li>
                </ul>
            </div>
            <div class="mt-8 border-t border-outline-variant pt-4">
                <button class="flex items-center text-brand-emerald font-label-md text-label-md hover:underline">View Research <span class="material-symbols-outlined ml-1">arrow_forward</span></button>
            </div>
        </div>
        <!-- Environmental Science -->
        <div class="md:col-span-4 area-card p-stack-lg hover:bg-slate-50">
            <span class="material-symbols-outlined text-brand-emerald text-3xl mb-stack-md">eco</span>
            <h3 class="font-headline-md text-headline-md text-brand-navy mb-stack-sm">Environmental Science</h3>
            <p class="font-body-sm text-body-sm text-secondary">Quantitative analysis of climate shifts, carbon sequestration strategies, and ecosystem restoration modeling to ensure sustainable global futures.</p>
        </div>
        <!-- Engineering -->
        <div class="md:col-span-4 area-card p-stack-lg hover:bg-slate-50">
            <span class="material-symbols-outlined text-brand-emerald text-3xl mb-stack-md">architecture</span>
            <h3 class="font-headline-md text-headline-md text-brand-navy mb-stack-sm">Engineering</h3>
            <p class="font-body-sm text-body-sm text-secondary">Materials science and structural engineering research focusing on resilient infrastructure and aerospace component optimization.</p>
        </div>
        <!-- Social Sciences -->
        <div class="md:col-span-4 area-card p-stack-lg hover:bg-slate-50">
            <span class="material-symbols-outlined text-brand-emerald text-3xl mb-stack-md">groups</span>
            <h3 class="font-headline-md text-headline-md text-brand-navy mb-stack-sm">Social Sciences</h3>
            <p class="font-body-sm text-body-sm text-secondary">Anthropological and economic data studies exploring urbanization, migration patterns, and the socio-economic impact of digital transformation.</p>
        </div>
        <!-- Agriculture -->
        <div class="md:col-span-6 area-card p-stack-lg flex gap-gutter items-center">
            <div class="flex-1">
                <span class="material-symbols-outlined text-brand-emerald text-4xl mb-stack-md">potted_plant</span>
                <h3 class="font-headline-md text-headline-md text-brand-navy mb-stack-sm">Agriculture</h3>
                <p class="font-body-sm text-body-sm text-secondary">Precision agtech and soil microbiome research to enhance crop yields and resource efficiency in challenging climates.</p>
            </div>
            <div class="hidden sm:block w-32 h-32 flex-shrink-0">
                <img alt="Plant growth" class="w-full h-full object-cover rounded-full border-4 border-white shadow-sm" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCDLzqYdxsK3T7CXI4zoFcOer9OsnYStvnC6WuIOF3dd_RAt8ZmktB9gk4seSFbBicvPF1j73SSzzMbOdL0wvs17lwyAw6QBb0-mSvbNRvn30Xd6v-rfWuy_GE7S7wx1WRaaARxLh3hpwY8gsgDU46NBfCuQJRCFFwavAHs9IT3yyXPev_yPsh--ChQx8-2cix78m6w8tTX1YbWLfwopcjrujy1ifcbr7A2wFTRh1wvZceLsUGFkcYZdujS7REE-lzGqAjaJ-KLplk"/>
            </div>
        </div>
        <!-- Education -->
        <div class="md:col-span-6 area-card p-stack-lg flex gap-gutter items-center">
            <div class="flex-1">
                <span class="material-symbols-outlined text-brand-emerald text-4xl mb-stack-md">school</span>
                <h3 class="font-headline-md text-headline-md text-brand-navy mb-stack-sm">Education</h3>
                <p class="font-body-sm text-body-sm text-secondary">Cognitive psychology and pedagogical research aimed at optimizing knowledge retention and digital learning interface accessibility.</p>
            </div>
            <div class="hidden sm:block w-32 h-32 flex-shrink-0">
                <img alt="Library" class="w-full h-full object-cover rounded-full border-4 border-white shadow-sm" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDMxM3wguDcK6GEGLaaoYmrr18ugrRb0Odwql5OtP7VUT-rBmpuJ7_oDLuQe-BE73PkkT0txWP9CEPa9Xww5llbqDaNao3XP-P2rShOjPcX4g7WBxduFQqRazz2XKujmdZG1-1MQb8dpFGB9Gd8RssWWu4rA6BfL_gQqG1n37pF7B6IyGn6w8KCAngvKkwSx4jQoEliE32Yb350H4Gc8RAAwpiaM_2Ep1MFlR2-OflqwV2rrFmzJ_CFL3g1NH7veNgUzDbXYpJIF-0"/>
            </div>
        </div>

        <?php endif; ?>
    </div>

    <!-- Call to Action Section -->
    <section class="mt-24 bg-brand-navy p-stack-lg md:p-16 rounded-xl relative overflow-hidden">
        <div class="relative z-10 max-w-2xl">
            <h2 class="font-headline-lg text-headline-lg text-white mb-stack-md">Ready to collaborate on pioneering research?</h2>
            <p class="font-body-md text-body-md text-secondary-fixed-dim mb-stack-lg">We partner with academic institutions, governments, and private enterprises to turn rigorous research into actionable strategy.</p>
            <div class="flex gap-stack-md flex-wrap">
                <button data-contact-trigger class="bg-brand-emerald text-white px-stack-lg py-3 rounded font-label-md text-label-md hover:brightness-90 transition-all">Contact Research Lead</button>
                <button class="border border-white/20 text-white px-stack-lg py-3 rounded font-label-md text-label-md hover:bg-white/10 transition-all">Download Prospectus</button>
            </div>
        </div>
        <div class="absolute right-0 top-0 w-1/3 h-full opacity-10">
            <span class="material-symbols-outlined text-[300px] leading-none select-none pointer-events-none">insights</span>
        </div>
    </section>
</main>

<?php get_footer(); ?>
