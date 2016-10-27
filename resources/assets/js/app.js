import Vue from 'vue';
import VueHighcharts from 'vue-highcharts';
import Highcharts from 'highcharts/highcharts';

import Echo from 'laravel-echo';
import SocketIO from 'socket.io-client';
import GoogleCalendar from './components/GoogleCalendar.vue';
import BatteryState from './components/BatteryState.vue';
import CurrentTime from './components/CurrentTime.vue';
import CodeCoverage from './components/CodeCoverage.vue';

Vue.use(VueHighcharts, { Highcharts });

window.io = SocketIO;

window.Echo = new Echo({
  broadcaster: 'socket.io',
  host: 'http://example-dashboard.dev:6001'
});

new Vue({
  el: '#app',
  components: {
    GoogleCalendar,
    BatteryState,
    CurrentTime,
    CodeCoverage
  }
});
