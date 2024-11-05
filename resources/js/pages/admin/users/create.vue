<template>
    <form @submit.prevent="createUser">
        <a-card title="Tạo mới Tài khoản" style="width: 100%;">
            <div class="row mb-3">
                <div class="col-12 col-sm-4">
                    <div class="row g-2">
                        <div class="col-12 d-flex justify-content-center">
                            <a-avatar shape="square" :size="200">
                                <template #icon>
                                    <img src="../../../assets/logo copy 2.png" alt="">
                                </template>
                            </a-avatar>
                        </div>
                        <div class="col-12 d-flex justify-content-center">
                            <a-button type="primary">
                                <font-awesome-icon :icon="['fas', 'plus']" class="me-2" />
                                <span>Chọn ảnh</span>
                            </a-button>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-8">
                    <div class="row mb-3">
                        <div class="col-12 col-sm-3 text-start text-sm-end">
                            <label>
                                <span class="text-danger me-1">*</span>
                                <span
                                    :class="{'text-danger':errors.status_id}"
                                >Tình trạng</span>
                            </label>
                        </div>
                        <div class="col-12 col-sm-5">
                            <a-select
                                show-search
                                placeholder="Tình trạng"
                                style="width: 100%"
                                :options="users_status"
                                :filter-option="filterOption"
                                v-model:value="status_id"
                                :class="{'select-danger':errors.status_id}"
                            ></a-select>
                            <div class="w-100"></div>
                            <small v-if="errors.status_id" class="text-danger">{{ errors.status_id[0] }}</small>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-12 col-sm-3 text-start text-sm-end">
                            <label>
                                <span class="text-danger me-1">*</span>
                                <span
                                    :class="{'text-danger':errors.username}"
                                >Tên Tài Khoản</span>
                            </label>
                        </div>
                        <div class="col-12 col-sm-5">
                            <a-input 
                                placeholder="Tên Tài Khoản" 
                                allow-clear 
                                v-model:value="username" 
                                :class="{'input-danger':errors.username}"
                            />
                            <div class="w-100"></div>
                            <small v-if="errors.username" class="text-danger">{{ errors.username[0] }}</small>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12 col-sm-3 text-start text-sm-end">
                            <label>
                                <span class="text-danger me-1">*</span>
                                <span
                                    :class="{'text-danger':errors.name}"
                                >Họ Tên</span>
                            </label>
                        </div>
                        <div class="col-12 col-sm-5">
                            <a-input 
                                placeholder="Họ Tên" 
                                allow-clear 
                                v-model:value="name" 
                                :class="{'input-danger':errors.name}"
                            />
                            <div class="w-100"></div>
                            <small v-if="errors.name" class="text-danger">{{ errors.name[0] }}</small>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12 col-sm-3 text-start text-sm-end">
                            <label>
                                <span class="text-danger me-1">*</span>
                                <span
                                    :class="{'text-danger':errors.email}"
                                >Email</span>
                            </label>
                        </div>
                        <div class="col-12 col-sm-5">
                            <a-input 
                                placeholder="Email" 
                                allow-clear 
                                v-model:value="email" 
                                :class="{'input-danger':errors.email}"
                            />
                            <div class="w-100"></div>
                            <small v-if="errors.email" class="text-danger">{{ errors.email[0] }}</small>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12 col-sm-3 text-start text-sm-end">
                            <label>
                                <span class="text-danger me-1">*</span>
                                <span
                                    :class="{'text-danger':errors.department_id}"
                                >Phòng ban</span>
                            </label>
                        </div>
                        <div class="col-12 col-sm-5">
                            <a-select
                                show-search
                                placeholder="Phòng ban"
                                style="width: 100%"
                                :options="departments"
                                :filter-option="filterOption"
                                v-model:value="department_id"
                                :class="{'select-danger':errors.department_id}"
                            ></a-select>
                            <div class="w-100"></div>
                            <small v-if="errors.department_id" class="text-danger">{{ errors.department_id[0] }}</small>
                            <!-- <a-button>
                                <font-awesome-icon :icon="['fas', 'plus']" />
                            </a-button> -->
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12 col-sm-3 text-start text-sm-end">
                            <label>
                                <span class="text-danger me-1">*</span>
                                <span
                                    :class="{'text-danger':errors.password}"
                                >Mật Khẩu</span>
                            </label>
                        </div>
                        <div class="col-12 col-sm-5">
                            <a-input-password 
                                placeholder="Mật Khẩu" 
                                allow-clear 
                                v-model:value="password" 
                                :class="{'input-danger':errors.password}"
                            />
                            <div class="w-100"></div>
                            <small v-if="errors.password" class="text-danger">{{ errors.password[0] }}</small>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12 col-sm-3 text-start text-sm-end">
                            <label>
                                <span class="text-danger me-1">*</span>
                                <span>Xác Nhận Mật Khẩu</span>
                            </label>
                        </div>
                        <div class="col-12 col-sm-5">
                            <a-input-password 
                                placeholder="Xác Nhận Mật Khẩu" 
                                allow-clear 
                                v-model:value="password_confirmation" 
                            />
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 d-grid mx-auto d-sm-flex justify-content-sm-end">
                        <router-link :to="{ name:'admin-users' }">
                            <a-button class="me-sm-2 mb-3">
                                <span>Hủy</span>
                            </a-button>
                        </router-link>
                    <a-button type="primary" html-type="submit">
                        <span>Lưu</span>
                    </a-button>
                </div>
            </div>
        </a-card>
    </form>     
</template>

<script>
    import { defineComponent, ref, reactive, toRefs } from "vue";
    import { useRouter } from "vue-router";
    import { message } from "ant-design-vue";
    import { useMenu } from '../../../store/use-menu.js';
    import axios from "axios";
    export default defineComponent({
        setup() {
            const store = useMenu();
            store.onSelectedKeys(["admin-users"]);

            const router = useRouter();
            const users_status = ref([]);
            const departments = ref([]);
            const users = reactive({
                username: "",
                name: "",
                email: "",
                password: "",
                password_confirmation: "",
                department_id: [],
                status_id: []
            });

            const errors = ref({});

            const getUsersCreate = () => {
                axios
                    .get("http://127.0.0.1:8000/api/users/create")
                    .then(
                        (response) => {
                            // console.log(response);
                            users_status.value = response.data.users_status;
                            departments.value = response.data.departments;
                    })
                    .catch(
                        (error) => {
                            // console.log(error);
                        }
                    );
            };

            const filterOption = (input, option) => {
                return option.label.toLowerCase().indexOf(input.toLowerCase()) >= 0;
            };

            const createUser = () => {
                axios
                    .post("http://127.0.0.1:8000/api/users/create", users)
                    .then(
                        (response) => {
                            if(response){
                                message.success('Tạo mới thành công');
                                router.push({ name:"admin-users" });
                            }
                        }
                    )
                    .catch(
                        (error) => {
                            if(error.response && error.response.data){
                                errors.value = error.response.data.errors;
                            }
                        }
                    );

            }

            getUsersCreate();

            return {
                users_status, departments, ...toRefs(users), errors, filterOption, createUser
            }
        }
    })
</script>

<style>
    .select-danger, .input-danger {
        border: 1px solid red;
    }
</style>