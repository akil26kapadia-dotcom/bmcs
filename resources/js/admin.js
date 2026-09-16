(function () {
  'use strict';

  /* ---------------- Mobile sidebar toggle ---------------- */
  var sidebarToggle = document.querySelector('[data-admin-sidebar-toggle]');
  var sidebar = document.querySelector('[data-admin-sidebar]');
  var sidebarBackdrop = document.querySelector('[data-admin-sidebar-backdrop]');

  function closeSidebar() {
    if (sidebar) sidebar.classList.remove('is-open');
    if (sidebarBackdrop) sidebarBackdrop.classList.add('hidden');
  }

  if (sidebarToggle && sidebar) {
    sidebarToggle.addEventListener('click', function () {
      sidebar.classList.add('is-open');
      if (sidebarBackdrop) sidebarBackdrop.classList.remove('hidden');
    });
  }
  if (sidebarBackdrop) {
    sidebarBackdrop.addEventListener('click', closeSidebar);
  }

  /* ---------------- Slug auto-generation + live URL preview ---------------- */
  var titleInput = document.querySelector('[data-slug-source]');
  var slugInput = document.querySelector('[data-slug-target]');
  var slugPreview = document.getElementById('slug-preview');

  function updateSlugPreview() {
    if (slugPreview) slugPreview.textContent = slugInput.value || 'your-post-slug';
  }

  if (titleInput && slugInput) {
    var slugTouched = slugInput.value.trim() !== '';
    slugInput.addEventListener('input', function () {
      slugTouched = true;
      updateSlugPreview();
    });
    titleInput.addEventListener('input', function () {
      if (slugTouched) return;
      slugInput.value = titleInput.value
        .toLowerCase()
        .trim()
        .replace(/[^a-z0-9]+/g, '-')
        .replace(/^-+|-+$/g, '');
      updateSlugPreview();
    });
  }

  /* ---------------- Copy media path to clipboard ---------------- */
  document.querySelectorAll('[data-copy-path]').forEach(function (btn) {
    btn.addEventListener('click', function () {
      navigator.clipboard.writeText(btn.getAttribute('data-copy-path'));
      var original = btn.textContent;
      btn.textContent = 'Copied!';
      setTimeout(function () { btn.textContent = original; }, 1500);
    });
  });

  /* ---------------- Featured image preview ---------------- */
  document.querySelectorAll('[data-image-preview-input]').forEach(function (input) {
    var previewId = input.getAttribute('data-image-preview-input');
    var preview = document.getElementById(previewId);
    if (!preview) return;
    input.addEventListener('change', function () {
      if (input.files && input.files[0]) {
        preview.src = URL.createObjectURL(input.files[0]);
        preview.classList.remove('hidden');
      }
    });
  });

  /* ---------------- Delete confirmation ---------------- */
  document.querySelectorAll('[data-confirm]').forEach(function (form) {
    form.addEventListener('submit', function (e) {
      if (!window.confirm(form.getAttribute('data-confirm'))) {
        e.preventDefault();
      }
    });
  });

  /* ---------------- Rich text editor (toolbar wraps <textarea> selection) ---------------- */
  document.querySelectorAll('[data-rich-editor]').forEach(function (wrapper) {
    var textarea = wrapper.querySelector('textarea');
    if (!textarea) return;

    function wrapSelection(before, after) {
      after = after === undefined ? before : after;
      var start = textarea.selectionStart;
      var end = textarea.selectionEnd;
      var value = textarea.value;
      var selected = value.slice(start, end) || 'text';

      textarea.value = value.slice(0, start) + before + selected + after + value.slice(end);
      textarea.focus();
      textarea.selectionStart = start + before.length;
      textarea.selectionEnd = start + before.length + selected.length;
    }

    function insertAtCursor(text) {
      var start = textarea.selectionStart;
      var end = textarea.selectionEnd;
      var value = textarea.value;
      textarea.value = value.slice(0, start) + text + value.slice(end);
      textarea.focus();
      var pos = start + text.length;
      textarea.selectionStart = textarea.selectionEnd = pos;
    }

    wrapper.querySelectorAll('[data-editor-action]').forEach(function (btn) {
      btn.addEventListener('click', function (e) {
        e.preventDefault();
        var action = btn.getAttribute('data-editor-action');

        switch (action) {
          case 'bold': wrapSelection('<strong>', '</strong>'); break;
          case 'italic': wrapSelection('<em>', '</em>'); break;
          case 'h2': wrapSelection('<h2>', '</h2>'); break;
          case 'h3': wrapSelection('<h3>', '</h3>'); break;
          case 'quote': wrapSelection('<blockquote>', '</blockquote>'); break;
          case 'code': wrapSelection('<code>', '</code>'); break;
          case 'ul': wrapSelection('<ul>\n  <li>', '</li>\n</ul>'); break;
          case 'ol': wrapSelection('<ol>\n  <li>', '</li>\n</ol>'); break;
          case 'p': wrapSelection('<p>', '</p>'); break;
          case 'link':
            var url = window.prompt('Link URL:', 'https://');
            if (url) wrapSelection('<a href="' + url + '">', '</a>');
            break;
          case 'image':
            var src = window.prompt('Image URL:', '/assets/images/blog/');
            if (src) {
              var alt = window.prompt('Alt text (describe the image):', '') || '';
              insertAtCursor('<img src="' + src + '" alt="' + alt + '" loading="lazy">');
            }
            break;
          case 'table':
            insertAtCursor(
              '\n<table>\n  <tr><th>Heading 1</th><th>Heading 2</th></tr>\n' +
              '  <tr><td>Cell 1</td><td>Cell 2</td></tr>\n</table>\n'
            );
            break;
        }
      });
    });
  });
})();
