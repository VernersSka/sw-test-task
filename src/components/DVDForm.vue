<template>
  <div>
    <label for="size">Size (MB)</label>
    <input
      @input="$emit('add-description', description)"
      v-model="description"
      type="text"
      id="size"
      name="size"
    />
    <p>Please, provide size</p>
  </div>
</template>

<script>
export default {
  data() {
    return {
      description: null,
    };
  },
};
</script>
