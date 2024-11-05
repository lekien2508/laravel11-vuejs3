<template>
    Đây là trang quản lý Settings
</template>

<script setup>
    import { useMenu } from '../../../store/use-menu.js';

    const store = useMenu();
    store.onSelectedKeys(["admin-settings"]);
</script>