</body>
<script src="lib/jquery/code.jquery.com_jquery-3.6.0.min.js"></script>
<script src="lib/jquery/popper.min.js"></script>
<script src="lib/jquery/bootstrap.min.js"></script>
<script src="lib/jquery/cdn.datatables.net_1.13.5_js_jquery.dataTables.min.js"></script>
<script src="lib/chartjs/chart.umd.min.js"></script>
<script src="js/main.js"></script>

</html>
<script>
anio();
grafifecha();
graficopie();
lista_pedido();

function lista_pedido() {
    $.ajax({
        dataType: 'json',
        url: './Controller/ControllGrafica.php?ope=maspedido',
        success: function(result) {
            $('#lista_pedido').html(result.html);
        }
    })
}

function anio(e) {
    let anio = $('#anio').val();
    let mese = ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE',
        'NOVIEMBRE', 'DICIEMBRE'
    ];
    $.ajax({
        type: 'POST',
        data: {
            id: anio
        },
        url: './Controller/ControllGrafica.php?ope=grafica_anio',
        dataType: 'json',
        success: function(resultado) {

            let mesesLabels = resultado.meses.map(numeroMes => mese[numeroMes - 1]);
            const dataanio = document.querySelector('#dataanio');

            // Destroy existing chart instance if it exists
            if (window.myChart instanceof Chart) {
                window.myChart.destroy();
            }

            window.myChart = new Chart(dataanio, {
                type: 'bar',
                data: {
                    labels: mesesLabels,
                    datasets: [{
                            label: 'EGRESO',
                            data: resultado.montoegreso,
                            backgroundColor: 'rgba(255, 99, 132, 0.2)', // Adjust colors as needed
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'INGRESO',
                            data: resultado.montoingreso,
                            backgroundColor: 'rgba(54, 162, 235, 0.2)', // Adjust colors as needed
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'TOTAL',
                            data: resultado.total,
                            backgroundColor: 'rgba(35, 155, 86, 0.2)', // Adjust colors as needed
                            borderColor: 'rgba(35, 155, 86, 1)',
                            borderWidth: 1
                        }
                    ]

                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    })

}

// Call the function when the document is ready
function grafifecha() {
    let fecha_inicio = $("#fech_inicio").val();
    let fecha_fin = $("#fech_fin").val();
    $.ajax({
        type: 'POST',
        data: {
            fech_ini: fecha_inicio,
            fech_fi: fecha_fin
        },
        url: './Controller/ControllGrafica.php?ope=grafica_meses',
        dataType: 'json',
        success: function(result) {

            const fechadato = document.querySelector('#datafechas');

            // Destroy existing chart instance if it exists
            if (window.graficafech instanceof Chart) {
                window.graficafech.destroy();
            }

            window.graficafech = new Chart(fechadato, {
                type: 'line',
                data: {
                    labels: result.fecha,
                    datasets: [{
                            label: 'EGRESO',
                            data: result.egreso,
                            backgroundColor: 'rgba(255, 99, 132, 0.2)', // Adjust colors as needed
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'INGRESO',
                            data: result.ingreso,
                            backgroundColor: 'rgba(54, 162, 235, 0.2)', // Adjust colors as needed
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }
                    ]

                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    })
}

function graficopie() {
    $.ajax({
        url: './Controller/ControllGrafica.php?ope=grafico_pie',
        dataType: 'json',
        success: function(resulta) {
            const piegrafico = document.querySelector('#graficopie');
            if (window.graficapie instanceof Chart) {
                window.graficapie.destroy();
            }
            window.graficapie = new Chart(piegrafico, {
                type: 'pie',
                data: {
                    labels: resulta.producto,
                    datasets: [{
                        label: 'cantidad',
                        data: resulta.cantidad,
                        backgroundColor: [
                            'rgb(245, 183, 177)',
                            'rgb(235, 222, 240)',
                            'rgb(169, 204, 227)',
                            'rgb(163, 228, 215)',
                            'rgb(22, 160, 133)',
                            'rgb(244, 208, 63)',
                            'rgb(214, 137, 16)',
                            'rgb(151, 154, 154)',
                            'rgb(52, 73, 94)',
                            'rgb(255, 99, 132)'
                        ],
                        hoverOffset: 4
                    }]
                },

            });
        }
    })
}
</script>