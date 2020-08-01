<template>
    <div>
        <h4>Užsakymų skaičius kas valandą</h4>
        <LineChart v-if="loaded" :data="orders" :styles="styles"/>
    </div>
</template>

<script>
    import LineChart from "./LineChart";
    import BarChart from "./BarChart";

    export default {
        components: {
            LineChart,
            BarChart
        },
        data() {
            return {
                loaded: false,
                styles: {
                    width: "100%",
                    height: "400px",
                    position: "relative"
                }
            };
        },
        async created() {
            let resp = await axios.get('/api/orders');
            this.orders = resp.data.orders;
            this.products = resp.data.orderedItems;
            this.loaded = true;
        }
    };
</script>
