$(function() {
    $('#form-btn').click(function () {
        $(this).attr("disabled", true);
        $(this).val('Returned');
    })
});