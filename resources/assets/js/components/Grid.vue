<template>
  <div :class="computedPosition">
    <div :class="computedModifiers">
      <slot></slot>
    </div>
  </div>
</template>
<script>
  const modifyClass = (modifiers, base) => {
    if (!modifiers) {
      return base;
    }

    modifiers = Array.isArray(modifiers) ? modifiers : modifiers.split(' ');
    modifiers = modifiers.map(modifier => `${base}--${modifier}`);

    return [base, ...modifiers];
  };

  const gridFromTo = value => {
    const [ from, to = from ] = value.toLowerCase().split(':');

    return modifyClass([`from-${from}`, `to-${to}`], 'grid');
  };

  export default {
    props: ['position', 'modifiers'],
    computed: {
      computedPosition () {
        return gridFromTo(this.position);
      },
      computedModifiers () {
        return modifyClass(this.modifiers, 'grid__tile');
      }
    }
  };
</script>