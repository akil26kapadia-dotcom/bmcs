<?php

/**
 * Purely decorative animated background for the hero: dot/line grid,
 * a soft gold glow, drifting "capability" glass cards, and a handful of
 * animated connection lines. No content lives here — safe to reorder
 * or remove without affecting page meaning. Respects prefers-reduced-motion
 * via the global CSS rule in app.css.
 */
?>
<div class="absolute inset-0 hero-grid pointer-events-none" aria-hidden="true"></div>
<div class="absolute -top-32 left-1/2 -translate-x-1/2 w-[640px] h-[640px] hero-glow pointer-events-none" aria-hidden="true"></div>

<svg class="absolute inset-0 w-full h-full pointer-events-none" aria-hidden="true" preserveAspectRatio="none">
    <line class="network-line" x1="8%" y1="20%" x2="30%" y2="55%" />
    <line class="network-line" x1="30%" y1="55%" x2="55%" y2="30%" />
    <line class="network-line" x1="70%" y1="70%" x2="92%" y2="35%" />
    <line class="network-line" x1="55%" y1="30%" x2="80%" y2="15%" />
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
