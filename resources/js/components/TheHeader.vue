<template>
    <div class="container-fluid">
        <div class="row text-white" style="background-color: #0c713d; padding:1rem">
            <div class="col-1 d-sm-none d-flex align-items-center justify-items-center">
                <span @click="showDrawer">
                    <font-awesome-icon icon="align-justify" />
                </span>
            </div>
            <div class="col-10 col-sm-9 d-flex align-items-center justify-content-center justify-content-sm-start">
                <img src="../assets/logo copy 2.png" alt="logo" height="30" width="30">
                <span class="d-none d-sm-flex">QUẢN TRỊ</span>
            </div>
            <div class="col-sm-3 d-none d-sm-flex align-items-center justify-content-sm-end">
                <span>Admin</span>
            </div>
            <div class="col-1 d-flex d-sm-none align-items-center justify-items-center">
                <span @click="showDrawerUser">
                    <font-awesome-icon icon="user" />
                </span>
            </div>
        </div>
    </div>

    <a-drawer
        v-model:open="open"
        title="Danh Mục"
        placement="left"
    >
       <TheMenu/>
    </a-drawer>

    <a-drawer
        v-model:open="open_user"
        title="Admin"
        placement="right"
    >
        <p>Some contents...</p>
        <p>Some contents...</p>
        <p>Some contents...</p>
    </a-drawer>
</template>

<script setup>
    import TheMenu from './TheMenu.vue';
    import { defineComponent, ref } from 'vue';

    const open = ref(false);
    const open_user = ref(false);
    const showDrawer = () => {
        open.value = true;
    };

    const showDrawerUser = () => {
        open_user.value = true;
    };
</script>