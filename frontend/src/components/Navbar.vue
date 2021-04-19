<template>
  <nav>
    <v-app-bar app text @click="drawer = !drawer" class="primary">
      <v-icon class="white--text">menu </v-icon>

      <v-toolbar-title class="text-uppercase white--text">
        <span class="font-weight-light">Desadio </span>
        <span>BRQ</span>
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn text color="white">
        <span>Sign Out</span>
        <v-icon right>exit_to_app</v-icon>
      </v-btn>
    </v-app-bar>
    <v-navigation-drawer
      v-model="drawer"
      absolute
      bottom
      temporary
      class="primary"
    >
      <v-list nav dense>
        <v-list-item-group
          v-model="group"
          active-class="deep-black--text text--accent-4"
        >
          <v-list-item
            v-for="link in links"
            :key="link.text"
            router
            :to="link.router"
          >
            <v-list-item-icon>
              <v-icon class="white--text">{{ link.icon }} </v-icon>
            </v-list-item-icon>
            <v-list-item-title class="white--text"
              >{{ link.text }}
            </v-list-item-title>
          </v-list-item>
        </v-list-item-group>
      </v-list>
    </v-navigation-drawer>
    <br />
    <br />
  </nav>
</template>
<script>
export default {
  data() {
    return {
      drawer: false,
      group: null,
      links: [
        { icon: "dashboard", text: "Dashboard", router: "/dashboard" },
        { icon: "inventory_2", text: "Usuario", router: "/" },
      ],
    };
  },
  watch: {
    group() {
      this.drawer = false;
    },
  },
};
</script>
