<template>
  <div class="home">
    <v-row>
      <v-col class="mb-2">
        <h2 class="subheading grey--text">Lista de Usuarios</h2>
      </v-col>
    </v-row>
    <v-row>
      <v-col class="text-right">
        <v-btn class="success" to="/cadastrar">
          <v-icon>add</v-icon> Cadastrar</v-btn
        >
      </v-col>
    </v-row>
    <v-row>
      <v-col class="text-right">
        <ListData />
      </v-col>
    </v-row>
  </div>
</template>

<script>
import ListData from "@/components/ListData";
export default {
  name: "Usuarios",
  components: { ListData },
};
</script>
