<template>
    <div>
        <button v-on:click="showMessage = !showMessage" class="btn btn-primary add">Add new item</button>
        <transition name="fade">
            <form @submit.prevent="createItem" v-if="showMessage">
                <div class="form-row pb-2">
                    <div class="form-group col-md-2">
                        <input v-model="newItemName" type="text" class="form-control" placeholder="name" required>
                    </div>
                    <div class="form-group col-md-2">
                        <input v-model="newItemPrice" type="number" class="form-control" placeholder="price" required>
                    </div>
                    <div class="form-group col-md-3">
                        <select id="inputCategories" class="form-control" v-model="cat" required>
                            <option disabled selected value> Choose a Category </option>
                            <option v-for="c in categories" :value="c.id" :key="c.id">{{c.name}}</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <select id="inputLocations" class="form-control" v-model="loc" required>
                            <option disabled selected value> Choose a Location </option>
                            <option v-for="l in locations" :value="l.id" :key="l.id">{{l.name}}</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <button class="btn btn-primary">Create</button>
                    </div>
                </div>
            </form>
        </transition>
        <table class="table table-hover">
            <thead class="thead-dark">
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Location</th>
                <th>Option</th>
            </thead>
            <tbody>
                 <tr v-for="row in items" :key="row.id">
                    <td>{{ row.id }}</td>
                    <td>{{ row.name }}</td>
                    <td>{{ row.category.name}}</td>
                    <td>{{ row.location.name}}</td>
                    <td align="center"><button class="btn btn-danger btn-sm" @click.prevent="deleteLocation(row.id)"><i class="fa fa-times" /> Delete</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                categories: [],
                locations: [],
                items:'',
                cat: '',
                loc: '',
                newItemPrice:'',
                newItemName: '',
                showMessage: false,
            };
        },
        mounted() {
            this.getCategories();
            this.getLocations();
            this.getItems();
        },
        methods: {
            getItems() {
                return axios.get('/api/items')
                    .then(response => {
                        this.items = response.data;
                    }).catch(console.error);
            },
            getCategories() {
                return axios.get('/api/categories')
                    .then(response => {
                        this.categories = response.data;
                    }).catch(console.error);
            },
            getLocations() {
                return axios.get('/api/locations')
                    .then(response => {
                        this.locations = response.data;
                    }).catch(console.error);
            },
            createItem() {
                return axios.post('/api/items', 
                    ({name: this.newItemName, category: this.cat, location: this.loc ,price: this.newItemPrice }))
                    .then(this.getItems)
                    .then(() => this.newItemName = '')
                    .then(() => this.newItemPrice = '')
                    .catch(console.error);
            },
            deleteLocation(id) {
            return axios.post('/api/items/' + id, {_method: 'DELETE'})
                .then(this.getItems)
                .catch(console.error);
        }
        }
    }
</script>

<style>
    .add {
        margin-bottom: 10px;
    }

    .fade-enter-active,
    .fade-leave-active {
        transition: opacity .5s;
    }

    .fade-enter,
    .fade-leave-to {
        opacity: 0;
    }
</style>