<x-layout>
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<link rel="stylesheet" href="{{ asset('plugins/fullcalendar/main.css') }}">
<link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

<ul class="nav nav-tabs" id="adminDashboardTabs">
    <li class="nav-item">
        <a class="nav-link active" data-bs-toggle="tab" href="#" role="tab" data-target="showcaseOne">Calendar</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#" role="tab" data-target="showcaseTwo">Communication Frequency</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#" role="tab" data-target="showcaseThree">Interaction Timeline</a>
    </li>
</ul>

<div class="tab-content" id="tabContent">
    <!-- Content is loaded dynamically here -->
</div>

<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/fullcalendar/main.js') }}"></script>
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>

<script>
$(document).ready(function() {
    $('#adminDashboardTabs a').click(function(e) {
        e.preventDefault();
        var target = $(this).data('target');

        // Fetch the content dynamically based on the data-target attribute
        $('#tabContent').load(`/tab-content/${target}`, function(response, status, xhr) {
            if (status == "success") {
                switch(target) {
                    case 'showcaseOne':
                        initializeCalendar();
                        break;
                    case 'showcaseTwo':
                        initializeCharts();
                        break;
                    case 'showcaseThree':
                        initializeInteractionTimelineGraph();
                        break;
                }
            }
        });

        // Update the active state of the tabs
        $('#adminDashboardTabs a').removeClass('active');
        $(this).addClass('active');
    });

    // Load content for the first tab by default
    $('#adminDashboardTabs a.active').click();
});

function initializeCalendar() {
    var calendarEl = document.getElementById('calendar');
    if (calendarEl) {
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            themeSystem: 'bootstrap',
            // Enable dragging and dropping external elements
            editable: true,
            droppable: true, // this allows things to be dropped onto the calendar
            drop: function(info) {
                // is the "remove after drop" checkbox checked?
                if (document.getElementById('drop-remove').checked) {
                    // if so, remove the element from the "Draggable Events" list
                    info.draggedEl.parentNode.removeChild(info.draggedEl);
                }
            },
            eventReceive: function(info) {
                // This function is called when a dragged event is dropped on the calendar
                // You can access the event object and manipulate it or make AJAX calls as needed
            },
            events: [
                // Your initial events go here
            ]
        });

        calendar.render();

        // Initialize draggable external events
        initializeExternalEvents();

        // A function to make external events draggable
        function initializeExternalEvents() {
            var containerEl = document.getElementById('external-events');
            new FullCalendar.Draggable(containerEl, {
                itemSelector: '.external-event',
                eventData: function(eventEl) {
                    return {
                        title: eventEl.innerText,
                        backgroundColor: window.getComputedStyle(eventEl, '').backgroundColor,
                        borderColor: window.getComputedStyle(eventEl, '').borderColor,
                        textColor: window.getComputedStyle(eventEl, '').color
                    };
                }
            });
        }
    }
}


function initializeCharts() {
    // Initialize Area Chart
    var areaChartCanvas = document.getElementById('areaChart').getContext('2d');
    var areaChart = new Chart(areaChartCanvas, {
        type: 'line',
        data: {
            // Your data here
        },
        options: {
            // Your options here
        }
    });
    $(function () {
    // ChartJS initialization for each chart

    // Area Chart
    var donutChartCtx = document.getElementById('donutChart').getContext('2d');
    var donutChartData = {
        labels: ['Chrome', 'IE', 'FireFox', 'Safari', 'Opera', 'Navigator'],
        datasets: [{
            data: [700, 500, 400, 600, 300, 100],
            backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }]
    };
    var donutOptions = {
        maintainAspectRatio: false,
        responsive: true,
    };
    new Chart(donutChartCtx, {
        type: 'doughnut',
        data: donutChartData,
        options: donutOptions
    });
    var areaChartCanvas = document.getElementById('areaChart').getContext('2d');
    var areaChartData = {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
        datasets: [{
            label: 'Digital Goods',
            backgroundColor: 'rgba(60,141,188,0.9)',
            borderColor: 'rgba(60,141,188,0.8)',
            pointRadius: false,
            pointColor: '#3b8bba',
            pointStrokeColor: 'rgba(60,141,188,1)',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data: [28, 48, 40, 19, 86, 27, 90]
        }, {
            label: 'Electronics',
            backgroundColor: 'rgba(210, 214, 222, 1)',
            borderColor: 'rgba(210, 214, 222, 1)',
            pointRadius: false,
            pointColor: 'rgba(210, 214, 222, 1)',
            pointStrokeColor: '#c1c7d1',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(220,220,220,1)',
            data: [65, 59, 80, 81, 56, 55, 40]
        }]
    };
    var areaChartOptions = {
        maintainAspectRatio: false,
        responsive: true,
        legend: {
            display: false
        },
        scales: {
            xAxes: [{
                gridLines: {
                    display: false,
                }
            }],
            yAxes: [{
                gridLines: {
                    display: false,
                }
            }]
        }
    };
    new Chart(areaChartCanvas, {
        type: 'line',
        data: areaChartData,
        options: areaChartOptions
    });

    
});
    // Pie Chart
    var pieChartCtx = document.getElementById('pieChart').getContext('2d');
    new Chart(pieChartCtx, {
        type: 'pie',
        data: {
            labels: ['Red', 'Blue', 'Yellow'],
            datasets: [{
                data: [300, 50, 100],
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'],
                hoverOffset: 4
            }]
        }
    });

    // Line Chart
    var lineChartCtx = document.getElementById('lineChart').getContext('2d');
    new Chart(lineChartCtx, {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May'],
            datasets: [{
                label: 'Demo line plot',
                backgroundColor: 'rgba(78, 115, 223, 0.05)',
                borderColor: 'rgba(78, 115, 223, 1)',
                data: [0, 20, 15, 25, 10]
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    // Bar Chart
    var barChartCtx = document.getElementById('barChart').getContext('2d');
    new Chart(barChartCtx, {
        type: 'bar',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May'],
            datasets: [{
                label: 'Demo bar chart',
                backgroundColor: '#4e73df',
                hoverBackgroundColor: '#2e59d9',
                borderColor: '#4e73df',
                data: [10, 20, 30, 40, 50],
            }]
        },
        options: {
            scales: {
                xAxes: [{
                    time: {
                        unit: 'month'
                    },
                    gridLines: {
                        display: false
                    },
                    ticks: {
                        maxTicksLimit: 6
                    }
                }],
                yAxes: [{
                    ticks: {
                        min: 0,
                        max: 60,
                        maxTicksLimit: 5
                    },
                    gridLines: {
                        display: true
                    }
                }],
            },
            legend: {
                display: false
            }
        }
    });

    // Stacked Bar Chart
    var stackedBarChartCtx = document.getElementById('stackedBarChart').getContext('2d');
    new Chart(stackedBarChartCtx, {
        type: 'bar',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May'],
            datasets: [{
                label: 'Dataset 1',
                backgroundColor: 'rgba(2,117,216,1)',
                data: [4215, 5312, 6251, 7841, 9821]
            }, {
                label: 'Dataset 2',
                backgroundColor: 'rgba(92, 184, 92, 1)',
                data: [2154, 3321, 4134, 5442, 6432]
            }]
        },
        options: {
            scales: {
                xAxes: [{ stacked: true }],
                yAxes: [{ stacked: true }]
            }
        }
    });  // Initialize other charts by repeating the pattern above
    // Replace 'areaChart' with the appropriate chart ID and configuration
}


function initializeInteractionTimelineGraph() {
    var ctx = document.getElementById('interactionTimelineGraph').getContext('2d');
    var interactionTimelineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April'],
            datasets: [{
                label: 'Interactions',
                data: [65, 59, 80, 81],
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
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
</script>
</x-layout>
