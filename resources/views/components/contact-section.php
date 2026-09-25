<?php

use App\Core\Csrf;
use App\Core\Session;
use App\Core\View;
use App\Helpers\SiteConfig;
use App\Models\Service;
use App\Models\ServiceCategory;

$phone = SiteConfig::get('site_phone');
$email = SiteConfig::get('site_email');
$whatsapp = SiteConfig::get('whatsapp_number');
$address = SiteConfig::get('site_address');
$city = SiteConfig::get('site_city', 'Dubai');
$success = Session::flash('contact_success');
$errors = Session::flash('contact_errors');

// Pulled live from Admin > Categories/Services, same as the header/footer menus.
try {
    $serviceOptions = array_merge(
        array_column(Service::byCategorySlug('tally-solutions'), 'name'),
        array_column(array_filter(ServiceCategory::allOrdered(), fn ($c) => $c['slug'] !== 'tally-solutions'), 'name')
    );
} catch (\Throwable $e) {
    $serviceOptions = [];
}
?>
<section id="contact" class="section-py bg-white">
    <div class="container-custom grid lg:grid-cols-5 gap-12">
        <div class="lg:col-span-2" data-animate="fade-right">
            <?= View::capture('components/section-heading', [
                'eyebrow' => SiteConfig::get('contact_form_eyebrow', 'Contact Us'),
                'title' => SiteConfig::get('contact_form_heading', 'Request a Quotation or Consultation'),
                'subtitle' => SiteConfig::get('contact_form_subtitle', 'Tell us a little about your business and one of our specialists will get back to you.'),
            ]) ?>

            <div class="mt-8 space-y-4">
                <a href="tel:<?= View::e(preg_replace('/\s+/', '', $phone)) ?>" class="flex items-center gap-3 text-ink-700 hover:text-navy-950">
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-lg bg-navy-950 text-gold-400 shrink-0">
                        <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor"><path d="M3.5 3A1.5 1.5 0 002 4.5v.5c0 7.732 6.268 14 14 14h.5a1.5 1.5 0 001.5-1.5v-2.086a1.5 1.5 0 00-1.048-1.43l-3.176-1.058a1.5 1.5 0 00-1.638.44l-.72.84a11.04 11.04 0 01-5.124-5.124l.84-.72a1.5 1.5 0 00.44-1.638L6.516 3.048A1.5 1.5 0 005.086 2H3.5z"/></svg>
                    </span>
                    <?= View::e($phone) ?>
                </a>
                <a href="mailto:<?= View::e($email) ?>" class="flex items-center gap-3 text-ink-700 hover:text-navy-950">
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-lg bg-navy-950 text-gold-400 shrink-0">
                        <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor"><path d="M2.94 4.94A2 2 0 014.5 4h11a2 2 0 011.56.94L10 10.06 2.94 4.94zM2 6.34V14a2 2 0 002 2h12a2 2 0 002-2V6.34l-7.4 5.28a1 1 0 01-1.2 0L2 6.34z"/></svg>
                    </span>
                    <?= View::e($email) ?>
                </a>
                <?php if (!empty($whatsapp)): ?>
                    <a href="https://wa.me/<?= View::e(preg_replace('/[^0-9]/', '', $whatsapp)) ?>" target="_blank" rel="noopener" class="flex items-center gap-3 text-ink-700 hover:text-navy-950">
                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-lg bg-navy-950 text-gold-400 shrink-0">
                            <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor"><path d="M10 2a8 8 0 00-6.9 12.02L2 18l4.1-1.07A8 8 0 1010 2zm0 14.4a6.4 6.4 0 01-3.26-.9l-.23-.14-2.43.64.65-2.37-.15-.24A6.4 6.4 0 1116.4 10 6.41 6.41 0 0110 16.4z"/></svg>
                        </span>
                        WhatsApp Us
                    </a>
                <?php endif; ?>
                <p class="flex items-center gap-3 text-ink-500">
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-lg bg-navy-950 text-gold-400 shrink-0">
                        <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9.69 18.933l.003.001C9.89 19.02 10 19 10 19s.11.02.308-.066l.002-.001.006-.003.018-.008a5.741 5.741 0 00.281-.14c.186-.096.446-.24.757-.433.62-.384 1.445-.966 2.274-1.765C15.302 14.988 17 12.493 17 9A7 7 0 103 9c0 3.492 1.698 5.988 3.355 7.584a13.731 13.731 0 002.273 1.765 11.842 11.842 0 00.976.544l.062.029.018.008.006.003zM10 11.25a2.25 2.25 0 100-4.5 2.25 2.25 0 000 4.5z" clip-rule="evenodd"/></svg>
                    </span>
                    <?= View::e($address ?: $city . ', United Arab Emirates') ?>
                </p>
            </div>
        </div>

        <div class="lg:col-span-3" data-animate="fade-left">
            <?php if ($success): ?>
                <div class="mb-6 rounded-lg bg-green-50 border border-green-200 text-green-800 px-5 py-4 text-sm"><?= View::e($success) ?></div>
            <?php endif; ?>
            <?php if ($errors): ?>
                <div class="mb-6 rounded-lg bg-red-50 border border-red-200 text-red-800 px-5 py-4 text-sm"><?= View::e($errors) ?></div>
            <?php endif; ?>

            <form action="/contact" method="POST" class="card p-8 grid sm:grid-cols-2 gap-5">
                <?= Csrf::field() ?>
                <input type="text" name="website" tabindex="-1" autocomplete="off" class="hidden" aria-hidden="true">

                <div class="sm:col-span-1">
                    <label for="name" class="block text-sm font-medium text-ink-700 mb-1.5">Name <span class="text-red-500">*</span></label>
                    <input type="text" id="name" name="name" required class="w-full rounded-lg border border-ink-300 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-gold-500 focus:border-transparent">
                </div>
                <div class="sm:col-span-1">
                    <label for="email" class="block text-sm font-medium text-ink-700 mb-1.5">Email <span class="text-red-500">*</span></label>
                    <input type="email" id="email" name="email" required class="w-full rounded-lg border border-ink-300 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-gold-500 focus:border-transparent">
                </div>
                <div class="sm:col-span-1">
                    <label for="phone" class="block text-sm font-medium text-ink-700 mb-1.5">Phone</label>
                    <input type="tel" id="phone" name="phone" class="w-full rounded-lg border border-ink-300 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-gold-500 focus:border-transparent">
                </div>
                <div class="sm:col-span-1">
                    <label for="company" class="block text-sm font-medium text-ink-700 mb-1.5">Company</label>
                    <input type="text" id="company" name="company" class="w-full rounded-lg border border-ink-300 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-gold-500 focus:border-transparent">
                </div>
                <div class="sm:col-span-2">
                    <label for="service" class="block text-sm font-medium text-ink-700 mb-1.5">Service of Interest</label>
                    <select id="service" name="service" class="w-full rounded-lg border border-ink-300 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-gold-500 focus:border-transparent">
                        <option value="">Select a service (optional)</option>
                        <?php foreach ($serviceOptions as $option): ?>
                            <option value="<?= View::e($option) ?>"><?= View::e($option) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="sm:col-span-2">
                    <label for="message" class="block text-sm font-medium text-ink-700 mb-1.5">Message <span class="text-red-500">*</span></label>
                    <textarea id="message" name="message" rows="4" required class="w-full rounded-lg border border-ink-300 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-gold-500 focus:border-transparent"></textarea>
                </div>
                <div class="sm:col-span-2">
                    <button type="submit" class="btn-primary w-full sm:w-auto">Send Message</button>
                </div>
            </form>
        </div>
    </div>
</section>
