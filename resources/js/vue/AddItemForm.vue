<template>
  <div class="container">
    <input type="text" v-model="item.name" />
    <button @click="saveItem" :disabled="!item.name">Save</button>
  </div>
</template>
<script>
export default {
  data() {
    return {
      item: {
        name: "",
      },
    };
  },
  methods: {
    saveItem() {
      if (this.item.name == "") {
        return;
      }
      axios
        .post("api/item/", {
          item: this.item,
        })
        .then((response) => {
          if (response.status == 201) {
            this.item.name = null;
            this.$emit("refreshItems");
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>
