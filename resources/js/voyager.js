
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

window._ = require('lodash');

window.swal = require('sweetalert');

window.Vue = require('vue');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
// TODO: inclute template section
Vue.component('data-sections', require('./components/DataSections.vue').default);

Vue.component('index-sections', require('./components/IndexSections.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// 
// courses
const $base_url = 'http://localhost:3000'

const app = new Vue({
    el: '#sections',
    data: {
        sections: [],
        materials: [],
    },
    methods: {
        addSection() {
            // console.log(this.sections.length);
            let title = document.getElementById('sectionTitle')
            axios.post(`${$base_url}/section`, {
                title: `${title.value}`,
                line: this.sections.length + 1,
                course_id: 1,
            })
            .then((response) => {
                console.log(response)
                this.sections.push(response.data)
                title.value = ''
                document.getElementById('close-modal').click()
                swal('Berhasil!', 'Data Berhasil Di Simpan', 'success')
            })
            .catch((error) => {
                console.log(error);
                swal('Gagal!', 'Data Gagal Di Simpan', 'error')
            });
        },
        deleteSection(param) {
            swal({
                title: 'Anda Yakin?',
                text: 'Data Akan Di Hapus Jika Anda Menekan OK',
                icon: 'error',
                dangerMode: true,
                buttons: {
                    cancel: true,
                    confirm: true,
                },
            }).then((val)=>{
                if (val) {
                    axios.delete(`${$base_url}/section/${param.id}`)
                    .then((response) => {
                        this.sections.splice(param.index, 1)
                    })
                    .catch((error) => {
                        console.log(error);
                        swal('Gagal!', 'Data Gagal Di Hapus', 'error')
                    });
                } else {
                    swal('Data Aman!', 'Data berhasil di amankan.', 'info')
                }
            })
        },
        addMaterial() {

        },
        deleteMaterial(param) {
            swal({
                title: 'Anda Yakin?',
                text: 'Data Akan Di Hapus Jika Anda Menekan OK',
                icon: 'error',
                dangerMode: true,
                buttons: {
                    cancel: true,
                    confirm: true,
                },
            }).then((val)=>{
                if (val) {
                    axios.delete(`${$base_url}/material/${param.id}`)
                    .then((response) => {
                        this.materials.splice(param.index, 1)
                    })
                    .catch((error) => {
                        console.log(error);
                        swal('Gagal!', 'Data Gagal Di Hapus', 'error')
                    });
                } else {
                    swal('Data Aman!', 'Data berhasil di amankan.', 'info')
                }
            })
        },
        generateWistia: () => {
            window._wapiq = window._wapiq || [];
                _wapiq.push(function(W) {
                    window.wistiaUploader = new W.Uploader({
                        theme: 'dark_background',
                        accessToken: `${process.env.WISTIA_TOKEN}`,
                        dropIn: "wistia_uploader",
                        projectId: `sfmij5j5nv`,
                        // button: $("[data-upload-button]")[0],
                    });
                    wistiaUploader.bind('uploadsuccess', function(file, media) {                
                        // let formData = new FormData() 
                        // formData.append('course_id', course_id);
                        // formData.append('section_id', );
                        // formData.append('type', 'VIDEO');
                        // formData.append('title', file.name);
                        // formData.append('file', '');
                        // formData.append('wistiaLink', media.id);
                        // formData.append('review', 0); 
                        // $.ajaxSetup({
                        // headers: {
                        //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        //     }
                        // });
                        // $.ajax({
                        //     url: '/material/store',
                        //     type: 'POST',
                        //     data: formData,
                        //     success: function (data) {
                        //         $('#materialsList' + data.section_id).append(data.view);
                        //         $('#modalAddMaterial' + data.section_id).modal('hide');
                        //         wistiaUploader.removePreview()
                        //         swal("Berhasil !", "Materi berhasil ditambahkan", "success");
                        //     },
                        //     error: function (error) {
                        //         $('#materialprogress' + sectionId).hide();

                        //         swal("Gagal !", "Materi gagal ditambahkan", "error");
                        //     },
                        //     cache: false,
                        //     contentType: false,
                        //     processData: false
                        // });
                    });
                });
        }
    },
    created() {
        
    },
    beforeMount() {
        this.generateWistia()
    },
});
