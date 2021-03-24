<template>
  <div>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createVacine">
      Cadastro de vacina
    </button>
    <div class="modal fade" id="createVacine" tabindex="-1" aria-labelledby="createVacineLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="createVacineLabel">Cadastrar vacina</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="manufacturer">Nome do fabricante</label>
              <input type="text" class="form-control" id="manufacturer" v-model="vacine.manufacturer">
            </div>
            <div class="row">
              <div class="form-group col">
                <label for="lote">Lote</label>
                <input type="text" class="form-control" id="lote" v-model="vacine.lote">
              </div>
              <div class="form-group col">
                <label for="expirationDate">Data de validade</label>
                <div class="row">
                  <div class="col">
                    <select class="form-control" v-model="expirationMonth">
                      <option :value="1">jan.</option>
                      <option :value="2">fev.</option>
                      <option :value="3">mar.</option>
                      <option :value="4">abr.</option>
                      <option :value="5">maio</option>
                      <option :value="6">jun.</option>
                      <option :value="7">jul.</option>
                      <option :value="8">ago.</option>
                      <option :value="9">set.</option>
                      <option :value="10">out.</option>
                      <option :value="11">nov.</option>
                      <option :value="12">dez.</option>
                    </select>
                  </div>
                  <div class="col">
                    <select class="form-control" v-model="expirationYear">
                      <option v-for="year in years" :key="year" :value="year">{{ year }}</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="form-group col">
                <label for="dosesNumber">Número de doses</label>
                <select class="form-control" id="dosesNumber" v-model="vacine.dosesNumber">
                  <option :value="1">1 dose</option>
                  <option :value="2">2 doses</option>
                  <option :value="3">3 doses</option>
                  <option :value="4">4 doses</option>
                  <option :value="5">5 doses</option>
                </select>
              </div>
              <div class="form-group col">
                <label for="interval">Intervalo entre doses</label>
                <div class="input-group mb-3">
                  <input type="number" class="form-control" v-model="vacine.daysInterval" placeholder="Ex: 10" aria-label="Intervalo entre doses" aria-describedby="days-interval">
                  <div class="input-group-append">
                    <span class="input-group-text" id="days-interval">Dias</span>
                  </div>
                </div>
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
  export default {
    name: 'VacineCreate',
    data() {
      return {
        expirationMonth: 0,
        expirationYear: 0,
        vacine: {
          manufacturer: '',
          expirationDate: '',
          lote: '',
          dosesNumber: 1
        }
      }
    },
    watch: {
      expirationMonth() {
        this.joinExpirationDate()
      },
      expirationYear(){
        this.joinExpirationDate()
      }
    },
    computed: {
      years() {
        const yearNow = new Date().getFullYear()
        const allYears = []
        for (let index = yearNow; index < yearNow+15; index++) {
          allYears.push(index)
        }
        return allYears;
      }
    },
    methods:{
      joinExpirationDate(){
        this.vacine.expirationDate = this.expirationMonth+'-'+this.expirationYear
      },
      store(){
        axios.post('/vue/vacine', this.vacine).then(response => {
          this.$emit('vacine', true);
          $('#createVacine').modal('toggle')
          iziToast.success({
            title: 'Ok',
            message: 'cadastro de vacina feito com sucesso!',
            position: 'topRight',
          });
        })
      }
    }
  }
</script>
