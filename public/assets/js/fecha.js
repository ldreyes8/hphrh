$(".vertical-spin").TouchSpin({
    verticalbuttons: true,
    buttondown_class: "btn btn-primary",
    buttonup_class: "btn btn-primary",
    verticalupclass: 'ion-plus-round',
    verticaldownclass: 'ion-minus-round'
    });
                var vspinTrue = $(".vertical-spin").TouchSpin({
                    verticalbuttons: true
                });
                if (vspinTrue) {
                    $('.vertical-spin').prev('.bootstrap-touchspin-prefix').remove();
                }

                $("input[name='demo1']").TouchSpin({
                    min: 0,
                    max: 100,
                    step: 0.1,
                    decimals: 2,
                    boostat: 5,
                    maxboostedstep: 10,
                    buttondown_class: "btn btn-primary",
                    buttonup_class: "btn btn-primary",
                    postfix: '%'
                });
                $("input[name='demo2']").TouchSpin({
                    min: -1000000000,
                    max: 1000000000,
                    stepinterval: 50,
                    buttondown_class: "btn btn-primary",
                    buttonup_class: "btn btn-primary",
                    maxboostedstep: 10000000,
                    prefix: '$'
                });
                $("input[name='demo3']").TouchSpin({
                    buttondown_class: "btn btn-primary",
                    buttonup_class: "btn btn-primary"
                });
                $("input[name='demo3_21']").TouchSpin({
                    initval: 40,
                    buttondown_class: "btn btn-primary",
                    buttonup_class: "btn btn-primary"
                });
                $("input[name='demo3_22']").TouchSpin({
                    initval: 40,
                    buttondown_class: "btn btn-primary",
                    buttonup_class: "btn btn-primary"
                });

                $("input[name='demo5']").TouchSpin({
                    prefix: "pre",
                    postfix: "post",
                    buttondown_class: "btn btn-primary",
                    buttonup_class: "btn btn-primary"
                });
                $("input[name='demo0']").TouchSpin({
                    buttondown_class: "btn btn-primary",
                    buttonup_class: "btn btn-primary"
                });

                // Time Picker
                jQuery('#timepicker').timepicker({
                    defaultTIme : false
                });
                jQuery('#timepicker2').timepicker({
                    showMeridian : false
                });
                jQuery('#timepicker3').timepicker({
                    minuteStep : 15
                });

                //colorpicker start

                $('.colorpicker-default').colorpicker({
                    format: 'hex'
                });
                $('.colorpicker-rgba').colorpicker();

                // Date Picker
                jQuery('#datepicker').datepicker();
                jQuery('#datepicker-autoclose').datepicker({
                    autoclose: true,
                    todayHighlight: true
                });

                 jQuery('#datepicker-fechafin').datepicker({
                    autoclose: true,
                    todayHighlight: true
                });
                jQuery('#datepicker-inline').datepicker();
                jQuery('#datepicker-multiple-date').datepicker({
                    format: "mm/dd/yyyy",
                    clearBtn: true,
                    multidate: true,
                    multidateSeparator: ","
                });
                jQuery('#date-range').datepicker({
                    toggleActive: true
                });

                // Date Picker
                jQuery('#datepicker').datepicker();
                jQuery('#datepicker-autoclose').datepicker({
                    autoclose: true,
                    todayHighlight: true
                });
                jQuery('#datepicker-inline').datepicker();
                jQuery('#datepicker-multiple-date').datepicker({
                    format: "mm/dd/yyyy",
                    clearBtn: true,
                    multidate: true,
                    multidateSeparator: ","
                });
                jQuery('#date-range').datepicker({
                    toggleActive: true
                });


                //Date range picker
                $('.input-daterange-datepicker').daterangepicker({
                    buttonClasses: ['btn', 'btn-sm'],
                    applyClass: 'btn-default',
                    cancelClass: 'btn-primary'
                });
                $('.input-daterange-timepicker').daterangepicker({
                    timePicker: true,
                    format: 'MM/DD/YYYY h:mm A',
                    timePickerIncrement: 30,
                    timePicker12Hour: true,
                    timePickerSeconds: false,
                    buttonClasses: ['btn', 'btn-sm'],
                    applyClass: 'btn-default',
                    cancelClass: 'btn-primary'
                });
                $('.input-limit-datepicker').daterangepicker({
                    format: 'MM/DD/YYYY',
                    minDate: '06/01/2016',
                    maxDate: '06/30/2016',
                    buttonClasses: ['btn', 'btn-sm'],
                    applyClass: 'btn-default',
                    cancelClass: 'btn-primary',
                    dateLimit: {
                        days: 6
                    }
                });

                $('#reportrange span').html(moment().subtract(29, 'days').format('D MMMM, YYYY') + ' - ' + moment().format('D MMMM, YYYY'));

                $('#reportrange').daterangepicker({
                    format: 'MM/DD/YYYY',
                    startDate: moment().subtract(29, 'days'),
                    endDate: moment(),
                    minDate: '01/01/2016',
                    maxDate: '12/31/2016',
                    dateLimit: {
                        days: 60
                    },
                    showDropdowns: true,
                    showWeekNumbers: true,
                    timePicker: false,
                    timePickerIncrement: 1,
                    timePicker12Hour: true,
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                    opens: 'left',
                    drops: 'down',
                    buttonClasses: ['btn', 'btn-sm'],
                    applyClass: 'btn-success',
                    cancelClass: 'btn-default',
                    separator: ' to ',
                    locale: {
                        applyLabel: 'Submit',
                        cancelLabel: 'Cancel',
                        fromLabel: 'From',
                        toLabel: 'To',
                        customRangeLabel: 'Custom',
                        daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                        monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                        firstDay: 1
                    }
                }, function (start, end, label) {
                    console.log(start.toISOString(), end.toISOString(), label);
                    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                });