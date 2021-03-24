<template>
  <div>
    <button v-if="checkApplication" type="button" class="btn btn-danger" data-toggle="modal" :data-target="`#registerApplication_${patient.id}`">
      Aplicar
    </button>
    <button v-else type="button" class="btn btn-seccondary" :class="{'btn-success' :patient.vacines.length >= lastApplication.dosesNumber}">
      <span v-if="patient.vacines.length >= lastApplication.dosesNumber">Ciclo completo</span>
      <span v-else>Fora da data</span>
    </button>
    <div class="modal fade" :id="`registerApplication_${patient.id}`" tabindex="-1" :aria-labelledby="`registerApplicationLabel${patient.id}`" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" :id="`registerApplicationLabel${patient.id}`">Cadastrar aplicação de vacina</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>
              <strong>Paciente: {{ patient.fullName }} </strong>
            </p>
            <div class="form-group">
              <label for="vacine">Vacina</label>
              <input type="text" class="form-control" v-if="patient.vacines[0]" :value="patient.vacines[0].manufacturer" readonly>
              <select v-else class="form-control" id="vacine" v-model="vacine">
                <option v-for="(vacine, index) in vacines" :key="index" :value="vacine.id"> {{ vacine.manufacturer }} </option>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary" @click="store">Salvar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import moment from 'moment'
export default {
  name: 'RegisterApplication',
  props: ['vacines', 'patient'],
  data() {
    return {
      vacine: this.patient.vacines[0] ? this.patient.vacines[0].id : null
    }
  },
  computed: {
    lastApplication(){
      if (this.patient.vacines[1]) {
        return this.patient.vacines[this.patient.vacines.length - 1]
      }
      if (this.patient.vacines[0]) {
        return this.patient.vacines[0]
      }
      return null
    },
    checkApplication(){
      if (!this.lastApplication) {
        return true
      }

      if (this.moment().diff(this.lastApplication.pivot.created_at, 'days') >= this.lastApplication.daysInterval && this.patient.vacines.length < this.lastApplication.dosesNumber) {
        return true
      }
      return false
    }
  },
  methods: {
    moment() {
      return moment();
    },
    store(){
      axios.post(`/vue/patient-register-application/${this.patient.id}`, {vacine_id: this.vacine}).then(response => {
        this.$emit('application', true)
        $(`#registerApplication_${this.patient.id}`).modal('toggle')
        iziToast.success({
            title: 'Ok',
            message: 'Aplicação registrada com sucesso!',
            position: 'topRight',
          });
      })
    }
  }
}
</script>
