<template>
    <v-dialog v-model="dialog" persistent max-width="1250">
        <v-card>
            <v-card-title>
                <TitlePage title="Crea progetto" ></TitlePage>
            </v-card-title>
            <v-card-text>
                <v-form ref="formCreateProject" valid="valid" style="border: 1px solid #000;border-radius: 0.5em;padding: 1vw 1vw ">
                    <v-row  justify="center" align="center" style="padding-left: 1vw;padding-top: 1vw;padding-right: 1vw">

                        <v-col cols="12">

                            <v-text-field
                                color="primary"
                                label="Nome"
                                name="name"
                                v-model="form.name"
                                type="text"
                                :rules="[value => !!value || 'Campo obbligatorio']"
                                :disabled="loading"
                                :loading="loading"
                            ></v-text-field>
                        </v-col>

                    </v-row>
                </v-form>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-row>
                    <v-col col="12">
                        <v-btn color="success" variant="outlined"  @click="$router.push({name:'Project'})" :disabled="loading">
                            Chiudi
                        </v-btn>
                        <v-btn color="success" variant="outlined"  @click="postCreate" :disabled="loading">
                            Crea
                        </v-btn>
                    </v-col>
                </v-row>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>
<script>
import TitlePage from "../../../Common/TitlePage.vue";
import storeComputed from "../../../../mixins/storeComputed.js";
import Project from "../../../../mixins/Task/Project.js";

export default {
    name: "CreateProject",
    components:{TitlePage},
    mixins:[storeComputed,Project],
    data: () => ({
        loading:false,
        form:{
            name: null
        },
        valid:false,
        dialog:true
    }),
    methods:{
        postCreate: function (){
            this.loading = true
            this.$refs.formCreateProject.validate().then(v => {
              if(v.valid){
                  let userid = this.$store.getters['user/getUserId']
                  this.create(userid, this.form).then(r => {
                      this.$store.commit('snackbar/update',{
                          show: true,
                          text: "Progetto creato",
                          color: 'success'
                      })
                      this.$router.push({name:'Project'})
                      this.$emit("reload")
                      this.loading = false
                  }).catch( e => {
                      this.loading = false
                  })
              } else
                  this.loading = false
            }).catch(e => {
                this.loading = false
            })

        }
    }
}
</script>
