<template>
  <grid :position="grid" modifiers="padded green">
    <section class="battery-state">
      <h1>Battery</h1>
      <percent-visualizer :percent="percent"></percent-visualizer>
      <p class="state"><span class="charging" v-if="charging">Changing...</span><span v-else class="not-charging">Not charging</span></p>
    </section>
  </grid>
</template>
<style>
  .state {
    padding: 0.5em 0;
    font-size: 0.75em;
    text-transform: uppercase;
  }
</style>
<script>
  import Grid from './Grid.vue';
  import PercentVisualizer from './PercentVisualizer.vue';

  export default {
    components: {
      Grid,
      PercentVisualizer
    },
    data () {
      return {
        percent: 1,
        charging: false
      }
    },
    props: {
      grid: {
        type: String,
      }
    },
    created () {
      window.Echo.private('dashboard')
          .listen('BatteryStateUpdated', (e) => {
            this.percent = e.percent;
            this.charging = e.charging === '1';
          });
    }
  };
</script>