<script>
    //links_completion_chart
    let links_completion_chart_options = {
        chart: {
            height: 280,
            type: "radialBar",
        },

        series: [
            <?= $anytc->links_completion->download->completion_rate ?? 0 ?>,
            <?= $anytc->links_completion->stream->completion_rate ?? 0 ?>
        ],
        colors: ["#26b99a"],
        plotOptions: {
            radialBar: {
                hollow: {
                    margin: 0,
                    size: "50%",
                },
                dataLabels: {
                    name: {
                        offsetY: -10,
                        color: "#73879C",
                        fontSize: "13px"
                    },
                    value: {
                        color: "#73879C",
                        fontSize: "30px",
                        show: true
                    }
                }
            }
        },
        fill: {
            colors: ["#26b99a", "#3498db"]
        },

        labels: ["Download", "Stream"]
    };
    let links_completion_chart = new ApexCharts(document.querySelector("#links_completion_chart"), links_completion_chart_options);
    links_completion_chart.render();

</script>
