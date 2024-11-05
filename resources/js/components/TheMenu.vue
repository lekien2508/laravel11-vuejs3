<template>
    <a-menu
      v-model:openKeys="openKeys"
      v-model:selectedKeys="selectedKeys"
      mode="inline"
      :items="items"
    ></a-menu>
</template>

<script setup>
    import { UserOutlined, SettingOutlined, KeyOutlined } from '@ant-design/icons-vue';
    import { reactive, h, defineComponent } from 'vue';
    import { RouterLink } from 'vue-router';
    import { storeToRefs } from 'pinia';
    import { useMenu } from '../store/use-menu.js';

    // const state = reactive({
    //     selectedKeys: ['admin-users'],
    //     openKeys: []
    // });

    // export default defineComponent({
    //     setup() {
    //         const store = useMenu();
    //         // const {selectedKeys, openKeys} = store;
    //         return{
    //             ...storeToRefs(store)
    //             // selectedKeys, openKeys
    //         };
    //     }
    // });

    // components: {
    //   MessageOutlined,
    // },

    const store = useMenu();
    const {selectedKeys, openKeys} = storeToRefs(store);
    
    const items = reactive([
        {
            key: 'admin-users',
            label: h(
                RouterLink, 
                { to: { name: 'admin-users' } }, 
                () => [h(
                    'span',
                    [h(
                        UserOutlined, 
                        {class: 'me-1'}),
                        'Tài khoản'
                    ]
                )]
            )
        },
        {
            key: 'admin-roles',
            label: h(
                RouterLink, 
                {to: { name: 'admin-roles' }}, 
                () => [h(
                    'span', 
                    [h(
                        KeyOutlined,
                        {class: 'me-1'}),
                        'Vai trò'
                    ]
                )]
            )
        },
        {
            key: 'admin-settings',
            label: h(
                RouterLink, 
                {to: { name: 'admin-settings' }}, 
                () => [h(
                    'span', 
                    [h(
                        SettingOutlined,
                        {class: 'me-1'}),
                        'Cài đặt'

                    ]
                )]
            )
        }
    ]);
</script>