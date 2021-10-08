<template>

  <div class="wrap">
    <h1 class="wp-heading-inline">Edit Poduct</h1>
    <a href="#/" class="btn btn-success">Back to list</a>

    <div class="row pt-5">
      <div class="col-md-12">

        <div class="form-group row">
          <div class="col-md-3">
            <label for="product_title">Product Title</label>
          </div>
          <div class="col-md-9">
            <input class="form-control" name="product_title" v-model="product_title" id="product_title"/>
          </div>
          <div class="invalid-feedback" v-if="errors.product_title">
            Product title can not be blank.
          </div>
        </div>

        <div class="form-group row">
          <div class="col-md-3">
            <label for="product_description">Product Description</label>
          </div>
          <div class="col-md-9">
            <textarea class="form-control" name="product_description" v-model="product_description" id="product_description"></textarea>
          </div>
          <div class="invalid-feedback" v-if="error.product_description">
            Product description can not be blank.
          </div>
        </div>

        <div class="form-group row">
          <div class="col-md-3">
            <label for="price">Product Price</label>
          </div>
          <div class="col-md-9">
            <input class="form-control" name="price" v-model="price" id="price"/>
          </div>
          <div class="invalid-feedback" v-if="errors.product_price">
            Product price can not be blank.
          </div>
        </div>

        <div class="form-group text-center">
          <button type="button" class="btn btn-outline-primary" id="save_product" @click="saveProduct">Update</button>
        </div>

      </div>
    </div>
  </div>
</template>

<script>
  import router from '../router/router.js';
  export default {
    data(){
      return {
        id: '',
        product_title: '',
        product_description: '',
        price: '',
        errors: {
          product_title: false,
          product_description: false,
          price: false
        },
        error: false
      }
    },
    created() {
      this.getProduct();
    },
    methods: {
      getProduct: function (){
        let id = this.$route.params.productId;
        let root = this;
        let data = {
          id: id,
          action: 'get_product'
        }
        $.ajax({
          url: ajaxurl,
          type: 'GET',
          dataType: 'json',
          data: data,
          beforeSend: function () {

          },
          success : function(response) {
            if(response.status){
              let product = response.data;

              root.id = product.id
              root.product_title = product.product_title
              root.product_description = product.product_description
              root.price = product.price
            }

          },
          error : function(request,error)
          {
            root.$toast.show('Error! Something went wrong, please try later', {
              type: 'error'
            });
          }
        });
      },

      saveProduct(){
        let root = this;
        if(this.product_title === ''){
          this.errors.product_price = true;
          this.error = true;
        }
        else if(this.product_description === ''){
          this.errors.product_description == true;
          this.error = true;
        }
        else if(this.price === ''){
          this.errors.price == true;
          this.error = true;
        }else{
          this.error = false;
        }
        console.log(this.error)
        if(!this.error){
          let data = {
            id: this.id,
            product_title: this.product_title,
            product_description: this.product_description,
            price: this.price,
            action: 'save_product'
          }

          $.ajax({
            url: ajaxurl,
            type: 'POST',
            dataType: 'json',
            data: data,
            beforeSend: function () {

            },
            success : function(data) {
              root.$toast.show('Success! Product updated successfully', {
                type: 'success'
              });
              router.push({name: 'Product'})
            },
            error : function(request,error)
            {
              root.$toast.show('Error! Something went wrong, please try later', {
                type: 'error'
              });
            }
          });
        }else{
          root.$toast.show('Error! Invalid data submitted', {
            type: 'error'
          });
        }
      }
    }
  }
</script>