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
                $('.money').mask('000.000.000,00', {
                    reverse: true
                });
                $('.onlyinteger').mask('000.000.000', {
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

                $('.datepicker').datepicker();

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
                                        type: "POST",
                                        data: {
                                            id: id
                                        },
                                        success: function(res) {
                                            if (res.code === 'OK') {
                                                if ($('#summaries-list .table tbody tr').length == 1) {
                                                    $('#summaries-list .table-container').slideUp(450, function() {
                                                        $('.empty-results').slideDown(450);
                                                    });
                                                }

                                                $('#hist_'+id).remove();

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

                $(document).on('click', '#summaries-list .table button.show', function(ev) {
                    let sumaryID = $(this).attr('data-id');
                    if($(this).hasClass('showed')){
                        console.log('#hist_'+sumaryID);
                        $('#hist_'+sumaryID).remove();
                        $(this).removeClass('showed');
                    }
                    else{
                        $(this).addClass('showed');
                        $('#ajax_loader').show();
                        $.ajax({
                            type: "POST",
                            url: base_url+"/summaries/show_hist",
                            data: {
                                "id": sumaryID,
                            },
                            dataType: "json",
                            success: function(result){
                                $('#ajax_loader').hide();
                                showTable(sumaryID, result);
                            }
                        });
                    }
                })
            }
        },
        form: {
            init: function() {
                let _this = this;
                admin.global.form.init();
                _this.events();
            },
            events: function() {

                $('#addUser').click(function (){
                    let sumary_id = $('#id').val();
                    addBlankUser(sumary_id);
                });
            }
        }
    }
}

function showTable(id, json){
    let tableHist = '<table width="100%"><thead><tr>' +
        '<th>Origen</th>' +
        '<th>destino</th>' +
        '<th>Trámite</th>' +
        '<th>Num Fojas</th>' +
        '<th>Estado</th>' +
        '<th>Fecha Emisión</th>' +
        '</tr></thead><tbody>';
    $.each(json, function( index, data ) {
        tableHist = tableHist+'<tr>' +
            '<td>'+data.d_origen+'</td>'+
            '<td>'+data.d_destino+'</td>'+
            '<td>'+data.d_tramite+'</td>'+
            '<td>'+data.n_fojas+'</td>'+
            '<td>'+data.estado+'</td>'+
            '<td>'+data.f_emision+'</td>'+
            '</tr>';
    });
    tableHist = tableHist + '</tbody></table>';
    $('<tr id="hist_'+id+'" style="background-color: #CCCCCC;"><td colspan="6">'+tableHist+'</td></tr>').insertAfter('.table #'+id);
}

function addBlankUser(sumariId){
    $('#ajax_loader').show();
    $.ajax({
        type: "POST",
        url: base_url+"/summaries/adduser",
        data: {
            "id": sumariId,
        },
        dataType: "json",
        success: function(result){
            $('#ajax_loader').hide();
            if(result.code == 'OK'){
                $('.users-list').append('<form id="userForm_'+result.userId+'">' +
                    '<div class="row user_form_block">' +
                    '<div class="col-md-4">' +
                    '    <div class="form-group">' +
                    '        <label for="input-d_denominacion-'+result.userId+'">Denominación</label>' +
                    '        <input type="text" name="d_denominacion-'+result.userId+'" class="form-control" id="input-d_denominacion-'+result.userId+'" value="">' +
                    '    </div>' +
                    '</div>' +
                    '<div class="col-md-2">' +
                    '    <div class="form-group">' +
                    '        <label for="input-n_documento-'+result.userId+'">Documento Nro.</label>' +
                    '        <input type="text" name="n_documento-'+result.userId+'" class="form-control" id="input-n_documento-'+result.userId+'" value="">' +
                    '    </div>' +
                    '</div>' +
                    '<div class="col-md-2">' +
                    '    <div class="form-group">' +
                    '        <label for="input-tipo-'+result.userId+'">Tipo Documento</label>' +
                    '        <select name="tipo-doc-'+result.userId+'" class="form-control" id="input-tipo-doc-'+result.userId+'">' +
                    '            <option value=""> Seleccione </option>' +
                    '            <option value="dni"> DNI </option>' +
                    '        </select>' +
                    '    </div>' +
                    '</div>' +
                    '<div class="col-md-2">' +
                    '    <div class="form-group">' +
                    '        <label for="input-titular-'+result.userId+'">Titular</label>' +
                    '        <select name="titular-'+result.userId+'" class="form-control" id="input-titular-'+result.userId+'">' +
                    '            <option value=""> Seleccione </option>' +
                    '            <option value="S"> SI </option>' +
                    '            <option value="N" selected> NO </option>' +
                    '        </select>' +
                    '    </div>' +
                    '</div>' +
                    '<div class="col-md-2" style="flex-direction: row; align-items: center; display: flex; padding-top: 10px;">' +
                    '    <button type="button" style="margin-right: 10px" class="btn btn-eco-primary-outline" onclick="saveUser('+result.userId+')">Guardar' +
                    '    </button>' +
                    '    <button type="button" class="btn btn-eco-danger-outline" onclick="deleteUser('+result.userId+')">Eliminar' +
                    '    </button>' +
                    '</div>' +
                    '</div>' +
                    '</form>');
                $.alert({
                    title: 'Información',
                    content: result.message,
                    escapeKey: 'cancel',
                    draggable: false,
                    closeIcon: true,
                    type: 'green',
                    backgroundDismiss: true,
                    typeAnimated: true,
                    animation: 'zoom',
                    closeAnimation: 'zoom',
                    animateFromElement: false
                });
            }
            else{
                $.alert({
                    title: 'Error',
                    content: result.message,
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
        }
    });
}

function saveUser(id){
    let validator = $( "#userForm_"+id ).validate();
    //console.log($( "#userForm_"+id ));
    $("#input-d_denominacion-"+id).rules("add", {
        required: true,
        messages: {
            required: "Este campo es Obligatorio"
        }
    });

    $("#input-n_documento-"+id).rules("add", {
        required: true,
        messages: {
            required: "Este campo es Obligatorio",
            number: "Por favor ingresar solo números"
        }
    });
    let valid = validator.form();
    if(valid){
        $('#ajax_loader').show();
        let denominacion = $("#input-d_denominacion-"+id).val();
        let documento = $("#input-n_documento-"+id).val();
        let tipo_doc = $("#input-tipo-doc-"+id).val();
        let titular = $("#input-titular-"+id).val();
        let sumary_id = $('#id').val();

        $.ajax({
            type: "POST",
            url: base_url+"/summaries/updtUser",
            data: {
                'id': id,
                'sumario_id': sumary_id,
                'documento': documento,
                'tipo_doc': tipo_doc,
                'denominacion': denominacion,
                'titular': titular
            },
            dataType: "json",
            success: function(result){
                $('#ajax_loader').hide();
                if(result.code == 'OK'){
                    $.alert({
                        title: 'Información',
                        content: result.message,
                        escapeKey: 'cancel',
                        draggable: false,
                        closeIcon: true,
                        type: 'green',
                        backgroundDismiss: true,
                        typeAnimated: true,
                        animation: 'zoom',
                        closeAnimation: 'zoom',
                        animateFromElement: false
                    });
                }
                else{
                    $.alert({
                        title: 'Error',
                        content: result.message,
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
            }
        });
    }
}

function saveSummary(){
    let validator = $( "#form-summary").validate();

    $("#input-id-summary, #input-d_sumario, #input-d_origen, #input-d_destino,#input-d_tramite").each(function() {
        $(this).rules("add", {
            required: true,
            messages: {
                required: "Este campo es Obligatorio"
            }
        });
    });
    let valid = validator.form();
    if(valid){

        $('#ajax_loader').show();
        let id_summary = $("#input-id-summary").val(),
            d_sumario = $("#input-d_sumario").val(),
            d_origen = $("#input-d_origen").val(),
            d_destino = $("#input-d_destino").val(),
            f_entrada = $("#input-f_entrada").val(),
            d_tramite = $("#input-d_tramite").val(),
            n_multa = $("#input-n_multa").val(),
            d_disposicion = $("#input-d_disposicion").val(),
            n_fojas = $("#input-n_fojas").val(),
            f_remision = $("#input-f_remision").val(),
            d_observacion = $("#input-d_observacion").val();

        $.ajax({
            type: "POST",
            url: base_url+"/summaries/addSummary",
            data: {
                'id_summary': id_summary,
                'd_sumario': d_sumario,
                'd_origen': d_origen,
                'd_destino': d_destino,
                'f_entrada': f_entrada,
                'd_tramite': d_tramite,
                'n_multa': n_multa,
                'd_disposicion': d_disposicion,
                'n_fojas': n_fojas,
                'f_remision': f_remision,
                'd_observacion': d_observacion
            },
            dataType: "json",
            success: function(result){
                $('#ajax_loader').hide();
                if(result.code == 'OK'){
                    $.alert({
                        title: 'Información',
                        content: result.message,
                        escapeKey: 'cancel',
                        draggable: false,
                        closeIcon: true,
                        type: 'green',
                        backgroundDismiss: true,
                        typeAnimated: true,
                        animation: 'zoom',
                        closeAnimation: 'zoom',
                        animateFromElement: false
                    });
                }
                else{
                    $.alert({
                        title: 'Error',
                        content: result.message,
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
            }
        });
    }
}

function deleteUser(id){
    $('#ajax_loader').show();
    $.ajax({
        type: "POST",
        url: base_url+"/summaries/delUser",
        data: {
            "id": id,
        },
        dataType: "json",
        success: function(result){
            $('#ajax_loader').hide();
            if(result.code == 'OK'){
                $('#userForm_'+id).remove();
                $.alert({
                    title: 'Información',
                    content: result.message,
                    escapeKey: 'cancel',
                    draggable: false,
                    closeIcon: true,
                    type: 'green',
                    backgroundDismiss: true,
                    typeAnimated: true,
                    animation: 'zoom',
                    closeAnimation: 'zoom',
                    animateFromElement: false
                });
            }
            else{
                $.alert({
                    title: 'Error',
                    content: result.message,
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
        }
    });
}
