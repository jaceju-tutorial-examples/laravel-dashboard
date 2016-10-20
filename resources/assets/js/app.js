import Vue from 'vue';
import Echo from 'laravel-echo';
import SocketIO from 'socket.io-client';
import BatteryState from './components/BatteryState.vue';
import CurrentTime from './components/CurrentTime.vue';

window.io = SocketIO;

window.Echo = new Echo({
  broadcaster: 'socket.io',
  host: 'http://example-dashboard.dev:6001'
});

new Vue({
  el: '#app',
  components: {
    BatteryState,
    CurrentTime
  }
});
