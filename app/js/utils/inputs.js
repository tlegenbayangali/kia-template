import $ from 'jquery';
import Cleave from 'cleave.js';
import './dalacode-input';
import './dalacode-textarea';
import './dalacode-checkbox';
import './dalacode-input-calc';
import './dalacode-form-validator';

$(() => {
  // $('input#form-date').dalacodeInput({
  //     'required': true,
  // }),
  $('input#form-name').dalacodeInput({
    required: true,
  });

  $('#form-vin').dalacodeInput({
    required: false,
  });

  $('#form-model').dalacodeInput({
    required: false,
    limits: {
      minimum: 2,
      maximum: 20,
    },
  });

  $('#form-year').dalacodeInput({
    required: true,
  });
  $('#form-email').dalacodeInput({
    required: false,
  });
  $('#form-date').dalacodeInput({
    required: true,
  });
  $('.select-form').dalacodeInput({
    required: true,
  });

  if ($('input.input-phone').length) {
    // eslint-disable-next-line no-unused-vars
    const cleave = new Cleave('input.input-phone', {
      prefix: '+',
      blocks: [1, 1, 3, 3, 2, 2],
      delimiters: ['', ' (', ') ', '-', '-'],
      uppercase: true,
      numericOnly: true,
    });
  }
  $('input.input-phone').dalacodeInput({
    required: true,
    limits: {
      minimum: 18,
    },
  });
  if ($('input.input-phone-test-drive').length) {
    // eslint-disable-next-line no-unused-vars
    const testDriveInputPhone = new Cleave('input.input-phone-test-drive', {
      prefix: '+',
      blocks: [1, 1, 3, 3, 2, 2],
      delimiters: ['', ' (', ') ', '-', '-'],
      uppercase: true,
      numericOnly: true,
    });
  }
  $('textarea.input-message').dalacodeTextarea({
    required: false,
  });

  $('input.input-checkbox').dalacodeCheckbox({
    required: true,
    content: {
      active: true,
      text: 'Проставляя отметку, в соответствии с Законом Республики Казахстан от 21 мая 2013 года № 94-V “О персональных данных и их защите” и иными нормативными правовыми актами Республики Казахстан, я даю свое безусловное согласие ТОО «Allur Motor Qazaqstan» [1], дилерам Kia[2], а также партнерам ТОО «Allur Motor Qazaqstan» в РК и за рубежом[3], на сбор, обработку, использование, обезличивание, распространение и трансграничную передачу моих персональных данных, таких как фамилия; имя; отчество; год; месяц, дата и место рождения; адрес, номер паспорта и сведения о дате выдачи паспорта и выдавшем его органе; образование, профессия, место работы и должность; домашний, рабочий и мобильный телефоны; адрес электронной почты. При этом сбор, обработка, использование, обезличивание, распространение и трансграничная передача моих персональных данных должна производится не противоречащими законодательству РК способами, в целях, связанных с возможностью предоставления информации о товарах и услугах, которые потенциально могут представлять интерес, информационных и рекламных материалов путем осуществления прямых контактов с помощью различных средств связи, включая, но, не ограничиваясь: почтовую рассылку, sms – рассылку, электронную почту, телефон, интернет, а также в целях сбора и обработки статистической информации и проведения маркетинговых исследований, в том числе общедоступных источниках.',
    },
  });
  $('input.input-checkbox-2').dalacodeCheckbox({
    required: false,
    content: {
      active: true,
      text: 'Я хочу, чтобы мне перезвонили и уточнили дату и время',
    },
  });

  $('.input-calc').dalacodeInputCalc();

  $('form').dalacodeForm();
});
