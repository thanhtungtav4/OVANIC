<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://dominhhai.com/
 * @since      1.0.0
 *
 * @package    Wordpress_Review_Mh
 * @subpackage Wordpress_Review_Mh/admin/partials
 */
?>
<div class="wrap-mh">
<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons" rel="stylesheet" type="text/css">

<link href="<?php echo FLATSOME_UTILS_MH_URL ?>/admin/css/animate.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo FLATSOME_UTILS_MH_URL ?>/admin/css/quasar.min.css" rel="stylesheet" type="text/css">

<script src="<?php echo FLATSOME_UTILS_MH_URL ?>/admin/js/vue.min.js"></script>
<script src="<?php echo FLATSOME_UTILS_MH_URL ?>/admin/js/quasar.umd.min.js"></script>
<script src="<?php echo FLATSOME_UTILS_MH_URL ?>/admin/js/vue-router.js"></script>
<script src="<?php echo FLATSOME_UTILS_MH_URL ?>/admin/js/axios.js"></script>
<style>
  .card-item {
      border: none;
      margin-bottom: 1rem;
      -webkit-box-shadow: 0 4px 24px 0 rgb(34 41 47 / 10%);
      box-shadow: 0 4px 24px 0 rgb(34 41 47 / 10%);
      border-radius: .428rem;
      overflow: hidden;
      padding: 1.5rem;
  }
  .card-name{
    font-weight: 400;
    font-size: 0.875rem;
    color: rgb(94, 88, 115);
  }
  .card-number{
    line-height: 1.2;
    color: rgb(94, 88, 115);
    font-size: 1.514rem;
    font-weight: 500;
    letter-spacing: 0px;
    margin-top: 5px;
  }
</style>
<script>
    window.quasarConfig = {
      brand: { // this will NOT work on IE 11
        primary: '',
        // ... or all other brand colors
      },
      notify: {}, // default set of options for Notify Quasar plugin
      loadingBar: {
        color: 'blue'
      }
      // ..and many more (check Installation card on each Quasar component/directive/plugin)
    }
    window.RV_CONFIGS = {
      plugin_url: '<?php echo FLATSOME_UTILS_MH_URL ?>',
        site_url: '<?php echo get_site_url() ?>',
        ajax_url: '<?php echo admin_url('admin-ajax.php') ?>',
    }
</script>



<div id="q-app">
    <div class="q-pa-md">

        <q-toolbar class="bg-primary text-white">
          <q-btn round dense icon="west" color="pink" class="q-mr-sm" to="/" v-show="$route.path != '/'"></q-btn>
              <!-- <q-btn flat round dense icon="wifi_tethering" class="q-mr-sm" to="/" v-show="$route.path == '/'"></q-btn> -->
          <!-- <q-btn flat round dense icon="menu" class="q-mr-sm" to="/" v-show="$route.path == '/'"></q-btn> -->
              <q-avatar to="/" class="quasar-logo" v-show="$route.path == '/'">
                <img :src="logo">
            <!-- <img :src="https://cdn.quasar.dev/logo/svg/quasar-logo.svg"> -->
              </q-avatar>

              <q-toolbar-title>{{page_title}}</q-toolbar-title>
               <q-space></q-space>
                <q-tabs>
                  <q-route-tab to="/" exact label="Custom Post Type"></q-route-tab>
                </q-tabs>

              <q-btn flat round dense icon="whatshot" @click="openURL('https://dominhhai.com')"></q-btn>
        </q-toolbar>
       
     


      <transition  name="fade" mode="out-in">
            <router-view></router-view>
      </transition>
        
            
    </div>
</div>

<script type='module'>
      /*
        Example kicking off the UI. Obviously, adapt this to your specific needs.
        Assumes you have a <div id="q-app"></div> in your <body> above
       */
       import settingsPage from '<?php echo FLATSOME_UTILS_MH_URL ?>/admin/partials/pages/setting.js';
       
       import emptyComponent from '<?php echo FLATSOME_UTILS_MH_URL ?>/admin/partials/components/data-empty.js';
       import loading from '<?php echo FLATSOME_UTILS_MH_URL ?>/admin/partials/components/loading.js';
       import {  getConfigs } from "<?php echo FLATSOME_UTILS_MH_URL ?>/admin/partials/api/config.js";
       
       // import VueEasyLightbox from 'https://unpkg.com/vue-easy-lightbox@next/dist/vue-easy-lightbox.esm.min.js';
       const EventBus = new Vue()

       const router = new VueRouter({
           routes: [
                { path: '/', component: settingsPage }, // Root IndexIndex
               
             ]
       });
       Vue.prototype.$eventBus = EventBus
       Vue.component('empty-component', emptyComponent)
       Vue.component('loading-component', loading)
       Vue.mixin({
         methods:{
          openURL(url){
            Quasar.utils.openURL(url)
          },
          addCommas(nStr) {
                      nStr += '';
                      let x = nStr.split('.');
                      let x1 = x[0];
                      let x2 = x.length > 1 ? '.' + x[1] : '';
                      let rgx = /(\d+)(\d{3})/;
                      while (rgx.test(x1)) {
                          x1 = x1.replace(rgx, '$1' + ',' + '$2');
                      }
                      return x1 + x2;
          },
          formatDateRange(date){
              const replaceW = (d) => {
                  return d.split('/').join('-');
              }

              if(date == '')
                  return '';
              if(typeof date == 'object')
                  return {from: replaceW(date.from), to: replaceW(date.to)}
              else
                  return {from: replaceW(date), to: replaceW(date)}
          },
          formatDateMoment(mysqlDate, format = 'DD/MM/YYYY HH:mm'){
            return moment(mysqlDate, "YYYY/MM/DD HH:mm:ss").format(format)
          },
            buildFormData(formData, data, parentKey) {
                if (data && typeof data === 'object' && !(data instanceof Date) && !(data instanceof File)) {
                  Object.keys(data).forEach(key => {
                    this.buildFormData(formData, data[key], parentKey ? `${parentKey}[${key}]` : key);
                  });
                } else {
                  const value = data == null ? '' : data;

                  formData.append(parentKey, value);
                }
              },
            jsonToFormData(data) {
                const formData = new FormData();

                this.buildFormData(formData, data);

                return formData;
            },
            NOTIFY(msg, type = true){
                this.$q.notify({
                    message: msg,
              progress: true,
              type: type == true ? 'positive' : 'negative',
                    color: type == true ? 'green' : 'red',
                    position: 'top',
                    timeout: 2000
                  })    
            },
           PROMPT(text){
             console.log(text);
            return new Promise((res, rej) => {
              this.$q.dialog({
                title: 'Xác nhận',
                message: text,
                prompt: {
                  model: '',
                  type: 'text' // optional
                },
                cancel: true,
                persistent: true
              }).onOk((data) => {
                res(data)
              }).onCancel(() => {
                res(false)

              })
            })
          },
          CONFIRM(text){
            return new Promise((res, rej) => {
              this.$q.dialog({
                title: 'Xác nhận',
                message: text,
                cancel: true,
                persistent: true,
                
              }).onOk(() => {
                res(true)
              }).onCancel(() => {
                res(false)

              })
            })
          },

            deepMerge(target, source) {
                        Object.entries(source).forEach(([key, value]) => {
                            if (value && typeof value === 'object') {
                                this.deepMerge(target[key] = target[key] || {}, value);
                                return;
                            }
                            target[key] = value;
                        });
                        return target;
            },
            getConfigs() {

            return new Promise((resolve, reject) => {
                if (window.hasOwnProperty('fsut_settings'))
                    resolve(window.fsut_settings)
                else {
                    axios.post(RV_CONFIGS.ajax_url, this.jsonToFormData({
                        action: 'fsut_get_option',
                        key: 'fsut_settings'
                    })).then(res => {

                        const {
                            success,
                            data
                        } = res.data
                        if (success && data) {
                            window.fsut_settings = data
                            resolve(data)
                        }
                    })
                }

            })

        }
          
         }
       })

      new Vue({
        router,
        el: '#q-app',
        data: function () {
          return {
            page_title: 'Flatsome Utils MH',
            lightbox: {
                toggler: false,
                sources: [],
                id: 0
            },
            logo: `${window.RV_CONFIGS.plugin_url}/public/images/virus.svg`
            // configs: window.RV_CONFIGS
            
          }
        },
        methods: {
          setPageTitle(title){
            this.page_title = title
          }
        },
        components:{

        },
        created(){
          this.getConfigs()
            EventBus.$on('set.page_title', this.setPageTitle);
          
        }
        // 
      });




      //Set Height Div Wrap
      const setViewPort = () => {

          const vh = Math.max(document.documentElement.clientHeight || 0, window.innerHeight || 0);
          document.querySelector(".wrap-mh").style.minHeight = `${vh - 120}px`;
      }
      window.onresize = () => {
        setViewPort();
      }
      setViewPort();

      //Fix Admin Href 
      const aList = document.querySelectorAll('#adminmenu a');
      aList.forEach(el => {
        const href = el.getAttribute("href");
        el.href = window.RV_CONFIGS.site_url + '/wp-admin/' + href;
      })
      // document.querySelector('.toplevel_page_wp_reviews_mh img').classList.add("rotating");
      document.title = 'WP Affiliate MH'

      document.querySelector('body').classList.add("wp-review-q-app");

</script>
</div>