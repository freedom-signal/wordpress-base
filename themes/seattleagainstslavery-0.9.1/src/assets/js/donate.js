import $ from 'jquery';

var Donate = function (elem) {
  var $forms = $(elem),
    $amountInput = $forms.find('input[name="amount"]');

  $amountInput
    .on('focus', function () {
      // $('.sas-donate-form--credit-card').hide();
      var $form = $(this).parents('.sas-donate-form'),
      $creditCard = $form.find('.sas-donate-form--credit-card');

      if($creditCard.not(':visible')){
        $('.sas-donate-form--credit-card').hide();
        $('.sas-donate-form--button').show();

        $creditCard.slideDown();
        $form.find('.sas-donate-form--button').slideUp();
      }
    })
    .on('change', function (evt) {
      var $form = $(this).parents('.sas-donate-form');
      $form.find('.ginput_amount').val(evt.target.value);
    });
};

$.fn.donate = function () {
  return Donate(this);
};
