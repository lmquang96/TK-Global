$.validator.addMethod(
  'regex',
  function (value, element, regexp) {
    var re = new RegExp(regexp);
    return this.optional(element) || re.test(value);
  },
  'Please check your input.'
);

$.validator.addMethod(
  'pwcheck',
  function (value, element) {
    return this.optional(element) || /^(?=.*?[A-Z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/i.test(value);
  },
  'Mật khẩu có ít nhất 8 ký tự, có ít nhất một chữ hoa, một chữ số và một ký tự đặc biệt'
);

$('#formRegister').validate({
  submitHandler: function (form) {
    form.submit();
  },
  errorPlacement: function (error, element) {
    if (element.parent().hasClass('input-group') || element.parent().hasClass('form-check')) {
      error.insertAfter(element.parent());
    } else {
      error.insertAfter(element);
    }
  },
  rules: {
    email: {
      required: true,
      maxlength: 50,
      email: true
    },
    name: {
      required: true,
      maxlength: 50,
      regex:
        '^[A-ZÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸĐ][a-zàáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđ]*(?:[ ][A-ZÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸĐ][a-zàáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđ]*){1,}$'
    },
    password: {
      required: true,
      maxlength: 50,
      pwcheck: true
    },
    re_password: {
      required: true,
      maxlength: 50,
      equalTo: '#password'
    },
    terms: {
      required: true
    }
  },
  messages: {
    email: {
      required: 'Email là bắt buộc',
      maxlength: 'Email không được quá dài',
      email: 'Email không đúng định dạng'
    },
    name: {
      required: 'Họ tên là bắt buộc',
      maxlength: 'Họ tên không được quá dài',
      regex: 'Họ tên có ít nhất 2 từ, viết hoa mỗi chữ cái đầu, những chữ cái khác viết thường. Ví dụ: Nguyễn Nhạc'
    },
    password: {
      required: 'Mật khẩu là bắt buộc',
      maxlength: 'Mật khẩu không được quá dài'
    },
    re_password: {
      required: 'Nhập lại mật khẩu là bắt buộc',
      equalTo: 'Nhập lại mật khẩu không khớp'
    },
    terms: {
      required: 'Đồng ý là bắt buộc'
    }
  }
});

$('#formAuthentication').validate({
  submitHandler: function (form) {
    form.submit();
  },
  errorPlacement: function (error, element) {
    if (element.parent().hasClass('input-group') || element.parent().hasClass('form-check')) {
      error.insertAfter(element.parent());
    } else {
      error.insertAfter(element);
    }
  },
  rules: {
    email: {
      required: true,
      maxlength: 50,
      email: true
    },
    password: {
      required: true,
      maxlength: 50,
      pwcheck: true
    }
  },
  messages: {
    email: {
      required: 'Email là bắt buộc',
      maxlength: 'Email không được quá dài',
      email: 'Email không đúng định dạng'
    },
    password: {
      required: 'Mật khẩu là bắt buộc',
      maxlength: 'Mật khẩu không được quá dài'
    }
  }
});
