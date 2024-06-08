<?php 
if (1==$_SESSION['rol']) {
?>	
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
<!--<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.11/vue.min.js"></script>
<div class="row">
<div class="col-md-12">
<div class="box box-info">
<div class="box-header with-border">
<h3 class="box-title">Consulados</h3>
<div class="input-group-btn">
<input type="text" id="search" name="buscar" placeholder="Buscar" class="form-control" required >
</div>
<div class="input-group-btn">
<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-search"></span> Buscar.</button> 
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
<th>#</th>
<th>Codigo</th>
<th>Nombre</th>
<th>DIRECCION</th>
<th>TELEFONO</th>
<th>Email</th>
</tr></thead>
 <tbody>
        <tr v-for="user, index in users">  <!-- array en VUE  -->
        <th scope="row">{{ index + 1 }}</th>
       <td>{{ user.ID_ENTIDAD }}</td>
          <td>{{ user.NOMBRE }}</td>
		  <td>{{ user.DIRECCION_ENTIDAD }}</td>
          <td>{{ user.TELEFONO_ENTIDAD }}</td>
		  <td>{{ user.EMAIL_ENTIDAD }}</td>
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
	  
        axios.get('https://sisg.supernotariado.gov.co/api/consulados/')
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