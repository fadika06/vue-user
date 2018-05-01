<template>
  <div>
		<div class="card mb-3">
			<div class="card-header d-flex flex-row align-items-center justify-content-between">
				<span>
					<i class="fa fa-table" aria-hidden="true"></i> User [ {{ model.name }} ]
				</span>
				<button class="btn btn-primary btn-sm ml-2" role="button" @click="back">
					<i class="fa fa-arrow-left" aria-hidden="true"></i>
				</button>
			</div>

			<div class="card-body">
				<dl class="row">
					<dt class="col-2">Name</dt>
					<dd class="col-10">{{ model.name }}</dd>

					<dt class="col-2">Email</dt>
					<dd class="col-10">{{ model.email }}</dd>

          <dt class="col-2">Password</dt>
					<dd class="col-10">{{ model.password }}</dd>

          <dt class="col-2">Role</dt>
					<dd class="col-10">{{ current_role.display_name }}</dd>
				</dl>
			</div>

	  </div>

    <div class="card">
      <div class="card-header">
        <i class="fa fa-key" aria-hidden="true"></i> Roles
      </div>

      <div class="card-body">
        <vue-form class="form-horizontal form-validation" :state="state" @submit.prevent="onSubmit">
            <div class="form-check" v-for="role in roles" :key="role.id">
                <input class="form-check-input" name="role" type="radio" v-model="model.role" :value="role" :disabled="role.id == current_role.id">
                <label class="form-check-label">
                {{ role.display_name }}
                </label>
            </div>

            <div class="form-row mt-4">
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Submit</button>

                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
            </div>
        </vue-form>
      </div>
    </div>

  </div>

</template>

<script>
export default {
  mounted() {
    axios.get('api/vue-user/user-add-role/' + this.$route.params.id)
      .then(response => {
        if (response.data.status == true) {
          this.model.email = response.data.user.email;
          this.model.name = response.data.user.name;
          this.current_role = response.data.user.roles[0];

          response.data.roles.forEach(role => {
            this.roles.push(role);
          });
        } else {
          alert('Failed');
        }
      })
      .catch(function(response) {
        alert('Break');
        window.location.href = '#/admin/user';
	  });
  },
  data() {
    return {
      state: {},
      model: {
        email: "",
        name: "",
        password: "*********",
        role: '',

      },
      roles: [],
      current_role: ''
    }
  },
  methods: {
  onSubmit(){
    axios.post('api/vue-user/user-add-role/' + this.$route.params.id + '/store', {
      old_role : this.current_role.id,
      new_role : this.model.role.id
    })
      .then(response => {
        if (response.data.status == true) {
          if(response.data.typem == 'success'){
            this.current_role = this.model.role;
          }
          this.toast_message(response.data.typem, response.data.title, response.data.message );
        } else {
          this.toast_message(response.data.typem, 'Failed', 'Failed update role' );
        }
      })
      .catch(function(response) {
        this.toast_message('error', 'Error#', 'Error#500' );
        window.location.href = '#/admin/vue-user';
	  });
  },
	toast_message(typem,title,message,event) {
      switch (typem) {
        case 'success':
          miniToastr.success(message, title);
          break;
        case 'error':
          miniToastr.error(message, title);
          break;
        case 'info':
          miniToastr.info(message, title);
          break;
      }
    },
    back() {
      window.location = '#/admin/user';
    }
  }
}
</script>
