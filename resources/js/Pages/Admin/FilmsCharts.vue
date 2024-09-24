<template>
    <Layout>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <SideBar aria-label="sidebar navigation" />
                </div>
                <div class="overflow-auto col-md-9 mt-3">
                    <div ref="chartRef" style="width: 100%; height: 540px;" aria-label="data visualization chart"></div>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script>
import Layout from "../../Layout/App.vue";
import { Link } from "@inertiajs/vue3";
import SideBar from "./Partials/SideBar.vue";
import * as echarts from 'echarts';
import { ref, onMounted } from 'vue';

export default {
    components: {
        Layout,
        Link,
        SideBar,
    },
    props: {
        filmsCountByYear: {
            type: Array,
            required: true,
        },
    },
    setup(props) {
        const chartRef = ref(null);

        onMounted(() => {
            const chart = echarts.init(chartRef.value);
            let title = "Films production by year";

            let seriesData = Object.entries(props.filmsCountByYear).map(([year, count]) => {
                return { value: count, name: year };
            });

            let legendData = seriesData.map(item => item.name);

            chart.setOption({
                textStyle: {
                    fontFamily: 'Inter, "Helvetica Neue", Arial, sans-serif',
                },
                title: {
                    text: title,
                    left: 'center',
                },
                tooltip: {
                    trigger: 'item',
                    formatter: '{a} <br/>{b} : {c} ({d}%)',
                },
                legend: {
                    orient: 'vertical',
                    left: 'left',
                    data: legendData,
                },
                series: [
                    {
                        name: title,
                        type: 'pie',
                        radius: '55%',
                        center: ['50%', '50%'],
                        data: seriesData,
                    },
                ],
            });
        });
        return {
            chartRef
        };
    },
};

</script>

<style></style>