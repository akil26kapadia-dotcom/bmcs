<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Session;
use App\Models\Setting;

class ContentController extends Controller
{
    /**
     * Every editable text block on the public site's non-database pages
     * (Home, About, Contact, Products, legal pages), grouped by page. Each
     * field is a plain `settings` row — no new table needed, this just
     * gives the existing key/value store a proper editing screen. A page's
     * template reads its default straight from here (via SiteConfig::get()
     * with the same default text), so leaving a field untouched changes
     * nothing.
     */
    private const FIELDS = [
        'home' => [
            'label' => 'Homepage',
            'fields' => [
                'home_hero_eyebrow' => ['label' => 'Hero eyebrow', 'default' => 'Bright Mind Computer Solutions LLC'],
                'home_hero_heading' => ['label' => 'Hero heading', 'default' => 'TallyPrime Solutions & Complete IT Services in Dubai, UAE'],
                'home_hero_subtext' => ['label' => 'Hero subtext', 'type' => 'textarea', 'default' => 'TallyPrime sales, TSS renewal, Tally on Cloud, TallyPrime Server, customization and support — together with IT hardware, servers, networking, cybersecurity, CCTV and AMC for businesses across the UAE.'],

                'home_tally_eyebrow' => ['label' => 'Tally section eyebrow', 'default' => 'TallyPrime Solutions'],
                'home_tally_heading' => ['label' => 'Tally section heading', 'default' => 'TallyPrime Dubai: Sales, Renewal, Cloud, Server and Support'],
                'home_tally_subtitle' => ['label' => 'Tally section subtitle', 'type' => 'textarea', 'default' => 'From licensing and TSS renewal to Tally on Cloud, TallyPrime Server, customization and AMC — everything you need to run TallyPrime with confidence in the UAE.'],

                'home_trust_1' => ['label' => 'Trust strip item 1', 'default' => 'IT Infrastructure'],
                'home_trust_2' => ['label' => 'Trust strip item 2', 'default' => 'Networking'],
                'home_trust_3' => ['label' => 'Trust strip item 3', 'default' => 'Security'],
                'home_trust_4' => ['label' => 'Trust strip item 4', 'default' => 'Cloud'],
                'home_trust_5' => ['label' => 'Trust strip item 5', 'default' => 'Telecommunication'],
                'home_trust_6' => ['label' => 'Trust strip item 6', 'default' => 'Digital Solutions'],

                'home_about_eyebrow' => ['label' => 'About section eyebrow', 'default' => 'About BMCS'],
                'home_about_heading' => ['label' => 'About section heading', 'default' => 'A Technology Partner Built Around Your Business'],
                'home_about_badge_title' => ['label' => 'About photo badge title', 'default' => 'Empowering Effective Solutions'],
                'home_about_badge_text' => ['label' => 'About photo badge text', 'default' => 'Since our founding, our focus has stayed the same.'],
                'home_about_paragraph_1' => ['label' => 'About paragraph 1', 'type' => 'textarea', 'default' => "Bright Mind Computer Solutions (BMCS) is a Dubai-based IT and technology solutions provider, delivering enterprise computing, data networking, security, voice and telephony, Microsoft solutions, business continuity and digital services to businesses across the UAE."],
                'home_about_paragraph_2' => ['label' => 'About paragraph 2', 'type' => 'textarea', 'default' => "From structured cabling and cloud infrastructure to CCTV surveillance and web development, we bring together the technical disciplines a modern business needs under one roof — so you can work with a single, accountable technology partner instead of a patchwork of vendors."],

                'home_services_eyebrow' => ['label' => 'IT services section eyebrow', 'default' => 'Complete IT Services'],
                'home_services_heading' => ['label' => 'IT services section heading', 'default' => 'Beyond Tally: A Complete Range of IT Services'],
                'home_services_subtitle' => ['label' => 'IT services section subtitle', 'type' => 'textarea', 'default' => 'From infrastructure to digital experiences, BMCS covers the full technology stack your business relies on.'],

                'home_chip_1' => ['label' => 'Popular service chip 1', 'default' => 'Computer Hardware'],
                'home_chip_2' => ['label' => 'Popular service chip 2', 'default' => 'Servers'],
                'home_chip_3' => ['label' => 'Popular service chip 3', 'default' => 'Networking'],
                'home_chip_4' => ['label' => 'Popular service chip 4', 'default' => 'Cloud Solutions'],
                'home_chip_5' => ['label' => 'Popular service chip 5', 'default' => 'Cybersecurity'],
                'home_chip_6' => ['label' => 'Popular service chip 6', 'default' => 'CCTV / Security'],
                'home_chip_7' => ['label' => 'Popular service chip 7', 'default' => 'IT Support'],
                'home_chip_8' => ['label' => 'Popular service chip 8', 'default' => 'IT AMC'],

                'home_bento_eyebrow' => ['label' => 'Technology tiles eyebrow', 'default' => 'Solutions We Deliver'],
                'home_bento_heading' => ['label' => 'Technology tiles heading', 'default' => 'Infrastructure Built for Reliability and Growth'],
                'home_bento_subtitle' => ['label' => 'Technology tiles subtitle', 'type' => 'textarea', 'default' => 'The technology areas where BMCS designs, installs and supports solutions for businesses across Dubai and the UAE.'],
                'home_bento_1' => ['label' => 'Tile 1 title', 'default' => 'Network & Infrastructure'],
                'home_bento_2' => ['label' => 'Tile 2 title', 'default' => 'Security & Surveillance'],
                'home_bento_3' => ['label' => 'Tile 3 title', 'default' => 'Cloud & Data'],
                'home_bento_4' => ['label' => 'Tile 4 title', 'default' => 'Telecommunication'],
                'home_bento_5' => ['label' => 'Tile 5 title', 'default' => 'IT Support & Distribution'],
                'home_bento_6' => ['label' => 'Tile 6 title', 'default' => 'Web & Digital'],

                'home_why_eyebrow' => ['label' => '"Why BMCS" eyebrow', 'default' => 'Why BMCS'],
                'home_why_heading' => ['label' => '"Why BMCS" heading', 'default' => 'A Partner Businesses Choose to Rely On'],
                'home_why_1_title' => ['label' => 'Why-card 1 title', 'default' => 'Value for Money'],
                'home_why_1_text' => ['label' => 'Why-card 1 text', 'default' => 'Solutions sized and quoted to match real business needs, not oversold.'],
                'home_why_2_title' => ['label' => 'Why-card 2 title', 'default' => 'High Quality Work'],
                'home_why_2_text' => ['label' => 'Why-card 2 text', 'default' => 'Careful design and installation across every service we deliver.'],
                'home_why_3_title' => ['label' => 'Why-card 3 title', 'default' => 'Excellent Service'],
                'home_why_3_text' => ['label' => 'Why-card 3 text', 'default' => 'Responsive support before, during and after every project.'],
                'home_why_4_title' => ['label' => 'Why-card 4 title', 'default' => 'Complete Solutions'],
                'home_why_4_text' => ['label' => 'Why-card 4 text', 'default' => 'One partner across infrastructure, security, cloud and digital.'],

                'home_blog_eyebrow' => ['label' => 'Blog section eyebrow', 'default' => 'Insights'],
                'home_blog_heading' => ['label' => 'Blog section heading', 'default' => 'From the BMCS Blog'],

                'home_cta_heading' => ['label' => 'Final CTA heading', 'default' => "Let's Build a Smarter Technology Infrastructure"],
                'home_cta_subtext' => ['label' => 'Final CTA subtext', 'type' => 'textarea', 'default' => "Tell us about your business and we'll help you find the right technology solution."],
            ],
        ],
        'about' => [
            'label' => 'About Page',
            'fields' => [
                'about_hero_eyebrow' => ['label' => 'Hero eyebrow', 'default' => 'About BMCS'],
                'about_hero_heading' => ['label' => 'Hero heading', 'default' => 'Empowering Effective Solutions'],
                'about_hero_subtext' => ['label' => 'Hero subtext', 'type' => 'textarea', 'default' => 'A Dubai-based IT and technology solutions provider bringing enterprise infrastructure, security, cloud and digital capabilities together for businesses across the UAE.'],

                'about_story_eyebrow' => ['label' => 'Story eyebrow', 'default' => 'Who We Are'],
                'about_story_heading' => ['label' => 'Story heading', 'default' => 'A Single Technology Partner, Not a Patchwork of Vendors'],
                'about_story_paragraph_1' => ['label' => 'Story paragraph 1', 'type' => 'textarea', 'default' => 'Bright Mind Computer Solutions (BMCS) is a Dubai-based IT and technology solutions provider. We deliver enterprise computing, data networking and security, voice and telephony, Microsoft licensing and solutions, business continuity and disaster recovery, data center, audio visual, access control, CCTV surveillance, video conferencing, projector and PABX systems for businesses across the UAE.'],
                'about_story_paragraph_2' => ['label' => 'Story paragraph 2', 'type' => 'textarea', 'default' => 'Alongside our core IT infrastructure services, we also deliver web design and development, mobile app development and digital branding — bringing network, ICT infrastructure and digital solutions together under one accountable partner instead of a patchwork of vendors and freelancers.'],

                'about_expertise_eyebrow' => ['label' => 'Expertise eyebrow', 'default' => 'What We Do'],
                'about_expertise_heading' => ['label' => 'Expertise heading', 'default' => 'Our Areas of Expertise'],
                'about_expertise_subtitle' => ['label' => 'Expertise subtitle', 'type' => 'textarea', 'default' => 'Eight core technology areas, covering the full range of services a modern business relies on.'],

                'about_why_eyebrow' => ['label' => '"Why BMCS" eyebrow', 'default' => 'Why BMCS'],
                'about_why_heading' => ['label' => '"Why BMCS" heading', 'default' => 'Why Businesses Choose to Work With Us'],
                'about_why_1_title' => ['label' => 'Why-card 1 title', 'default' => 'Value for Money'],
                'about_why_1_text' => ['label' => 'Why-card 1 text', 'default' => 'Solutions sized and priced to match real business needs, not oversold.'],
                'about_why_2_title' => ['label' => 'Why-card 2 title', 'default' => 'High Quality Work'],
                'about_why_2_text' => ['label' => 'Why-card 2 text', 'default' => 'Careful design and installation across every service we deliver.'],
                'about_why_3_title' => ['label' => 'Why-card 3 title', 'default' => 'Excellent Service'],
                'about_why_3_text' => ['label' => 'Why-card 3 text', 'default' => 'Responsive support before, during and after every project.'],
                'about_why_4_title' => ['label' => 'Why-card 4 title', 'default' => 'Complete Solutions'],
                'about_why_4_text' => ['label' => 'Why-card 4 text', 'default' => 'One partner across infrastructure, security, cloud and digital.'],

                'about_tech_eyebrow' => ['label' => 'Technology section eyebrow', 'default' => 'Technology & Innovation'],
                'about_tech_heading' => ['label' => 'Technology section heading', 'default' => 'Built on the Desire to Do Excellent Work'],
                'about_tech_paragraph' => ['label' => 'Technology section paragraph', 'type' => 'textarea', 'default' => 'We approach every engagement with the same goal: deliver technology that genuinely works for the business behind it. From network cabling to cloud migration and digital design, our focus stays on solutions that are reliable, well-installed and built to last — not just the fastest thing to deploy.'],

                'about_cta_heading' => ['label' => 'CTA heading', 'default' => "Let's Talk About Your Technology Needs"],
                'about_cta_subtext' => ['label' => 'CTA subtext', 'default' => "Get in touch and we'll help you find the right solution for your business."],
            ],
        ],
        'contact' => [
            'label' => 'Contact Page',
            'fields' => [
                'contact_hero_eyebrow' => ['label' => 'Hero eyebrow', 'default' => 'Get In Touch'],
                'contact_hero_heading' => ['label' => 'Hero heading', 'default' => 'Contact BMCS'],
                'contact_hero_subtext' => ['label' => 'Hero subtext', 'type' => 'textarea', 'default' => 'Tell us about your business and one of our specialists will get back to you.'],
                'contact_form_eyebrow' => ['label' => 'Form section eyebrow', 'default' => 'Contact Us'],
                'contact_form_heading' => ['label' => 'Form section heading', 'default' => 'Request a Quotation or Consultation'],
                'contact_form_subtitle' => ['label' => 'Form section subtitle', 'type' => 'textarea', 'default' => 'Tell us a little about your business and one of our specialists will get back to you.'],
            ],
        ],
        'products' => [
            'label' => 'Products Page',
            'fields' => [
                'products_hero_eyebrow' => ['label' => 'Hero eyebrow', 'default' => 'IT Distribution'],
                'products_hero_heading' => ['label' => 'Hero heading', 'default' => 'IT Products & Distribution'],
                'products_hero_subtext' => ['label' => 'Hero subtext', 'type' => 'textarea', 'default' => 'BMCS supplies and configures the hardware businesses need — from servers and workstations to networking equipment and accessories.'],
                'products_cta_heading' => ['label' => 'CTA heading', 'default' => 'Looking for Specific Hardware?'],
                'products_cta_subtext' => ['label' => 'CTA subtext', 'type' => 'textarea', 'default' => "Tell us what your business needs and we'll help you source and configure the right equipment, at the right budget."],
            ],
        ],
        'legal' => [
            'label' => 'Legal Pages',
            'fields' => [
                // The "Contact Us" paragraph at the end of each page is not
                // part of this block — it always uses the current site email
                // automatically, so it can't go stale here.
                'privacy_content' => ['label' => 'Privacy Policy body (HTML, excluding the final "Contact Us" line)', 'type' => 'html', 'default' => "<p>Bright Mind Computer Solutions (\"BMCS\", \"we\", \"us\") respects your privacy. This policy explains what information we collect through this website, how we use it, and the choices you have.</p>\n\n<h2>Information We Collect</h2>\n<p>When you submit our contact form, we collect the details you provide — such as your name, email address, phone number, company and message. We do not require you to create an account or provide payment information through this website.</p>\n\n<h2>How We Use Your Information</h2>\n<ul>\n    <li>To respond to enquiries submitted through our contact form.</li>\n    <li>To provide information about our services when requested.</li>\n    <li>To improve this website and the services we offer.</li>\n</ul>\n<p>We do not sell or rent your personal information to third parties.</p>\n\n<h2>Cookies</h2>\n<p>This website may use strictly necessary cookies (such as session cookies) required for core functionality. If analytics tools are enabled, they may use cookies to help us understand how visitors use the site.</p>\n\n<h2>Data Security</h2>\n<p>We take reasonable technical and organizational measures to protect the information you share with us. However, no method of transmission over the internet is completely secure, and we cannot guarantee absolute security.</p>\n\n<h2>Third-Party Services</h2>\n<p>This website may link to third-party websites or use third-party services (for example, analytics providers). We are not responsible for the privacy practices of those third parties.</p>\n\n<h2>Your Rights</h2>\n<p>You may contact us at any time to ask what information we hold about you, to request a correction, or to request deletion of your information, subject to any legal or legitimate business requirements to retain it.</p>\n\n<h2>Changes to This Policy</h2>\n<p>We may update this policy from time to time. Changes will be posted on this page with an updated revision date.</p>"],
                'terms_content' => ['label' => 'Terms & Conditions body (HTML, excluding the final "Contact Us" line)', 'type' => 'html', 'default' => "<p>These terms and conditions govern your use of the Bright Mind Computer Solutions (\"BMCS\", \"we\", \"us\") website. By using this website, you agree to these terms.</p>\n\n<h2>Use of This Website</h2>\n<p>This website is provided for general information about BMCS and its services. You agree to use it only for lawful purposes and not to attempt to disrupt or compromise its security or functionality.</p>\n\n<h2>Information Accuracy</h2>\n<p>We aim to keep the information on this website accurate and up to date, but we make no warranty that all content is complete, current or error-free. Service descriptions are general in nature; specific project scope, pricing and timelines are confirmed separately with each client.</p>\n\n<h2>Intellectual Property</h2>\n<p>The content, design and branding of this website are the property of BMCS unless otherwise stated, and may not be reproduced without permission.</p>\n\n<h2>Third-Party Links</h2>\n<p>This website may contain links to third-party websites. We are not responsible for the content or practices of any linked third-party site.</p>\n\n<h2>Limitation of Liability</h2>\n<p>BMCS shall not be liable for any indirect, incidental or consequential damages arising from your use of this website, to the fullest extent permitted by law.</p>\n\n<h2>Governing Law</h2>\n<p>These terms are governed by the laws of the United Arab Emirates.</p>\n\n<h2>Changes to These Terms</h2>\n<p>We may update these terms from time to time. Continued use of the website after changes are posted constitutes acceptance of the revised terms.</p>"],
            ],
        ],
    ];

    public static function fieldGroups(): array
    {
        return self::FIELDS;
    }

    public function index(Request $request): void
    {
        $settings = Setting::allAsMap();

        $groups = [];
        foreach (self::FIELDS as $groupKey => $group) {
            $fields = [];
            foreach ($group['fields'] as $key => $field) {
                $fields[$key] = $field + ['value' => $settings[$key] ?? $field['default']];
            }
            $groups[$groupKey] = ['label' => $group['label'], 'fields' => $fields];
        }

        $this->view('pages/admin/content/index', [
            'title' => 'Page Content',
            'groups' => $groups,
        ], 'layouts/admin');
    }

    public function update(Request $request, array $params): void
    {
        $groupKey = $params['group'];

        if (!isset(self::FIELDS[$groupKey])) {
            http_response_code(404);
            return;
        }

        foreach (self::FIELDS[$groupKey]['fields'] as $key => $field) {
            $value = $request->input($key);
            if ($value === null) {
                continue;
            }
            $value = trim((string) $value);
            // An emptied field reverts to the built-in default rather than
            // saving a blank — clearing a box is how an admin "resets" it.
            if ($value === '') {
                Setting::forget($key);
            } else {
                Setting::set($key, $value);
            }
        }

        Session::flash('admin_success', self::FIELDS[$groupKey]['label'] . ' updated.');
        $this->redirect('/admin/content');
    }
}
