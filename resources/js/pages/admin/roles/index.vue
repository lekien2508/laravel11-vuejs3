<template>
    Đây là trang quản lý Role
</template>

<script setup>
    import { useMenu } from '../../../store/use-menu.js';

    const store = useMenu();
    store.onSelectedKeys(["admin-roles"]);
</script>