<template>
  <progress :max="max" :value="percent" :class="state"></progress>
</template>
<script>
  const MAX = 100;
  export default {
    computed: {
      state () {
        if (this.percent >= 75) {
          return 'high';
        }
        if (this.percent <= 35) {
          return 'low';
        }
        return 'middle';
      }
    },
    props: {
      max: {
        default: MAX,
        validator: (value) => {
          return value <= MAX;
        }
      },
      percent: {
        default: 1,
        validator: (value) => {
          return value <= MAX;
        }
      }
    }
  };
</script>
<style>
  progress {
    width: 100%;
    height: 50%;
    background-color: #655;
    border: 0;
  }

  progress::before {
    content: attr(value) '%';
    position: absolute;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100%;
    text-align: center;
    font-size: 2em;
  }

  progress,
  progress::-webkit-progress-bar {
    background-color: #655;
    border: 0;
  }

  progress[value],
  progress::-webkit-progress-value {
    border: 0;
    transition: 1s;
  }

  progress.high::-moz-progress-bar {
    background-color: yellowgreen;
  }

  progress.high[value],
  progress.high::-webkit-progress-value {
    background-color: yellowgreen;
  }

  progress.middle::-moz-progress-bar {
    background-color: orange;
  }

  progress.middle[value],
  progress.middle::-webkit-progress-value {
    background-color: orange;
  }

  progress.low::-moz-progress-bar {
    background-color: red;
  }

  progress.low[value],
  progress.low::-webkit-progress-value {
    background-color: red;
  }
</style>