<template>
  <div class="header">
    <h2>Product List</h2>
    <div class="btn-container">
      <router-link to="/addproduct">
        <button class="btn btn-secondary">ADD</button>
      </router-link>
      <button
        id="delete-product-btn"
        class="btn btn-secondary"
        @click="deleteSelected"
      >
        MASS DELETE
      </button>
    </div>
  </div>
  <ItemList @add-to-checklist="addToCheckedList" :key="componentKey" />
</template>

<script>
import ItemList from '@/components/ItemList.vue';
import EventService from '@/services/EventService.js';

export default {
  name: 'Home',
  data() {
    return {
      checkedItems: [],
      componentKey: 0,
    };
  },
  components: {
    ItemList,
  },
  methods: {
    addToCheckedList(sku) {
      if (!this.checkedItems.includes(sku)) {
        this.checkedItems.push(sku);
      } else {
        this.checkedItems.splice(this.checkedItems.indexOf(sku), 1);
      }
    },
    // Force re-rendering of component updating the components key
    forceRender() {
      this.componentKey += 1;
    },
    deleteSelected() {
      EventService.deleteProducts(
        // Use this payload formatting when request method set to DELETE
        // {
        //   data: { data: this.checkedItems },
        // }

        { data: this.checkedItems }
      )
        .then((res) => {
          console.log(res.data);
          this.forceRender();
        })
        .catch((error) => {
          console.log(error, error.response);
        });
      this.checkedItems = [];
    },
  },
};
</script>
