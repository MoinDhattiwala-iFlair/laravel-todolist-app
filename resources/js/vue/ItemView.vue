<template>
  <div class="container">
    <input type="checkbox" @change="updateCheck" v-model="item.completed" />
    <span :class="[item.completed ? 'completed' : '']">{{ item.name }}</span>
    <button @click="deleteItem">X</button>
  </div>
</template>
<script>
export default {
  props: ["item"],
  methods: {
    updateCheck() {
      axios
        .put("api/item/" + this.item.id, {
          item: this.item,
        })
        .then((result) => {
          if (result.status == 200) {
            this.$emit("itemChanged");
          }
        })
        .catch((err) => {
          console.log(err);
        });
    },
    deleteItem() {
      axios
        .delete("api/item/" + this.item.id)
        .then((result) => {
          if (result.status == 200) {
            this.$emit("itemChanged");
          }
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>
<style scoped>
.completed {
  text-decoration: line-through;
}
</style>
