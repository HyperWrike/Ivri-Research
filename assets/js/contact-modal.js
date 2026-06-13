document.addEventListener('DOMContentLoaded', () => {
    const modalBackdrop = document.getElementById('contact-modal');
    const modalContainer = document.getElementById('contact-modal-container');
    const closeBtn = document.getElementById('contact-modal-close');
    const contactForm = document.getElementById('contact-form');
    const formResponse = document.getElementById('form-response');
    const submitBtn = document.getElementById('contact-submit-btn');

    if (!modalBackdrop || !modalContainer) return;

    // Helper: Open Modal
    function openModal() {
        modalBackdrop.classList.remove('hidden');
        modalBackdrop.classList.add('flex');
        // Trigger reflow for transition
        setTimeout(() => {
            modalBackdrop.classList.remove('opacity-0');
            modalContainer.classList.remove('opacity-0', 'scale-95');
        }, 10);
        document.body.classList.add('overflow-hidden');
    }

    // Helper: Close Modal
    function closeModal() {
        modalBackdrop.classList.add('opacity-0');
        modalContainer.classList.add('opacity-0', 'scale-95');
        setTimeout(() => {
            modalBackdrop.classList.add('hidden');
            modalBackdrop.classList.remove('flex');
        }, 300);
        document.body.classList.remove('overflow-hidden');
        // Clear message & reset form on close
        if (contactForm) contactForm.reset();
        if (formResponse) {
            formResponse.className = 'hidden p-4 rounded-lg text-sm';
            formResponse.innerHTML = '';
        }
    }

    // Listen to all contact triggers
    document.addEventListener('click', (e) => {
        const trigger = e.target.closest('[data-contact-trigger]');
        if (trigger) {
            e.preventDefault();
            openModal();
        }
    });

    // Close on click of close button
    if (closeBtn) {
        closeBtn.addEventListener('click', closeModal);
    }

    // Close on click of backdrop
    modalBackdrop.addEventListener('click', (e) => {
        if (e.target === modalBackdrop) {
            closeModal();
        }
    });

    // Close on Escape key
    window.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !modalBackdrop.classList.contains('hidden')) {
            closeModal();
        }
    });

    // Form Submission & Validation
    if (contactForm) {
        contactForm.addEventListener('submit', (e) => {
            e.preventDefault();

            // Clear previous alerts
            formResponse.className = 'hidden p-4 rounded-lg text-sm';
            formResponse.innerHTML = '';

            const name = document.getElementById('contact-name').value.trim();
            const email = document.getElementById('contact-email').value.trim();
            const subject = document.getElementById('contact-subject').value.trim();
            const message = document.getElementById('contact-message').value.trim();
            const nonce = document.getElementById('contact-nonce').value;

            // Simple client-side validation
            let errors = [];
            if (!name) errors.push('Name is required.');
            if (!email) {
                errors.push('Email is required.');
            } else {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(email)) {
                    errors.push('Please enter a valid email address.');
                }
            }
            if (!subject) errors.push('Subject is required.');
            if (!message) errors.push('Message is required.');

            if (errors.length > 0) {
                formResponse.className = 'p-4 rounded-lg text-sm bg-error-container text-error border border-error/20 mb-4 block';
                formResponse.innerHTML = errors.join('<br>');
                return;
            }

            // Disable submit button during submit
            const originalBtnText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="flex items-center justify-center gap-2"><svg class="animate-spin h-5 w-5 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Sending Message...</span>';

            // Build form data
            const formData = new FormData();
            formData.append('action', 'submit_contact_form');
            formData.append('name', name);
            formData.append('email', email);
            formData.append('subject', subject);
            formData.append('message', message);
            formData.append('nonce', nonce);

            // Live WordPress AJAX Request
            const ajaxUrl = typeof ivri_contact_ajax !== 'undefined' ? ivri_contact_ajax.ajax_url : '/wp-admin/admin-ajax.php';
            
            fetch(ajaxUrl, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnText;

                if (data.success) {
                    // Show success
                    formResponse.className = 'p-4 rounded-lg text-sm bg-emerald-50 text-emerald-800 border border-emerald-200 mb-4 block';
                    formResponse.innerHTML = data.data.message;
                    contactForm.reset();
                    
                    // Close modal after 2 seconds
                    setTimeout(closeModal, 2000);
                } else {
                    // Show error
                    formResponse.className = 'p-4 rounded-lg text-sm bg-error-container text-error border border-error/20 mb-4 block';
                    formResponse.innerHTML = data.data.message || 'An error occurred. Please try again.';
                }
            })
            .catch(error => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnText;

                formResponse.className = 'p-4 rounded-lg text-sm bg-error-container text-error border border-error/20 mb-4 block';
                formResponse.innerHTML = 'Network error. Please check your connection and try again.';
                console.error('AJAX Submit Error:', error);
            });
        });
    }
});
