<template>
  <div class="home">
    <v-row>
      <v-col class="mb-2">
        <h2 v-if="!codigo" class="subheading grey--text">
          Cadastro de Usuario
        </h2>
        <h2 v-else class="subheading grey--text">Editar de Usuario</h2>
      </v-col>
    </v-row>

    <v-row>
      <v-col class="text-right">
        <v-btn to="/"> <v-icon>arrow_back</v-icon> Voltar</v-btn>
      </v-col>
    </v-row>
    <br />
    <v-card>
      <v-progress-linear
        v-if="loading"
        indeterminate
        color="blue"
      ></v-progress-linear>
      <v-card-title>
        <v-row>
          <v-col class="text-right">
            <v-form ref="form" v-model="valid" lazy-validation>
              <v-text-field
                v-model="nome"
                :counter="50"
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

              <v-btn color="success" class="mr-4" @click="save()">
                Salvar
              </v-btn>

              <v-btn color="error" class="mr-4" @click="reset"> Limpar</v-btn>
            </v-form>
          </v-col>
        </v-row>
      </v-card-title>
    </v-card>
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
    loading: false,
    nome: "",
    nomeRules: [
      (v) => !!v || "Nome é obrigatorio",
      (v) =>
        (v && v.length <= 50) || "O Nome tem que ser menor que 50 caracteres",
    ],

    status: null,
    items: ["Disponivel", "Em Processo", "Indisponivel"],
    checkbox: false,
  }),

  mounted() {
    if (this.codigo) {
      UsuarioService.find(this.codigo)
        .then((res) => {
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
        this.loading = true;
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
                this.$toast.success("Usuario editado", {
                  position: "top-right",
                });
                this.$router.push({
                  name: "Usuarios",
                });
              } else {
                this.$toast.error(res.data.error, {
                  position: "top-right",
                });
              }
              this.loading = false;
            })
            .catch((err) => {
              console.error(err);
              this.loading = false;
            });
        } else {
          UsuarioService.add({
            nome: this.nome,
            status: this.status,
          })
            .then((res) => {
              if (!res.data.error) {
                this.$toast.success("Usuario cadastrado", {
                  position: "top-right",
                });
                this.$router.push({
                  name: "Usuarios",
                });
              } else {
                this.$toast.error(res.data.error, {
                  position: "top-right",
                });
              }
              this.loading = false;
            })
            .catch((err) => {
              console.error(err);
              this.loading = false;
            });
        }
      }
    },
  },
};
</script>
