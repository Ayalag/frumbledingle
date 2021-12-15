import Vuetify from 'vuetify';
<template>
  <table class="table table-hover">
    <thead class="thead-dark">
      <th>Location</th>
      <th>Parent Category </th>
      <th>Category</th>
      <th>Count</th>
      <th>New price</th>
      <th>Cta Price</th>
    </thead>
    <tbody>
      <tr v-for="row in items" :key="row.id">
        <td>{{ row.location}}</td>
        <td></td>
        <td>{{ row.category}}</td>
        <td>{{ row.count}}</td>
        <td><input v-model="row.id" type="number" placeholder="New price"></td>
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
        newPrice: [],
      };
    },
    mounted() {
      this.getItems();
    },
    methods: {
      getItems() {
        return axios.get('api/reports')
          .then(response => {
            this.items = response.data;
          }).catch(console.error);
      },
      postPrice(id){}
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