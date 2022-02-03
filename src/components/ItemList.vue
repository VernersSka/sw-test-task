<template>
  <div class="list-container">
    <div v-for="product in products" :key="product.sku">
      <Item
        v-if="products.length > 0"
        :info="product"
        @add-to-checklist="$emit('add-to-checklist', product.sku)"
      />
    </div>
  </div>
</template>

<script>
import Item from '@/components/Item.vue';
import EventService from '@/services/EventService.js';

export default {
  name: 'ItemList',
  components: {
    Item,
  },
  data() {
    return {
      products: [],
    };
  },
  mounted() {
    this.getAll();
  },

  methods: {
    getAll() {
      EventService.getProducts()
        .then((res) => {
          if (res.data) {
            this.products = res.data;
          } else {
            this.products = [];
          }
        })
        .catch((error) => {
          console.log(error, error.response);
        });
    },
  },
  emits: ['add-to-checklist'],
};
</script>
