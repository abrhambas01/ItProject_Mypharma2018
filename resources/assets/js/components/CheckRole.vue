<template>
	<div>
		<div class="form-group row role_id" id="form-group-role">
			<div class="col-md-9">
				<div class="form-material">
					<select name="role_id" id="role_id" class="form-control" > 
						<option :value="role.id" v-for="role in roles">{{ role.name }}</option>
					</select>

					<label for="material-select">Member Type</label>
					
				</div>
			</div>
		</div>


		<div class="form-group row add_barangay_id" id="form-group-barangay" v-show="!isSocialWorker">
			<div class="col-md-9">
				<div class="form-material">
					<select name="barangay_id" id="barangay_id" class="form-control" > 
						<option class="selection" v-for="barangay in barangays" :value="barangay.id">{{ barangay.name }}</option>
					</select>
					<label for="material-select">Assign Barangay</label>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {

	name: 'CheckRole',

	data () {
		return {
			isSocialWorker : true ,
			barangays : [] ,
			roles :  [], 
		};
	},
	methods : {

		getRoles(){
			axios.get('/roles') 
			.then(response => this.roles = response.data)
			.catch(error => console.log(error.response.data));
		},

		getBarangays(){
			axios.get('/barangays') 
			.then(response => this.barangays = response.data)
			.catch(error => console.log(error.response.data));
		}

	},


	mounted(){
		this.getRoles() ; 
		this.getBarangays() ;
	}
};
</script>

<style lang="css" scoped>
</style>