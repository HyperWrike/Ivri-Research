<?php
/**
 * Footer template & Contact Modal markup
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Fetch global contact details from the front page ACF fields
$front_id  = get_option( 'page_on_front' );
$email     = $front_id ? ( get_field( 'contact_email', $front_id ) ?: 'info@ivriresearch.com' ) : 'info@ivriresearch.com';
$phone     = $front_id ? ( get_field( 'contact_phone', $front_id ) ?: '+91 86183 88731' ) : '+91 86183 88731';
$address   = $front_id ? ( get_field( 'contact_address', $front_id ) ?: 'Zurich Headquarters, Switzerland' ) : 'Zurich Headquarters, Switzerland';
$hours     = $front_id ? ( get_field( 'contact_hours', $front_id ) ?: 'Monday – Friday: 9:00 AM to 6:00 PM (IST)' ) : 'Monday – Friday: 9:00 AM to 6:00 PM (IST)';
$linkedin  = $front_id ? ( get_field( 'social_linkedin', $front_id ) ?: '#' ) : '#';
$twitter   = $front_id ? ( get_field( 'social_twitter', $front_id ) ?: '#' ) : '#';
$facebook  = $front_id ? ( get_field( 'social_facebook', $front_id ) ?: '#' ) : '#';
$youtube   = $front_id ? ( get_field( 'social_youtube', $front_id ) ?: '#' ) : '#';
?>

<!-- Footer -->
<footer class="bg-surface-container dark:bg-surface-dim border-t border-outline-variant dark:border-outline">
    <div class="flex flex-col md:flex-row justify-between items-center px-margin-desktop py-stack-lg w-full max-w-container-max mx-auto">
        <div class="mb-stack-md md:mb-0">
            <div class="font-headline-md text-headline-md font-bold text-primary dark:text-primary-fixed">
                Ivri Research
            </div>
            <p class="font-body-sm text-body-sm text-on-surface dark:text-on-surface-variant opacity-60 mt-2">
                © <?php echo date('Y'); ?> Ivri Research. All rights reserved.
            </p>
        </div>

        <div class="flex space-x-stack-lg">
            <?php
            $locations = get_nav_menu_locations();
            $footer_items = array();
            if ( isset( $locations['footer-menu'] ) ) {
                $menu = wp_get_nav_menu_object( $locations['footer-menu'] );
                if ( $menu ) {
                    $footer_items = wp_get_nav_menu_items( $menu->term_id );
                }
            }

            if ( ! empty( $footer_items ) ) {
                foreach ( $footer_items as $item ) {
                    echo '<a class="text-secondary dark:text-secondary-fixed-dim hover:text-primary dark:hover:text-primary-fixed transition-all font-label-sm text-label-sm hover:underline" href="' . esc_url( $item->url ) . '">' . esc_html( $item->title ) . '</a>';
                }
            } else {
                // Mockup default footer links
                echo '<a class="text-secondary dark:text-secondary-fixed-dim hover:text-primary dark:hover:text-primary-fixed transition-all font-label-sm text-label-sm hover:underline" href="#">Terms</a>';
                echo '<a class="text-secondary dark:text-secondary-fixed-dim hover:text-primary dark:hover:text-primary-fixed transition-all font-label-sm text-label-sm hover:underline" href="#">Privacy</a>';
                echo '<a class="text-secondary dark:text-secondary-fixed-dim hover:text-primary dark:hover:text-primary-fixed transition-all font-label-sm text-label-sm hover:underline" href="#">Publication Ethics</a>';
            }
            ?>
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
            <h2 class="font-display-lg text-display-lg text-brand-navy mb-2">Get in Touch</h2>
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
                                <a href="tel:<?php echo esc_attr( str_replace(' ', '', $phone) ); ?>" class="font-body-md text-secondary hover:text-primary transition-colors">
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
                        <a href="<?php echo esc_url( $linkedin ); ?>" target="_blank" class="flex items-center gap-2 bg-brand-navy hover:bg-opacity-90 text-white px-4 py-2 text-label-sm font-label-sm transition-all">
                            <span class="material-symbols-outlined text-sm">link</span> LinkedIn
                        </a>
                        <a href="<?php echo esc_url( $twitter ); ?>" target="_blank" class="flex items-center gap-2 bg-brand-navy hover:bg-opacity-90 text-white px-4 py-2 text-label-sm font-label-sm transition-all">
                            <span class="material-symbols-outlined text-sm">link</span> Twitter/X
                        </a>
                        <a href="<?php echo esc_url( $facebook ); ?>" target="_blank" class="flex items-center gap-2 bg-brand-navy hover:bg-opacity-90 text-white px-4 py-2 text-label-sm font-label-sm transition-all">
                            <span class="material-symbols-outlined text-sm">link</span> Facebook
                        </a>
                        <a href="<?php echo esc_url( $youtube ); ?>" target="_blank" class="flex items-center gap-2 bg-brand-navy hover:bg-opacity-90 text-white px-4 py-2 text-label-sm font-label-sm transition-all">
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
