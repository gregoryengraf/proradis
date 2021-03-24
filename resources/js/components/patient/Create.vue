<template>
  <div class="ml-3">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createPatient">
      Cadastro de paciente
    </button>
    <div class="modal fade" id="createPatient" tabindex="-1" aria-labelledby="createPatientLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="createPatientLabel">Cadastrar paciente</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="fullName">Nome completo</label>
              <input type="text" class="form-control" id="fullName" v-model="patient.fullName">
            </div>
            <div class="row">
              <div class="form-group col">
                <label for="gender">Sexo</label>
                <select class="form-control" id="gender" v-model="patient.gender">
                  <option value="f">Fem.</option>
                  <option value="m">Masc.</option>
                </select>
              </div>
              <div class="form-group col">
                <label for="dateOfBirth">Data de Nasc.</label>
                <input type="text" class="form-control" v-mask="'##-##-####'" id="dateOfBirth" v-model="patient.dateOfBirth">
              </div>
              <div class="form-group col">
                <label for="cpf">CPF</label>
                <input type="text" class="form-control" v-mask="'###.###.###-##'" id="cpf" v-model="patient.cpf">
              </div>
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
  import {mask} from 'vue-the-mask'
  export default {
    name: 'PatientCreate',
    directives: {mask},
    data() {
      return {
        patient: {
          fullName: '',
          dateOfBirth:'',
          cpf: '',
          gender: ''
        }
      }
    },
    methods: {
      store(){
        axios.post('/vue/patient', this.patient).then(response => {
          this.$emit('patient', true);
          $('#createPatient').modal('toggle')
          iziToast.success({
            title: 'Ok',
            message: 'Paciente cadastrado com sucesso!',
            position: 'topRight',
          });
        }).cath(error => {
          $('#createPatient').modal('toggle')
          iziToast.error({
            title: 'Ops',
            message: 'Não foi possivel cadastrar paciente!',
            position: 'topRight',
          });
        })
      }
    }
  }
</script>
