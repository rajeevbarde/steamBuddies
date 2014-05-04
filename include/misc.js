$('#steamval').on('click focusin', function() {
    if(this.value == 'steamid / urlname')
    this.value = '';
});

$('#steamval').on('focusout', function() {
    if(this.value == '')
        this.value = 'steamid / urlname';
});

