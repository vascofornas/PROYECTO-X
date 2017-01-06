$(document).ready( function () 
    {
      $('#table_cust').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": false,
        "responsive": true,
        "autoWidth": false,
        "pageLength": 10,
        "ajax": {
          "url": "data_opiniones.php",
          "type": "POST"
        },
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
        "columns": [
        { "data": "urutan" },
        { "data": "nombre_doctor" },
        { "data": "apellidos_doctor" },
        { "data": "especialidad_doctor" },
        { "data": "ciudad_doctor" },
        { "data": "estado_doctor" },
        { "data": "pais_doctor" },
        { "data": "verificado" },
        { "data": "button" },
        ]
      });


    });





    $(document).on("click","#btnadd",function(){
        $("#modalcust").modal("show");
        $("#txtnombre").focus();
        $("#txtnombre").val("");
        $("#txtapellidos").val("");
        $("#txtespecialidad").val("");
         $("#txtdireccion").val("");
         $("#txttelefono").val("");
         $("#txtciudad").val("");
         $("#txtestado").val("");
         $("#txtpais").val("");
         $("#txtatencion").val("");
         $("#txtinstalaciones").val("");
         $("#txtprecio").val("");
         $("#txtpuntualidad").val("");
         $("#txtlorecomendarias").val("");
         $("#txteficiencia").val("");
          $("#txtcomentarios").val("");
           $("#txtusuario").val("");
            $("#txtemail").val("");
            $("#txtverificado").val();
     



        $("#crudmethod").val("N");
        $("#txtid").val("0");
    });
    $(document).on( "click",".btnhapus", function() {
      var id = $(this).attr("id");
      var nombre = $(this).attr("nombre");
      swal({   
        title: "Borrar Usuario?",   
        text: "Borrar usuario : "+nombre+" ?",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Delete",   
        closeOnConfirm: true }, 
        function(){   
          var value = {
            id: id
          };
          $.ajax(
          {
            url : "delete_usuario.php",
            type: "POST",
            data : value,
            success: function(data, textStatus, jqXHR)
            {
              var data = jQuery.parseJSON(data);
              if(data.result ==1){
                $.notify('Usuario borrado correctamente');
                var table = $('#table_cust').DataTable(); 
                table.ajax.reload( null, false );
              }else{
                swal("Error","Can't delete customer data, error : "+data.error,"error");
              }

            },
            error: function(jqXHR, textStatus, errorThrown)
            {
             swal("Error!", textStatus, "error");
            }
          });
        });
    });
    $(document).on("click","#btnsave",function(){




        var id = $("#txtid").val();
        var nombre = $("#txtnombre").val();
        var apellidos = $("#txtapellidos").val();
        var especialidad = $("#txtespecialidad").val();
        var direccion = $("#txtdireccion").val();
        var telefono = $("#txttelefono").val();
        var ciudad = $("#txtciudad").val();
        var estado = $("#txtestado").val();
        var pais = $("#txtpais").val();
        var atencion = $("#txtatencion").val();
        var precio = $("#txtprecio").val();
        var instalaciones = $("#txtinstalaciones").val();
        var lorecomendarias = $("#txtlorecomendarias").val();
        var puntualidad = $("#txtpuntualidad").val();
        var eficiencia = $("#txteficiencia").val();
        var comentarios = $("#txtcomentarios").val();
        var usuario = $("#txtusuario").val();
        var email = $("#txtemail").val();
        var verificado = $("#txtverificado").val();

       
     
      var crud=$("#crudmethod").val();


      if(nombre == '' || nombre == null ){
        swal("AVISO","Campo Nombre es obligatorio","warning");
        $("#txtnombre").focus();
        return;
      }
      if(apellidos == '' || apellidos == null ){
          swal("AVISO","Campo Apellidos es obligatorio","warning");
          $("#txtapellidos").focus();
          return;
        }
     
      var value = {
        id: id,
        nombre: nombre,
        apellidos:apellidos,
        especialidad: especialidad,
        direccion: direccion,
        telefono: telefono,
        ciudad: ciudad,
        estado: estado,
        pais: pais,
        atencion: atencion,
        precio: precio,
        instalaciones: instalaciones,
        puntualidad: puntualidad,
        eficiencia: eficiencia,
        lorecomendarias: lorecomendarias,
        comentarios: comentarios,
        usuario: usuario,
        email: email,
        verificado: verificado,
        
      
        
        crud:crud
      };
      $.ajax(
      {
        url : "save_opinion.php",
        type: "POST",
        data : value,
        success: function(data, textStatus, jqXHR)
        {
          var data = jQuery.parseJSON(data);
          if(data.crud == 'N'){
            if(data.result == 1){
              $.notify('Opinión guardada correctamente');
              var table = $('#table_cust').DataTable(); 
              table.ajax.reload( null, false );
              $("#txtnombre").focus();
              
        $("#txtnombre").val("");
        $("#txtapellidos").val("");
        $("#txtespecialidad").val("");
        $("#txtdireccion").val("");
        $("#txttelefono").val("");
        $("#txtciudad").val("");
        $("#txtestado").val("");
        $("#txtpais").val("");
         
         
          $("#txtprecio").val("");
           $("#txtinstalaciones").val("");
            $("#txtpuntualidad").val("");
             $("#txtlorecomendarias").val("");
              $("#txteficiencia").val("");
               $("#txtatencion").val("");
               $("#txtcomentarios").val("");
               $("#txtusuario").val("");
               $("#txtemail").val("");
               $("#txtverificado").val();
       
              
              $("#crudmethod").val("N");
              $("#txtid").val("0");
              $("#txtnombre").focus();
            }else{
              swal("Error","Can't save customer data, error : "+data.error,"error");
            }
          }else if(data.crud == 'E'){
            if(data.result == 1){
              $.notify('Opinión modificada correctamente');
              var table = $('#table_cust').DataTable(); 
              table.ajax.reload( null, false );
              $("#txtnombre").focus();
            }else{
             swal("Error","Can't update customer data, error : "+data.error,"error");
            }
          }else{
            swal("Error","invalid order","error");
          }
        },
        error: function(jqXHR, textStatus, errorThrown)
        {
           swal("Error!", textStatus, "error");
        }
      });
    });
    $(document).on("click",".btnedit",function(){
      var id=$(this).attr("id");
      var value = {
        id: id
      };
      $.ajax(
      {
        url : "get_usuario.php",
        type: "POST",
        data : value,
        success: function(data, textStatus, jqXHR)
        {
          var data = jQuery.parseJSON(data);
          $("#crudmethod").val("E");
          $("#txtid").val(data.id);
          $("#txtnombre").val(data.nombre);
          $("#txtapellidos").val(data.apellidos);
          
         

          $("#modalcust").modal('show');
          $("#txtnombre").focus();
        },
        error: function(jqXHR, textStatus, errorThrown)
        {
          swal("Error!", textStatus, "error");
        }
      });
    });
    $.notifyDefaults({
      type: 'success',
      delay: 500
    });