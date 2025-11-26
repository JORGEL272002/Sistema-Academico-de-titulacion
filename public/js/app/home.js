$(document).ready(function () {

    const userGroups = [
        { id: 'usersCount', value: activeUsers, color: '#9C27B0' }
    ];

    const createCircle = ({ id, value, color }) => {
        if (typeof value !== 'number') return;

        Circles.create({
            id: id,
            radius: 45,
            value: value,
            maxValue: 100,
            width: 7,
            text: value,
            colors: ['#f1f1f1', color],
            duration: 400,
            wrpClass: 'circles-wrp',
            textClass: 'circles-text',
            styleWrapper: true,
            styleText: true
        });
    };

    userGroups.forEach(createCircle);


    barChart = document.getElementById('barChart').getContext('2d');
    pieChart = document.getElementById('pieChart').getContext('2d');

    new Chart(pieChart, {
        type: 'pie',
        data: {
            datasets: [{
                data: [50, 35, 15],
                backgroundColor: ["#1d7af3", "#f3545d", "#fdaf4b"],
                borderWidth: 0
            }],
            labels: ['Estudiantes', 'Avances', 'Entregas']
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                position: 'bottom',
                labels: {
                    fontColor: 'rgb(154, 154, 154)',
                    fontSize: 11,
                    usePointStyle: true,
                    padding: 20
                }
            },
            pieceLabel: {
                render: 'percentage',
                fontColor: 'white',
                fontSize: 14,
            },
            tooltips: false,
            layout: {
                padding: {
                    left: 20,
                    right: 20,
                    top: 20,
                    bottom: 20
                }
            }
        }
    })

   new Chart(barChart, {
        type: 'bar',
        data: {
            labels: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
            datasets: [{
                label: "Estudiantes",
                backgroundColor: 'rgb(23, 125, 255)',
                borderColor: 'rgb(23, 125, 255)',
                data: [3, 2, 9, 5, 4, 6, 4, 6, 7, 8, 7, 4],
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
        }
    });
});
