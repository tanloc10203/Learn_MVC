function handleErrorInput({ error = false, model = {} }) {
  if (error) {
    const keys = Object.keys(model);

    // delete key errors first array
    keys.shift();

    keys.forEach(i => {
      let element = $(`input[name=${i}]`);

      if (element.length === 0)
        element = $(`select[name=${i}]`);

      const formGroup = element.parent().find(".invalid-feedback");

      formGroup.text('');
      element.removeClass('is-invalid');

      if (model.errors[i]) {
        element.addClass('is-invalid');
        formGroup.text(model.errors[i][0]);
      }
    });

    console.log(model.errors);

    return true;
  }

  return false;
}


function cutUrl(url = '') {
  if (!url)
    return '';

  const array = url.split("/");
  return url.slice(0, -array[array.length - 1].length);
}

function format_price(price) {
  return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(price)
}