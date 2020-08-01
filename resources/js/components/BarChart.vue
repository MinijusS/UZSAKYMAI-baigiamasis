<script>
    import {Bar} from "vue-chartjs";
    import moment from "moment";

    export default {
        extends: Bar,
        props: ["data"],
        mounted() {
            // reformat in the way the lib wants
            let chartData = {
                labels: [],
                datasets: [
                    {
                        label: "Produktas",
                        backgroundColor: "#0984e3",
                        data: []
                    }
                ]
            };

            for (let i = 1; i <= 10; i++) {
                chartData.labels.push(i);
                let counter = 0;
                orders_times.forEach(order => {
                    if (order == i) {
                        counter++;
                    }
                });
                chartData.datasets[0].data.push(counter);
            }

            this.renderChart(chartData, {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            stepSize: 1
                        }
                    }]
                },
                legend: {
                    display: false
                }
            });
        }
    };
</script>
