$(document).ready(function () {
  $(document).on("click", "#show__pw", function () {

    const parent = $(this).parent()[0];

    const input = $(parent).find("input[name='password']")[0];

    $(this).empty();

    if ($(input).attr("type") === 'password') {
      $(input).attr("type", 'text');
      $(this).append(`<i class="fa-solid fa-eye-slash"></i>`);
    } else {
      $(this).append(`<i class="fa-solid fa-eye"></i>`);
      $(input).attr("type", 'password');
    }
  });
})

function readURL(input) {
  if (input.files) {
    const file = input.files[0];

    const url = input.value;
    const ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();

    if (file && (ext === "gif" || ext === "png" || ext === "jpeg" || ext === "jpg")) {
      const reader = new FileReader();

      reader.onload = function (e) {
        const img = `<img src="${e.target.result}" alt="" class="img-thumbnail">`;
        $('#show-img').empty();
        $('#show-img').append(img);
      }

      reader.readAsDataURL(file);
    } else {
      alert(`File ảnh phải có đuôi 'gif' hoặc 'png' hoặc 'jpef' hoặc 'jpg'`);
    }
  }
}