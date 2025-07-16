/**
* PHP Email Form Validation - v3.10
* URL: https://bootstrapmade.com/php-email-form/
* Author: BootstrapMade.com
*/
(function () {
  "use strict";

  let forms = document.querySelectorAll('.php-email-form');

  forms.forEach(function (e) {
    e.addEventListener('submit', function (event) {
      event.preventDefault();

      let thisForm = this;

      let action = thisForm.getAttribute('action');
      let recaptcha = thisForm.getAttribute('data-recaptcha-site-key');

      if (!action) {
        displayError(thisForm, 'The form action property is not set!');
        return;
      }
      thisForm.querySelector('.loading').classList.add('d-block');
      thisForm.querySelector('.error-message').classList.remove('d-block');
      thisForm.querySelector('.sent-message').classList.remove('d-block');

      let formData = new FormData(thisForm);

      if (recaptcha) {
        if (typeof grecaptcha !== "undefined") {
          grecaptcha.ready(function () {
            try {
              grecaptcha.execute(recaptcha, { action: 'php_email_form_submit' })
                .then(token => {
                  formData.set('recaptcha-response', token);
                  php_email_form_submit(thisForm, action, formData);
                })
            } catch (error) {
              displayError(thisForm, error);
            }
          });
        } else {
          displayError(thisForm, 'The reCaptcha javascript API url is not loaded!')
        }
      } else {
        php_email_form_submit(thisForm, action, formData);
      }
    });
  });

  function php_email_form_submit(thisForm, action, formData) {
    fetch(action, {
      method: 'POST',
      body: formData,
      headers: {
        'X-Requested-With': 'XMLHttpRequest'
      }
    })
      .then(response => {
        thisForm.querySelector('.loading').classList.remove('d-block');

        const contentType = response.headers.get("content-type");
        if (contentType && contentType.includes("application/json")) {
          return response.json().then(data => {
            if (response.ok && data.success) {
              const successBox = thisForm.querySelector('.sent-message');
              successBox.innerHTML = data.message || 'Pesan berhasil dikirim.';
              successBox.classList.add('d-block');
              thisForm.reset();
            } else {
              let errorMessage = "";
              if (data.errors) {
                for (const field in data.errors) {
                  errorMessage += data.errors[field].join('<br>') + '<br>';
                }
              }
              throw new Error(errorMessage);
            }
          });
        } else {
          return response.text().then(text => {
            throw new Error(text || 'Terjadi kesalahan yang tidak diketahui.');
          });
        }
      })
      .catch(error => {
        displayError(thisForm, error.message || error);
      });
  }

  function displayError(thisForm, error) {
    const errorBox = thisForm.querySelector('.error-message');
    errorBox.innerHTML = error;
    errorBox.classList.add('d-block');
  }

})();
