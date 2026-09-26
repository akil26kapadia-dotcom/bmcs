/**
 * Homepage-only behaviour (loaded just on the new homepage):
 *  - animated "living network" canvas in the hero
 *  - cursor spotlight on cards, hero card parallax
 *  - animated counters, how-we-work progress line
 *  - TallyPrime Advisor quiz
 *  - optional background video (only on wide screens, never on reduced motion)
 * All of it is progressive enhancement: the page reads fine without it.
 */
(function () {
  'use strict';

  var reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var saveData = navigator.connection && navigator.connection.saveData;

  /* ---------------- Hero network canvas ---------------- */
  var canvas = document.querySelector('[data-network]');
  if (canvas && canvas.getContext) {
    var ctx = canvas.getContext('2d');
    var labels = [];
    try { labels = JSON.parse(canvas.getAttribute('data-labels') || '[]'); } catch (e) { labels = []; }

    var w = 0, h = 0, dpr = 1, nodes = [], hubs = [], packets = [];
    var mouse = { x: -9999, y: -9999, active: false };
    var running = false, raf = 0, lastPacket = 0;

    var rand = function (a, b) { return a + Math.random() * (b - a); };

    var build = function () {
      var rect = canvas.getBoundingClientRect();
      w = rect.width; h = rect.height;
      dpr = Math.min(window.devicePixelRatio || 1, 2);
      canvas.width = Math.round(w * dpr);
      canvas.height = Math.round(h * dpr);
      ctx.setTransform(dpr, 0, 0, dpr, 0, 0);

      var count = Math.max(26, Math.min(64, Math.round(w / 24)));
      nodes = [];
      for (var i = 0; i < count; i++) {
        nodes.push({ x: rand(0, w), y: rand(0, h), vx: rand(-.22, .22), vy: rand(-.22, .22), r: rand(1.2, 2.4) });
      }

      // Labelled hub nodes (service areas), placed on the right half so the
      // headline on the left stays clear.
      // Hubs sit in the top and bottom strips so labels never hide behind
      // the hero cards or the headline.
      hubs = [];
      var slots = w < 900
        ? [[.12, .07], [.5, .05], [.88, .07], [.14, .94], [.5, .95], [.86, .94]]
        : [[.52, .12], [.68, .1], [.84, .13], [.56, .88], [.72, .9], [.88, .87]];
      ctx.font = '600 12px "Bricolage Grotesque", Arial, sans-serif';
      for (var j = 0; j < Math.min(labels.length, slots.length); j++) {
        hubs.push({ label: labels[j], bx: w * slots[j][0], by: h * slots[j][1], ph: rand(0, 6.28), tw: ctx.measureText(labels[j]).width });
      }
    };

    var draw = function (t) {
      ctx.clearRect(0, 0, w, h);
      var maxD = w < 700 ? 90 : 130, maxD2 = maxD * maxD, i, j, a, b, dx, dy, d2;

      for (i = 0; i < nodes.length; i++) {
        a = nodes[i];
        if (!reduced) {
          a.x += a.vx; a.y += a.vy;
          if (a.x < 0 || a.x > w) a.vx *= -1;
          if (a.y < 0 || a.y > h) a.vy *= -1;
        }
        // Gentle pull toward the cursor.
        if (mouse.active) {
          dx = mouse.x - a.x; dy = mouse.y - a.y; d2 = dx * dx + dy * dy;
          if (d2 < 22000 && d2 > 1) { a.x += dx * .0035; a.y += dy * .0035; }
        }
      }

      ctx.lineWidth = 1;
      for (i = 0; i < nodes.length; i++) {
        a = nodes[i];
        for (j = i + 1; j < nodes.length; j++) {
          b = nodes[j]; dx = a.x - b.x; dy = a.y - b.y; d2 = dx * dx + dy * dy;
          if (d2 < maxD2) {
            ctx.strokeStyle = 'rgba(255,255,255,' + (0.22 * (1 - d2 / maxD2)).toFixed(3) + ')';
            ctx.beginPath(); ctx.moveTo(a.x, a.y); ctx.lineTo(b.x, b.y); ctx.stroke();
          }
        }
        // Lines to the cursor, in yellow.
        if (mouse.active) {
          dx = a.x - mouse.x; dy = a.y - mouse.y; d2 = dx * dx + dy * dy;
          if (d2 < 24000) {
            ctx.strokeStyle = 'rgba(255,198,50,' + (0.55 * (1 - d2 / 24000)).toFixed(3) + ')';
            ctx.beginPath(); ctx.moveTo(a.x, a.y); ctx.lineTo(mouse.x, mouse.y); ctx.stroke();
          }
        }
        ctx.fillStyle = 'rgba(255,255,255,.75)';
        ctx.beginPath(); ctx.arc(a.x, a.y, a.r, 0, 6.283); ctx.fill();
      }

      // Hubs: connect to nearest nodes, glow, label.
      ctx.font = '600 12px "Bricolage Grotesque", Arial, sans-serif';
      ctx.textBaseline = 'middle';
      for (i = 0; i < hubs.length; i++) {
        var hub = hubs[i];
        hub.x = hub.bx + (reduced ? 0 : Math.sin(t / 1800 + hub.ph) * 10);
        hub.y = hub.by + (reduced ? 0 : Math.cos(t / 2100 + hub.ph) * 8);
        for (j = 0; j < nodes.length; j++) {
          b = nodes[j]; dx = hub.x - b.x; dy = hub.y - b.y; d2 = dx * dx + dy * dy;
          if (d2 < 30000) {
            ctx.strokeStyle = 'rgba(255,198,50,' + (0.4 * (1 - d2 / 30000)).toFixed(3) + ')';
            ctx.beginPath(); ctx.moveTo(hub.x, hub.y); ctx.lineTo(b.x, b.y); ctx.stroke();
          }
        }
        var g = ctx.createRadialGradient(hub.x, hub.y, 0, hub.x, hub.y, 26);
        g.addColorStop(0, 'rgba(255,198,50,.55)'); g.addColorStop(1, 'rgba(255,198,50,0)');
        ctx.fillStyle = g; ctx.beginPath(); ctx.arc(hub.x, hub.y, 26, 0, 6.283); ctx.fill();
        ctx.fillStyle = '#FFC632'; ctx.beginPath(); ctx.arc(hub.x, hub.y, 4.5, 0, 6.283); ctx.fill();
        if (w > 560) {
          ctx.fillStyle = 'rgba(255,255,255,.92)';
          var lx = hub.x + 12;
          if (lx + hub.tw > w - 8) lx = hub.x - 12 - hub.tw;
          ctx.fillText(hub.label, lx, hub.y);
        }
      }

      // Data packets travelling along hub links.
      if (!reduced && hubs.length && t - lastPacket > 900 && packets.length < 8) {
        lastPacket = t;
        var hb = hubs[Math.floor(Math.random() * hubs.length)];
        var target = nodes[Math.floor(Math.random() * nodes.length)];
        packets.push({ from: hb, to: target, p: 0 });
      }
      for (i = packets.length - 1; i >= 0; i--) {
        var pk = packets[i]; pk.p += .012;
        if (pk.p >= 1) { packets.splice(i, 1); continue; }
        var px = pk.from.x + (pk.to.x - pk.from.x) * pk.p, py = pk.from.y + (pk.to.y - pk.from.y) * pk.p;
        ctx.fillStyle = 'rgba(255,214,110,' + (1 - Math.abs(pk.p - .5)).toFixed(2) + ')';
        ctx.beginPath(); ctx.arc(px, py, 2.6, 0, 6.283); ctx.fill();
      }
    };

    var loop = function (t) {
      if (!running) return;
      draw(t);
      raf = requestAnimationFrame(loop);
    };
    var start = function () { if (running || reduced) return; running = true; raf = requestAnimationFrame(loop); };
    var stop = function () { running = false; cancelAnimationFrame(raf); };

    build();
    draw(0);
    if (!reduced) {
      var section = canvas.closest('section') || canvas;
      section.addEventListener('mousemove', function (e) {
        var r = canvas.getBoundingClientRect();
        mouse.x = e.clientX - r.left; mouse.y = e.clientY - r.top; mouse.active = true;
      }, { passive: true });
      section.addEventListener('mouseleave', function () { mouse.active = false; });

      if ('IntersectionObserver' in window) {
        new IntersectionObserver(function (en) { en[0].isIntersecting && !document.hidden ? start() : stop(); }).observe(canvas);
      } else { start(); }
      document.addEventListener('visibilitychange', function () { document.hidden ? stop() : start(); });
    }
    var resizeT;
    window.addEventListener('resize', function () { clearTimeout(resizeT); resizeT = setTimeout(function () { build(); draw(0); }, 200); });
  }

  /* ---------------- Cursor spotlight on cards ---------------- */
  document.addEventListener('mousemove', function (e) {
    var el = e.target.closest ? e.target.closest('.spotlight, [data-spot]') : null;
    if (!el) return;
    var r = el.getBoundingClientRect();
    el.style.setProperty('--mx', (e.clientX - r.left) + 'px');
    el.style.setProperty('--my', (e.clientY - r.top) + 'px');
  }, { passive: true });

  /* ---------------- Hero card parallax ---------------- */
  var parallaxItems = document.querySelectorAll('[data-depth]');
  if (parallaxItems.length && !reduced && window.matchMedia('(pointer: fine)').matches) {
    var heroSection = parallaxItems[0].closest('section');
    heroSection && heroSection.addEventListener('mousemove', function (e) {
      var cx = (e.clientX / window.innerWidth - .5), cy = (e.clientY / window.innerHeight - .5);
      parallaxItems.forEach(function (item) {
        var d = parseFloat(item.getAttribute('data-depth')) || 10;
        item.style.transform = 'translate3d(' + (cx * d).toFixed(1) + 'px,' + (cy * d).toFixed(1) + 'px,0)';
      });
    }, { passive: true });
  }

  /* ---------------- Counters ---------------- */
  var counters = document.querySelectorAll('[data-count]');
  var runCounter = function (el) {
    var target = parseFloat(el.getAttribute('data-count')) || 0;
    var decimals = (el.getAttribute('data-count').split('.')[1] || '').length;
    if (reduced) { el.textContent = target.toFixed(decimals); return; }
    var t0 = performance.now(), dur = 1500;
    var step = function (now) {
      var p = Math.min((now - t0) / dur, 1), eased = 1 - Math.pow(1 - p, 3);
      el.textContent = (target * eased).toFixed(decimals);
      if (p < 1) requestAnimationFrame(step);
    };
    requestAnimationFrame(step);
  };
  if (counters.length) {
    if ('IntersectionObserver' in window) {
      var co = new IntersectionObserver(function (entries) {
        entries.forEach(function (en) { if (en.isIntersecting) { runCounter(en.target); co.unobserve(en.target); } });
      }, { threshold: .4 });
      counters.forEach(function (c) { co.observe(c); });
    } else { counters.forEach(runCounter); }
  }

  /* ---------------- How-we-work progress line ---------------- */
  var stepsEl = document.querySelector('[data-steps]');
  if (stepsEl) {
    var stepItems = stepsEl.querySelectorAll('.step');
    var onScrollSteps = function () {
      var r = stepsEl.getBoundingClientRect(), vh = window.innerHeight;
      var p = (vh * .6 - r.top) / r.height;
      p = Math.max(0, Math.min(1, p));
      stepsEl.style.setProperty('--p', p.toFixed(3));
      stepItems.forEach(function (s, i) {
        s.classList.toggle('is-active', p >= (i / stepItems.length) + .02);
      });
    };
    onScrollSteps();
    window.addEventListener('scroll', onScrollSteps, { passive: true });
    window.addEventListener('resize', onScrollSteps);
  }

  /* ---------------- About photo: mask reveal, scroll parallax, mouse tilt ---------------- */
  var mask = document.querySelector('[data-reveal-mask]');
  if (mask) {
    if ('IntersectionObserver' in window && !reduced) {
      var mo = new IntersectionObserver(function (en) { if (en[0].isIntersecting) { mask.classList.add('is-in'); mo.disconnect(); } }, { threshold: .25 });
      mo.observe(mask.parentNode);
    } else { mask.classList.add('is-in'); }
  }
  var pimg = document.querySelector('[data-parallax-y]');
  if (pimg && !reduced) {
    var onParallax = function () {
      var r = pimg.parentNode.getBoundingClientRect(), vh = window.innerHeight;
      if (r.bottom < 0 || r.top > vh) return;
      var p = (r.top + r.height / 2 - vh / 2) / vh; // -1..1 around the viewport centre
      pimg.style.translate = '0 ' + (p * -34).toFixed(1) + 'px';
    };
    onParallax();
    window.addEventListener('scroll', onParallax, { passive: true });
  }
  var tilt = document.querySelector('[data-tilt]');
  if (tilt && !reduced && window.matchMedia('(pointer: fine)').matches) {
    var tiltHost = tilt.parentNode;
    tiltHost.addEventListener('mousemove', function (e) {
      var r = tiltHost.getBoundingClientRect();
      var x = (e.clientX - r.left) / r.width - .5, y = (e.clientY - r.top) / r.height - .5;
      tilt.style.transform = 'perspective(1000px) rotateY(' + (x * 9).toFixed(2) + 'deg) rotateX(' + (-y * 7).toFixed(2) + 'deg) scale(1.015)';
    });
    tiltHost.addEventListener('mouseleave', function () { tilt.style.transform = ''; });
  }

  /* ---------------- Scroll progress bar ---------------- */
  var bar = document.querySelector('[data-scroll-progress]');
  if (bar && !reduced) {
    var onScrollBar = function () {
      var max = document.documentElement.scrollHeight - window.innerHeight;
      bar.style.transform = 'scaleX(' + (max > 0 ? Math.min(1, window.scrollY / max) : 0).toFixed(4) + ')';
    };
    onScrollBar();
    window.addEventListener('scroll', onScrollBar, { passive: true });
  }

  /* ---------------- Optional background video ---------------- */
  var video = document.querySelector('[data-hero-video]');
  if (video) {
    if (!reduced && !saveData && window.innerWidth >= 768) {
      video.src = video.getAttribute('data-src');
      video.addEventListener('canplay', function () { video.classList.remove('opacity-0'); video.play().catch(function () {}); });
      video.load();
    } else {
      video.remove();
    }
  }

  /* ---------------- TallyPrime Advisor ---------------- */
  var root = document.querySelector('[data-advisor]');
  var cfgEl = document.querySelector('[data-advisor-config]');
  if (root && cfgEl) {
    var cfg;
    try { cfg = JSON.parse(cfgEl.textContent); } catch (e) { cfg = null; }
    if (cfg) {
      var answers = {}, path = [];
      var stage = root.querySelector('[data-advisor-stage]');
      var progress = root.querySelector('[data-advisor-progress]');
      var backBtn = root.querySelector('[data-advisor-back]');

      var visible = function (q) {
        if (!q.showIf) return true;
        return Object.keys(q.showIf).every(function (k) { return q.showIf[k].indexOf(answers[k]) !== -1; });
      };
      var nextQuestion = function () {
        for (var i = 0; i < cfg.questions.length; i++) {
          var q = cfg.questions[i];
          if (answers[q.id] === undefined && visible(q)) return q;
        }
        return null;
      };
      var esc = function (s) { var d = document.createElement('div'); d.textContent = s; return d.innerHTML; };

      var render = function () {
        var q = nextQuestion();
        backBtn.hidden = path.length === 0;
        progress.style.width = Math.min(100, Math.round((path.length / 3) * 100)) + '%';
        if (q) {
          var html = '<h3 class="text-xl md:text-2xl font-semibold text-navy-950">' + esc(q.title) + '</h3><div class="mt-6 space-y-3">';
          q.options.forEach(function (o) {
            html += '<button type="button" class="advisor-option" data-q="' + q.id + '" data-v="' + esc(o.v) + '"><span>' + esc(o.label) +
              '</span><svg class="w-5 h-5 text-gold-600 shrink-0" viewBox="0 0 20 20" fill="none"><path d="M4 10h12M11 5l5 5-5 5" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/></svg></button>';
          });
          stage.innerHTML = html + '</div>';
          var first = stage.querySelector('.advisor-option'); first && first.focus({ preventScroll: true });
          return;
        }
        progress.style.width = '100%';
        var rule = null;
        for (var i = 0; i < cfg.rules.length && !rule; i++) {
          var when = cfg.rules[i].when || {};
          if (Object.keys(when).every(function (k) { return when[k] === answers[k]; })) rule = cfg.rules[i];
        }
        rule = rule || cfg.fallback;
        var svc = cfg.services[rule.service] || {};
        var msg = 'Hello BMCS, I used the TallyPrime Advisor and I am interested in: ' + (svc.name || 'TallyPrime') + '. ' + (rule.note || '');
        var wa = cfg.whatsapp ? cfg.whatsapp + (cfg.whatsapp.indexOf('?') === -1 ? '?text=' : '&text=') + encodeURIComponent(msg) : '';
        stage.innerHTML =
          '<p class="eyebrow">We recommend</p>' +
          '<h3 class="mt-2 text-2xl md:text-3xl font-semibold text-navy-950">' + esc(svc.name || '') + '</h3>' +
          '<p class="mt-3 text-ink-500 leading-relaxed">' + esc(rule.why) + '</p>' +
          '<div class="mt-7 flex flex-wrap gap-3">' +
          '<a class="btn-primary" href="' + esc(svc.url || '/contact') + '">Read more</a>' +
          '<a class="btn-secondary" href="/contact">Request a Quotation</a>' +
          (wa ? '<a class="btn-outline-dark" target="_blank" rel="noopener" href="' + esc(wa) + '">Ask on WhatsApp</a>' : '') +
          '</div><button type="button" class="mt-6 text-sm font-semibold text-gold-600 hover:text-navy-950" data-advisor-restart>Start again</button>';
      };

      root.addEventListener('click', function (e) {
        var opt = e.target.closest('.advisor-option');
        if (opt) {
          answers[opt.getAttribute('data-q')] = opt.getAttribute('data-v');
          path.push(opt.getAttribute('data-q'));
          render();
        } else if (e.target.closest('[data-advisor-back]')) {
          var last = path.pop(); if (last) delete answers[last];
          render();
        } else if (e.target.closest('[data-advisor-restart]')) {
          answers = {}; path = []; render();
        }
      });
      render();
    }
  }
})();
