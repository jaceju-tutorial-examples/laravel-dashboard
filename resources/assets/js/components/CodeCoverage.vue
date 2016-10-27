<template>
  <grid :position="grid">
    <section class="battery-state">
      <highcharts :options="options" ref="highcharts" :title="title"></highcharts>
    </section>
  </grid>
</template>

<script>
  import Grid from './Grid.vue';
  import getOptions from '../chart-options';

  export default {
    components: {
      Grid
    },

    props: {
      grid: {
        type: String
      },
      title: {
        type: String
      }
    },

    created () {
      window.Echo.private('dashboard')
          .listen('CodeCoverageCreated', (e) => {
            if (e.project === this.title) {
              this.updateCoverage(e.coverage);
            }
          });
    },

    methods: {
      updateCoverage (coverage) {
        const series = this.$refs.highcharts.chart.series[0];
        const x = (new Date()).getTime(), // current time
            y = parseFloat(coverage);
        console.log(x, y);
        series.addPoint([x, y], true, true);
      }
    },

    data () {
      const options = getOptions();
      options.title.text = this.title;
      return {
        options: options
      }
    }
  }
</script>