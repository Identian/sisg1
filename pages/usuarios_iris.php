<?php 
$nump36=privilegios(36,$_SESSION['snr']);
if (1==$_SESSION['rol'] or 0<$nump36) {
	

if ((isset($_POST["codigo_usuario_iris"])) && ($_POST["codigo_usuario_iris"] != "")) { 
$insertSQL = sprintf("INSERT INTO usuario_iris (codigo_usuario_iris, user_iris, nombre_usuario_iris, estado_usuario_iris) VALUES (%s, %s, %s, %s)", 
GetSQLValueString($_POST["codigo_usuario_iris"], "int"), 
GetSQLValueString($_POST["user_iris"], "text"), 
GetSQLValueString($_POST["nombre_usuario_iris"], "text"), 
GetSQLValueString(1, "int"));
$Result = mysql_query($insertSQL, $conexion) ;
echo $insertado;
} else { }


	
?>	
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
<!--<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.11/vue.min.js"></script>
<div class="row">
<div class="col-md-12">
<div class="box box-info">
<div class="box-header with-border">
<h3 class="box-title">Usuarios de Iris</h3>

<div class="row">
<div class="col-md-5">
<div class="input-group-btn">
<input type="text" id="search" name="buscar" placeholder="Buscar" class="form-control" required >
</div>
<div class="input-group-btn">
<button type="submit" class="btn btn-success">Buscar</button> 
</div>
</div>
<div class="col-md-7">
<form name="asas" action="" method="post">
Nuevo:
<input type="text" class="numero" name="codigo_usuario_iris" placeholder="Codigo" required style="width:100px;">
<input type="text" name="user_iris" placeholder="usuario" required style="width:130px;">
<input type="text" name="nombre_usuario_iris" placeholder="Nombres y apelidos" required style="width:300px;">
<input type="submit" value="Vincular" >
</form>
</div>
<div class="box-tools pull-right">
                   
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>               
                  </div>
                </div>

            <div class="box-body">

			<div  class="modal-body" id="app"><!-- app  es para VUE  -->

<table class="table" id="mytable" >
<thead>
<tr align="center" valign="middle">
<!--<th>#</th>-->
<th>Codigo</th>
<th>Usuario</th>
<th>Nombre / Apellido</th>
<th>Creado</th>
<th>Estado</th>
</tr></thead>
 <tbody>
        <tr v-for="user, index in users">  <!-- array en VUE  -->
      <!--  <th scope="row">{{ index + 1 }}</th>-->
       <td>{{ user.idusuario }}</td>
	   <td>{{ user.username }}</td>
          <td>{{ user.nombre }} {{ user.apellido }}</td>
		  
          <td>{{ user.fcreado }}</td>
		  <td>{{ user.activo }}</td>

        </tr>
      </tbody>
</table>
</div>
	</div>
	</div>
	</div>
		</div>
<script>
    var app = new Vue({
      el: '#app',
      data: {
        users: []
      },
      mounted: function() {
	  

        axios.get('https://sisg.supernotariado.gov.co/api/usuarios_iris/')
            .then(response => {
              this.users = response.data;
              console.log(response);
            })
            .catch(error => {
              console.log(error);
            });
      }
    })
  </script>
  
  <script>
 // Write on keyup event of keyword input element
 $(document).ready(function(){
 $("#search").keyup(function(){
 _this = this;
 // Show only matching TR, hide rest of them
 $.each($("#mytable tbody tr"), function() {
 if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
 $(this).hide();
 else
 $(this).show();
 });
 });
});
</script>


 



<?php
} else {}
?>