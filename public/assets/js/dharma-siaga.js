(function ($) {
  'use strict';

  const currency = new Intl.NumberFormat('id-ID', {style: 'currency', currency: 'IDR', maximumFractionDigits: 0});

  function configureCalculator(panel) {
    const isSaving = panel.dataset.calculator === 'saving';
    const settings = [
      {selector: '.price-range-slider', input: '.property-amount', min: isSaving ? 0 : 1000000, max: isSaving ? 5000000 : 100000000, step: isSaving ? 50000 : 500000, value: isSaving ? 500000 : 10000000, label: isSaving ? 'Setoran per bulan' : 'Jumlah pinjaman', format: currency.format},
      {selector: '.loan-term-range-slider', input: '.loan-term-range', min: 1, max: isSaving ? 120 : 60, step: 1, value: 12, label: isSaving ? 'Durasi simpanan' : 'Tenor pinjaman', format: value => `${value} bulan`},
      {selector: '.interest-rate-range-slider', input: '.interest-rate-range', min: 0, max: isSaving ? 20 : 30, step: 0.1, value: isSaving ? 3 : 12, label: 'Estimasi persentase per tahun', format: value => `${value}%`}
    ];
    const values = settings.map(setting => setting.value);
    const result = panel.querySelector('.inner-title h2');
    const totals = panel.querySelectorAll('.right-box .text p');

    function calculate() {
      const [principal, months, rate] = values;
      const deposited = isSaving ? principal * months : principal;
      const interest = deposited * rate / 100 * months / 12;
      result.textContent = currency.format(isSaving ? deposited + interest : (principal + interest) / months);
      result.setAttribute('aria-live', 'polite');
      totals[0].textContent = currency.format(interest);
      totals[1].textContent = currency.format(isSaving ? deposited : principal + interest);
    }

    settings.forEach((setting, index) => {
      const slider = $(panel).find(setting.selector);
      if (slider.hasClass('ui-slider')) {
        slider.slider('destroy');
      }
      const input = panel.querySelector(setting.input);
      input.setAttribute('aria-label', setting.label);
      const sync = value => {
        values[index] = value;
        input.value = setting.format(value);
        slider.find('.ui-slider-handle').attr({'role': 'slider', 'aria-label': setting.label, 'aria-valuemin': setting.min, 'aria-valuemax': setting.max, 'aria-valuenow': value, 'aria-valuetext': setting.format(value)});
        calculate();
      };
      slider.slider({range: 'min', min: setting.min, max: setting.max, step: setting.step, value: setting.value, slide: (_event, ui) => sync(ui.value), change: (_event, ui) => sync(ui.value)});
      sync(setting.value);
    });
  }

  $(function () {
    document.querySelectorAll('[data-calculator]').forEach(configureCalculator);

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
        $(this).trigger('click');
      }
    });
    const status = document.querySelector('#member-contact-form [role="status"], #member-contact-form [role="alert"]');
    if (status) {
      status.scrollIntoView({block: 'center'});
    }
  });

  $(window).on('load', function () {
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
})(jQuery);
