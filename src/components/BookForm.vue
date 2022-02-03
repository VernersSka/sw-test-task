<template>
  <div>
    <label for="weight">Weight (Kg)</label>
    <input
      @input="$emit('add-description', description)"
      v-model="description"
      type="text"
      id="weight"
      name="weight"
    />
    <p>Please, provide weight</p>
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
