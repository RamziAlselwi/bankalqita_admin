(function($) {
    'use strict';    
        // role wise permissiom ajax script
        $(document).on('change', '#emirate_id', function(){
            var token = $('#token').val();
            $.ajax({
                url : "/getCitesByEmirate",
                type: 'get',
                data: {
                    id : $(this).val(),
                    _token : token
                },
                success: function(data)
                {
                    $('#city_id').val(null).trigger('change');
                    $('#city_id').empty();
                    $.each(data.data, function (index, city) {
                        $('#city_id').append('<option value="' + index + '">' + city + '</option>');
                    })
                    $("#city_id option:first-child").attr("selected", true);
                    $('#city_id').trigger('change');
                },
                error: function()
                {
                    alert('failed...');
    
                }
            });
        });
    
        $('select').select2();
    })(jQuery);
    