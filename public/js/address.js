$(document).ready(function () {

  const url = 'https://vapi.vnappmob.com/api/province/';

  function getProvince() {
    $.ajax({
      url: url,
      method: 'get',
      dataType: 'json',
      success: ({ results }) => {
        if (results && results.length > 0) {
          $('#province').empty();

          let option = '<option value="" disabled selected>---- Chọn ----</option>';

          option += `${results.map(i => (
            `<option value="${i.province_id}">${i.province_name}</option>`
          )).join('')}`;

          $('#province').append(option);
        }
      },
      error: (error) => console.log(error)
    });
  }

  getProvince();

  $(document).on('change', '#province', (e) => {
    const province_id = e.target.value;

    $.ajax({
      url: url + 'district/' + province_id,
      method: 'get',
      dataType: 'json',
      success: ({ results }) => {
        if (results && results.length > 0) {
          $('#district').empty();

          let option = '<option value="" disabled selected>---- Chọn ----</option>';

          option += `${results.map(i => (
            `<option value="${i.district_id}">${i.district_name}</option>`
          )).join('')}`;

          $('#district').append(option);
        }
      },
      error: (error) => console.log(error)
    });

    handleGetValue();
  });

  $(document).on('change', '#district', (e) => {
    const district_id = e.target.value;

    $.ajax({
      url: url + 'ward/' + district_id,
      method: 'get',
      dataType: 'json',
      success: ({ results }) => {
        $('#ward').empty();

        if (results && results.length > 0) {
          let option = '<option value="" disabled selected>---- Chọn ----</option>';

          option += `${results.map(i => (
            `<option value="${i.ward_id}">${i.ward_name}</option>`
          )).join('')}`;

          $('#ward').append(option);
        } else {
          let option = '<option value="" disabled selected>Không tìm thấy dữ liệu</option>';
          $('#ward').append(option);
        }
      },
      error: (error) => console.log(error)
    });

    handleGetValue()
  });

  $(document).on('change', '#ward', () => {
    handleGetValue();
  })

  function handleGetValue() {
    const name_province = $(`option[value='${$('#province').val()}']`).text();
    const name_district = $(`option[value='${$('#district').val()}']`).text();
    const name_ward = $(`option[value='${$('#ward').val()}']`).text();

    const value = name_province + ', ' + name_district + ', ' + name_ward;

    $('input[name="address"]').val(value);
  }
})