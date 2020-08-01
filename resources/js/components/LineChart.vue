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
                        label: "Užsakymai",
                        backgroundColor: "#f87979",
                        data: []
                    }
                ]
            };

            let orders_times = [];

            this.data.forEach(order => orders_times.push(moment(order.created_at).format('H')));

            for (let i = 10; i <= 23; i++) {
                chartData.labels.push(i + ':00');
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
