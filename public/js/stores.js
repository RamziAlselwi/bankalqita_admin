(function($) {
    
    var searchable = [];
    var selectable = []; 

    //cites table
    var dTable = $('#store_table').DataTable({
    
        order: [],
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        processing: true,
        responsive: false,
        serverSide: true,
        processing: true,
        language: {
          processing: '<i class="ace-icon fa fa-spinner fa-spin orange bigger-500" style="font-size:60px;margin-top:50px;"></i>'
        },
        scroller: {
            loadingIndicator: false
        },
        pagingType: "full_numbers",
        dom: "<'row'<'col-sm-2'l><'col-sm-7 text-center'B><'col-sm-3'f>>tipr",
        ajax: {
            url: 'stores/get-stores',
            type: "get"
        },
        columns: [
            {data:'name', name: 'name'},
            {data:'phone', name: 'phone'},
            {data:'image', name: 'image'},
            {data:'commercial_register', name: 'commercial_register', orderable: false, searchable: false},
            {data:'emirate', name: 'emirate', orderable: false, searchable: false},
            {data:'city', name: 'city', orderable: false, searchable: false},
            {data:'orders', name: 'orders', orderable: false, searchable: false},
            {data:'orders_amend', name: 'orders_amend', orderable: false, searchable: false},
            {data:'action', name: 'action'}
        ],
        buttons: [
            {
                extend: 'copy',
                className: 'btn-sm btn-info',
                title: 'stores',
                header: false,
                footer: true,
                exportOptions: {
                    // columns: ':visible'
                }
            },
            {
                extend: 'csv',
                className: 'btn-sm btn-success',
                title: 'stores',
                header: false,
                footer: true,
                exportOptions: {
                    // columns: ':visible'
                }
            },
            {
                extend: 'excel',
                className: 'btn-sm btn-warning',
                title: 'stores',
                header: false,
                footer: true,
                exportOptions: {
                    // columns: ':visible',
                }
            },
            {
                extend: 'pdf',
                className: 'btn-sm btn-primary',
                title: 'stores',
                pageSize: 'A2',
                header: false,
                footer: true,
                exportOptions: {
                    // columns: ':visible'
                }
            },
            {
                extend: 'print',
                className: 'btn-sm btn-default',
                title: 'stores',
                // orientation:'landscape',
                pageSize: 'A2',
                header: true,
                footer: false,
                orientation: 'landscape',
                exportOptions: {
                    // columns: ':visible',
                    stripHtml: false
                }
            }
        ],
        initComplete: function () {
            var api =  this.api();
            api.columns(searchable).every(function () {
                var column = this;
                var input = document.createElement("input");
                input.setAttribute('placeholder', $(column.header()).text());
                input.setAttribute('style', 'width: 140px; height:25px; border:1px solid whitesmoke;');
    
                $(input).appendTo($(column.header()).empty())
                .on('keyup', function () {
                    column.search($(this).val(), false, false, true).draw();
                });
    
                $('input', this.column(column).header()).on('click', function(e) {
                    e.stopPropagation();
                });
            });
    
            api.columns(selectable).every( function (i, x) {
                var column = this;
    
                var select = $('<select style="width: 140px; height:25px; border:1px solid whitesmoke; font-size: 12px; font-weight:bold;"><option value="">'+$(column.header()).text()+'</option></select>')
                    .appendTo($(column.header()).empty())
                    .on('change', function(e){
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
                        column.search(val ? '^'+val+'$' : '', true, false ).draw();
                        e.stopPropagation();
                    });
    
                $.each(dropdownList[i], function(j, v) {
                    select.append('<option value="'+v+'">'+v+'</option>')
                });
            });
        }
    });


    $('select').select2();
})(jQuery);

