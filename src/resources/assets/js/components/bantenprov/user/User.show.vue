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
