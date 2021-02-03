<template>
  <div class="container">
    <h1>Todo List</h1>
    <br />
    <add-item-form v-on:refreshItems="getItems()" />
    <br />
    <list-item :items="items" v-on:refreshItems="getItems()" />
  </div>
</template>

<script>
import AddItemForm from "./AddItemForm.vue";
import ListItem from "./ListItem.vue";
export default {
  data() {
    return {
      items: [],
    };
  },
  components: {
    AddItemForm,
    ListItem,
  },
  methods: {
    getItems() {
      console.log("get items");
      axios
        .get("api/item")
        .then((response) => {
          console.log(response);
          this.items = response.data;
          console.log(this.items);
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  created() {
    this.getItems();
  },
};
</script>
