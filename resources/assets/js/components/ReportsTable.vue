import Vuetify from 'vuetify';
<template>
  <table class="table table-hover">
    <thead class="thead-dark">
      <th>Location</th>
      <th>Parent Category </th>
      <th>Category</th>
      <th>Count</th>
      <th>Price</th>
      <th>New price</th>
      <th>Cta Price</th>
    </thead>
    <tbody>
      <tr v-for="row in items" :key="row.id">
        <td>{{ row.location.name}}</td>
        <td></td>
        <td>{{ row.category.name}}</td>
        <td></td>
        <td>{{ row.price }}</td>
        <td><input v-model="newPrice" type="number" placeholder="New price"></td>
        <td><button  class="btn btn-primary btn-sm" @click.prevent="postPrice(row.id)"><i class="fa fa-check" /> Update</button></td>
      </tr>
    </tbody>
  </table>
</template>

<script>
  export default {
    data() {
      return {
        items: [],
        newPrice: '',
      };
    },
    mounted() {
      this.getItems();
    },
    methods: {
      getItems() {
        return axios.get('/api/items')
          .then(response => {
            this.items = response.data;
            console.log(response.data);
          }).catch(console.error);
      },
      postPrice(id){
        return axios.post('api/items/'+id, ({price: this.newPrice[id], id:id, _method: 'PUT'}))
        .then(this.getItems())
        .catch(console.error);
      }
    }
  }
</script>
<style>
  table td input {
    position: relative;
    display: block;
    top: 0;
    left: 0;
    margin: 0;
    height: 100% !important;
    border-radius: 0 !important;
    border: none;
    padding: 5px;
    box-sizing: border-box;
  }
</style>