  // Paso 1: Funcion de numero
 $(document).ready(function(){
    $('.numero').on('input', function () { 
      this.value = this.value.replace(/[^0-9.]/g,'');
    });

         // Fin Funcion de numero


         // Paso 1: Reporte de Facturacion

         $(function(){
                $('.exp').on('change',function(){
                        console.log('Change event.');
                        var val = $('.exp').val();
                        $('#numexp').val( val !== '' ? val : '(empty)' );
                });

                $('.exp').change(function(){
                        console.log('Second change event...');
                });

                $('.exp').number( true, 2 );
        });

         $(function(){
                $('.1exp').on('change',function(){
                        console.log('Change event.');
                        var val = $('.1exp').val();
                        $('#num1exp').val( val !== '' ? val : '(empty)' );
                });

                $('.1exp').change(function(){
                        console.log('Second change event...');
                });

                $('.1exp').number( true, 2 );
        });

         $(function(){
                $('.2exp').on('change',function(){
                        console.log('Change event.');
                        var val = $('.2exp').val();
                        $('#num2exp').val( val !== '' ? val : '(empty)' );
                });

                $('.2exp').change(function(){
                        console.log('Second change event...');
                });

                $('.2exp').number( true, 2 );
        });

        // $(function(){
        //         $('.3exp').on('change',function(){
        //                 console.log('Change event.');
        //                 var val = $('.3exp').val();
        //                 $('#num3exp').val( val !== '' ? val : '(empty)' );
        //         });

        //         $('.3exp').change(function(){
        //                 console.log('Second change event...');
        //         });

        //         $('.3exp').number( true, 2 );
        // });


        //FIN DE Paso 1: Reporte de Facturacion



        // DETALLE GASTOS DE PERSONAL
        $(function(){
                $('.4exp').on('change',function(){
                        console.log('Change event.');
                        var val = $('.4exp').val();
                        $('#num4exp').val( val !== '' ? val : '(empty)' );
                });

                $('.4exp').change(function(){
                        console.log('Second change event...');
                });

                $('.4exp').number( true, 2 );
        });

        $(function(){
                $('.5exp').on('change',function(){
                        console.log('Change event.');
                        var val = $('.5exp').val();
                        $('#num5exp').val( val !== '' ? val : '(empty)' );
                });

                $('.5exp').change(function(){
                        console.log('Second change event...');
                });

                $('.5exp').number( true, 2 );
        });

        $(function(){
                $('.6exp').on('change',function(){
                        console.log('Change event.');
                        var val = $('.6exp').val();
                        $('#num6exp').val( val !== '' ? val : '(empty)' );
                });

                $('.6exp').change(function(){
                        console.log('Second change event...');
                });

                $('.6exp').number( true, 2 );
        });

        $(function(){
                $('.7exp').on('change',function(){
                        console.log('Change event.');
                        var val = $('.7exp').val();
                        $('#num7exp').val( val !== '' ? val : '(empty)' );
                });

                $('.7exp').change(function(){
                        console.log('Second change event...');
                });

                $('.7exp').number( true, 2 );
        });

        $(function(){
                $('.8exp').on('change',function(){
                        console.log('Change event.');
                        var val = $('.8exp').val();
                        $('#num8exp').val( val !== '' ? val : '(empty)' );
                });

                $('.8exp').change(function(){
                        console.log('Second change event...');
                });

                $('.8exp').number( true, 2 );
        });

        $(function(){
                $('.9exp').on('change',function(){
                        console.log('Change event.');
                        var val = $('.9exp').val();
                        $('#num9exp').val( val !== '' ? val : '(empty)' );
                });

                $('.9exp').change(function(){
                        console.log('Second change event...');
                });

                $('.9exp').number( true, 2 );
        });

        $(function(){
                $('.10exp').on('change',function(){
                        console.log('Change event.');
                        var val = $('.10exp').val();
                        $('#num10exp').val( val !== '' ? val : '(empty)' );
                });

                $('.10exp').change(function(){
                        console.log('Second change event...');
                });

                $('.10exp').number( true, 2 );
        });

        $(function(){
                $('.11exp').on('change',function(){
                        console.log('Change event.');
                        var val = $('.11exp').val();
                        $('#num11exp').val( val !== '' ? val : '(empty)' );
                });

                $('.11exp').change(function(){
                        console.log('Second change event...');
                });

                $('.11exp').number( true, 2 );
        });

        $(function(){
                $('.12exp').on('change',function(){
                        console.log('Change event.');
                        var val = $('.12exp').val();
                        $('#num12exp').val( val !== '' ? val : '(empty)' );
                });

                $('.12exp').change(function(){
                        console.log('Second change event...');
                });

                $('.12exp').number( true, 2 );
        });

        // FIN DETALLE GASTOS DE PERSONAL




        // DETALLE GASTOS GENERALES
        $(function(){
                $('.13exp').on('change',function(){
                        console.log('Change event.');
                        var val = $('.13exp').val();
                        $('#num13exp').val( val !== '' ? val : '(empty)' );
                });

                $('.13exp').change(function(){
                        console.log('Second change event...');
                });

                $('.13exp').number( true, 2 );
        });

        $(function(){
                $('.14exp').on('change',function(){
                        console.log('Change event.');
                        var val = $('.14exp').val();
                        $('#num14exp').val( val !== '' ? val : '(empty)' );
                });

                $('.14exp').change(function(){
                        console.log('Second change event...');
                });

                $('.14exp').number( true, 2 );
        });

        $(function(){
                $('.15exp').on('change',function(){
                        console.log('Change event.');
                        var val = $('.15exp').val();
                        $('#num15exp').val( val !== '' ? val : '(empty)' );
                });

                $('.15exp').change(function(){
                        console.log('Second change event...');
                });

                $('.15exp').number( true, 2 );
        });

        $(function(){
                $('.16exp').on('change',function(){
                        console.log('Change event.');
                        var val = $('.16exp').val();
                        $('#num16exp').val( val !== '' ? val : '(empty)' );
                });

                $('.16exp').change(function(){
                        console.log('Second change event...');
                });

                $('.16exp').number( true, 2 );
        });

        $(function(){
                $('.17exp').on('change',function(){
                        console.log('Change event.');
                        var val = $('.17exp').val();
                        $('#num17exp').val( val !== '' ? val : '(empty)' );
                });

                $('.17exp').change(function(){
                        console.log('Second change event...');
                });

                $('.17exp').number( true, 2 );
        });

        $(function(){
                $('.18exp').on('change',function(){
                        console.log('Change event.');
                        var val = $('.18exp').val();
                        $('#num18exp').val( val !== '' ? val : '(empty)' );
                });

                $('.18exp').change(function(){
                        console.log('Second change event...');
                });

                $('.18exp').number( true, 2 );
        });

        $(function(){
                $('.19exp').on('change',function(){
                        console.log('Change event.');
                        var val = $('.19exp').val();
                        $('#num19exp').val( val !== '' ? val : '(empty)' );
                });

                $('.19exp').change(function(){
                        console.log('Second change event...');
                });

                $('.19exp').number( true, 2 );
        });

        $(function(){
                $('.20exp').on('change',function(){
                        console.log('Change event.');
                        var val = $('.20exp').val();
                        $('#num20exp').val( val !== '' ? val : '(empty)' );
                });

                $('.20exp').change(function(){
                        console.log('Second change event...');
                });

                $('.20exp').number( true, 2 );
        });
        // FIN DETALLE GASTOS GENERALES



        // DETALLE GASTOS 
        $(function(){
                $('.21exp').on('change',function(){
                        console.log('Change event.');
                        var val = $('.21exp').val();
                        $('#num21exp').val( val !== '' ? val : '(empty)' );
                });

                $('.21exp').change(function(){
                        console.log('Second change event...');
                });

                $('.21exp').number( true, 2 );
        });

        $(function(){
                $('.22exp').on('change',function(){
                        console.log('Change event.');
                        var val = $('.22exp').val();
                        $('#num22exp').val( val !== '' ? val : '(empty)' );
                });

                $('.22exp').change(function(){
                        console.log('Second change event...');
                });

                $('.22exp').number( true, 2 );
        });

        $(function(){
                $('.23exp').on('change',function(){
                        console.log('Change event.');
                        var val = $('.23exp').val();
                        $('#num23exp').val( val !== '' ? val : '(empty)' );
                });

                $('.23exp').change(function(){
                        console.log('Second change event...');
                });

                $('.23exp').number( true, 2 );
        });
        // FIN DETALLE GASTOS



        // DETALLE TRANSFERENCIAS 
        $(function(){
                $('.24exp').on('change',function(){
                        console.log('Change event.');
                        var val = $('.24exp').val();
                        $('#num24exp').val( val !== '' ? val : '(empty)' );
                });

                $('.24exp').change(function(){
                        console.log('Second change event...');
                });

                $('.24exp').number( true, 2 );
        });

        $(function(){
                $('.25exp').on('change',function(){
                        console.log('Change event.');
                        var val = $('.25exp').val();
                        $('#num25exp').val( val !== '' ? val : '(empty)' );
                });

                $('.25exp').change(function(){
                        console.log('Second change event...');
                });

                $('.25exp').number( true, 2 );
        });

        $(function(){
                $('.26exp').on('change',function(){
                        console.log('Change event.');
                        var val = $('.26exp').val();
                        $('#num26exp').val( val !== '' ? val : '(empty)' );
                });

                $('.26exp').change(function(){
                        console.log('Second change event...');
                });

                $('.26exp').number( true, 2 );
        });

        $(function(){
                $('.27exp').on('change',function(){
                        console.log('Change event.');
                        var val = $('.27exp').val();
                        $('#num27exp').val( val !== '' ? val : '(empty)' );
                });

                $('.27exp').change(function(){
                        console.log('Second change event...');
                });

                $('.27exp').number( true, 2 );
        });

        $(function(){
                $('.28exp').on('change',function(){
                        console.log('Change event.');
                        var val = $('.28exp').val();
                        $('#num28exp').val( val !== '' ? val : '(empty)' );
                });

                $('.28exp').change(function(){
                        console.log('Second change event...');
                });

                $('.28exp').number( true, 2 );
        });

        $(function(){
                $('.29exp').on('change',function(){
                        console.log('Change event.');
                        var val = $('.29exp').val();
                        $('#num29exp').val( val !== '' ? val : '(empty)' );
                });

                $('.29exp').change(function(){
                        console.log('Second change event...');
                });

                $('.29exp').number( true, 2 );
        });

        $(function(){
                $('.30exp').on('change',function(){
                        console.log('Change event.');
                        var val = $('.30exp').val();
                        $('#num30exp').val( val !== '' ? val : '(empty)' );
                });

                $('.30exp').change(function(){
                        console.log('Second change event...');
                });

                $('.30exp').number( true, 2 );
        });

        $(function(){
                $('.31exp').on('change',function(){
                        console.log('Change event.');
                        var val = $('.31exp').val();
                        $('#num31exp').val( val !== '' ? val : '(empty)' );
                });

                $('.31exp').change(function(){
                        console.log('Second change event...');
                });

                $('.31exp').number( true, 2 );
        });
        // FIN DETALLE TRANSFERENCIAS

        // DETALLE IVA
        $(function(){
                $('.32exp').on('change',function(){
                        console.log('Change event.');
                        var val = $('.32exp').val();
                        $('#num32exp').val( val !== '' ? val : '(empty)' );
                });

                $('.32exp').change(function(){
                        console.log('Second change event...');
                });

                $('.32exp').number( true, 2 );
        });

        $(function(){
                $('.33exp').on('change',function(){
                        console.log('Change event.');
                        var val = $('.33exp').val();
                        $('#num33exp').val( val !== '' ? val : '(empty)' );
                });

                $('.33exp').change(function(){
                        console.log('Second change event...');
                });

                $('.33exp').number( true, 2 );
        });

        $(function(){
                $('.34exp').on('change',function(){
                        console.log('Change event.');
                        var val = $('.34exp').val();
                        $('#num34exp').val( val !== '' ? val : '(empty)' );
                });

                $('.34exp').change(function(){
                        console.log('Second change event...');
                });

                $('.34exp').number( true, 2 );
        });

});
// FIN DETALLE IVA




