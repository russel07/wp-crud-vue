<template>
  <div class="card col-md-10 offset-1">
    <div class="mb-2">
      <a href="#/" class="btn btn-success">Back to list</a>
    </div>


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
          <button type="button" class="btn btn-outline-primary" id="save_product" @click="saveProduct">Save</button>
        </div>

      </div>
    </div>
  </div>
</template>

<script>
  import router from '../router/router.js'
  export default {
    name: 'AddProduct',
    data() {
      return {
        product_title: '',
        product_description: '',
        price: '',
        errors: {
          product_title: false,
          product_description: false,
          product_price: false
        },
        error: false,
      }
    },
    methods: {
      saveProduct(){
        let root = this;
        if(this.product_title === ''){console.log("product_title blank");
          this.errors.product_price = true;
          this.error = true;
        }
        else if(this.product_description === ''){console.log("description blank");
          this.errors.product_description == true;
          this.error = true;
        }
        else if(this.price === ''){console.log("price blank");
          this.errors.price == true;
          this.error = true;
        }else{
          this.error = false;
        }

        if(!this.error){
          let data = {
            product_title: this.product_title,
            product_description: this.product_description,
            price: this.price,
            action: 'save_product'
          }
          console.log(data);

          $.ajax({
            url: ajaxurl,
            type: 'POST',
            dataType: 'json',
            data: data,
            beforeSend: function () {

            },
            success : function(data) {
              root.$toast.show('Success! Product addedd successfully', {
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