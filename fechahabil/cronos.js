/*var diaInicio = '17/02/2021'
var diaFin = '31/12/2023'

calcularDiasHabiles(diaInicio, diaFin)*/

/* funcion dias habiles */
function calcularDiasHabiles() {
    diasMenos = 0;
    fetch("pascual.json").then(response => response.json()).then(festivosF => {
        // fecha desde - hasta
        let fechaInicio = moment(document.fechaCalcular.fecha.value.replace(/^(\d{4})-(\d{2})-(\d{2})$/g,'$3/$2/$1'), 'DD/MM/YYYY'),
        fechaFin = moment(document.fechaCalcular.fechaF.value.replace(/^(\d{4})-(\d{2})-(\d{2})$/g,'$3/$2/$1'), 'DD/MM/YYYY'), dias = 0
        // recorrer fechas
        while (!fechaInicio.isAfter(fechaFin)) {
            const festivo =  fechaInicio.date() + "/" + (fechaInicio.month() + 1);
            const festivo2 =  (fechaInicio.month() + 1) + "/" + fechaInicio.date();
            if (
                fechaInicio.isoWeekday() !== 6 &&
                fechaInicio.isoWeekday() !== 7
            ) {
                    dias++;
            }
           const festivoCorrido = festivosF[fechaInicio.year()];
            for (var i = 0; i < 18; i++) {
                if (festivoCorrido[i] == festivo2 && fechaInicio.isoWeekday() !== 6 &&
                fechaInicio.isoWeekday() !== 7) {
                    diasMenos++;
                }
            }
            fechaInicio.add(1, 'days')
        }
        //console.log('Dias habiles:: de '+fechaDesde+' a '+fechaHasta+' :: ', ((dias-1) - diasMenos) );
        escribir = document.getElementById("caja")
        miFecha = document.fechaCalcular.fecha.value
        escribir.innerHTML = ( ((dias-1)- diasMenos) + ' Dias');
        //return ((dias-1) - diasMenos) ;
    });
}

function calcularDiasHabilesFecha() {
    diasMenos = 0;
    fetch("pascual.json").then(response => response.json()).then(festivosF => {
        // fecha desde - hasta
        let fechaInicio = moment(document.fechaCalcularDias.fechaI.value.replace(/^(\d{4})-(\d{2})-(\d{2})$/g,'$3/$2/$1'), 'DD/MM/YYYY'),
        diaFin = document.fechaCalcularDias.diasF.value, dias = 0, diaObjetivo = 0;
        // recorrer fechas
        while (diaObjetivo <= diaFin) {
            const festivo =  (fechaInicio.month() + 1) + "/" + fechaInicio.date();
            if (
                fechaInicio.isoWeekday() !== 6 &&
                fechaInicio.isoWeekday() !== 7
            ) {
                diaObjetivo++;
            }
            const festivoCorrido = festivosF[fechaInicio.year()];
            for (var i = 0; i < 18; i++) {
                if (festivoCorrido[i] == festivo && fechaInicio.isoWeekday() !== 6 &&
                fechaInicio.isoWeekday() !== 7) {
                    diaObjetivo--;
                }
            }
            fechaInicio.add(1, 'days')
            destino =  fechaInicio.date() + "/" + (fechaInicio.month() + 1+ "/" + fechaInicio.year());
        }

        fechaInicio.add(-1, 'days')
        destino =  fechaInicio.date() + "/" + (fechaInicio.month() + 1+ "/" + fechaInicio.year());
        //console.log('Dias habiles:: de '+fechaDesde+' a '+fechaHasta+' :: ', ((dias-1) - diasMenos) );
        escribir = document.getElementById("caja2")
        escribir.innerHTML = ( 'La fecha es: ' + destino);
        //return ((dias-1) - diasMenos) ;
    });
}

window.onload = function() {
    document.fechaCalcular.Calcular.onclick = calcularDiasHabiles
    document.fechaCalcularDias.CalcularDias.onclick = calcularDiasHabilesFecha
}


