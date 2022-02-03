<template>
  <div>
    <form id="product_form" method="post" @submit.prevent="handleForm">
      <label for="sku">SKU</label>
      <input v-model="formData.sku" type="text" id="sku" name="sku" />
      <br />

      <label for="name">Name</label>
      <input v-model="formData.name" type="text" id="name" name="name" />
      <br />

      <label for="price">Price ($)</label>
      <input v-model="formData.price" type="text" id="price" name="price" />
      <br />

      <label for="productType">Type Switcher</label>
      <select :name="productType" id="productType" v-model="productType">
        <option>DVD</option>
        <option>Book</option>
        <option>Furniture</option>
      </select>

      <DVDForm @add-description="addDescription" v-if="productType === 'DVD'" />
      <BookForm
        @add-description="addDescription"
        v-if="productType === 'Book'"
      />
      <FurnitureForm
        @add-description="addDescription"
        v-if="productType === 'Furniture'"
      />

      <p v-if="error_msg.length > 0" class="error-msg">
        {{ error_msg }}
      </p>
    </form>
  </div>
</template>

<script>
import DVDForm from './DVDForm.vue';
import BookForm from './BookForm.vue';
import FurnitureForm from './FurnitureForm.vue';
import EventService from '@/services/EventService.js';

export default {
  name: 'ProductForm',
  components: { DVDForm, BookForm, FurnitureForm },
  data() {
    return {
      productType: 'DVD',
      formData: {
        sku: null,
        name: null,
        price: null,
        description: null,
      },
      error_msg: '',
      uniqueSku: new Boolean(),
    };
  },
  computed: {
    dataToSend() {
      return {
        sku: this.formData.sku,
        name: this.formData.name,
        price: this.formData.price,
        type: this.productType,
        description: this.formData.description,
      };
    },
  },
  methods: {
    addDescription(description) {
      this.formData.description = description;
    },

    handleForm() {
      this.error_msg = '';

      this.validateInput();

      this.validateSkuUnique(this.dataToSend.sku).then(() => this.sendForm());
    },

    validateInput() {
      // Empty field check
      if (
        !this.formData.sku ||
        !this.formData.name ||
        !this.formData.price ||
        !this.formData.description
      ) {
        this.error_msg = 'Please, submit required data';
      }
      // Price field number check
      if (isNaN(this.formData.price) && this.error_msg === '') {
        this.error_msg = 'Please, provide the data of indicated type';
      }

      if (this.productType === 'Furniture') {
        this.dataToSend.description = '';
        // Description field check for product type Furniture
        for (const dimension of this.formData.description) {
          if (
            (isNaN(dimension) || dimension === '' || dimension === null) &&
            this.error_msg === ''
          ) {
            this.error_msg = 'Please, provide the data of indicated type';
          } else {
            // Dimension is valid, build description string
            this.dataToSend.description += dimension + 'x';
          }
        }
        // Remove the redundant 'x' at the end of string
        this.dataToSend.description = this.dataToSend.description.slice(0, -1);
      } else {
        // Description field check for product types DVD and Book
        if (isNaN(this.formData.description) && this.error_msg === '') {
          this.error_msg = 'Please, provide the data of indicated type';
        }
      }
    },

    // Check if provided SKU value is unique
    validateSkuUnique(value) {
      return EventService.findSKU({ params: { value } })
        .then((res) => {
          if (res.data === false) {
            // SKU not in database
            this.uniqueSku = true;
          } else {
            // SKU already taken
            this.uniqueSku = false;
            this.error_msg = 'SKU already taken. Please, enter a unique SKU';
          }
        })
        .catch((error) => {
          console.log(error, error.response);
        });
    },

    sendForm() {
      if (this.error_msg === '' && this.uniqueSku === true) {
        EventService.addProducts(this.dataToSend)
          .then((res) => {
            if (res.data.error_msg) {
              // Display error message received from backend
              this.error_msg = res.data.error_msg;
            } else {
              // Form sending successful, redirect to home view
              this.$router.push('/');
            }
          })
          .catch((error) => {
            console.log(error, error.response);
          });
      }
    },
  },
};
</script>
