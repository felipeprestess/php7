
// CARROUSEL START
$(document).ready(function () {
    $("#owl-demo").owlCarousel({
        navigation: true,
        slideSpeed: 300,
        paginationSpeed: 400,
        singleItem: true,
        autoPlay: true
    });
});
// CARROSEUL END


//CUSTOM SELECT BOX START
$(function () {
    $('select.styled').customSelect();
});
//CUSTOM SELECT BOX END


// COUNT USUARIOS START
function countUp(count)
{
    var div_by = 100,
            speed = Math.round(count / div_by),
            $display = $('.count'),
            run_count = 1,
            int_speed = 24;

    var int = setInterval(function () {
        if (run_count < div_by) {
            $display.text(speed * run_count);
            run_count++;
        } else if (parseInt($display.text()) < count) {
            var curr_count = parseInt($display.text()) + 1;
            $display.text(curr_count);
        } else {
            clearInterval(int);
        }
    }, int_speed);
}
countUp(495);
// COUNT USUARIOS END

// COUNT VENDAS START
function countUp2(count)
{
    var div_by = 100,
            speed = Math.round(count / div_by),
            $display = $('.count2'),
            run_count = 1,
            int_speed = 24;

    var int = setInterval(function () {
        if (run_count < div_by) {
            $display.text(speed * run_count);
            run_count++;
        } else if (parseInt($display.text()) < count) {
            var curr_count = parseInt($display.text()) + 1;
            $display.text(curr_count);
        } else {
            clearInterval(int);
        }
    }, int_speed);
}
countUp2(947);
// COUNT VENDAS END

// COUNT PEDIDOS START
function countUp3(count)
{
    var div_by = 100,
            speed = Math.round(count / div_by),
            $display = $('.count3'),
            run_count = 1,
            int_speed = 24;

    var int = setInterval(function () {
        if (run_count < div_by) {
            $display.text(speed * run_count);
            run_count++;
        } else if (parseInt($display.text()) < count) {
            var curr_count = parseInt($display.text()) + 1;
            $display.text(curr_count);
        } else {
            clearInterval(int);
        }
    }, int_speed);
}
countUp3(328);
// COUNT PEDIDOS END

// COUNT LUCRO TOTAL START
function countUp4(count)
{
    var div_by = 100,
            speed = Math.round(count / div_by),
            $display = $('.count4'),
            run_count = 1,
            int_speed = 24;

    var int = setInterval(function () {
        if (run_count < div_by) {
            $display.text(speed * run_count);
            run_count++;
        } else if (parseInt($display.text()) < count) {
            var curr_count = parseInt($display.text()) + 1;
            $display.text(curr_count);
        } else {
            clearInterval(int);
        }
    }, int_speed);
}
countUp4(1038);
// COUNT LUCRO TOTAL END


//  SPARKLINE START
var Script = function () {

    $(".sparkline").each(function () {
        var $data = $(this).data();

        $data.valueSpots = {'0:': $data.spotColor};

        $(this).sparkline($data.data || "html", $data,
                {
                    tooltipFormat: '<span style="display:block; padding:0px 10px 12px 0px;">' +
                            '<span style="color: {{color}}">&#9679;</span> {{offset:names}} ({{percent.1}}%)</span>'
                });




    });

//sparkline chart

    $("#barchart").sparkline([5, 3, 6, 7, 5, 6, 4, 2, 3, 4, 6, 8, 9, 10, 8, 6, 5, 7, 6, 5, 4, 7, 4], {
        type: 'bar',
        height: '65',
        barWidth: 8,
        barSpacing: 5,
        barColor: '#fff'
//        tooltipFormat: '<span style="display:block; padding:0px 10px 12px 0px;">' +
//            '<span style="color: {{color}}">&#9679;</span> {{offset:names}} ({{percent.1}}%)</span>'

    });


    $("#linechart").sparkline([1, 5, 3, 7, 9, 3, 6, 4, 7, 9, 7, 6, 2], {
        type: 'line',
        width: '300',
        height: '75',
        fillColor: '',
        lineColor: '#fff',
        lineWidth: 2,
        spotColor: '#fff',
        minSpotColor: '#fff',
        maxSpotColor: '#fff',
        highlightSpotColor: '#fff',
        highlightLineColor: '#ffffff',
        spotRadius: 4
//        tooltipFormat: '<span style="display:block; padding:0px 10px 12px 0px;">' +
//            '<span style="color: {{color}}">&#9679;</span> {{offset:names}} ({{percent.1}}%)</span>'



    });

    $("#pie-chart").sparkline([2, 1, 1, 1], {
        type: 'pie',
        width: '100',
        height: '100',
        borderColor: '#00bf00',
        sliceColors: ['#41CAC0', '#A8D76F', '#F8D347', '#EF6F66']
//        tooltipFormat: '<span style="display:block; padding:0px 10px 12px 0px;">' +
//            '<span style="color: {{color}}">&#9679;</span> {{offset:names}} ({{percent.1}}%)</span>'
    });

    //work progress bar

    $("#work-progress1").sparkline([5, 6, 7, 5, 9, 6, 4], {
        type: 'bar',
        height: '20',
        barWidth: 5,
        barSpacing: 2,
        barColor: '#5fbf00'
//        tooltipFormat: '<span style="display:block; padding:0px 10px 12px 0px;">' +
//            '<span style="color: {{color}}">&#9679;</span> {{offset:names}} ({{percent.1}}%)</span>'
    });

    $("#work-progress2").sparkline([3, 2, 5, 8, 4, 7, 5], {
        type: 'bar',
        height: '22',
        barWidth: 5,
        barSpacing: 2,
        barColor: '#58c9f1'
//        tooltipFormat: '<span style="display:block; padding:0px 10px 12px 0px;">' +
//            '<span style="color: {{color}}">&#9679;</span> {{offset:names}} ({{percent.1}}%)</span>'
    });

    $("#work-progress3").sparkline([1, 6, 9, 3, 4, 8, 5], {
        type: 'bar',
        height: '22',
        barWidth: 5,
        barSpacing: 2,
        barColor: '#8075c4'
//        tooltipFormat: '<span style="display:block; padding:0px 10px 12px 0px;">' +
//            '<span style="color: {{color}}">&#9679;</span> {{offset:names}} ({{percent.1}}%)</span>'
    });

    $("#work-progress4").sparkline([9, 4, 9, 6, 7, 4, 3], {
        type: 'bar',
        height: '22',
        barWidth: 5,
        barSpacing: 2,
        barColor: '#ff6c60'
//        tooltipFormat: '<span style="display:block; padding:0px 10px 12px 0px;">' +
//            '<span style="color: {{color}}">&#9679;</span> {{offset:names}} ({{percent.1}}%)</span>'
    });

    $("#work-progress5").sparkline([6, 8, 5, 7, 6, 8, 3], {
        type: 'bar',
        height: '22',
        barWidth: 5,
        barSpacing: 2,
        barColor: '#41cac0'
//        tooltipFormat: '<span style="display:block; padding:0px 10px 12px 0px;">' +
//            '<span style="color: {{color}}">&#9679;</span> {{offset:names}} ({{percent.1}}%)</span>'
    });

    $("#pie-chart2").sparkline([2, 1, 1, 1], {
        type: 'pie',
        width: '250',
        height: '125',
        sliceColors: ['#41CAC0', '#A8D76F', '#F8D347', '#EF6F66']
//        tooltipFormat: '<span style="display:block; padding:0px 10px 12px 0px;">' +
//    '<span style="color: {{color}}">&#9679;</span> {{offset:names}} ({{percent.1}}%)</span>'});

    });

}();
// SPARKLINE END



// XCHART START
(function () {
    var data = [
        {"xScale": "ordinal",
            "comp": [],
            "main": [
                {"className": ".main.l1",
                    "data": [
                        {"y": 15, "x": "2012-11-19T00:00:00"},
                        {"y": 11, "x": "2012-11-20T00:00:00"},
                        {"y": 8, "x": "2012-11-21T00:00:00"},
                        {"y": 10, "x": "2012-11-22T00:00:00"},
                        {"y": 1, "x": "2012-11-23T00:00:00"},
                        {"y": 6, "x": "2012-11-24T00:00:00"},
                        {"y": 8, "x": "2012-11-25T00:00:00"}]},
                {"className": ".main.l2",
                    "data": [
                        {"y": 29, "x": "2012-11-19T00:00:00"},
                        {"y": 33, "x": "2012-11-20T00:00:00"},
                        {"y": 13, "x": "2012-11-21T00:00:00"},
                        {"y": 16, "x": "2012-11-22T00:00:00"},
                        {"y": 7, "x": "2012-11-23T00:00:00"},
                        {"y": 18, "x": "2012-11-24T00:00:00"},
                        {"y": 8, "x": "2012-11-25T00:00:00"}]}],
            "type": "cumulative",
            "yScale": "linear"},{"xScale": "ordinal",
            "comp": [],
            "main": [
                {"className": ".main.l1",
                    "data": [
                        {"y": 15, "x": "2012-11-19T00:00:00"},
                        {"y": 11, "x": "2012-11-20T00:00:00"},
                        {"y": 8, "x": "2012-11-21T00:00:00"},
                        {"y": 10, "x": "2012-11-22T00:00:00"},
                        {"y": 11, "x": "2012-11-23T00:00:00"},
                        {"y": 61, "x": "2012-11-24T00:00:00"},
                        {"y": 81, "x": "2012-11-25T00:00:00"}]},
                {"className": ".main.l2",
                    "data": [
                        {"y": 49, "x": "2012-11-19T00:00:00"},
                        {"y": 13, "x": "2012-11-20T00:00:00"},
                        {"y": 13, "x": "2012-11-21T00:00:00"},
                        {"y": 16, "x": "2012-11-22T00:00:00"},
                        {"y": 71, "x": "2012-11-23T00:00:00"},
                        {"y": 18, "x": "2012-11-24T00:00:00"},
                        {"y": 81, "x": "2012-11-25T00:00:00"}]}],
            "type": "bar",
            "yScale": "linear"},{"xScale": "ordinal",
            "comp": [],
            "main": [
                {"className": ".main.l1",
                    "data": [
                        {"y": 15, "x": "2012-11-19T00:00:00"},
                        {"y": 11, "x": "2012-11-20T00:00:00"},
                        {"y": 8, "x": "2012-11-21T00:00:00"},
                        {"y": 10, "x": "2012-11-22T00:00:00"},
                        {"y": 1, "x": "2012-11-23T00:00:00"},
                        {"y": 6, "x": "2012-11-24T00:00:00"},
                        {"y": 8, "x": "2012-11-25T00:00:00"}]},
                {"className": ".main.l2",
                    "data": [
                        {"y": 29, "x": "2012-11-19T00:00:00"},
                        {"y": 33, "x": "2012-11-20T00:00:00"},
                        {"y": 13, "x": "2012-11-21T00:00:00"},
                        {"y": 16, "x": "2012-11-22T00:00:00"},
                        {"y": 7, "x": "2012-11-23T00:00:00"},
                        {"y": 18, "x": "2012-11-24T00:00:00"},
                        {"y": 8, "x": "2012-11-25T00:00:00"}]}],
            "type": "line",
            "yScale": "linear"}];

    var order = [0, 1, 0, 2],
            i = 0,
            xFormat = d3.time.format('%A'),
            chart = new xChart('line-dotted', data[order[i]], '#chart', {
                axisPaddingTop: 5,
                dataFormatX: function (x) {
                    return new Date(x);
                },
                tickFormatX: function (x) {
                    return xFormat(x);
                },
                timing: 1250
            }),
            rotateTimer,
            toggles = d3.selectAll('.multi button'),
            t = 3500;

    function updateChart(i) {
        var d = data[i];
        chart.setData(d);
        toggles.classed('toggled', function () {
            return (d3.select(this).attr('data-type') === d.type);
        });
        return d;
    }

    toggles.on('click', function (d, i) {
        clearTimeout(rotateTimer);
        updateChart(i);
    });

    function rotateChart() {
        i += 1;
        i = (i >= order.length) ? 0 : i;
        var d = updateChart(order[i]);
        rotateTimer = setTimeout(rotateChart, t);
    }
    rotateTimer = setTimeout(rotateChart, t);
}());
// XCHART END



// MORRIS START
var Script = function () {

    $(function () {
        // data stolen from http://howmanyleft.co.uk/vehicle/jaguar_'e'_type
        var tax_data = [
            {"period": "2011 Q3", "licensed": 3407, "sorned": 660},
            {"period": "2011 Q2", "licensed": 3351, "sorned": 629},
            {"period": "2011 Q1", "licensed": 3269, "sorned": 618},
            {"period": "2010 Q4", "licensed": 3246, "sorned": 661},
            {"period": "2009 Q4", "licensed": 3171, "sorned": 676},
            {"period": "2008 Q4", "licensed": 3155, "sorned": 681},
            {"period": "2007 Q4", "licensed": 3226, "sorned": 620},
            {"period": "2006 Q4", "licensed": 3245, "sorned": null},
            {"period": "2005 Q4", "licensed": 3289, "sorned": null}
        ];
        Morris.Line({
            element: 'hero-graph',
            data: tax_data,
            xkey: 'period',
            ykeys: ['licensed', 'sorned'],
            labels: ['Licenciado', 'Fora de circulação'],
            lineColors: ['#8075c4', '#6883a3']
        });

        Morris.Donut({
            element: 'hero-donut',
            data: [
                {label: 'Geléia', value: 25},
                {label: 'Polvilho', value: 40},
                {label: 'Quindim', value: 25},
                {label: 'Açúcar', value: 10}
            ],
            colors: ['#41cac0', '#49e2d7', '#34a39b'],
            formatter: function (y) {
                return y + "%"
            }
        });

        Morris.Area({
            element: 'hero-area',
            data: [
                {period: '2010 Q1', iphone: 2666, ipad: null, itouch: 2647},
                {period: '2010 Q2', iphone: 2778, ipad: 2294, itouch: 2441},
                {period: '2010 Q3', iphone: 4912, ipad: 1969, itouch: 2501},
                {period: '2010 Q4', iphone: 3767, ipad: 3597, itouch: 5689},
                {period: '2011 Q1', iphone: 6810, ipad: 1914, itouch: 2293},
                {period: '2011 Q2', iphone: 5670, ipad: 4293, itouch: 1881},
                {period: '2011 Q3', iphone: 4820, ipad: 3795, itouch: 1588},
                {period: '2011 Q4', iphone: 15073, ipad: 5967, itouch: 5175},
                {period: '2012 Q1', iphone: 10687, ipad: 4460, itouch: 2028},
                {period: '2012 Q2', iphone: 8432, ipad: 5713, itouch: 1791}
            ],
            xkey: 'period',
            ykeys: ['iphone', 'ipad', 'itouch'],
            labels: ['iPhone', 'iPad', 'iPod Touch'],
            hideHover: 'auto',
            lineWidth: 1,
            pointSize: 5,
            lineColors: ['#4a8bc2', '#ff6c60', '#a9d86e'],
            fillOpacity: 0.5,
            smooth: true
        });

        Morris.Bar({
            element: 'hero-bar',
            data: [
                {device: 'iPhone', geekbench: 136},
                {device: 'iPhone 3G', geekbench: 137},
                {device: 'iPhone 3GS', geekbench: 275},
                {device: 'iPhone 4', geekbench: 380},
                {device: 'iPhone 4S', geekbench: 655},
                {device: 'iPhone 5', geekbench: 1571}
            ],
            xkey: 'device',
            ykeys: ['geekbench'],
            labels: ['Geekbench'],
            barRatio: 0.4,
            xLabelAngle: 35,
            hideHover: 'auto',
            barColors: ['#6883a3']
        });

        new Morris.Line({
            element: 'examplefirst',
            xkey: 'year',
            ykeys: ['value'],
            labels: ['Value'],
            data: [
                {year: '2008', value: 20},
                {year: '2009', value: 10},
                {year: '2010', value: 5},
                {year: '2011', value: 5},
                {year: '2012', value: 20}
            ]
        });

        $('.code-example').each(function (index, el) {
            eval($(el).text());
        });
    });

}();

// MORRIS END


// CHART START
var Script = function () {
    var doughnutData = [
        {
            value: 30,
            color: "#F7464A"
        },
        {
            value: 50,
            color: "#46BFBD"
        },
        {
            value: 100,
            color: "#FDB45C"
        },
        {
            value: 40,
            color: "#949FB1"
        },
        {
            value: 120,
            color: "#4D5360"
        }

    ];
    var lineChartData = {
        labels: ["", "", "", "", "", "", ""],
        datasets: [
            {
                fillColor: "rgba(220,220,220,0.5)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#fff",
                data: [65, 59, 90, 81, 56, 55, 40]
            },
            {
                fillColor: "rgba(151,187,205,0.5)",
                strokeColor: "rgba(151,187,205,1)",
                pointColor: "rgba(151,187,205,1)",
                pointStrokeColor: "#fff",
                data: [28, 48, 40, 19, 96, 27, 100]
            }
        ]

    };
    var pieData = [
        {
            value: 30,
            color: "#F38630"
        },
        {
            value: 50,
            color: "#E0E4CC"
        },
        {
            value: 100,
            color: "#69D2E7"
        }

    ];
    var barChartData = {
        labels: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho"],
        datasets: [
            {
                fillColor: "rgba(220,220,220,0.5)",
                strokeColor: "rgba(220,220,220,1)",
                data: [65, 59, 90, 81, 56, 55, 40]
            },
            {
                fillColor: "rgba(151,187,205,0.5)",
                strokeColor: "rgba(151,187,205,1)",
                data: [28, 48, 40, 19, 96, 27, 100]
            }
        ]

    };
    var chartData = [
        {
            value: Math.random(),
            color: "#D97041"
        },
        {
            value: Math.random(),
            color: "#C7604C"
        },
        {
            value: Math.random(),
            color: "#21323D"
        },
        {
            value: Math.random(),
            color: "#9D9B7F"
        },
        {
            value: Math.random(),
            color: "#7D4F6D"
        },
        {
            value: Math.random(),
            color: "#584A5E"
        }
    ];
    var radarChartData = {
        labels: ["", "", "", "", "", "", ""],
        datasets: [
            {
                fillColor: "rgba(220,220,220,0.5)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#fff",
                data: [65, 59, 90, 81, 56, 55, 40]
            },
            {
                fillColor: "rgba(151,187,205,0.5)",
                strokeColor: "rgba(151,187,205,1)",
                pointColor: "rgba(151,187,205,1)",
                pointStrokeColor: "#fff",
                data: [28, 48, 40, 19, 96, 27, 100]
            }
        ]

    };
    new Chart(document.getElementById("doughnut").getContext("2d")).Doughnut(doughnutData);
    new Chart(document.getElementById("line").getContext("2d")).Line(lineChartData);
    new Chart(document.getElementById("radar").getContext("2d")).Radar(radarChartData);
    new Chart(document.getElementById("polarArea").getContext("2d")).PolarArea(chartData);
    new Chart(document.getElementById("bar").getContext("2d")).Bar(barChartData);
    new Chart(document.getElementById("pie").getContext("2d")).Pie(pieData);

}();
// CHART END