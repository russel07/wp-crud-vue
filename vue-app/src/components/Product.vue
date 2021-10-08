<template>
  <div class="wrap">
    <h1 class="wp-heading-inline">Products</h1>
    <a href="#/add-product" class="btn btn-success">Add Product</a>
    <table class="wp-list-table widefat fixed striped table-view-list products">
      <thead>
      <tr>
        <th>Product Title</th>
        <th>Product Description</th>
        <th>Product Price</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="(item, index) in products" :key="index">
        <td>{{item.product_title}}</td>
        <td>{{item.product_description}}</td>
        <td>{{item.price}}</td>
        <td>
          <button class="btn btn-sm btn-outline-warning">Edit</button>&nbsp;
          <button class="ml-2 btn btn-sm btn-outline-danger" @click="deleteProduct(item.id)">Delete</button>
        </td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  name: 'Product',
  data(){
    return{
      products: []
    }
  },
  created() {
    this.getProducts();
  },
  methods: {
    getProducts: function(){
      let root = this;
      $.ajax({
        url: ajaxurl,
        type: 'GET',
        dataType: 'json',
        data: {
          'action': 'get_products'
        },
        beforeSend: function () {

        },
        success : function(data) {
          root.products = data;
        },
        error : function(request,error)
        {
            console.log(error);
        }
      });
    },
    deleteProduct: function (id){
      if(confirm('Are you sure you want to delete?')){
        let  root = this;
        let data = {
          id: id,
          action: 'delete_product'
        }
        $.ajax({
          url: ajaxurl,
          type: 'POST',
          dataType: 'json',
          data: data,
          beforeSend: function () {

          },
          success : function(data) {
            let index = root.products.findIndex(row => row.id === id);
            root.products.splice(index, 1);
          },
          error : function(request,error)
          {
            console.log(error);
          }
        });
      }
    }
  }
}
</script>
