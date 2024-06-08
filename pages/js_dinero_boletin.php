<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>

 $(function(){
        $('.price').on('change',function(){
                console.log('Change event.');
                var val = $('.price').val();
                $('#numero').val( val !== '' ? val : '(empty)' );
        });

        $('.price').change(function(){
                console.log('Second change event...');
        });

        $('.price').number( true, 2 );
});

 $(function(){
        $('.price1').on('change',function(){
                console.log('Change event.');
                var val = $('.price1').val();
                $('#numero1').val( val !== '' ? val : '(empty)' );
        });

        $('.price1').change(function(){
                console.log('Second change event...');
        });

        $('.price1').number( true, 2 );
});

 $(function(){
        $('.price2').on('change',function(){
                console.log('Change event.');
                var val = $('.price2').val();
                $('#numero2').val( val !== '' ? val : '(empty)' );
        });

        $('.price2').change(function(){
                console.log('Second change event...');
        });

        $('.price2').number( true, 2 );
});

$(function(){
        $('.price3').on('change',function(){
                console.log('Change event.');
                var val = $('.price3').val();
                $('#numero3').val( val !== '' ? val : '(empty)' );
        });

        $('.price3').change(function(){
                console.log('Second change event...');
        });

        $('.price3').number( true, 2 );
});

$(function(){
        $('.price4').on('change',function(){
                console.log('Change event.');
                var val = $('.price4').val();
                $('#numero4').val( val !== '' ? val : '(empty)' );
        });

        $('.price4').change(function(){
                console.log('Second change event...');
        });

        $('.price4').number( true, 2 );
});

$(function(){
        $('.price5').on('change',function(){
                console.log('Change event.');
                var val = $('.price5').val();
                $('#numero5').val( val !== '' ? val : '(empty)' );
        });

        $('.price5').change(function(){
                console.log('Second change event...');
        });

        $('.price5').number( true, 2 );
});

$(function(){
        $('.price6').on('change',function(){
                console.log('Change event.');
                var val = $('.price6').val();
                $('#numero6').val( val !== '' ? val : '(empty)' );
        });

        $('.price6').change(function(){
                console.log('Second change event...');
        });

        $('.price6').number( true, 2 );
});

$(function(){
        $('.price7').on('change',function(){
                console.log('Change event.');
                var val = $('.price7').val();
                $('#numero7').val( val !== '' ? val : '(empty)' );
        });

        $('.price7').change(function(){
                console.log('Second change event...');
        });

        $('.price7').number( true, 2 );
});

$(function(){
        $('.price8').on('change',function(){
                console.log('Change event.');
                var val = $('.price8').val();
                $('#numero8').val( val !== '' ? val : '(empty)' );
        });

        $('.price8').change(function(){
                console.log('Second change event...');
        });

        $('.price8').number( true, 2 );
});

$(function(){
        $('.price9').on('change',function(){
                console.log('Change event.');
                var val = $('.price9').val();
                $('#numero9').val( val !== '' ? val : '(empty)' );
        });

        $('.price9').change(function(){
                console.log('Second change event...');
        });

        $('.price9').number( true, 2 );
});

$(function(){
        $('.price10').on('change',function(){
                console.log('Change event.');
                var val = $('.price10').val();
                $('#numero10').val( val !== '' ? val : '(empty)' );
        });

        $('.price10').change(function(){
                console.log('Second change event...');
        });

        $('.price10').number( true, 2 );
});

$(function(){
        $('.price11').on('change',function(){
                console.log('Change event.');
                var val = $('.price11').val();
                $('#numero11').val( val !== '' ? val : '(empty)' );
        });

        $('.price11').change(function(){
                console.log('Second change event...');
        });

        $('.price11').number( true, 2 );
});

$(function(){
        $('.price12').on('change',function(){
                console.log('Change event.');
                var val = $('.price12').val();
                $('#numero12').val( val !== '' ? val : '(empty)' );
        });

        $('.price12').change(function(){
                console.log('Second change event...');
        });

        $('.price12').number( true, 2 );
});

$(function(){
        $('.price13').on('change',function(){
                console.log('Change event.');
                var val = $('.price13').val();
                $('#numero13').val( val !== '' ? val : '(empty)' );
        });

        $('.price13').change(function(){
                console.log('Second change event...');
        });

        $('.price13').number( true, 2 );
});

$(function(){
        $('.price14').on('change',function(){
                console.log('Change event.');
                var val = $('.price14').val();
                $('#numero14').val( val !== '' ? val : '(empty)' );
        });

        $('.price14').change(function(){
                console.log('Second change event...');
        });

        $('.price14').number( true, 2 );
});

$(function(){
        $('.price15').on('change',function(){
                console.log('Change event.');
                var val = $('.price15').val();
                $('#numero15').val( val !== '' ? val : '(empty)' );
        });

        $('.price15').change(function(){
                console.log('Second change event...');
        });

        $('.price15').number( true, 2 );
});

$(function(){
        $('.price16').on('change',function(){
                console.log('Change event.');
                var val = $('.price16').val();
                $('#numero16').val( val !== '' ? val : '(empty)' );
        });

        $('.price16').change(function(){
                console.log('Second change event...');
        });

        $('.price16').number( true, 2 );
});

$(function(){
        $('.price17').on('change',function(){
                console.log('Change event.');
                var val = $('.price17').val();
                $('#numero17').val( val !== '' ? val : '(empty)' );
        });

        $('.price17').change(function(){
                console.log('Second change event...');
        });

        $('.price17').number( true, 2 );
});

$(function(){
        $('.price18').on('change',function(){
                console.log('Change event.');
                var val = $('.price18').val();
                $('#numero18').val( val !== '' ? val : '(empty)' );
        });

        $('.price18').change(function(){
                console.log('Second change event...');
        });

        $('.price18').number( true, 2 );
});

/*
$(document).ready(function(){
	$('.numeropunto').on('input', function () { 
this.value = this.value.replace(/\D/g, "")
                       .replace(/([0-9])([0-9]{2})$/, '$1.$2');
               
});
});/*


$(".numeropuntode").keyup(function() {

  this.value = parseFloat(this.value.replace(/,/g, ""))
                    .toFixed(2)
                    .toString()
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
});

$(document).ready(function(){
	$('.numeropunto').on('input', function () { 
this.value = this.value.replace(/\D/g, "")
                       .replace(/([0-9])([0-9]{2})$/, '$1.$2');
                       .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");

        
});
});
/*
$("#number").on({
    "focus": function (event) {
        $(event.target).select();
    },
    "keyup": function (event) {
        $(event.target).val(function (index, value ) {
            return value.replace(/\D/g, "")
                        .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                        .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
        });
    }
});
     
     this.value = this.value.replace(/[^0-9.]/g,''); //ESTE FUNCIONA PERFECTAMENTE
    .replace(/(?=\d*\,?)(\d{3})/g, '$1,');
     **/




function sumar() {
// FUNCION DE CONTEO MONTO TOTAL INGRESOS RECIBIDOS EN LA OFICINA
  var totalt = 0;

  $(".montot").each(function() {

    if (isNaN(parseFloat($(this).val()))) {

      totalt += 0;

    } else {

      totalt += parseFloat($(this).val());

    }

  });
  
// FUNCION DE CONTEO MONTO 1
  var total1 = 0;

  $(".monto").each(function() {

    if (isNaN(parseFloat($(this).val()))) {

      total1 += 0;

    } else {

      total1 += parseFloat($(this).val());

    }

  });
  
  // FUNCION DE CONTEO MONTO 2
  var total2 = 0;

  $(".monto2").each(function() {

    if (isNaN(parseFloat($(this).val()))) {

      total2 += 0;

    } else {

      total2 += parseFloat($(this).val());

    }

  });
  
  // FUNCION DE CONTEO MONTO 3
  var total3 = 0;

  $(".monto3").each(function() {

    if (isNaN(parseFloat($(this).val()))) {

      total3 += 0;

    } else {

      total3 += parseFloat($(this).val());

    }

  });
  
    // FUNCION DE CONTEO MONTO 4
  var total4 = 0;

  $(".monto4").each(function() {

    if (isNaN(parseFloat($(this).val()))) {

      total4 += 0;

    } else {

      total4 += parseFloat($(this).val());

    }

  });
  
  // FUNCION DE CONTEO MONTO 4
  var total5 = 0;

  $(".monto5").each(function() {

    if (isNaN(parseFloat($(this).val()))) {

      total5 += 0;

    } else {

      total5 += parseFloat($(this).val());

    }

  });

  
  
// OPERACIONES DE CONTEO MONTO TOTAL INGRESOS RECIBIDOS EN LA OFICINA
var total10t=Math.floor10(totalt, -2);

// RECORDAR QUE VAR TOTAL10 ES PARA OPERAR LAS OPERACIONES

var total_101t=formatNumber.new(total10t, "$");

document.getElementById('spTotalt').innerHTML = total_101t;
  
// OPERACIONES DE CONTEO MONTO 1 
var total10=Math.floor10(total1, -2);

// RECORDAR QUE VAR TOTAL10 ES PARA OPERAR LAS OPERACIONES

var total_101=formatNumber.new(total10, "$");

document.getElementById('spTotal').innerHTML = total_101;
 
// OPERACIONES DE CONTEO MONTO 2 
var total20=Math.floor10(total2, -2);

// RECORDAR QUE VAR TOTAL20 ES PARA OPERAR LAS OPERACIONES

var total_202=formatNumber.new(total20, "$");

document.getElementById('spTotal2').innerHTML = total_202;

// OPERACIONES DE CONTEO MONTO 3 
var total30=Math.floor10(total3, -2);

// RECORDAR QUE VAR TOTAL20 ES PARA OPERAR LAS OPERACIONES

var total_303=formatNumber.new(total30, "$");

document.getElementById('spTotal3').innerHTML = total_303;

// OPERACIONES DE CONTEO MONTO 4 
var total40=Math.floor10(total4, -2);

// RECORDAR QUE VAR TOTAL20 ES PARA OPERAR LAS OPERACIONES

var total_404=formatNumber.new(total40, "$");

document.getElementById('spTotal4').innerHTML = total_404;

// OPERACIONES DE CONTEO MONTO 5 
var total50=Math.floor10(total5, -2);

// RECORDAR QUE VAR TOTAL20 ES PARA OPERAR LAS OPERACIONES

var total_505=formatNumber.new(total50, "$");

document.getElementById('spTotal5').innerHTML = total_505;

// OPERACION DE SUMA DE 1020

var total10;
var total20;
var suma1020 = parseFloat(total10) + parseFloat(total20);

var suma1020_1=Math.floor10(suma1020, -2);

var suma1020_2=formatNumber.new(suma1020_1, "$");

document.getElementById('spTotal1020').innerHTML = suma1020_2;

// OPERACION DE SUMA CONSOLIDACION DIARIA
var total40;
var total50;
var restacan = parseFloat(total40) - parseFloat(total50);

var restacan_1=Math.floor10(restacan, -2);

var restacan_2=formatNumber.new(restacan_1, "$");

document.getElementById('spTotarestacan').innerHTML = restacan_2;


// OPERACION DE SUMA CONSOLIDACION DIARIA
var total10t;
var suma1020_1;
var total30;
var restacan_1;

var consolidadosuma = parseFloat(total10t) - parseFloat(suma1020_1) - parseFloat(total30) - parseFloat(restacan_1);

var consolidadosuma_1=Math.floor10(consolidadosuma, -2);

var consolidadosuma_2=formatNumber.new(consolidadosuma_1, "$");

document.getElementById('spTotaconsolidadosuma').innerHTML = consolidadosuma_2;



// OPERACION SUMA INGRESOS TOTALES = INGRESOS ODINARIOS + INGRESOS EXTRAORDINARIOS
var suma1020_1;
var total30;

var ingresoTsg = parseFloat(suma1020_1) + parseFloat(total30);

var ingresoTsg_1=Math.floor10(ingresoTsg, -2);

var ingresoTsg_2=formatNumber.new(ingresoTsg_1, "$");

document.getElementById('spTotaingresoTsg').innerHTML = ingresoTsg_2;



// OPERACION SUMA TOTAL BOLETIN = INGRESOS ODINARIOS + INGRESOS EXTRAORDINARIOS + TOTAL ANTICIPADO
var suma1020_1;
var total30;
var restacan_1;

var sumatbsg = parseFloat(suma1020_1) + parseFloat(total30) + parseFloat(restacan_1);

var sumatbsg_1=Math.floor10(sumatbsg, -2);

var sumatbsg_2=formatNumber.new(sumatbsg_1, "$");

document.getElementById('sumatbsg').innerHTML = sumatbsg_2;

}





// Conclusión
(function() {
  /**
   * Ajuste decimal de un número.
   *
   * @param {String}  tipo  El tipo de ajuste.
   * @param {Number}  valor El numero.
   * @param {Integer} exp   El exponente (el logaritmo 10 del ajuste base).
   * @returns {Number} El valor ajustado.
   */
  function decimalAdjust(type, value, exp) {
    // Si el exp no está definido o es cero...
    if (typeof exp === 'undefined' || +exp === 0) {
      return Math[type](value);
    }
    value = +value;
    exp = +exp;
    // Si el valor no es un número o el exp no es un entero...
    if (isNaN(value) || !(typeof exp === 'number' && exp % 1 === 0)) {
      return NaN;
    }
    // Shift
    value = value.toString().split('e');
    value = Math[type](+(value[0] + 'e' + (value[1] ? (+value[1] - exp) : -exp)));
    // Shift back
    value = value.toString().split('e');
    return +(value[0] + 'e' + (value[1] ? (+value[1] + exp) : exp));
  }

  // Decimal round
  if (!Math.round10) {
    Math.round10 = function(value, exp) {
      return decimalAdjust('round', value, exp);
    };
  }
  // Decimal floor
  if (!Math.floor10) {
    Math.floor10 = function(value, exp) {
      return decimalAdjust('floor', value, exp);
    };
  }
  // Decimal ceil
  if (!Math.ceil10) {
    Math.ceil10 = function(value, exp) {
      return decimalAdjust('ceil', value, exp);
    };
  }
})();

// Round




/////////////////////////////

var formatNumber = {
 separador: ",", // separador para los miles
 sepDecimal: '.', // separador para los decimales
 formatear:function (num){
 num +='';
 var splitStr = num.split('.');
 var splitLeft = splitStr[0];
 var splitRight = splitStr.length > 1 ? this.sepDecimal + splitStr[1] : '';
 var regx = /(\d+)(\d{3})/;
 while (regx.test(splitLeft)) {
 splitLeft = splitLeft.replace(regx, '$1' + this.separador + '$2');
 }
 return this.simbol + splitLeft +splitRight;
 },
 new:function(num, simbol){
 this.simbol = simbol ||'';
 return this.formatear(num);
 }
}
</script>



<!--
<script>
function agregar_numero() {
  // quitas los puntos (para evitar problemas con los decimales) e inicializa a 0 si el campo esta vacio 
  var TextBox1 = parseFloat(document.getElementById("txt1").value.replace(/,/g, '')) || 0;
  var TextBox2 = parseFloat(document.getElementById("txt2").value.replace(/,/g, '')) || 0;
  var TextBox3 = parseFloat(document.getElementById("txt3").value.replace(/,/g, '')) || 0;
  var result = TextBox1 + TextBox2 + TextBox3;
  //console.log(TextBox1 + "__" + TextBox2 + "__" + TextBox3 + "__" + result);
  result.toFixed(2);
  document.getElementById("txt4").value = result;

  // formatea el resultado para que aparezca igual que los otros numeros
 // format(document.getElementById("txt4"));
}

function format(input) {
  var num = input.value.replace(/\,/g, '');
  var decimales = "";
  if (num.indexOf(".") >= 0) { 
    decimales = "." + num.split(".")[1].substring(0,2); // sólo nos quedamos con los dos primeros decimales
    num = Math.floor(num); // redondeamos hacia abajo para quedarnos con la parte entera
  }
  if (!isNaN(num)) {
    num = num.toString().split('').reverse().join('').replace(/(?=\d*\,?)(\d{3})/g, '$1,');
    // añadir los decimales al final!
    num = num.split('').reverse().join('').replace(/^[\,]/, '') + decimales;
    input.value = num;
  }
  else {
    alert('Solo se permiten numeros');
    input.value = input.value.replace(/[^\d\,\.]*/g, '');
  }
} 
</script>