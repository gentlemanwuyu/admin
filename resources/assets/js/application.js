// 定义layer
var layer = layui.layer;

/**
 * 组装响应内容
 * @param text
 * @returns {string}
 */
function packageValidatorResponseText (text) {
    text = JSON.parse(text);
    var message = [];
    $.each(text, function (key, val) {
        $.each(val, function (vk, vv) {
            message.push(vv);
        });
    });
    return message.join('<br>');
}

// select2
$('.select2').select2();

// 日期inputmask
$('.date-mask').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
$('.telephone-mask').inputmask({"mask": "99999999999"});

// fileinput配置
$('.fileinput').fileinput({
    showPreview: false,
    removeLabel: '',
    uploadLabel: '',
    browseLabel: ''
});

// 给所有的ajax请求加上csrf_token
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

//iCheck for checkbox and radio inputs
$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
    checkboxClass: 'icheckbox_minimal-blue',
    radioClass   : 'iradio_minimal-blue'
});
//Red color scheme for iCheck
$('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
    checkboxClass: 'icheckbox_minimal-red',
    radioClass   : 'iradio_minimal-red'
});
//Flat red color scheme for iCheck
$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
    checkboxClass: 'icheckbox_flat-green',
    radioClass   : 'iradio_flat-green'
});