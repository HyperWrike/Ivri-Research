<?php
/**
 * Footer template & Contact Modal markup
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$settings  = ivri_get_site_settings();
$email     = $settings['contact_email'];
$phone     = $settings['contact_phone'];
$address   = $settings['contact_address'];
$hours     = $settings['contact_hours'];
$facebook  = $settings['social_facebook'];
$linkedin  = $settings['social_linkedin'];
$instagram = $settings['social_instagram'];
$youtube   = $settings['social_youtube'];
$footer_desc = $settings['footer_description'];

$social_links = array(
    array(
        'url'   => $facebook,
        'label' => 'Facebook',
        'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>',
    ),
    array(
        'url'   => $linkedin,
        'label' => 'LinkedIn',
        'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 114.126 0 2.063 2.063 0 01-2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>',
    ),
    array(
        'url'   => $instagram,
        'label' => 'Instagram',
        'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>',
    ),
    array(
        'url'   => $youtube,
        'label' => 'YouTube',
        'icon'  => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>',
    ),
);
?>

<!-- Site Footer -->
<footer class="site-footer" role="contentinfo">
    <div class="site-footer__main">
        <div class="site-footer__container">

            <!-- Brand Column -->
            <div class="site-footer__brand">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-footer__logo">
                    Ivri Research
                </a>
                <p class="site-footer__description">
                    <?php echo esc_html( $footer_desc ); ?>
                </p>
                <div class="site-footer__social" aria-label="<?php esc_attr_e( 'Social media links', 'ivri-research' ); ?>">
                    <?php foreach ( $social_links as $social ) : ?>
                        <a href="<?php echo esc_url( $social['url'] ); ?>"
                           class="site-footer__social-link"
                           target="_blank"
                           rel="noopener noreferrer"
                           aria-label="<?php echo esc_attr( $social['label'] ); ?>">
                            <?php echo $social['icon']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- SVG markup ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Navigation Column -->
            <div class="site-footer__nav">
                <h3 class="site-footer__heading"><?php esc_html_e( 'Quick Links', 'ivri-research' ); ?></h3>
                <ul class="site-footer__nav-list">
                    <?php
                    $locations    = get_nav_menu_locations();
                    $footer_items = array();

                    if ( isset( $locations['footer-menu'] ) ) {
                        $menu = wp_get_nav_menu_object( $locations['footer-menu'] );
                        if ( $menu ) {
                            $footer_items = wp_get_nav_menu_items( $menu->term_id );
                        }
                    }

                    if ( ! empty( $footer_items ) ) {
                        foreach ( $footer_items as $item ) {
                            printf(
                                '<li><a href="%s">%s</a></li>',
                                esc_url( $item->url ),
                                esc_html( $item->title )
                            );
                        }
                    } else {
                        $fallback_links = array(
                            array( 'label' => 'Home',           'url' => home_url( '/' ),                  'contact' => false ),
                            array( 'label' => 'About Us',       'url' => home_url( '/about-us/' ),         'contact' => false ),
                            array( 'label' => 'Research Areas', 'url' => home_url( '/research-areas/' ),   'contact' => false ),
                            array( 'label' => 'Publications',   'url' => home_url( '/publications/' ),     'contact' => false ),
                            array( 'label' => 'Conferences',    'url' => home_url( '/conferences/' ),      'contact' => false ),
                            array( 'label' => 'Services',       'url' => home_url( '/services/' ),         'contact' => false ),
                            array( 'label' => 'Contact',        'url' => '#',                              'contact' => true ),
                        );

                        foreach ( $fallback_links as $link ) {
                            if ( $link['contact'] ) {
                                printf(
                                    '<li><button type="button" data-contact-trigger class="site-footer__contact-trigger">%s</button></li>',
                                    esc_html( $link['label'] )
                                );
                            } else {
                                printf(
                                    '<li><a href="%s">%s</a></li>',
                                    esc_url( $link['url'] ),
                                    esc_html( $link['label'] )
                                );
                            }
                        }
                    }
                    ?>
                </ul>
            </div>

            <!-- Contact Column -->
            <div class="site-footer__contact">
                <h3 class="site-footer__heading"><?php esc_html_e( 'Contact Us', 'ivri-research' ); ?></h3>
                <ul class="site-footer__contact-list">
                    <li class="site-footer__contact-item">
                        <span class="site-footer__contact-icon material-symbols-outlined" aria-hidden="true">mail</span>
                        <div>
                            <span class="site-footer__contact-label"><?php esc_html_e( 'Email', 'ivri-research' ); ?></span>
                            <a href="mailto:<?php echo esc_attr( $email ); ?>" class="site-footer__contact-value">
                                <?php echo esc_html( $email ); ?>
                            </a>
                        </div>
                    </li>
                    <li class="site-footer__contact-item">
                        <span class="site-footer__contact-icon material-symbols-outlined" aria-hidden="true">call</span>
                        <div>
                            <span class="site-footer__contact-label"><?php esc_html_e( 'Phone', 'ivri-research' ); ?></span>
                            <a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $phone ) ); ?>" class="site-footer__contact-value">
                                <?php echo esc_html( $phone ); ?>
                            </a>
                        </div>
                    </li>
                    <li class="site-footer__contact-item">
                        <span class="site-footer__contact-icon material-symbols-outlined" aria-hidden="true">location_on</span>
                        <div>
                            <span class="site-footer__contact-label"><?php esc_html_e( 'Address', 'ivri-research' ); ?></span>
                            <span class="site-footer__contact-value"><?php echo esc_html( $address ); ?></span>
                        </div>
                    </li>
                    <li class="site-footer__contact-item">
                        <span class="site-footer__contact-icon material-symbols-outlined" aria-hidden="true">schedule</span>
                        <div>
                            <span class="site-footer__contact-label"><?php esc_html_e( 'Working Hours', 'ivri-research' ); ?></span>
                            <span class="site-footer__contact-value"><?php echo esc_html( $hours ); ?></span>
                        </div>
                    </li>
                </ul>
            </div>

        </div>
    </div>

    <!-- Bottom Bar -->
    <div class="site-footer__bottom">
        <div class="site-footer__container site-footer__bottom-inner">
            <p class="site-footer__copyright">
                &copy; <?php echo esc_html( date( 'Y' ) ); ?> Ivri Research. <?php esc_html_e( 'All rights reserved.', 'ivri-research' ); ?>
            </p>
            <p class="site-footer__tagline">
                <?php esc_html_e( 'Advancing Research Innovation', 'ivri-research' ); ?>
            </p>
        </div>
    </div>
</footer>

<!-- -----------------------------------------------------------------------
     CONTACT MODAL (GET IN TOUCH)
     ----------------------------------------------------------------------- -->
<div id="contact-modal" class="fixed inset-0 z-[100] hidden items-center justify-center bg-black/60 opacity-0 contact-modal-backdrop transition-opacity duration-300 px-4">
    <div id="contact-modal-container" class="bg-white rounded-xl shadow-2xl w-full max-w-5xl max-h-[90vh] overflow-y-auto relative scale-95 opacity-0 contact-modal-container transition-all duration-300 p-8 md:p-12">

        <!-- Close button -->
        <button id="contact-modal-close" class="absolute top-4 right-4 text-secondary hover:text-primary transition-colors focus:outline-none">
            <span class="material-symbols-outlined text-3xl">close</span>
        </button>

        <!-- Get In Touch Header -->
        <div class="mb-12 border-b border-outline-variant pb-6">
            <h2 class="font-display-lg text-headline-lg md:text-display-lg text-brand-navy mb-2">Get in Touch</h2>
            <p class="font-body-md text-secondary max-w-3xl">
                We welcome enquiries from researchers, institutions, potential partners, and anyone curious about what Ivri Research does. Our team is here to help.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            <!-- Left Side: Contact Information -->
            <div class="lg:col-span-5 space-y-8">
                <div>
                    <h3 class="font-headline-md text-headline-md text-brand-navy mb-6">Contact Information</h3>

                    <ul class="space-y-6">
                        <!-- Email -->
                        <li class="flex items-start gap-4">
                            <span class="material-symbols-outlined text-brand-emerald text-2xl mt-0.5">mail</span>
                            <div>
                                <h4 class="font-label-md text-label-md text-brand-navy">Email</h4>
                                <a href="mailto:<?php echo esc_attr( $email ); ?>" class="font-body-md text-secondary hover:text-primary transition-colors underline decoration-brand-emerald/30">
                                    <?php echo esc_html( $email ); ?>
                                </a>
                            </div>
                        </li>

                        <!-- Phone -->
                        <li class="flex items-start gap-4">
                            <span class="material-symbols-outlined text-brand-emerald text-2xl mt-0.5">call</span>
                            <div>
                                <h4 class="font-label-md text-label-md text-brand-navy">Phone</h4>
                                <a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $phone ) ); ?>" class="font-body-md text-secondary hover:text-primary transition-colors">
                                    <?php echo esc_html( $phone ); ?>
                                </a>
                            </div>
                        </li>

                        <!-- Address -->
                        <li class="flex items-start gap-4">
                            <span class="material-symbols-outlined text-brand-emerald text-2xl mt-0.5">location_on</span>
                            <div>
                                <h4 class="font-label-md text-label-md text-brand-navy">Address</h4>
                                <p class="font-body-md text-secondary whitespace-pre-line">
                                    <?php echo esc_html( $address ); ?>
                                </p>
                            </div>
                        </li>

                        <!-- Working Hours -->
                        <li class="flex items-start gap-4">
                            <span class="material-symbols-outlined text-brand-emerald text-2xl mt-0.5">schedule</span>
                            <div>
                                <h4 class="font-label-md text-label-md text-brand-navy">Working Hours</h4>
                                <p class="font-body-sm text-secondary">
                                    <?php echo esc_html( $hours ); ?>
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- Follow Us -->
                <div>
                    <h4 class="font-label-md text-label-md text-brand-navy mb-4 uppercase tracking-widest">Follow Us</h4>
                    <div class="flex flex-wrap gap-3">
                        <a href="<?php echo esc_url( $facebook ); ?>" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 bg-brand-navy hover:bg-opacity-90 text-white px-4 py-2 text-label-sm font-label-sm transition-all">
                            <span class="material-symbols-outlined text-sm">link</span> Facebook
                        </a>
                        <a href="<?php echo esc_url( $linkedin ); ?>" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 bg-brand-navy hover:bg-opacity-90 text-white px-4 py-2 text-label-sm font-label-sm transition-all">
                            <span class="material-symbols-outlined text-sm">link</span> LinkedIn
                        </a>
                        <a href="<?php echo esc_url( $instagram ); ?>" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 bg-brand-navy hover:bg-opacity-90 text-white px-4 py-2 text-label-sm font-label-sm transition-all">
                            <span class="material-symbols-outlined text-sm">link</span> Instagram
                        </a>
                        <a href="<?php echo esc_url( $youtube ); ?>" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 bg-brand-navy hover:bg-opacity-90 text-white px-4 py-2 text-label-sm font-label-sm transition-all">
                            <span class="material-symbols-outlined text-sm">play_arrow</span> YouTube
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right Side: Contact Form -->
            <div class="lg:col-span-7 bg-slate-50 p-8 rounded-lg border border-slate-100">
                <h3 class="font-headline-md text-headline-md text-brand-navy mb-6">Send Us a Message</h3>

                <!-- Alert Response container -->
                <div id="form-response" class="hidden p-4 rounded-lg text-sm mb-4"></div>

                <form id="contact-form" novalidate class="space-y-6">
                    <!-- Nonce Field -->
                    <input type="hidden" id="contact-nonce" value="<?php echo esc_attr( wp_create_nonce( 'contact_form_nonce' ) ); ?>">

                    <!-- Name -->
                    <div>
                        <label for="contact-name" class="block text-label-sm font-label-sm text-brand-navy mb-2">Name</label>
                        <input type="text" id="contact-name" name="name" required placeholder="Your full name"
                               class="w-full px-4 py-3 bg-white border border-outline-variant focus:border-brand-emerald focus:ring-0 outline-none font-body-sm transition-all">
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="contact-email" class="block text-label-sm font-label-sm text-brand-navy mb-2">Email</label>
                        <input type="email" id="contact-email" name="email" required placeholder="your@email.com"
                               class="w-full px-4 py-3 bg-white border border-outline-variant focus:border-brand-emerald focus:ring-0 outline-none font-body-sm transition-all">
                    </div>

                    <!-- Subject -->
                    <div>
                        <label for="contact-subject" class="block text-label-sm font-label-sm text-brand-navy mb-2">Subject</label>
                        <input type="text" id="contact-subject" name="subject" required placeholder="How can we help?"
                               class="w-full px-4 py-3 bg-white border border-outline-variant focus:border-brand-emerald focus:ring-0 outline-none font-body-sm transition-all">
                    </div>

                    <!-- Message -->
                    <div>
                        <label for="contact-message" class="block text-label-sm font-label-sm text-brand-navy mb-2">Message</label>
                        <textarea id="contact-message" name="message" rows="5" required placeholder="Tell us about your research, institution, or enquiry..."
                                  class="w-full px-4 py-3 bg-white border border-outline-variant focus:border-brand-emerald focus:ring-0 outline-none font-body-sm transition-all resize-none"></textarea>
                    </div>

                    <!-- Submit -->
                    <button type="submit" id="contact-submit-btn" class="w-full bg-[#0F766E] text-white py-4 font-label-md text-label-md hover:bg-[#115E59] transition-all flex items-center justify-center gap-2">
                        Send Message →
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>

<?php wp_footer(); ?>
</body>
</html>
