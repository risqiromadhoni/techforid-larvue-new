<template>
  <div class="panel panel-bordered panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title"><i class="icon wb-image"></i>{{section}} : {{index + 1}}</h3>
      <div class="panel-actions">
        <a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
      </div>
    </div>
    <div class="panel-body">
      <div class="float-right pnl-footer">
        <button type="button" class="btn btn-danger" v-on:click="sectionDelete(index)">Hapus</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
    props: ['section', 'index'],
    mounted() {
      console.log('template mounted')
    },
    methods: {
      deletedSection(index) {
        // this.$emit('sectionDelete', index);
        
      }
    }
}
</script>

<style scope="this api replaced by slot-scope in 2.5.0+">

</style>

