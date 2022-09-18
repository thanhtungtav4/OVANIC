

const template = `
<div class="q-mt-lg">
    <loading-component v-if="isLoading" />
    
    <div v-else>
            <div class="row q-col-gutter-md">
                <div class="dash-item col-12">
                    <q-markup-table v-if="settings.custom_post.length">
                          <thead>
                            <tr>
                              <th class="text-left">#</th>
                              <th class="text-left">Custom post type</th>
                              <th class="text-left">Category</th>
                              <th class="text-left">Ux Element Name</th>
                              <th class="text-left">#</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="(cp, i) in settings.custom_post">
                              <td class="text-left">{{i+1}}</td>
                              <td class="text-left"> <q-input filled v-model="cp.post_type"  /></td>
                              <td class="text-left"> <q-input filled v-model="cp.category"  /></td>
                              <td class="text-left"> <q-input filled v-model="cp.ux_name"  /></td>
                              <td class="text-left">
                                <q-btn round color="accent" icon="delete" @click="delete_(cp)" size="sm"/>
                              </td>
                            </tr>
                          
                            
                          </tbody>
                        </q-markup-table>
                         <q-input hidden filled v-model="settings.haha" style="display:none"/>
                        <q-btn class="q-mt-sm" color="primary" icon="add" label="Add a new UX"  @click="add"/>
                        <q-btn class="q-mt-sm q-ml-sm" color="accent" icon="refresh" label="Save" @click="save"/>
                        <!-- <q-btn class="q-mt-sm q-ml-sm" color="accent" icon="refresh" label="Generate UX" @click="generate"/> -->
                </div>
             
            </div>
            

            
            
    </div>
</div>
`;


//import { getSettingss, updateSettings } from '../api/settings.js'
const { RV_CONFIGS } = window 
export default {
    data: () => ({
        confis: RV_CONFIGS,
        isLoading: false,
        settings: {
            haha: 'love',
            custom_post: [
                // {
                //     post_type: 'book',
                //     category: 'book_genre',
                //     ux_name: 'Book Posts'
                // }
            ]
        }
       
    }),
   
    methods: {
        add(){
            this.settings.custom_post.push({
                    post_type: '',
                    category: '',
                    ux_name: ''
                })
        },
        async delete_(cpt){
            const confirm = await this.CONFIRM('Bạn chắc chắn muốn xóa')
            if(confirm){
                const index = this.settings.custom_post.findIndex(el => el.post_type == cpt.post_type)
                this.settings.custom_post.splice(index,1)
                this.generate()
            }
        },
        generate(){
            axios.post(RV_CONFIGS.ajax_url, this.jsonToFormData({action: 'fsut_generate_custom_post_type', data: this.settings.custom_post})).then(res => {
                // this.NOTIFY('Cập nhật thành công');
                // this.save()
            })
        },
        save() {
            this.generate();
            this.$q.loading.show()
            axios.post(RV_CONFIGS.ajax_url, this.jsonToFormData({action: 'fsut_save_option',key: 'fsut_settings', data: this.settings})).then(res => {
                const {success, msg} = res.data
              
                this.NOTIFY(msg, success);
                this.$q.loading.hide()
                if(success)
                    window.fsut_settings = Object.assign({}, this.settings)
            })
        },
    },
	components:{

    },
    watch:{
      
    },
    template: template,
    created(){
    
        this.getConfigs().then(data => {
            this.settings = this.deepMerge(this.settings, data);
            console.log(this.settings)
        })
        this.$eventBus.$emit('set.page_title', 'Flatsome Utils MH');
        
    }

}