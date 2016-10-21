<template>
  <grid :position="grid" modifiers="padded blue">
    <section class="google-calendar">
      <h1>Upcoming</h1>
      <ul class="google-calendar__events">
        <li v-for="event in events"  class="google-calendar__event">
          <h2 class="google-calendar__event__title">{{ event.name }}</h2>
          <div class="google-calendar__event__date">{{ relativeDate(event.date) }}</div>
        </li>
      </ul>
    </section>
  </grid>
</template>

<script>
  import _ from 'lodash';
  import moment from 'moment';
  import Grid from './Grid.vue';

  export default {

    components: {
      Grid,
    },

    props: ['grid'],

    data() {
      return {
        events: [],
      };
    },

    created () {
      this.loadState();
      window.Echo.private('dashboard')
          .listen('GoogleCalendarEventsFetched', (e) => {
            this.events = e.events;
          });
    },

    watch: {
      'events': {
        handler() {
          this.saveState();
        },
        deep: true,
      },
    },

    methods: {
      loadState() {
        let savedState = this.getSavedState();

        if (!savedState) {
          return;
        }

        this.events = savedState;
      },
      saveState() {
        localStorage.setItem(this.getSavedStateId(), JSON.stringify(this.events));
      },

      getSavedState() {
        let savedState = localStorage.getItem(this.getSavedStateId());

        if (savedState) {
          savedState = JSON.parse(savedState);
        }

        return savedState;
      },

      getSavedStateId() {
        return 'google-calendar';
      },

      relativeDate (value) {
        let date = moment(value);
        let diffInDays = date.diff(moment(), 'days');
        if (diffInDays < 7) {
          return date.calendar();
        }
        return _.upperFirst(date.fromNow());
      }
    }
  };
</script>