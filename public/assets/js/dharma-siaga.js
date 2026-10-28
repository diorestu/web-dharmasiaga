import { getLoanPolicy, calculateLoanSimulation } from './loan-simulation.js';
import { calculateSavingsSimulation } from './savings-simulation.js';

(function ($) {
  'use strict';

  const currency = new Intl.NumberFormat('id-ID', {style: 'currency', currency: 'IDR', maximumFractionDigits: 0});
  const integer = new Intl.NumberFormat('id-ID', {maximumFractionDigits: 0});
  const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');

  function configureMotion() {
    $.easing.dharmaEaseOut = progress => 1 - Math.pow(1 - progress, 3);
    $.fx.off = reducedMotion.matches;
    $('.accordion-box .acc-btn').each(function () {
      $(this).attr({role: 'button', 'aria-expanded': String(this.classList.contains('active'))});
    });
    reducedMotion.addEventListener('change', event => {
      $.fx.off = event.matches;
      $('.acc-content, .tabs-content-box').stop(true, true);
    });

    $('.accordion-box').off('click', '.acc-btn').on('click', '.acc-btn', function () {
      const box = $(this).closest('.accordion-box');
      const item = $(this).closest('.accordion');
      if (item.hasClass('active-block')) {
        return;
      }
      const duration = reducedMotion.matches || document.documentElement.classList.contains('motion-keyboard') ? 0 : 220;
      box.find('.acc-content').stop(true, false).slideUp({duration, easing: 'dharmaEaseOut'});
      box.children('.accordion').removeClass('active-block');
      box.find('.acc-btn').removeClass('active').attr('aria-expanded', 'false');
      item.addClass('active-block');
      $(this).addClass('active').attr('aria-expanded', 'true');
      item.children('.acc-content').stop(true, false).slideDown({duration, easing: 'dharmaEaseOut'});
    });

    document.querySelectorAll('.service-style1-tab, .emi-calculator-tab').forEach(wrapper => {
      const content = wrapper.querySelector('.tabs-content-box');
      let frame;
      wrapper.addEventListener('click', event => {
        const button = event.target.closest('.tab-btn-item');
        if (!button || button.classList.contains('active-btn-item')) {
          return;
        }
        window.cancelAnimationFrame(frame);
        const box = $(content).stop(true, false);
        const startHeight = content.getBoundingClientRect().height;
        box.css({height: startHeight, overflow: 'hidden'});
        frame = window.requestAnimationFrame(() => {
          const panel = content.querySelector('.tab-content-box-item-active');
          const duration = reducedMotion.matches || !event.isTrusted ? 0 : 220;
          box.animate({height: panel.getBoundingClientRect().height}, {duration, easing: 'dharmaEaseOut', complete: () => {
            content.style.height = '';
            content.style.overflow = '';
          }});
        });
      }, true);
    });
  }

  function openLinkedSavingsProduct() {
    const product = document.getElementById(window.location.hash.slice(1));
    if (!product?.matches('.accordion[data-product]')) {
      return;
    }
    const button = product.querySelector('.acc-btn');
    if (!button.classList.contains('active')) {
      button.click();
    }
    window.setTimeout(() => {
      const headerHeight = document.querySelector('.stricky-header')?.offsetHeight ?? 0;
      window.scrollTo({top: product.getBoundingClientRect().top + window.scrollY - headerHeight - 20, behavior: reducedMotion.matches ? 'auto' : 'smooth'});
    }, reducedMotion.matches ? 0 : 260);
  }

  function configureCalculator(panel) {
    const isSaving = panel.dataset.calculator === 'saving';
    const loanType = panel.dataset.loanType ?? 'standard';
    const amount = panel.querySelector('[data-calculator-amount]');
    const months = panel.querySelector('[data-calculator-months]');
    const customMonths = panel.querySelector('[data-calculator-custom-months]');
    const customField = panel.querySelector('[data-custom-months-field]');
    const rate = panel.querySelector('[data-calculator-rate]');
    const amountHint = panel.querySelector('[data-amount-hint]');
    const result = panel.querySelector('.inner-title h2');
    const totals = panel.querySelectorAll('.right-box .text p');
    let activePolicy = null;
    result.setAttribute('aria-live', 'polite');

    function synchronizeLoanPolicy(principal) {
      const policy = getLoanPolicy(principal, loanType);
      if (!policy) {
        rate.value = '';
        return;
      }
      rate.value = policy.monthlyRatePercent.toLocaleString('id-ID');
      if (activePolicy?.maximumMonths === policy.maximumMonths) {
        activePolicy = policy;
        return;
      }
      activePolicy = policy;
      const previousChoice = months.value;
      const choices = [12, 18, 24, 36, 48, 60].filter(value => value <= policy.maximumMonths);
      months.replaceChildren(...choices.map(value => new Option(`${value} bulan`, String(value))), new Option('Lainnya — isi jumlah bulan', 'custom'));
      months.value = previousChoice === 'custom' || choices.includes(Number(previousChoice)) ? previousChoice : String(policy.maximumMonths);
      customMonths.min = String(policy.minimumMonths);
      customMonths.max = String(policy.maximumMonths);
      panel.querySelector('[data-months-error]').textContent = `Masukkan tenor antara ${policy.minimumMonths} dan ${policy.maximumMonths} bulan.`;
    }

    function maskLoanAmount() {
      const raw = amount.value;
      const caret = amount.selectionStart ?? raw.length;
      const digitsBeforeCaret = raw.slice(0, caret).replace(/\D/g, '').length;
      const digits = raw.replace(/\D/g, '');
      if (!digits) {
        amount.value = '';
        return;
      }
      const value = Math.min(Number(digits), loanType === 'business' ? Number.MAX_SAFE_INTEGER : Number(amount.dataset.maxAmount));
      const formatted = integer.format(value);
      amount.value = formatted;
      const targetDigits = Math.min(digitsBeforeCaret, String(value).length);
      let position = 0;
      let countedDigits = 0;
      while (position < formatted.length && countedDigits < targetDigits) {
        if (/\d/.test(formatted[position])) {
          countedDigits++;
        }
        position++;
      }
      amount.setSelectionRange(position, position);
    }

    function calculate() {
      const principal = isSaving ? amount.valueAsNumber : (amount.value ? Number(amount.value.replace(/\D/g, '')) : NaN);
      if (!isSaving) {
        synchronizeLoanPolicy(principal);
      }
      const usesCustomMonths = months.value === 'custom';
      customField.hidden = !usesCustomMonths;
      customMonths.disabled = !usesCustomMonths;
      if (!isSaving) {
        const outOfRange = Number.isFinite(principal) && (principal < Number(amount.dataset.minAmount) || principal > Number(amount.dataset.maxAmount) || !getLoanPolicy(principal, loanType));
        amount.setCustomValidity(outOfRange ? panel.querySelector('.invalid-feedback').textContent.trim() : '');
      }
      const controls = [amount, rate, ...(usesCustomMonths ? [customMonths] : [])];
      controls.forEach(control => {
        const invalid = !control.validity.valid;
        control.classList.toggle('is-invalid', invalid);
        control.setAttribute('aria-invalid', String(invalid));
      });
      const duration = usesCustomMonths ? customMonths.valueAsNumber : Number(months.value);
      amountHint.textContent = amount.validity.valid ? currency.format(principal) : '';
      if (controls.some(control => !control.validity.valid) || !Number.isFinite(duration) || duration <= 0) {
        result.textContent = '—';
        totals.forEach(total => {total.textContent = '—';});
        return;
      }
      if (isSaving) {
        const simulation = calculateSavingsSimulation(principal, duration);
        result.textContent = simulation ? currency.format(simulation.finalBalance).replace(/\u00a0/g, ' ') : '—';
        totals[0].textContent = simulation ? currency.format(simulation.totalInterest) : '—';
        totals[1].textContent = simulation ? currency.format(simulation.totalDeposited) : '—';
      } else {
        const simulation = calculateLoanSimulation(principal, duration, loanType);
        result.textContent = simulation ? currency.format(simulation.monthlyPayment).replace(/\u00a0/g, ' ') : '—';
        totals[0].textContent = simulation ? currency.format(simulation.totalInterest) : '—';
        totals[1].textContent = simulation ? currency.format(simulation.totalPayment) : '—';
      }
    }

    if (!isSaving) {
      amount.addEventListener('beforeinput', event => {
        const start = amount.selectionStart;
        const end = amount.selectionEnd;
        const backward = event.inputType === 'deleteContentBackward';
        const forward = event.inputType === 'deleteContentForward';
        if (start !== null && start === end && (backward || forward)) {
          const separatorPosition = backward ? start - 1 : start;
          if (amount.value[separatorPosition] === '.') {
            event.preventDefault();
            const from = backward ? separatorPosition - 1 : separatorPosition;
            const to = backward ? start : separatorPosition + 2;
            amount.value = amount.value.slice(0, from) + amount.value.slice(to);
            amount.setSelectionRange(from, from);
            maskLoanAmount();
            calculate();
            return;
          }
        }
        if (event.inputType === 'insertText' && event.data && /\D/.test(event.data)) {
          event.preventDefault();
        }
      });
      amount.addEventListener('input', maskLoanAmount);
      maskLoanAmount();
    }
    [amount, months, customMonths, rate].forEach(control => {
      control.addEventListener('input', calculate);
      control.addEventListener('change', calculate);
    });
    calculate();
  }

  $(function () {
    document.querySelectorAll('[data-calculator]').forEach(configureCalculator);
    configureMotion();
    window.addEventListener('hashchange', openLinkedSavingsProduct);

    $('[data-service-select]').on('change', function () {
      window.location.href = `${document.querySelector('.logo-box-style1 a').href}#${this.value}`;
    });

    $('[data-faq-search]').on('submit', function (event) {
      event.preventDefault();
      const query = this.querySelector('input').value.toLocaleLowerCase('id');
      const items = document.querySelectorAll('#faq .accordion');
      items.forEach(item => {item.hidden = !item.textContent.toLocaleLowerCase('id').includes(query);});
      this.querySelector('input').setAttribute('aria-label', `Cari pertanyaan. ${[...items].filter(item => !item.hidden).length} hasil.`);
    });

    $('[data-site-search]').on('submit', function (event) {
      event.preventDefault();
      const query = this.querySelector('input').value.toLocaleLowerCase('id');
      const section = /pinjam|simpan|hitung|simula/.test(query) ? 'simulator' : /lapor|aset/.test(query) ? 'assets' : /tentang|profil/.test(query) ? 'about' : /kontak|anggota|gabung/.test(query) ? 'contact' : 'faq';
      window.location.href = `${document.querySelector('.logo-box-style1 a').href}#${section}`;
      $('.search-popup').removeClass('active');
      $('body').removeClass('locked');
    });

    $('.mobile-nav__container').on('click', 'a', function (event) {
      if (!event.target.closest('button')) {
        $('.mobile-nav__wrapper').removeClass('expanded');
        $('body').removeClass('locked');
      }
    });

    $('.tab-btn-item, .acc-btn').attr('tabindex', '0').on('keydown', function (event) {
      if (event.key === 'Enter' || event.key === ' ') {
        event.preventDefault();
        document.documentElement.classList.add('motion-keyboard');
        $(this).trigger('click');
        this.getBoundingClientRect();
        window.setTimeout(() => document.documentElement.classList.remove('motion-keyboard'), 0);
      }
    });
    const status = document.querySelector('#member-contact-form [role="status"], #member-contact-form [role="alert"]');
    if (status) {
      status.scrollIntoView({block: 'center'});
    }
  });

  $(window).on('load', function () {
    openLinkedSavingsProduct();
    $('#polyglotLanguageSwitcher').polyglotLanguageSwitcher({effect: 'slide', animSpeed: 100, testMode: true, onChange: event => {
      document.querySelectorAll('[data-copy-id][data-copy-en]').forEach(element => {
        element.lang = event.selectedItem;
        const lines = element.dataset[event.selectedItem === 'en' ? 'copyEn' : 'copyId'].split('|');
        element.replaceChildren();
        lines.forEach((line, index) => {
          if (index) {element.appendChild(document.createElement('br')); element.appendChild(document.createTextNode(' '));}
          element.appendChild(document.createTextNode(line));
        });
      });
    }});
    $('#polyglotLanguageSwitcher a').on('click', event => event.preventDefault());
  });
})(window.jQuery);
