$(document).ready(function () {

    (function ($) {
        "use strict";


        jQuery.validator.addMethod('answercheck', function (value, element) {
            return this.optional(element) || /^\bcat\b$/.test(value)
        }, "type the correct answer -_-");

        // validate contactForm form
        $(function () {
            $('#contactForm').validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 2
                    },
                    subject: {
                        required: true,
                        minlength: 4
                    },
                    phone: {
                        required: true,
                        minlength: 9
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    message: {
                        required: true,
                        minlength: 20
                    }
                },
                messages: {
                    name: {
                        required: "Hãy điền tên của bạn",
                        minlength: "Tên của bạn phải có ít nhất 2 ký tự"
                    },
                    subject: {
                        required: "Hãy điền chủ đề",
                        minlength: "Chủ đề phải có ít nhất 4 ký tự"
                    },
                    number: {
                        required: "Hãy điền số điện thoại",
                        minlength: "Số điện thoại phải có ít nhất 9 ký tự"
                    },
                    email: {
                        required: "Hãy điền email"
                    },
                    message: {
                        required: "Hãy điền nội dung tin nhắn",
                        minlength: "Nội dung tin nhắn phải có ít nhất 10 ký tự"
                    }
                },
                submitHandler: function (form) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $(form).ajaxSubmit({
                        type: "POST",
                        data: $(form).serialize(),
                        url: $(form).attr('action'),
                        success: function () {
                            $('#contactForm :input').attr('disabled', 'disabled');
                            $('#contactForm').fadeTo("slow", 1, function () {
                                $(this).find(':input').attr('disabled', 'disabled');
                                $(this).find('label').css('cursor', 'default');
                                $('#success').fadeIn()
                                $('.modal').modal('hide');
                                $('#success').modal('show');
                            })
                        },
                        error: function () {
                            $('#contactForm').fadeTo("slow", 1, function () {
                                $('#error').fadeIn()
                                $('.modal').modal('hide');
                                $('#error').modal('show');
                            })
                        }
                    })
                }
            })
        })

    })(jQuery)
})