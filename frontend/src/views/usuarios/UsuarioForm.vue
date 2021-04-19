<template>
  <div class="home">
    <v-row>
      <v-col class="mb-2">
        <h2 class="subheading grey--text">Cadastro de Usuario</h2>
      </v-col>
    </v-row>
    <v-row>
      <v-col class="text-right">
        <v-btn to="/"> <v-icon>arrow_back</v-icon> Voltar</v-btn>
      </v-col>
    </v-row>
    <v-row>
      <v-col class="text-right">
        <v-form ref="form" v-model="valid" lazy-validation>
          <v-text-field
            v-model="nome"
            :counter="10"
            :rules="nomeRules"
            label="Nome"
            required
          ></v-text-field>

          <v-select
            v-model="status"
            :items="items"
            :rules="[(v) => !!v || 'Status é obrigadorio']"
            label="Status"
            required
          ></v-select>

          <v-btn color="success" class="mr-4" @click="save()"> Salvar </v-btn>

          <v-btn color="error" class="mr-4" @click="reset"> Limpar</v-btn>
        </v-form>
      </v-col>
    </v-row>
  </div>
</template>

<script>
import UsuarioService from "../../services/UsuarioService";
export default {
  name: "UsuarioForm",
  components: {},
  props: ["codigo"],
  data: () => ({
    valid: true,
    nome: "",
    nomeRules: [
      (v) => !!v || "Nome é obrigatorio",
      (v) =>
        (v && v.length <= 10) || "O Nome tem que cer acima de 10 caracteres",
    ],

    status: null,
    items: ["Disponivel", "Em Processo", "Indisponivel"],
    checkbox: false,
  }),

  mounted() {
    if (this.codigo) {
      UsuarioService.find(this.codigo)
        .then((res) => {
          console.log(res);
          this.nome = res.data[0].nome;
          this.status = res.data[0].status;
        })
        .catch((err) => console.error(err));
    }
  },

  methods: {
    validate() {
      return this.$refs.form.validate();
    },
    reset() {
      this.$refs.form.reset();
    },

    save() {
      if (this.validate()) {
        if (this.codigo) {
          UsuarioService.update(
            {
              nome: this.nome,
              status: this.status,
            },
            this.codigo
          )
            .then((res) => {
              if (!res.data.error) {
                this.$router.push({
                  name: "Usuarios",
                });
              } else {
                console.log(res);
              }
            })
            .catch((err) => console.error(err));
        } else {
          UsuarioService.add({
            nome: this.nome,
            status: this.status,
          })
            .then((res) => {
              if (!res.data.error) {
                this.$router.push({
                  name: "Usuarios",
                });
              } else {
                console.log(res);
              }
            })
            .catch((err) => console.error(err));
        }
      }
    },
  },
};
</script>
