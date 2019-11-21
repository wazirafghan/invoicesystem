$(document).ready(function(){
    // alert("working");
    setTimeout(function(){
        $('.alert').fadeOut();}, 4000);

});
$(document).on('keydown','.quantity ,.num  , .rate,.paid',function (e) {
    var self = this;
    // Allow: backspace, delete, tab, escape, enter and .
    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
        // Allow: Ctrl+A, Command+A
        (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
        // Allow: home, end, left, right, down, up
        (e.keyCode >= 35 && e.keyCode <= 40)) {
        // let it happen, don't do anything
        return;
    }
    // Ensure that it is a number and stop the keypress
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        e.preventDefault();
    }
    setTimeout(function () {
        var number = self.value;
        number = parseFloat(number);
        self.value = number;
    }, 0);
});
