<?php
if (isset($_POST['option']) and ""!=$_POST['option']) {	
require_once('../conf.php'); 
session_start();
$id=intval($_POST['option']);
$query235 = "SELECT * FROM concertacion_edl where id_concertacion_edl=".$id." and 
id_evaluador=".$_SESSION['snr']." 
and estado_concertacion_edl=1 limit 1";
$result235 = mysql_query($query235);	
 $row = mysql_fetch_assoc($result235); 
$totalRows = mysql_num_rows($result235);
if (0<$totalRows){
 ?>

<div style="padding: 10px 10px 10px 10px">

<form action="" method="post" name="ewr43e353455435435435ewr" >
<input type="hidden" value="<?php echo $row['id_comision']; ?>" name="userevaluador">
<input type="hidden" value="<?php echo $id; ?>" name="id_concertacion_com">
<div class="form-group text-left"> 
<label  class="control-label">EVALUADOR:</label> 
<input type="text" class="form-control" value="<?php echo $_SESSION['snr_nombre']; ?>" name="evaluadorpredefinido" readonly >
</div>

<div class="form-group text-left"> 
<label  class="control-label"> COMPROMISOS:</label> 
<?php
$select1 = mysql_query("SELECT * from compromiso_edl, metas_edl where compromiso_edl.id_metas_edl=metas_edl.id_metas_edl  
and id_concertacion_edl=".$id." and estado_compromiso_edl=1 ", $conexion);
$row4 = mysql_fetch_assoc($select1);
$totalRows1 = mysql_num_rows($select1);
if (0<$totalRows1){
$i=1;
do {
$compromiso=$row4['id_compromiso_edl'];
echo '<br>'.$i++.'. ';
echo '<b>'.$row4['nombre_metas_edl'].'</b>: ';
echo ''.$row4['nombre_compromiso_edl'].'. ';
echo '<b>'.$row4['porcentaje'].'%</b>. ';
if (1==$row4['aceptado']) {
if (isset($row4['nota'])) {
echo '<b>Nota: '.$row4['nota'].'</b> ';
} else {
echo 'Nota: <select  name="notacompromiso-'.$compromiso.'">';
echo '<option selected></option>';
echo '<option>100</option><option>99</option><option>98</option><option>97</option><option>96</option><option>95</option><option>94</option><option>93</option><option>92</option><option>91</option><option>90</option><option>89</option><option>88</option><option>87</option><option>86</option><option>85</option><option>84</option><option>83</option><option>82</option><option>81</option><option>80</option><option>79</option><option>78</option><option>77</option><option>76</option><option>75</option><option>74</option><option>73</option><option>72</option><option>71</option><option>70</option><option>69</option><option>68</option><option>67</option><option>66</option><option>65</option><option>64</option><option>63</option><option>62</option><option>61</option><option>60</option><option>59</option><option>58</option><option>57</option><option>56</option><option>55</option><option>54</option><option>53</option><option>52</option><option>51</option><option>50</option><option>49</option><option>48</option><option>47</option><option>46</option><option>45</option><option>44</option><option>43</option><option>42</option><option>41</option><option>40</option><option>39</option><option>38</option><option>37</option><option>36</option><option>35</option><option>34</option><option>33</option><option>32</option><option>31</option><option>30</option><option>29</option><option>28</option><option>27</option><option>26</option><option>25</option><option>24</option><option>23</option><option>22</option><option>21</option><option>20</option><option>19</option><option>18</option><option>17</option><option>16</option><option>15</option><option>14</option><option>13</option><option>12</option><option>11</option><option>10</option><option>9</option><option>8</option><option>7</option><option>6</option><option>5</option><option>4</option><option>3</option><option>2</option><option>1</option><option>0</option>';
echo '</select> ';
}
} else { echo '<span class="label label-warning">El evaluado no ha aceptado la concertación.</span>'; }
if (isset($row4['confirmacion_nota'])) {
if (1==$row4['confirmacion_nota']) {
 echo '<span style="color:#3F8E4D">Aprobada</span>';
} else { echo '<span style="color:#B52824">Rechazada</span> ';

echo 'Nueva nota: <select  name="notacompromiso-'.$compromiso.'">';
echo '<option selected></option>';
echo '<option>100</option><option>99</option><option>98</option><option>97</option><option>96</option><option>95</option><option>94</option><option>93</option><option>92</option><option>91</option><option>90</option><option>89</option><option>88</option><option>87</option><option>86</option><option>85</option><option>84</option><option>83</option><option>82</option><option>81</option><option>80</option><option>79</option><option>78</option><option>77</option><option>76</option><option>75</option><option>74</option><option>73</option><option>72</option><option>71</option><option>70</option><option>69</option><option>68</option><option>67</option><option>66</option><option>65</option><option>64</option><option>63</option><option>62</option><option>61</option><option>60</option><option>59</option><option>58</option><option>57</option><option>56</option><option>55</option><option>54</option><option>53</option><option>52</option><option>51</option><option>50</option><option>49</option><option>48</option><option>47</option><option>46</option><option>45</option><option>44</option><option>43</option><option>42</option><option>41</option><option>40</option><option>39</option><option>38</option><option>37</option><option>36</option><option>35</option><option>34</option><option>33</option><option>32</option><option>31</option><option>30</option><option>29</option><option>28</option><option>27</option><option>26</option><option>25</option><option>24</option><option>23</option><option>22</option><option>21</option><option>20</option><option>19</option><option>18</option><option>17</option><option>16</option><option>15</option><option>14</option><option>13</option><option>12</option><option>11</option><option>10</option><option>9</option><option>8</option><option>7</option><option>6</option><option>5</option><option>4</option><option>3</option><option>2</option><option>1</option><option>0</option>';
echo '</select> ';

 } 
} else { echo '<span style="color:#E08E39">Pendiente</span>'; }
	 } while ($row4 = mysql_fetch_assoc($select1)); 
} else {}	 
mysql_free_result($select1);
?>
</div>


<div class="form-group text-left"> 
<label  class="control-label"> COMPETENCIAS:</label> 
<?php
$select12 = mysql_query("SELECT * from competencia_edl, competencias_edl where 
competencia_edl.id_competencias_edl=competencias_edl.id_competencias_edl 
and id_concertacion_edl=".$id." and estado_competencia_edl=1 ", $conexion);
$row42 = mysql_fetch_assoc($select12);
$totalRows12 = mysql_num_rows($select12);
if (0<$totalRows12){
$e=1;
do {
$competencia=$row42['id_competencia_edl'];
echo '<br>'.$e++.'. ';
echo '<b>'.$row42['nombre_competencias_edl'].'</b>: ';
echo ''.$row42['definicion_edl'].'. ';
echo '<i>'.$row42['conducta_asociada'].'</i>. ';
if (1==$row42['aceptado']) {
if (isset($row42['nota'])) {
echo '<b>Nota: '.$row42['nota'].'</b> ';
} else {
echo 'Nota: <select  name="notacompetencia-'.$competencia.'">';
echo '<option value="" selected=""></option>
<option value="100">Muy alto</option>
<option value="80">Alto</option>
<option value="60">Aceptable</option>
<option value="40">Bajo</option>';
echo '</select> ';
}
} else { echo '<span class="label label-warning">El evaluado no ha aceptado la concertación.</span>'; }

if (isset($row42['confirmacion_nota'])) {
if (1==$row42['confirmacion_nota']) {
 echo '<span style="color:#3F8E4D">Aprobada</span>';
} else { echo '<span style="color:#B52824">Rechazada</span> ';
echo 'Nueva nota: <select  name="notacompetencia-'.$competencia.'">';
echo '<option value="" selected=""></option>
<option value="100">Muy alto</option>
<option value="80">Alto</option>
<option value="60">Aceptable</option>
<option value="40">Bajo</option>';
echo '</select> ';

 } 
} else { echo '<span style="color:#E08E39">Pendiente</span>'; }

	 } while ($row42 = mysql_fetch_assoc($select12)); 
} else {}	 
mysql_free_result($select12);
?>


</div>

<div class="modal-footer"><button type="reset" class="btn btn-default" data-dismiss="modal" onClick="this.form.reset()">
<span class="glyphicon glyphicon-remove"></span> Cancelar</button>
<button type="submit" class="btn btn-success">
<input type="hidden" name="table" value="estado_contable">
<span class="glyphicon glyphicon-ok"></span> Enviar </button>
</div>


</form>

</div>
<?php

	} else { echo 'No tiene permisos'; }
mysql_free_result($result235);


} else {}
?>


