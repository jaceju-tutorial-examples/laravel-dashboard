<template>
  <grid :position="grid">
    <section class="current-time">
      <time class="current-time__content">
        <span class="current-time__time">{{ time }}</span>
        <span class="current-time__date">{{ date }}</span>
      </time>
    </section>
  </grid>
</template>
<script>
  import Grid from './Grid.vue';
  import moment from 'moment';

  moment.locale('zh-TW');

  export default {
    components: {
      Grid
    },

    props: {
      dateformat: {
        type: String,
        default: 'YYYY-MM-DD',
      },
      timeformat: {
        type: String,
        default: 'HH:mm:ss',
      },
      grid: {
        type: String,
      },
    },

    data() {
      return {
        date: '',
        time: '',
      };
    },

    created() {
      this.refreshTime();
      setInterval(this.refreshTime, 1000);
    },

    methods: {
      refreshTime() {
        this.date = moment().format(this.dateformat);
        this.time = moment().format(this.timeformat);
      },
    },
  };
</script>
