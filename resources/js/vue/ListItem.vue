<template>
  <div class="container">
    <h2>Item List</h2>
    <ul>
      <li v-for="item in items" :key="item.id">
        <item-view :item="item" v-on:itemChanged="$emit('refreshItems')" />
      </li>
    </ul>
  </div>
</template>
<script>
import ItemView from "./ItemView.vue";
export default {
  props: ["items"],
  components: { ItemView },
};
</script>
