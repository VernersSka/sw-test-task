<template>
  <div class="header">
    <h2>Product Add</h2>
    <div class="btn-container">
      <button type="submit" form="product_form" class="btn btn-secondary">
        Save
      </button>
      <router-link to="/">
        <button class="btn btn-secondary">Cancel</button>
      </router-link>
    </div>
  </div>
  <ProductForm />
</template>

<script>
import ProductForm from '@/components/ProductForm';

export default {
  name: 'AddProduct',
  data() {
    return {};
  },
  components: { ProductForm },
};
</script>
