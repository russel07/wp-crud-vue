<template>
  <div class="card col-md-10 offset-1">
    <div class=" mb-2">
      <a href="#/add-product" class="btn btn-success">Add Product</a>
    </div>
    <table class="table table-bordered table-hover table-striped">
      <thead>
      <tr>
        <th>Product Title</th>
        <th>Product Description</th>
        <th>Product Price</th>
        <th>Short Code</th>
        <th width="15%">Action</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="(item, index) in products" :key="index">
        <td>{{item.product_title}}</td>
        <td>{{item.product_description}}</td>
        <td>{{item.price}}</td>
        <td style="width: 30%">
          <input class="form-control" :value="getShortCode(item.id)" @click="copyToClipboard()">
        </td>
        <td>
          <a class="btn btn-sm btn-outline-warning" :href="getEditLink(item.id)">Edit</a>&nbsp;
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
    getShortCode(id){
      return "[WPCRUDVUE id=\""+id+"\"]"
    },
    getEditLink: function (id){
      return '#/edit-product/'+id;
    },
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

            root.$toast.show('Success! Product deleted successfully', {
              type: 'success'
            });
          },
          error : function(request,error)
          {
            root.$toast.show('Error! Something went wrong, please try later', {
              type: 'error'
            });
          }
        });
      }
    }
  }
}
</script>
