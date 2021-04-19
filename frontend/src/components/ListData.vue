<template>
  <div id="ListData">
    <v-card>
      <v-card-title>
        <v-spacer></v-spacer>
        <v-spacer></v-spacer>
        <v-spacer></v-spacer>
        <v-spacer></v-spacer>
        <v-text-field
          v-model="search"
          append-icon="mdi-magnify"
          label="Pesquisar"
          single-line
          hide-details
          dense
        ></v-text-field>
      </v-card-title>
      <v-data-table
        :headers="headers"
        :items="desserts"
        :search="search"
        :header-props="headerProps"
        :footer-props="{
          'items-per-page-text': 'Usuarios por página',
        }"
      >
        <!--  eslint-disable-next-line  -->
        <template v-slot:item.opcao="{ item }">
          <div class="text-center">
            <v-btn
              @click="editData(item.codigo)"
              title="Editar"
              class="mx-2 warning"
              ><v-icon>edit</v-icon></v-btn
            >

            <v-btn @click="confirmDeleteData(item)" title="Deletar" class="red"
              ><v-icon class="white--text">delete</v-icon></v-btn
            >
          </div>
        </template>
        <!--  eslint-disable-next-line  -->
        <template v-slot:item.created_at="{ item }">
          {{ item.created_at | moment }}
        </template></v-data-table
      >
    </v-card>
    <v-dialog v-model="dialog" persistent max-width="320">
      <v-card>
        <v-card-title class="headline"> Atenção </v-card-title>
        <v-card-text
          >Deseja apagar o registro com o codigo: {{ deleteInforms.codigo }},
          nome: {{ deleteInforms.nome }} e status:
          {{ deleteInforms.status }}?</v-card-text
        >
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="black darken-1" text @click="dialog = false">
            Cancelar
          </v-btn>
          <v-btn color="red darken-1" text @click="deleteData()">
            Confirmar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
import UsuarioService from "../services/UsuarioService";
import moment from "moment";
export default {
  name: "ListData",
  data() {
    return {
      search: "",
      dialog: false,
      deleteInforms: {},
      headerProps: {
        sortByText: "Filtro",
      },

      headers: [
        {
          text: "Código",
          align: "left",
          filterable: false,
          value: "codigo",
        },
        { text: "Nome", value: "nome", align: "center" },
        { text: "Status", value: "status", align: "center" },
        { text: "Data de Criação", value: "created_at", align: "center" },
        { text: "Opções", value: "opcao", align: "center", sortable: false },
      ],
      desserts: [],
    };
  },
  created() {
    this.inicioDados();
  },

  methods: {
    inicioDados() {
      UsuarioService.findAll()
        .then((res) => {
          this.desserts = res.data;
        })
        .catch((err) => console.error(err));
    },
    confirmDeleteData(item) {
      this.dialog = true;
      this.deleteInforms = item;
    },

    deleteData() {
      UsuarioService.delete(this.deleteInforms.codigo)
        .then((res) => {
          if (!res.data.error) {
            this.inicioDados();
            this.$toast.success("Usuario deletado", {
              position: "top-right",
            });
          } else {
            this.$toast.error(res.data.error, {
              position: "top-right",
            });
          }
          this.dialog = false;
        })
        .catch((err) => {
          console.error(err);
          this.dialog = false;
        });
    },
    editData(id) {
      this.$router.push({
        name: "UsuarioForm",
        params: {
          codigo: id,
        },
      });
    },
  },
  filters: {
    moment(date) {
      return moment(date).format("DD/MM/YYYY HH:mm:ss");
    },
  },
};
</script>