
$(document).ready(function () {
    //editamos datos del usuario
    $(".editar").on('click', function () {

        var id = $(this).attr('id');
        var nombre = $("#nombre" + id).html();
        var unidad_de_medida = $("#udm" + id).html();
        var proveedor = $("#proveedor" + id).html();
        var presentacion = $("#pres" + id).html();
        var clave = $("#clave" + id).html();
        var smax = $("#smax" + id).html();
        var smin = $("#smin" + id).html();
        var fdr = $("#fdr" + id).html();
        var cant = $("#cant" + id).html();
        var costo = $("#costo" + id).html();
        var tiempo = $("#tiempo" + id).html();
        var cron = $("#cron" + id).html();

        $(" <div class='edit_modal'>
                <form name='edit' id='edit' method='post' action='<?php echo base_url();?>/index.php/catalogos/updateMaterial/material'>"+
                    "<input type='hidden' name='id' class='id' id='id' value="+id+">"+
                    "<label>Nombre<input type='text' name='nombre' class='nombre' value="+nombre+" id='nombre' /></label><br/>"+
                    "<label>UDM<input type='text' name='nombre' class='nombre' value="+unidad_de_medida+" id='udm' /></label><br/>"+
                    "<label>Proveedor<input type='text' name='nombre' class='nombre' value="+proveedor+" id='proveedor' /></label><br/>"+
                    "<label>Presentacion<input type='text' name='nombre' class='nombre' value="+presentacion+" id='presentacion' /></label><br/>"+
                    "<label>clave<input type='text' name='nombre' class='nombre' value="+clave+" id='clave' /></label><br/>"+
                    "<label>Stock maximo<input type='text' name='nombre' class='nombre' value="+smax+" id='smax' /></label><br/>"+
                    "<label>Stock minimo<input type='text' name='nombre' class='nombre' value="+smin+" id='smin' /></label><br/>"+
                    "<label>Factor de rendimiento<input type='text' name='nombre' class='nombre' value="+fdr+" id='factor' /></label><br/>"+
                    "<label>Cantidad<input type='text' name='nombre' class='nombre' value="+cant+" id='cant' /></label><br/>"+
                    "<label>Ultimo costo<input type='text' name='nombre' class='nombre' value="+costo+" id='costo' /></label><br/>"+
                    "<label>Tiempo de elaboración<input type='text' name='nombre' class='nombre' value="+tiempo+" id='tiempo' /></label><br/>"+
                    "<label>Orden cronologico<input type='text' name='nombre' class='nombre' value="+cron+" id='cron' /></label><br/>"+
                "</form>
                <div class='respuesta'></div>
            </div>").dialog({

                resizable:false,
                title:'Editar material.',
                height:300,
                width:450,
                modal:true,
                buttons:{
                    
                    "Editar":function () {
                        $.ajax({
                            url : $('#edit').attr("action"),
                            type : $('#edit').attr("method"),
                            data : $('#edit').serialize(),

                            success:function (data) {

                                var obj = JSON.parse(data);

                                if(obj.respuesta == 'error')
                                {
                                    
                                        $(".respuesta").html(obj.nombre + '<br />' + obj.email);
                                        return false;

                                }else{

                                    $('.edit_modal').dialog("close");

                                    $("<div class='edit_modal'>El usuario fué editado correctamente</div>").dialog({

                                        resizable:false,
                                        title:'Usuario editado.',
                                        height:200,
                                        width:450,
                                        modal:true

                                    });

                                    setTimeout(function() {
                                        window.location.href = "http://localhost:82/index.php/catalogos/index/material";
                                    }, 2000);

                                }

                            }, error:function (error) {
                                $('.edit_modal').dialog("close");
                                $("<div class='edit_modal'>Ha ocurrido un error!</div>").dialog({
                                    resizable:false,
                                    title:'Error editando!.',
                                    height:200,
                                    width:450,
                                    modal:true
                                });
                            }

                        });
                        return false;
                    },
                    Cancelar:function () {
                        $(this).dialog("close");
                    }
                }
            });
    });
});