<template>
  <label :for="info.sku" class="item-container">
    <input
      type="checkbox"
      :name="info.sku"
      :id="info.sku"
      class="delete-checkbox"
      @change="onChange"
    />
    <p>{{ info.sku }}</p>
    <p>{{ info.name }}</p>
    <p>{{ info.price }}$</p>
    <p v-if="info.type === 'DVD'">Size: {{ info.description }} MB</p>
    <p v-if="info.type === 'Book'">Weight: {{ info.description }}KG</p>
    <p v-if="info.type === 'Furniture'">Dimensions: {{ info.description }}</p>
  </label>
</template>

<script>
export default {
  name: 'Item',
  data() {},
  props: {
    info: {
      type: Object,
      required: true,
    },
  },
  methods: {
    onChange() {
      this.$emit('add-to-checklist');
    },
  },
};
</script>
