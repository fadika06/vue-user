<template>
    <div>
		<div class="card mb-3">
			<div class="card-header">
				<span>
					<i class="fa fa-table" aria-hidden="true"></i> User [ {{ model.name }} ]
				</span>

        <ul class="nav nav-pills card-header-pills pull-right">
          <li class="nav-item">
            <button class="btn btn-success btn-sm ml-2" role="button" @click="goToEdit">
              <i class="fa fa-pencil" aria-hidden="true"></i> Edit
            </button>
            <button class="btn btn-warning btn-sm ml-2" role="button" @click="goToSetRole">
              <i class="fa fa-key" aria-hidden="true"></i> Set Role
            </button>
            <button class="btn btn-primary btn-sm ml-2" role="button" @click="back">
              <i class="fa fa-arrow-left" aria-hidden="true"></i>
            </button>
          </li>
        </ul>
			</div>

			<div class="card-body">
				<dl class="row">
					<dt class="col-2">Name</dt>
					<dd class="col-10">{{ model.name }}</dd>

					<dt class="col-2">Email</dt>
					<dd class="col-10">{{ model.email }}</dd>

          <dt class="col-2">Password</dt>
					<dd class="col-10">{{ model.password }}</dd>
				</dl>
			</div>

	    </div>
  </div>

</template>

<script>
export default {
  mounted() {
    axios.get('api/vue-user/' + this.$route.params.id)
      .then(response => {
        if (response.data.status == true) {
          this.model.email = response.data.user.email;
          this.model.name = response.data.user.name;
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
        password: "*********"
	  }
    }
  },
  methods: {
  goToEdit(){
    window.location = '#/admin/user/'+this.$route.params.id+'/edit';
  },
  goToSetRole(){
    window.location = '#/admin/user/add-user-role/'+this.$route.params.id;
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
