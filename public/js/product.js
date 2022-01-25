// "use strict";
// $(document).ready(function() {
//     var chart = AmCharts.makeChart("line_chart", {
//         "type": "serial",
//         "theme": "light",
//         "dataDateFormat": "YYYY-MM-DD",
//         "precision": 2,
//         "valueAxes": [{
//             "id": "v1",
//             "position": "left",
//             "autoGridCount": false,
//             "labelFunction": function(value) {
//                 return "$" + Math.round(value) + "M";
//             }
//         }],
//         "graphs": [{
//             "id": "g1",
//             "valueAxis": "v2",
//             "bullet": "round",
//             "bulletBorderAlpha": 1,
//             "bulletColor": "#FFFFFF",
//             "bulletSize": 8,
//             "hideBulletsCount": 50,
//             "lineThickness": 3,
//             "lineColor": "#2ed8b6",
//             "title": "Daily Sales",
//             "useLineColorForBulletBorder": true,
//             "valueField": "market1",
//             "balloonText": "[[title]]<br /><b style='font-size: 130%'>[[value]]</b>"
//         }],
//         "chartCursor": {
//             "pan": true,
//             "valueLineEnabled": true,
//             "valueLineBalloonEnabled": true,
//             "cursorAlpha": 0,
//             "valueLineAlpha": 0.2
//         },
//         "categoryField": "date",
//         "categoryAxis": {
//             "parseDates": true,
//             "dashLength": 1,
//             "minorGridEnabled": true
//         },
//         "legend": {
//             "useGraphSettings": true,
//             "position": "top"
//         },
//         "balloon": {
//             "borderThickness": 1,
//             "shadowAlpha": 0
//         },
//         "dataProvider": [{
//             "date": "2013-01-16",
//             "market1": 71
//         }, {
//             "date": "2013-01-17",
//             "market1": 80
//         }, {
//             "date": "2013-01-18",
//             "market1": 78
//         }, {
//             "date": "2013-01-19",
//             "market1": 85
//         }, {
//             "date": "2013-01-20",
//             "market1": 87
//         }, {
//             "date": "2013-01-21",
//             "market1": 97
//         }, {
//             "date": "2013-01-22",
//             "market1": 93,
//             "market2": 88
//         }, {
//             "date": "2013-01-23",
//             "market1": 85,
//             "market2": 80
//         }, {
//             "date": "2013-01-24",
//             "market1": 90
//         }]
//     });
// })


(function($) {
    
    var searchable = [];
    var selectable = []; 
    
    
    var dTable = $('#product_table').DataTable({
    
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
            url: 'products/get-products',
            type: "get"
        },
        columns: [
            {data:'name', name: 'name'},
            {data:'category.name', name: 'category.name', orderable: false, searchable: false},
            {data:'action', name: 'action'}
        ],
        buttons: [
            {
                extend: 'copy',
                className: 'btn-sm btn-info',
                title: 'products',
                header: false,
                footer: true,
                exportOptions: {
                    // columns: ':visible'
                }
            },
            {
                extend: 'csv',
                className: 'btn-sm btn-success',
                title: 'products',
                header: false,
                footer: true,
                exportOptions: {
                    // columns: ':visible'
                }
            },
            {
                extend: 'excel',
                className: 'btn-sm btn-warning',
                title: 'products',
                header: false,
                footer: true,
                exportOptions: {
                    // columns: ':visible',
                }
            },
            {
                extend: 'pdf',
                className: 'btn-sm btn-primary',
                title: 'products',
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
                title: 'products',
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

