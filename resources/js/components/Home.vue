<template>
  <div>
    <div class="row">
      <div class="col d-flex">
        <v-create-vacine v-on:vacine="getVacine"></v-create-vacine>
        <v-create-patient v-on:patient="getPatient"></v-create-patient>
      </div>
    </div>
    <div class="row mt-5">
      <div class="col">
        <div class="card">
          <div class="card-header">Vacinas</div>
          <div class="card-body">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Fabricante</th>
                  <td>Validade</td>
                  <td>Doses aplicadas</td>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(vacine, index) in vacines" :key="index">
                  <th>{{ vacine.manufacturer }}</th>
                  <td>{{ vacine.expirationDate }}</td>
                  <td>{{ vacine.patients.length }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <div class="card-header">Pacientes</div>
          <div class="card-body">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Nome</th>
                  <th>Vacina</th>
                  <th>Doses aplicadas</th>
                  <th>#</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(patient, index) in patients" :key="index">
                  <th>{{ patient.fullName }}</th>
                  <td>{{ patient.vacines[0] ? patient.vacines[0].manufacturer : ' - ' }}</td>
                  <td>{{ patient.vacines.length }} </td>
                  <td>
                    <v-register-application v-on:application="loadInfo" :vacines="vacines" :patient="patient"></v-register-application>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  Vue.component('v-create-vacine', require('./vacine/Create.vue').default);
  Vue.component('v-create-patient', require('./patient/Create.vue').default);
  Vue.component('v-register-application', require('./RegisterApplication.vue').default);
  export default {
    name: 'Home',
    data() {
      return {
        vacines: null,
        patients: null,
      }
    },
    methods: {
      getVacine(){
        this.load = true
        axios.get('/vue/vacine').then(response => {
          this.load = false
          this.vacines = response.data
        })
      },
      getPatient(){
        this.load = true
        axios.get('/vue/patient').then(response => {
          this.load = false
          this.patients = response.data
        })
      },
      loadInfo() {
        this.getVacine()
        this.getPatient()
      }
    },
    mounted() {
      this.getVacine()
      this.getPatient()
    },
  }
</script>
