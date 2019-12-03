//Plugin Jquery
jQuery(document).ready(function ($) {

    // Load Picker
    flatpickr("#from-date", {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        time_24hr: true
    });
    flatpickr("#to-date", {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        time_24hr: true
    });

    /**
     * Generate Flat Random Color
     */
    window.wp_price_random_color = function (i = false) {
        let colors = [
            [243, 156, 18, "#f39c12"],
            [52, 152, 219, "#3498db"],
            [192, 57, 43, "#c0392b"],
            [155, 89, 182, "#9b59b6"],
            [39, 174, 96, "#27ae60"],
            [230, 126, 34, "#e67e22"],
            [142, 68, 173, "#8e44ad"],
            [46, 204, 113, "#2ecc71"],
            [41, 128, 185, "#2980b9"],
            [22, 160, 133, "#16a085"],
            [211, 84, 0, "#d35400"],
            [44, 62, 80, "#2c3e50"],
            [241, 196, 15, "#f1c40f"],
            [231, 76, 60, "#e74c3c"],
            [26, 188, 156, "#1abc9c"],
            [46, 204, 113, "#2ecc71"],
            [52, 152, 219, "#3498db"],
            [155, 89, 182, "#9b59b6"],
            [52, 73, 94, "#34495e"],
            [22, 160, 133, "#16a085"],
            [39, 174, 96, "#27ae60"],
            [44, 62, 80, "#2c3e50"],
            [241, 196, 15, "#f1c40f"],
            [230, 126, 34, "#e67e22"],
            [231, 76, 60, "#e74c3c"],
            [236, 240, 241, "#9b9e9f"],
            [149, 165, 166, "#a65d20"]
        ];
        return colors[(i === false ? Math.floor(Math.random() * colors.length) : i)];
    };

    /**
     * Create Line Chart JS
     */
    window.wp_price_line_chart = function (tag_id, title, label, data) {

        // Get Element By ID
        let ctx = document.getElementById(tag_id).getContext('2d');

        // Create Chart
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: label,
                datasets: data
            },
            options: {
                responsive: true,
                legend: {
                    position: 'bottom',
                },
                animation: {
                    duration: 1500,
                },
                title: {
                    display: false,
                    text: title
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    };

    /**
     * Show Chart
     */
    if (jQuery("div.wp_price_line_chart")) {

        let datasets = [];
        let item_name = window.wp_price_chart_data_label_name;
        let color = window.wp_price_random_color(1);
        datasets.push({
            label: item_name,
            data: window.wp_price_chart_data,
            backgroundColor: 'rgba(' + color[0] + ',' + color[1] + ',' + color[2] + ',' + '0.3)',
            borderColor: 'rgba(' + color[0] + ',' + color[1] + ',' + color[2] + ',' + '1)',
            borderWidth: 1,
            fill: true
        });

        window.wp_price_line_chart("wp_stock_price_chart", '', window.wp_price_chart_data_label, datasets);
    }
});