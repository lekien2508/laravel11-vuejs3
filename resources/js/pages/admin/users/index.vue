<template>
    <a-card title="Tài khoản" style="width: 100%">
        <div class="row mb-3">
            <div class="col-12 d-flex justify-content-end">
                <router-link :to="{name: 'admin-users-create'}">
                    <a-button type="primary">
                        <font-awesome-icon :icon="['fas', 'plus']" />
                    </a-button>
                </router-link>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <a-table :dataSource="users" :columns="columns" :scroll="{ x: 576 }">
                    <template #bodyCell="{ column, index, record }">
                        <template v-if="column.key === 'index'">
                            <span>{{ index + 1 }}</span>
                        </template>

                        <template v-if="column.key == 'status'">
                            <span v-if="record.status_id == 1" class="text-primary">{{ record.status }}</span>
                            <span v-else-if="record.status_id == 2" class="text-danger">{{ record.status }}</span>
                        </template>

                        <template v-if="column.key == 'action'">
                            <router-link :to="{name: 'admin-users-edit', params:{id:record.id}}">
                                <a-button type="primary" class="me-sm-2 mb-2">
                                    <font-awesome-icon :icon="['far', 'pen-to-square']" />
                                </a-button>
                            </router-link>

                                <a-button type="primary" danger @click="deleteUsers(record.id)">
                                    <font-awesome-icon :icon="['far', 'trash-can']" />
                                </a-button>
                        </template>
                    </template>
                </a-table>
            </div>
        </div>
    </a-card>
</template>

<script setup>
    import { ref, createVNode } from 'vue';
    import { useMenu } from '../../../store/use-menu.js';
    import { ExclamationCircleOutlined } from '@ant-design/icons-vue';
    import { Modal, message } from 'ant-design-vue';
    import axios from 'axios';

    const store = useMenu();
    store.onSelectedKeys(["admin-users"]);

    const users = ref([]);
    const columns = [
        {
            title: '#',
            key: 'index'
        },
        {
            title: 'Avatar',
            dataIndex: 'avatar',
            key: 'avatar'
        },
        {
            title: 'Tài khoản',
            dataIndex: 'username',
            key: 'username'
        },
        {
            title: 'Họ tên',
            dataIndex: 'name',
            key: 'name'
        },
        {
            title: 'Phòng ban',
            dataIndex: 'department',
            key: 'department',
            responsive: ['sm'] //Chi hien thi o kich thuoc sm
        },
        {
            title: 'Vai trò',
            dataIndex: '',
            key: ''
        },
        {
            title: 'Tình trạng',
            dataIndex: 'status',
            key: 'status'
        },
        {
            title: 'Công cụ',
            key: 'action',
            fixed: 'right'
        },
    ];
    const getUsers = () => {
        axios.get('http://127.0.0.1:8000/api/users')
            .then(function (response) {
                // handle success
                console.log(response);

                users.value = response.data;
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
    }

    const deleteUsers = (id) => {
        Modal.confirm({
            title: 'Bạn có chắc chắn muốn xóa không?',
            icon: createVNode(ExclamationCircleOutlined),
            content: 'Click Ok để xóa, Click Cancel để hủy',
            onOk() {
                axios
                    .delete(`http://127.0.0.1:8000/api/users/${id}`)
                    .then((response) => {
                        if(response.status == 200){
                            message.success("Xóa tài khoản thành công");
                            getUsers();
                        }
                    })
                    .catch((error) => {

                    });
            },
            // eslint-disable-next-line @typescript-eslint/no-empty-function
            onCancel() {},
        });
    }

    // const getUsers2 = async () => {
    //     try {
    //         const response = await axios.get('/user?ID=12345');
    //         console.log(response);
    //     } catch (error) {
    //         console.error(error);
    //     }
    // }

    getUsers();
</script>
