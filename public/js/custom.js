$(document).ready( function(){

    var adminUrl = window.location.origin + '/admin';
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    var pdfbutton = '<img class="exportbutton_img" ' + 'src="' + '{{ asset("images/icons/pdf.png") }}"' + ' alt="pdf" />';
    var excelbutton = '<img class="exportbutton_img" ' + 'src="' + '{{ asset("images/icons/excel.png") }}"' + ' alt="excel" />';
    var csvbutton = '<img class="exportbutton_img" ' + 'src="' + '{{ asset("images/icons/csv.png") }}"' + ' alt="csv" />';
    var printbutton = '<img class="exportbutton_img" ' + 'src="' + '{{ asset("images/icons/print.png") }}"' + ' alt="print" />';

  
    //getting csrf token
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    //floating form
    $('.form-material').each( function(e){
        if ($(this).hasClass('floating')){
            var control = $(this).find('.form-control');
            var input_text = $(this).find('label').text();
            var input_val = control.val();
            
            if(input_val == '' || input_val == null || input_val == 'undefined'){
                control.addClass('empty');
            }

            control.on('keyup change', function(e){
                var input_val = $(this).val();
                if(input_val === '' || input_val === null || input_val === 'undefined'){
                    control.addClass('empty');
                }else{
                    control.removeClass('empty');   
                }
            });
        }
    });

    //custom file
    $(".input-group-btn").find('input[type=file]').on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).parent().parent().siblings(".form-control").val(fileName);
    });

});
// toastr
function showToastr(title, message, type) {
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-center",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    toastr[type](message, title)

}

//select2
function applySelect2 (modal){
    $('.select2').select2({
      dropdownParent: $('#' + modal)
    });
}
