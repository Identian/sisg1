
      
/* funcion dias habiles */
function calcularDiasHabiles(fechaDesde, fechaHasta) {
    fetch("pascual.json").then(response => response.json()).then(festivosF => {
        // fecha desde - hasta
        let fechaInicio = moment(fechaDesde, 'DD/MM/YYYY'), fechaFin = moment(fechaHasta, 'DD/MM/YYYY'), dias = 0
        // recorrer fechas
        while (!fechaInicio.isAfter(fechaFin)) {
            const festivo =  fechaInicio.date() + "/" + (fechaInicio.month() + 1);
            if (
                fechaInicio.isoWeekday() !== 6 &&
                fechaInicio.isoWeekday() !== 7 &&
                festivosF[fechaInicio.year()].includes(festivo) !== true
            ) {
                dias++;
            }

            fechaInicio.add(1, 'days')
        }
        console.log('Dias habiles:: de '+fechaDesde+' a '+fechaHasta+' :: ', dias-1);
        return dias-1;
    });
}

var diaInicio = '5/02/2021'
var diaFin = '10/02/2021'

calcularDiasHabiles(diaInicio, diaFin)


