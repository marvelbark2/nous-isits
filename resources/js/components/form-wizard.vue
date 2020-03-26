<template>
    <form-wizard @on-complete="onComplete"
                      shape="tab"
                      color="#9b59b6">
            <tab-content title="Personal details"
                         icon="ti-user">
              My first tab content
            </tab-content>
            <tab-content title="Additional Info"
                         icon="ti-settings">
              My second tab content
            </tab-content>
            <tab-content title="Last step"
                         icon="ti-check">
              Yuhuuu! This seems pretty damn simple
            </tab-content>
    </form-wizard>
</template>


<script>
import {VueFormWizard, FormWizard} from 'vue-form-wizard';
Vue.use(VueFormWizard)

  export default {
      components: {
        VueFormWizard,
        FormWizard
    },
    methods: {
        onComplete: function(){
            alert('Yay. Done!');
         }
        }
  }

</script>

<style>

</style>
