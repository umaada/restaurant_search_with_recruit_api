<template>

<div>
  <div class="form-group">
    <label for="large-area">大エリア</label>
    <select name="large-area" v-model="selectedLargeArea" @change="largeAreaOnChange($event)" id="large-area" class="form-control">
      <option v-for="largeArea in largeAreas" :value="largeArea.code">{{ largeArea.name }}</option>
      <option value="">指定なし</option>
    </select>
  </div>
  <div class="form-group">
    <label for="middle-area">中エリア</label>
    <select name="middle-area" v-model="selectedMiddleArea" @change="middleAreaOnChange($event)" id="middle-area" class="form-control">
      <option v-for="middleArea in middleAreas" :value="middleArea.code">{{ middleArea.name }}</option>
    </select>
  </div>
  <div class="form-group">
    <label for="small-area">小エリア</label>
    <select name="small-area" v-model="selectedSmallArea" id="small-area" class="form-control">
      <option v-for="smallArea in smallAreas" :value="smallArea.code">{{ smallArea.name }}</option>
    </select>
  </div>

</div>

</template>

<script>

  export default {

    props: ['largeAreas'],

    data: function() {
      let urlParams = new URLSearchParams(window.location.search);
      return {
        selectedLargeArea: urlParams.get('large-area'),
        selectedMiddleArea: urlParams.get('middle-area'),
        selectedSmallArea: urlParams.get('small-area')
      }
    },

    computed: {

      middleAreas() {
        if(this.selectedLargeArea){
          let areas = this.largeAreas.find((x) => x.code === this.selectedLargeArea).middle_areas;
          return [
            ...areas,
            { code: '', name:'指定なし'}
          ]
        }else{
          return []
        }
      },

      smallAreas() {
        if(this.selectedMiddleArea){
          let areas = this.middleAreas.find((x) => x.code === this.selectedMiddleArea).small_areas;
          return [
            ...areas,
            { code: '', name:'指定なし'}
          ]
        }else{
          return []
        }
      }
    },


    methods: {
      largeAreaOnChange(event){
        this.selectedMiddleArea = null
        this.selectedSmallArea = null
      },
      middleAreaOnChange(event){
        this.selectedSmallArea = null
      }

    }



  }

</script>
