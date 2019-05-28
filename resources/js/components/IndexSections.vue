<template>
    <div class="root">
        <button class="btn btn-primary" data-toggle="modal" data-target="#add_section">+ Tambah</button>
        <div class="panel panel-bordered panel-primary"
        v-for="(section, index) in mysections"
        :key="index"
        >
            <div class="panel-heading">
                <h3 class="panel-title"><i class="icon wb-image"></i>{{section.line}}. {{section.title}}</h3>
                <div class="panel-actions">
                    <a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                </div>
            </div>
            <div class="panel-body">
                <button class="btn btn-primary" data-toggle="modal" data-target="#add_material">+ Video</button>
                <button class="btn btn-primary" data-toggle="modal" data-target="#add_excercies">+ Latihan</button>
                
                <div class="panel panel-bordered panel-info"
                v-for="(material, indexs) in materials"
                :key="indexs"
                >

                </div>
                <div class="float-right pnl-footer">
                    <button type="button" class="btn btn-danger" v-on:click="sectionDelete(index, section.id)">Hapus</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import swal from 'sweetalert';
const $base_url = 'http://localhost:3000'

export default {
    props: ['sections', 'materials'],
    data: () => {
        return {
            mysections: this.sections
        }
    },
    mounted() {
      console.log('template mounted')
    },
    created() {
        axios.get(`${$base_url}/section`)
            .then((response) => {
                this.mysections = response.data
                console.log(mysections);
                
            })
            .catch((error) => {
                console.log(error);
                swal('Gagal!', 'Data Gagal Di Ambil', 'error')
            });
    },
    methods: {
        sectionDelete(index, id) {
            alert(index, id)
            this.$emit('deleted-section', {
                index: index,
                id: id,
            });
        },
        materialDelete(index) {
            this.$emit('deleted-material', index);
        }
    }
}
</script>