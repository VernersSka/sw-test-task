<template>
  <div>
    <div>
      <label for="height">Height (CM)</label>
      <input
        @input="$emit('add-description', description)"
        v-model="height"
        type="text"
        id="height"
        name="height"
      />
    </div>
    <div>
      <label for="width">Width (CM)</label>
      <input
        @input="$emit('add-description', description)"
        v-model="width"
        type="text"
        id="width"
        name="width"
      />
    </div>
    <div>
      <label for="length">Length (CM)</label>
      <input
        @input="$emit('add-description', description)"
        v-model="length"
        type="text"
        id="length"
        name="length"
      />
    </div>
    <p>Please, provide dimensions</p>
  </div>
</template>

<script>
export default {
  data() {
    return {
      height: null,
      width: null,
      length: null,
    };
  },
  computed: {
    description() {
      return [this.height, this.width, this.length];
    },
  },
};
</script>
