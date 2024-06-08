  <style>

  .first {
	background:#1B66C9;
	color:#fff;
	width:350px;
	height:90px;
	position: fixed;
  bottom: 10px;
  right: 10px;
  border: 3px solid #fff;
  border-radius: 10px;
  padding: 5px 5px 2px 5px;
box-shadow: 5px 10px 18px #888888;
 opacity: 0.8;
  }

  .first a {
  	color:#fff;
	font-weight: bold;
	text-decoration: underline #fff;
}



  </style><!--#1B66C9;-->

</head>
<body>
 

<div class="first">	

<div class="row">
        <div class="col-md-2">
	<img src="files/portal/intranet/portal-vickyv1.png" style="width:50px;">
	</div>
	 <div class="col-md-10">
	 <div style="text-align:right;cursor:pointer;" class="cerrar"> x </div>
	Concurso de función pública 
	<a href="bit.ly/snrcolombia">aqui,</a>
 </div>
</div>
</div>

 
<script>
  $( "div.first" ).delay( 10000 ).slideUp( 900 );
$( ".cerrar" ).on( "click", function() {
   $('div.first').slideUp( 300 ).delay( 800 ).attr( 'style','display:none;' );
});
</script>