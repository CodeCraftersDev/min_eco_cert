const admin = {
    helpers: {
        CleanPastedHTML: function(input) {
            var stringStripper = /(\n|\r| class=(")?Mso[a-zA-Z]+(")?)/g;
            var output = input.replace(stringStripper, ' ');
            var commentSripper = new RegExp('<!--(.*?)-->', 'g');
            var output = output.replace(commentSripper, '');
            var tagStripper = new RegExp('<(/)*(meta|link|span|\\?xml:|st1:|o:|font)(.*?)>', 'gi');
            output = output.replace(tagStripper, '');
            var badTags = ['style', 'script', 'applet', 'embed', 'noframes', 'noscript'];
            for (var i = 0; i < badTags.length; i++) {
                tagStripper = new RegExp('<' + badTags[i] + '.*?' + badTags[i] + '(.*?)>', 'gi');
                output = output.replace(tagStripper, '');
            }
            var badAttributes = ['style', 'start', 'data-dtm', 'class'];
            for (var i = 0; i < badAttributes.length; i++) {
                var attributeStripper = new RegExp(' ' + badAttributes[i] + '="(.*?)"', 'gi');
                output = output.replace(attributeStripper, '');
            }
            return output;
        }
    },
    global: {
        nav: {
            init: function() {
                this.events();
            },
            events: function() {
            }
        },
        list: {
            init: function() {
                this.events();
            },
            events: function() {
                let _this = this;

                // Tooltip
                $('[data-toggle="tooltip"]').tooltip();

                // Scroll horizontal on list table
                OverlayScrollbars(document.querySelectorAll('.table-responsive'), {});

                // Select2 for filter on list page
                $('.filter-list').select2({
                    width: 'auto',
                    theme: 'bootstrap4'
                });

                // Select2 for groups with search input
                $('.select2.with-search').select2({
                    width: 'auto',
                    theme: 'bootstrap4'
                });

                // Change event for region filter
                $('.filter-list').change(function() {
                    $(this).closest('form').submit();
                });
            },
        },
        form: {
            init: function() {
                this.events();
            },
            events: function() {
                let _this = this;

                // Select 2
                $.each($('form .select2'), function(select) {
                    let data = {
                        width: 'auto',
                        theme: 'bootstrap4'
                    };
                    if (!$(this).hasClass('with-search')) data.minimumResultsForSearch = -1;
                    $(this).select2(data);
                })

                // Bootstrap Switch
                $("input[data-bootstrap-switch]").each(function() {
                    $(this).bootstrapSwitch('state', $(this).prop('checked'));
                });

                // Mask money
                $('.money').mask('000.000.000', {
                    reverse: true
                });

                // Mask slug
                $('.onlyalphanumeric').mask('Z', {
                    translation: {
                        'Z': {
                            pattern: /[A-Za-z0-9 \-]/,
                            recursive: true
                        }
                    }
                });

                $.validator.addMethod("loginRegex", function(value, element) {
                    return this.optional(element) || /^[a-z0-9 \-]+$/i.test(value);
                }, "Ingresar únicamente letras y números.");


                // Select all items in groups
                $('form .groups .item .select-all input[type="checkbox"]').change(function() {
                    var checked = $(this).prop('checked');
                    var inputs = $(this).closest('.item').find('.custom-check:not(.select-all) input[type="checkbox"]');

                    inputs.prop('checked', checked);
                });

                // Select / Unselect "select all" checkbox on item change.
                $('form .groups .item .custom-check:not(.select-all) input[type="checkbox"]').change(function() {
                    var inputs = $(this).closest('.item').find('.custom-check:not(.select-all) input[type="checkbox"]');
                    var selectAll = $(this).closest('.item').find('.select-all input[type="checkbox"]');
                    var total = 0;

                    $.each(inputs, function(i, input) {
                        if ($(input).prop('checked')) {
                            total++;
                        }
                    });

                    selectAll.prop('checked', total == inputs.length);
                });

                // Tooltip for help icon
                $('[data-toggle="tooltip"]').tooltip();
            }
        }
    },
    summaries: {
        list: {
            init: function() {
                let _this = this;
                admin.global.list.init();
                _this.events();
            },
            events: function() {

                // Remove action for summaries list
                $(document).on('click', '#summaries-list .table button.remove', function(ev) {
                    ev.preventDefault();

                    let $btn = $(this);
                    let id = $btn.data('id');
                    let name = $btn.data('name').replace(new RegExp("\\\\", "g"), "");

                    $.confirm({
                        title: 'Eliminar Sumario',
                        content: '¿Confirma eliminar el registro <strong>' + name + '</strong>?',
                        theme: 'modern',
                        type: 'red',
                        typeAnimated: true,
                        escapeKey: 'cancel',
                        closeIcon: true,
                        draggable: false,
                        closeAnimation: 'opacity',
                        backgroundDismiss: true,
                        buttons: {
                            cancel: {
                                text: 'Cancelar',
                                action: function() {

                                }
                            },
                            confirm: {
                                text: 'Confirmar',
                                btnClass: 'btn btn-danger',
                                action: function() {
                                    $.ajax({
                                        url: base_url + '/summaries/delete',
                                        type: "DELETE",
                                        data: {
                                            id: id
                                        },
                                        // headers: {
                                        //     'X-Auth-Token': token
                                        // },
                                        success: function(res) {
                                            if (res.action) {
                                                if ($('#summaries-list .table tbody tr').length == 1) {
                                                    $('#summaries-list .table-container').slideUp(450, function() {
                                                        $('.empty-results').slideDown(450);
                                                    });
                                                }

                                                $btn.closest('tr').animate({
                                                    height: 0
                                                });
                                                $btn.closest('tr').children('td').animate({
                                                    paddingTop: 0,
                                                    paddingBottom: 0
                                                }).wrapInner('<div />').children().slideUp(function() {
                                                    $(this).closest('tr').remove();
                                                });

                                                // Show notification
                                                new Noty({
                                                    text: 'Sumario <strong>' + name + '</strong> eliminado.',
                                                    theme: 'bootstrap-v4',
                                                    type: 'success',
                                                    layout: 'bottomRight',
                                                    timeout: 3000,
                                                    closeWith: ['click', 'button']
                                                }).show();
                                            } else {
                                                $.alert({
                                                    title: 'Error',
                                                    content: res.message,
                                                    escapeKey: 'cancel',
                                                    draggable: false,
                                                    closeIcon: true,
                                                    type: 'red',
                                                    backgroundDismiss: true,
                                                    typeAnimated: true,
                                                    animation: 'opacity',
                                                    closeAnimation: 'opacity'
                                                });
                                            }
                                        }
                                    });
                                }
                            }
                        }
                    });
                });
            }
        },
        form: {
            init: function() {
                let _this = this;
                admin.global.form.init();
                _this.events();
            },
            events: function() {
                // Form validation
                $('#form-summary').validate({
                    ignore: ":hidden:not(#summernote),.note-editable.panel-body",
                    // rules: {
                    //     name: {
                    //         required: true,
                    //         maxlength: 30,
                    //         loginRegex: true,
                    //     },
                    //     regions_id: {
                    //         required: $('[name="regions_id"]').length == 1
                    //     }
                    // },
                    // messages: {
                    //     name: {
                    //         required: 'Debe completar este campo.',
                    //         maxlength: 'Máximo 30 caracteres.'
                    //     },
                    //     regions_id: {
                    //         required: 'Debe seleccionar la provincia.'
                    //     }
                    // },
                    errorElement: 'span',
                    errorPlacement: function(error, element) {
                        error.addClass('invalid-feedback');
                        element.closest('.form-group').append(error);
                    },
                    highlight: function(element, errorClass, validClass) {
                        if ($(element).hasClass('summernote')) {
                            $(element).closest('.form-group').addClass('is-invalid');
                        }
                        $(element).addClass('is-invalid');
                    },
                    unhighlight: function(element, errorClass, validClass) {
                        if ($(element).hasClass('summernote')) {
                            $(element).closest('.form-group').removeClass('is-invalid');
                        }
                        $(element).removeClass('is-invalid');
                    },
                    invalidHandler: function(form, validator) {
                        if (!validator.numberOfInvalids())
                            return;

                        let $element = $(validator.errorList[0].element);

                        if (!$element.hasClass('summernote'))
                            return;

                        $('html, body').animate({
                            scrollTop: $element.closest('.form-group').offset().top - 50
                        }, 300);

                    },
                    submitHandler: function(form) {
                        let $btn = $(form).find('button[type="submit"]');
                        $btn.addClass('loading');
                        $btn.attr('disabled', true);
                        const endpoint = $('[name="id"]').length ? 'edit' : 'create';
                        const data = new FormData(form);

                        $.ajax({
                            url: base_url + '/summaries/' + endpoint,
                            type: 'POST',
                            processData: false,
                            contentType: false,
                            data: data,
                            // headers: {
                            //     'X-Auth-Token': token
                            // },
                            success: function(res) {
                                if (res.action) {
                                    // Redirect to list
                                    window.location.href = base_url + '/summaries';
                                } else {
                                    $.alert({
                                        title: 'Error',
                                        content: res.message,
                                        escapeKey: 'cancel',
                                        draggable: false,
                                        closeIcon: true,
                                        type: 'red',
                                        backgroundDismiss: true,
                                        typeAnimated: true,
                                        animation: 'zoom',
                                        closeAnimation: 'zoom',
                                        animateFromElement: false
                                    });
                                }
                            },
                            complete: function() {
                                $btn.removeClass('loading');
                                $btn.attr('disabled', false);
                            }
                        });
                    }
                });
            }
        }
    }
}
