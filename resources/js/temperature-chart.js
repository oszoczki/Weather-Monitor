import Chart from 'chart.js/auto';

document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('temperatureChart');
    if (!ctx) return;

    const temperatures = JSON.parse(ctx.dataset.temperatures);
    const labels = temperatures.map(t => new Date(t.created_at).toLocaleString('hu-HU'));
    const data = temperatures.map(t => t.temperature);

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Hőmérséklet (°C)',
                data: data,
                borderColor: '#2563eb',
                backgroundColor: 'rgba(37, 99, 235, 0.1)',
                borderWidth: 2,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `${context.parsed.y.toFixed(1)}°C`;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: false,
                    title: {
                        display: true,
                        text: 'Hőmérséklet (°C)'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Időpont'
                    }
                }
            }
        }
    });
}); 