<?php

/**
 * Purely decorative animated background for the hero: dot/line grid,
 * a soft gold glow, a scattered twinkling dot field (echoing distant city
 * lights against the night skyline photo), and drifting "capability" glass
 * cards. No content lives here — safe to reorder or remove without
 * affecting page meaning. Respects prefers-reduced-motion via the global
 * CSS rule in app.css.
 */
?>
<div class="absolute inset-0 hero-grid pointer-events-none" aria-hidden="true"></div>
<div class="absolute -top-32 left-1/2 -translate-x-1/2 w-[640px] h-[640px] hero-glow pointer-events-none" aria-hidden="true"></div>

<svg class="absolute inset-0 w-full h-full pointer-events-none" aria-hidden="true" preserveAspectRatio="none">
    <circle class="hero-dot" cx="10%" cy="22%" r="1.6" style="animation-delay:0s" />
    <circle class="hero-dot" cx="22%" cy="68%" r="1.3" style="animation-delay:0.5s" />
    <circle class="hero-dot" cx="35%" cy="15%" r="1.8" style="animation-delay:1s" />
    <circle class="hero-dot" cx="48%" cy="45%" r="1.3" style="animation-delay:1.5s" />
    <circle class="hero-dot" cx="18%" cy="42%" r="1.4" style="animation-delay:2s" />
    <circle class="hero-dot" cx="62%" cy="20%" r="1.6" style="animation-delay:0.8s" />
    <circle class="hero-dot" cx="72%" cy="60%" r="1.3" style="animation-delay:2.4s" />
    <circle class="hero-dot" cx="85%" cy="30%" r="1.8" style="animation-delay:1.2s" />
    <circle class="hero-dot" cx="90%" cy="72%" r="1.4" style="animation-delay:1.8s" />
    <circle class="hero-dot" cx="55%" cy="78%" r="1.3" style="animation-delay:0.3s" />
</svg>

<div class="hero-float-card hero-float-1" aria-hidden="true">
    <svg class="w-4 h-4 text-gold-400" viewBox="0 0 20 20" fill="currentColor"><path d="M5.5 13a3.5 3.5 0 01-.42-6.98A4.5 4.5 0 0113.9 7.3 3.5 3.5 0 0114 13H5.5z"/></svg>
    Cloud
</div>
<div class="hero-float-card hero-float-2" aria-hidden="true">
    <svg class="w-4 h-4 text-gold-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 1l7 3v5c0 4.5-3 8.2-7 9-4-.8-7-4.5-7-9V4l7-3z" clip-rule="evenodd"/></svg>
    Security
</div>
<div class="hero-float-card hero-float-3" aria-hidden="true">
    <svg class="w-4 h-4 text-gold-400" viewBox="0 0 20 20" fill="currentColor"><path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 13a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-1 1H4a1 1 0 01-1-1v-3z"/></svg>
    Network
</div>
<div class="hero-float-card hero-float-4" aria-hidden="true">
    <svg class="w-4 h-4 text-gold-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v2a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm0 8a2 2 0 00-2 2v2a2 2 0 002 2h12a2 2 0 002-2v-2a2 2 0 00-2-2H4z" clip-rule="evenodd"/></svg>
    Server
</div>
<div class="hero-float-card hero-float-5" aria-hidden="true">
    <svg class="w-4 h-4 text-gold-400" viewBox="0 0 20 20" fill="currentColor"><path d="M2 5a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2H4a2 2 0 01-2-2V5zm4 3a1 1 0 000 2h8a1 1 0 100-2H6z"/></svg>
    Digital
</div>
