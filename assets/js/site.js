// Language preference, mobile navigation and contact form feedback.
(function () {
  'use strict';

  var languageKey = 'ganzaquest-language';
  document.querySelectorAll('.lang-switch a[hreflang]').forEach(function (link) {
    link.addEventListener('click', function () {
      try {
        localStorage.setItem(languageKey, link.hreflang);
      } catch (error) {
        // The language link still works when storage is unavailable.
      }
    });
  });

  if (document.body.hasAttribute('data-language-entry')) {
    var alternateLinks = new Map();
    document.querySelectorAll('link[rel="alternate"][hreflang]').forEach(function (link) {
      if (link.hreflang !== 'x-default') alternateLinks.set(link.hreflang, link.href);
    });

    try {
      var saved = localStorage.getItem(languageKey);
      var preferred = (navigator.languages || [navigator.language])
        .map(function (locale) { return (locale || '').toLowerCase().split('-')[0]; })
        .find(function (language) { return alternateLinks.has(language); });
      var language = alternateLinks.has(saved) ? saved : preferred;

      if (language && language !== document.documentElement.lang) {
        var destination = new URL(alternateLinks.get(language));
        // The alternate links publish production URLs. Keep local previews on their current host.
        window.location.replace(destination.pathname + window.location.search + window.location.hash);
      }
    } catch (error) {
      // English stays available on the entry page when storage is blocked.
    }
  }

  var toggle = document.querySelector('.menu-toggle');
  var panel = document.getElementById('mobile-nav');

  function setMenu(open) {
    if (!toggle || !panel) return;
    toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    toggle.setAttribute('aria-label', open ? toggle.dataset.labelClose : toggle.dataset.labelOpen);
    panel.hidden = !open;
  }

  if (toggle && panel) {
    toggle.addEventListener('click', function () {
      setMenu(toggle.getAttribute('aria-expanded') !== 'true');
    });
    document.addEventListener('keydown', function (event) {
      if (event.key === 'Escape' && !panel.hidden) {
        setMenu(false);
        toggle.focus();
      }
    });
    window.matchMedia('(max-width: 959px)').addEventListener('change', function (event) {
      if (!event.matches) setMenu(false);
    });
  }

  document.querySelectorAll('.contact-form').forEach(function (form) {
    form.addEventListener('submit', function () {
      var button = form.querySelector('button[type="submit"]');
      if (!button) return;
      button.disabled = true;
      button.textContent = form.dataset.sending || button.textContent;
    });
  });
})();
