<template>
  <div>	
    
    <input :id="'todo'+id" type="checkbox" @click="toggle" :checked="isPacked" >

    <label :for="'todo'+id">Parcel Number : {{ id }}</label> 
    
    <span v-for="p in ownersUniqueNames">Owner : {{ p.owner.first_name }} {{ p.owner.last_name}} </span>
    
    <span v-for="p in parcel">Medicine ID : {{ p.medicine_id }} - {{ p.qty }} pcs</span>

  </div>
</template>

<script>
import _ from 'lodash';

export default {

 name: 'DeliveryParcels',
 
 props : ['parcel','index'],
 
 data () {

  return {
    
    isPacked : false ,

    id : this.index,

   // medicine_id : this.parcel.index ,
   // qty : this.parcel.qty , 
   // products : [],
   // owner_name  : this.parcel.owner.first_name +' ' +this.parcel.owner.last_name

 }

}, 


computed : {

  checkEndpoint(){
    return 'api/parcel/check/' +this.id ; 
  } ,

  uncheckEndpoint(){
    return 'api/parcel/uncheck/' +this.id ; 
  } ,


  ownersUniqueNames(){
    return _.uniqBy(this.parcel, function (p) {
      return p.owner.first_name + p.owner.last_name;
    });
  }

},

methods : { 

  toggle(){

    console.log(this.id);

    this.isPacked ?  this.check() : this.uncheck() ; 

    axios.post('api/parcel/' + this.id + '/state', { packed: this.isPacked })


    // axios.post('api/parcel/' + this.id + '/state', { packed: this.isPacked })


  },


  check(){

    axios.post(this.checkEndpoint) ; 

    this.isPacked = false ; 

  } , 

  uncheck(){

    axios.post(this.uncheckEndpoint) ; 

    this.isPacked = true ; 

  }
},


mounted(){


}



};
</script>

<style lang="css" scoped>

</style>