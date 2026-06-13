<?php
/**
 * Template Name: About Us
 * Description: Page template for the About Us page.
 */
get_header();

$hero_title   = get_field( 'about_hero_title' ) ?: 'Defining the Future through Rigorous Inquiry';
$hero_desc    = get_field( 'about_hero_description' ) ?: 'Ivri Research is a global catalyst for intellectual advancement, bridging the gap between theoretical science and industrial application.';
$vision_title = get_field( 'about_vision_title' ) ?: 'Our Vision';
$vision_desc  = get_field( 'about_vision_description' ) ?: 'To become the global cornerstone of cross-disciplinary research, where groundbreaking discoveries serve as the foundation for a more resilient and technologically advanced society. We envision a world where every strategic decision is rooted in empirical truth and scientific excellence.';
$mission_title = get_field( 'about_mission_title' ) ?: 'Our Mission';
$mission_desc  = get_field( 'about_mission_description' ) ?: 'Our mission is to accelerate the pace of innovation by fostering a global network of elite researchers. We provide the infrastructure, funding, and intellectual framework necessary to translate complex data into actionable strategies that solve the world\'s most pressing technical and social challenges.';

$timeline   = get_field( 'about_timeline' );
$objectives = get_field( 'about_objectives' );
$research_url = get_page_link( get_page_by_path( 'research-areas' ) ) ?: home_url('/research-areas/');
?>

<main class="pt-16 md:pt-24">
    <!-- Hero Section -->
    <section class="relative min-h-[320px] md:h-[614px] flex items-center overflow-hidden bg-primary-container">
        <div class="absolute inset-0 opacity-40">
            <img alt="Laboratory research" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBLANK4gq_49XTtyu0xDApe4jM_67dYvevFFXcHZJau6oPspkN3NS9z8WoH9kdOR0pRrobh18kzxJ5h1uPlVjCzuMcwUqh3rvc2Bp1LNBnEYWNUGZUKlRc3pXR6bx8A3JcfKaYZbnjTvTB0PaZuVxI1_JOipZW2HJ4jnSXny3K0G6YBaUlWD9YpYW9Q3tN8U3P5Z3tXADwjzEaEFOsfLa5Kx9Q58JCHFb-bZx-RYerFQEFkwjpzrZzRbF-SM6iKDnH6eQ-sBObjZwM"/>
        </div>
        <div class="relative z-10 px-4 md:px-margin-desktop py-12 md:py-0 w-full max-w-container-max mx-auto">
            <div class="max-w-2xl">
                <h1 class="font-display-lg text-headline-lg md:text-display-lg text-white mb-stack-md"><?php echo esc_html( $hero_title ); ?></h1>
                <p class="font-body-md md:font-body-lg text-body-md md:text-body-lg text-primary-fixed-dim"><?php echo esc_html( $hero_desc ); ?></p>
            </div>
        </div>
    </section>

    <!-- Mission & Vision Cards -->
    <section class="py-12 md:py-24 px-4 md:px-margin-desktop bg-background">
        <div class="max-w-container-max mx-auto grid grid-cols-1 md:grid-cols-2 gap-gutter">
            <div class="p-stack-lg bg-surface-container-lowest border border-outline-variant hover:border-primary transition-all group">
                <div class="flex items-center gap-stack-md mb-stack-md">
                    <span class="material-symbols-outlined text-emerald text-4xl">visibility</span>
                    <h2 class="font-headline-lg text-headline-md md:text-headline-lg"><?php echo esc_html( $vision_title ); ?></h2>
                </div>
                <p class="font-body-md md:font-body-lg text-body-md md:text-body-lg text-on-surface-variant leading-relaxed">
                    <?php echo esc_html( $vision_desc ); ?>
                </p>
            </div>
            <div class="p-stack-lg bg-surface-container-lowest border border-outline-variant hover:border-primary transition-all group">
                <div class="flex items-center gap-stack-md mb-stack-md">
                    <span class="material-symbols-outlined text-emerald text-4xl">rocket_launch</span>
                    <h2 class="font-headline-lg text-headline-md md:text-headline-lg"><?php echo esc_html( $mission_title ); ?></h2>
                </div>
                <p class="font-body-md md:font-body-lg text-body-md md:text-body-lg text-on-surface-variant leading-relaxed">
                    <?php echo esc_html( $mission_desc ); ?>
                </p>
            </div>
        </div>
    </section>

    <!-- History Timeline (Bento Style) -->
    <section class="py-12 md:py-24 bg-surface-container-low px-4 md:px-margin-desktop">
        <div class="max-w-container-max mx-auto">
            <div class="mb-10 md:mb-16">
                <h2 class="font-headline-lg text-headline-md md:text-headline-lg mb-stack-sm">A Legacy of Precision</h2>
                <p class="text-secondary font-body-md">Tracing our journey from a small strategy collective to a global research powerhouse.</p>
            </div>

            <?php if ( $timeline && have_rows( 'about_timeline' ) ) : ?>
            <div class="grid grid-cols-1 md:grid-cols-12 gap-gutter">
                <?php
                $col_patterns = array(
                    array('md:col-span-4', false),
                    array('md:col-span-8', true),
                    array('md:col-span-7', false, 'featured'),
                    array('md:col-span-5', false),
                );
                $i = 0;
                while ( have_rows( 'about_timeline' ) ) : the_row();
                    $year  = get_sub_field( 'timeline_year' );
                    $title = get_sub_field( 'timeline_title' );
                    $desc  = get_sub_field( 'timeline_description' );
                    $img   = get_sub_field( 'timeline_image' );
                    $pat   = $col_patterns[ $i % count($col_patterns) ];
                    $featured = isset($pat[2]) && $pat[2] === 'featured';
                    $has_img = isset($pat[1]) && $pat[1];
                    ?>
                    <div class="<?php echo esc_attr($pat[0]); ?> <?php echo $featured ? 'bg-primary text-white' : 'bg-surface-container-lowest'; ?> p-stack-lg border <?php echo $featured ? 'border-primary' : 'border-outline-variant'; ?> <?php echo $has_img ? 'flex flex-col md:flex-row gap-stack-lg' : ''; ?> relative <?php echo $featured ? 'overflow-hidden' : ''; ?>">
                        <?php if ( $has_img ) : ?>
                        <div class="md:w-1/2">
                        <?php endif; ?>
                            <span class="font-display-lg text-3xl md:text-display-lg <?php echo $featured ? '' : 'text-primary'; ?> opacity-20 block mb-stack-sm"><?php echo esc_html($year); ?></span>
                            <h3 class="font-headline-md text-headline-md mb-stack-sm"><?php echo esc_html($title); ?></h3>
                            <p class="<?php echo $featured ? 'text-primary-fixed' : 'text-on-surface-variant'; ?> font-body-md relative z-10"><?php echo esc_html($desc); ?></p>
                        <?php if ( $has_img ) : ?>
                        </div>
                        <?php if ( $img ) : ?>
                        <div class="md:w-1/2 min-h-[200px]">
                            <img alt="<?php echo esc_attr($title); ?>" class="w-full h-full object-cover rounded" src="<?php echo esc_url($img); ?>"/>
                        </div>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php if ( $featured ) : ?>
                        <div class="absolute right-0 bottom-0 opacity-10 pointer-events-none">
                            <span class="material-symbols-outlined text-[160px]">hub</span>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php
                    $i++;
                endwhile;
                ?>
            </div>
            <?php else : ?>
            <!-- Fallback static timeline -->
            <div class="grid grid-cols-1 md:grid-cols-12 gap-gutter">
                <div class="md:col-span-4 bg-surface-container-lowest p-stack-lg border border-outline-variant">
                    <span class="font-display-lg text-3xl md:text-display-lg text-primary opacity-20 block mb-stack-sm">2012</span>
                    <h3 class="font-headline-md text-headline-md mb-stack-sm">Founding</h3>
                    <p class="text-on-surface-variant font-body-md">Ivri was established as a boutique consultancy focusing on the intersection of data science and corporate governance in Zurich.</p>
                </div>
                <div class="md:col-span-8 bg-surface-container-lowest p-stack-lg border border-outline-variant flex flex-col md:flex-row gap-stack-lg">
                    <div class="md:w-1/2">
                        <span class="font-display-lg text-3xl md:text-display-lg text-primary opacity-20 block mb-stack-sm">2016</span>
                        <h3 class="font-headline-md text-headline-md mb-stack-sm">Expansion</h3>
                        <p class="text-on-surface-variant font-body-md">Launch of the Ivri Global Fellowship program, connecting over 200 researchers across five continents to collaborative research initiatives.</p>
                    </div>
                    <div class="md:w-1/2 min-h-[200px]">
                        <img alt="Collaborative meeting" class="w-full h-full object-cover rounded" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBvZXx_lSPKBLATWqLVWsiY44FAuN_PvWCQ4U1rDLmg-Dxb4Lk5U7-MPntq2BAjv0JNXVb9fJ3h-dPvMiGg73vu-ALQ8JfTffVFPDh_S5Kz1s5Z3GC-530KrmefGPhOvCzw9kBwrqlzLC-Xh47DFUu7qDARbVcI3SOKY4cPlDETv2-xmZY7Mh5slKbaDiOl42A748kuNszsMdNmDtEAQKRAELOssgzW8lLmWZ1X1LtOkQPiWxGU3Jd4SgdD4IPP_kgICBTaaW59aPc"/>
                    </div>
                </div>
                <div class="md:col-span-7 bg-primary text-white p-stack-lg border border-primary relative overflow-hidden">
                    <span class="font-display-lg text-3xl md:text-display-lg opacity-20 block mb-stack-sm">2020</span>
                    <h3 class="font-headline-md text-headline-md mb-stack-sm">Digital Transformation</h3>
                    <p class="text-primary-fixed font-body-md relative z-10">Pioneered the 'Open-Sovereign Research' framework, allowing for real-time collaboration on sensitive data sets while maintaining absolute intellectual property security.</p>
                    <div class="absolute right-0 bottom-0 opacity-10 pointer-events-none">
                        <span class="material-symbols-outlined text-[160px]">hub</span>
                    </div>
                </div>
                <div class="md:col-span-5 bg-surface-container-lowest p-stack-lg border border-outline-variant">
                    <span class="font-display-lg text-3xl md:text-display-lg text-emerald opacity-20 block mb-stack-sm">Present</span>
                    <h3 class="font-headline-md text-headline-md mb-stack-sm">Global Leadership</h3>
                    <p class="text-on-surface-variant font-body-md">Recognized as the primary strategic partner for leading Fortune 500 companies seeking rigorous scientific validation for sustainable transformations.</p>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Core Objectives Grid -->
    <section class="py-12 md:py-24 px-4 md:px-margin-desktop bg-background">
        <div class="max-w-container-max mx-auto">
            <div class="text-center mb-10 md:mb-16">
                <h2 class="font-headline-lg text-headline-md md:text-headline-lg mb-stack-sm">Our Core Objectives</h2>
                <p class="text-secondary font-body-md max-w-2xl mx-auto">Five pillars that define our strategic approach to advancing the frontiers of human knowledge.</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-stack-md">
                <?php if ( $objectives && have_rows( 'about_objectives' ) ) :
                    while ( have_rows( 'about_objectives' ) ) : the_row();
                        $num   = get_sub_field( 'objective_number' );
                        $icon  = get_sub_field( 'objective_icon' );
                        $title = get_sub_field( 'objective_title' );
                        $desc  = get_sub_field( 'objective_description' );
                        ?>
                        <div class="flex flex-col p-6 bg-surface-container border border-outline-variant hover:bg-surface-container-lowest transition-colors group">
                            <div class="w-12 h-12 bg-primary text-white flex items-center justify-center mb-stack-lg">
                                <span class="material-symbols-outlined"><?php echo esc_html( $icon ?: 'analytics' ); ?></span>
                            </div>
                            <h4 class="font-label-md text-label-md mb-stack-sm uppercase tracking-wider text-primary"><?php echo esc_html( $num ); ?></h4>
                            <h3 class="font-headline-md text-headline-md mb-stack-md leading-snug"><?php echo esc_html( $title ); ?></h3>
                            <p class="text-secondary font-body-sm mt-auto"><?php echo esc_html( $desc ); ?></p>
                        </div>
                    <?php endwhile;
                else : ?>
                <?php
                $defaults = array(
                    array('analytics', 'Objective 01', 'Advancing Research Excellence', 'Setting the highest standards for methodological rigor and analytical precision.'),
                    array('public', 'Objective 02', 'Building Global Networks', 'Connecting disparate nodes of excellence into a cohesive, global intellectual brain.'),
                    array('school', 'Objective 03', 'Supporting Emerging Researchers', 'Investing in the next generation of thinkers through mentorship and funding.'),
                    array('handshake', 'Objective 04', 'Bridging Research & Application', 'Turning theoretical breakthroughs into practical solutions for industry.'),
                    array('lock_open', 'Objective 05', 'Championing Open Science', 'Advocating for accessibility and transparency in scientific data distribution.'),
                );
                foreach ( $defaults as $obj ) : ?>
                <div class="flex flex-col p-6 bg-surface-container border border-outline-variant hover:bg-surface-container-lowest transition-colors group">
                    <div class="w-12 h-12 bg-primary text-white flex items-center justify-center mb-stack-lg">
                        <span class="material-symbols-outlined"><?php echo esc_html( $obj[0] ); ?></span>
                    </div>
                    <h4 class="font-label-md text-label-md mb-stack-sm uppercase tracking-wider text-primary"><?php echo esc_html( $obj[1] ); ?></h4>
                    <h3 class="font-headline-md text-headline-md mb-stack-md leading-snug"><?php echo esc_html( $obj[2] ); ?></h3>
                    <p class="text-secondary font-body-sm mt-auto"><?php echo esc_html( $obj[3] ); ?></p>
                </div>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-12 md:py-24 px-4 md:px-margin-desktop bg-surface-container-lowest border-y border-outline-variant">
        <div class="max-w-container-max mx-auto text-center">
            <h2 class="font-headline-lg text-headline-md md:text-headline-lg mb-stack-md">Partner with Excellence</h2>
            <p class="font-body-lg text-body-lg text-on-surface-variant mb-stack-lg max-w-xl mx-auto">Explore how Ivri Research can provide the intellectual foundation for your next strategic breakthrough.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <button data-contact-trigger class="bg-emerald text-white px-8 py-3 font-label-md text-label-md rounded-lg hover:opacity-90 transition-opacity">Contact Our Strategists</button>
                <a href="<?php echo esc_url( $research_url ); ?>" class="border border-primary text-primary px-8 py-3 font-label-md text-label-md rounded-lg hover:bg-primary hover:text-white transition-all">View Research Areas</a>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
