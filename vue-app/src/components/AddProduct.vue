<template>
  <div class="wrap">
    <h1 class="wp-heading-inline">Add Poduct</h1>
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
            <input class="form-control" name="product_description" v-model="product_description" id="product_description"/>
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
        console.log(this.error)
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
              alert("added successfully");
            },
            error : function(request,error)
            {
              console.log(error);
            }
          });
        }else{
          console.log("Data validation error");
        }
      }
    }
  }
</script>