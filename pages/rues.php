<?php if (1==$_SESSION['rol']) { ?>
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <div class="col-md-12">
		  
  <form class="navbar-form" name="fo544535345435rm1" method="post" action="">

  
			   <div class="input-group">
			   
              <input name="numero"  placeholder="Nit sin numero siguiente del guion" class="form-control numero"  value="<?php echo $_POST['numero']; ?>" required>
			  </div>
			  
			  
              <div class="input-group">
                <button type="submit" class="btn  btn-success">Consultar</button>
              </div>

          
          </form>
		  

<?php
if (isset($_POST['numero'])) {


$numero=$_POST['numero'];


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://192.168.80.110/r1/CO/GOB/CONFECAMARAS-0001/RUES/wsConsultaRUES?usuario=Usersupernota1&nit='.$numero.'&dv=null',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_HTTPHEADER => array(
    'x-road-client: CO/GOB/SNR-0027/FM-SIR',
    'Authorization: Bearer 9oJB57w7QU88LPVE4tpt_Z1MwIsjQTB9bijkw5o9NVKUFVRT6sC03FKp4bm7ZR1tHCtP94q_8LoYUi7HlJ-cHizwrP8liuDi_Hl38J3jCL34ze5w32HexsB0H4Uu2qPP_r2wsSAkaGrRh1L26X6X-Dz069TiYxDR_0SoovSe1C0XXF_IreuNTcEa8bvP5dTDXX9unchSBh3Uw0hYNhGEw-S01ktmp2qkSiRbfMdMDbMkSEVG2dbo9KnE3rhUcrf1E_K0WKemI6R1bpSjrBom-HZ9MAK3j8xQ5uuJNjjQVZyD6dhzLTpLYlIgnSZ1cEPEyzGYUxaTTLoFCQn8xzwcAfPpOnYEUxUKYYPNgbOh-qNN6GokXeYhe2IqhdoRmNd-JInpna6C9-eEOS9OgpFlxk5pI_iIB5GfLjZfVw4Q6iPXiI2gtrPwunOmfoMAYrb-VFcT51VJMWTbH8VXV9BPFjx0HoM4MSbvBnRxwYmvbbJ5XPNXs5osRR6hYXJzXnJaPw08lHc_8Tqks88KeyXJWQ',
    'Cookie: .AspNet.Cookies=AvpRal5UjNPzBSoSrA3DWnMvCZ60ikNDGJnvWctxV4Q8aQfXnpExpolwu_RykC6ltTPChL5Lrb43V__w2JRQOT5_W-UTfuQBWqnfigt6Y7elNIqsyX0qv9Y78-Vki0kr0DvCE8ZHa4Z6Zjfbk0lgwwvs9CH5bGxngIatAOwnqyWgfa5_vvN2xJ8nYwGMnhtO2JCnJXWCkyalIMHhB9O01LFv5T6jdJKneQFqxIwPW_iJ5EglQw6pXPqECZLf62rzXMwK9OZzv4uj9oQKzaXiNu3dNkOZX7ft7lqxq9CqBVukXyYtNVnNndPX9gATdp2bQZQ_mAtb-JG2gTPaY7L9oirBNROYYidfEGTPdwaDNgkl5_agETUU6aNPGfrz3e3Y209u-yGOM6egCVjmhVc54ro2ZTX9Hx-2mVav6QsdEEhrAJpBjcS4oqRqo2NS0PTkMkZHvSfDamI7aFV4VCQudE_F4USzCt-U3vSkuaZZN7LQwPZoTYJFXBPVBqx9qQf7'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;

//var_dump($response);


$obj=json_decode($response);

echo '<br>Nit: '.$obj->nit;

echo '<br>Dv: '.$obj->dv;

$array=$obj->registros;
foreach ($array as $item) {

    foreach($item as $key => $value) {
        echo '<br>'.$key.': '.$value.'';
    }	
}




}
?>

</div>
</div>
</div>
</div>
</div>
<?php } ?>