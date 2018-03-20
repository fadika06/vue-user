<template>
  <div class="card">
    <div class="card-header">
      <i class="fa fa-table" aria-hidden="true"></i> Edit User

      <ul class="nav nav-pills card-header-pills pull-right">
        <li class="nav-item">
          <button class="btn btn-primary btn-sm" role="button" @click="back">
            <i class="fa fa-arrow-left" aria-hidden="true"></i>
          </button>
        </li>
      </ul>
    </div>

    <div class="card-body">
      <vue-form class="form-horizontal form-validation" :state="state" @submit.prevent="onSubmit">        
        <div class="form-row">          
          <div class="col-md">
            <validate tag="div">              
              <input class="form-control" v-model="model.name" required autofocus name="name" type="text" placeholder="Name">

              <field-messages name="name" show="$invalid && $submitted" class="text-danger">
                <small class="form-text text-success">Looks good!</small>
                <small class="form-text text-danger" slot="required">Name is a required field</small>
              </field-messages>
            </validate>
          </div>
        </div>

        <div class="form-row mt-4"> 
          <div class="col-md">
            <validate tag="div">
              <input class="form-control" v-model="model.email" name="email" type="email" placeholder="Email">

              <field-messages name="email" show="$invalid && $submitted" class="text-danger">
                <small class="form-text text-success">Looks good!</small>
                <small class="form-text text-danger" slot="required">Email is a required field</small>
              </field-messages>
            </validate>
          </div>
        </div>

        <div class="form-row mt-4"> 
          <div class="col-md">
            <validate tag="div">
              <input class="form-control" v-model="model.password" name="password" type="password" placeholder="Password">

              <field-messages name="password" show="$invalid && $submitted" class="text-danger">
                <small class="form-text text-success">Looks good!</small>
                <small class="form-text text-danger" slot="required">Password is a required field</small>
              </field-messages>
            </validate>
          </div>
        </div>

        <div class="form-row mt-4"> 
          <div class="col-auto">
            <button type="submit" class="btn btn-primary">Submit</button>

            <button type="reset" class="btn btn-secondary" @click="reset">Reset</button>
          </div>
        </div>        
      </vue-form>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    
  },
  data() {
    return {
      state: {},
      model: {
        name: "",
        email: "",
        password: ""
      }
    }
  },
  methods: {
    onSubmit: function() {
      let app = this;

      if (this.state.$invalid) {
        return;
      } else {
        axios.post('api/vue-user', {
            name: this.model.name,
            email: this.model.email,
            password: this.model.password
          })
          .then(response => {
            if (response.data.status == true) {
              if(response.data.message == 'success'){
                alert(response.data.message);
                app.back();
              }else{
                alert(response.data.message);
              }
            } else {
              alert(response.data.message);
            }
          })
          .catch(function(response) {
            alert('Break ' + response.data.message);
          });
      }
    },
    reset() {
      this.model.name = "";
      this.model.email = "";
      this.model.password = "";
    },
    back() {
      window.location = '#/admin/user';
    }
  }
}
</script>
