<script setup>
import axios from "axios";
import { BButton, BModal, BTable } from "bootstrap-vue-next";
import { ref, onMounted } from "vue";


const fields = ['name', 'code', 'description', 'status']
let responseData = ref([]);

const getAllItems = async () => {
    try {
        const response = await axios.get("/api/items");
        responseData.value = response.data;

    } catch (error) {
        console.log(error);
    }
};

const deleteModal = ref(false);
const itemToDelete = ref(null);

const openDeleteModal = (item) => {
    itemToDelete.value = item;
    deleteModal.value = true;
}

const confirmDelete = async () => {
    if (!itemToDelete) return;

    try {
        await axios.delete(`api/items/${itemToDelete.value.id}`);
        responseData.value = responseData.value.filter(
            (item) => item.id !== itemToDelete.value.id
        );
        deleteModal.value = false;
        itemToDelete.value = null;
    } catch (error) {
        console.log(error);
    }
};

const updateItem = async (id) => {
    console.log("Update", id);
}



onMounted(() => {
    getAllItems();
});

</script>

<template>
    <div class="text-white">
        <h2 class="d-flex justify-content-center py-4">ASSETS</h2>
        <!-- <router-link to="/test"> Take me to Test page </router-link> -->
    </div>

    <div class="d-flex flex-column">
        <div class="d-flex  justify-content-end mr-4">
            <b-button variant="success px-5" @click=createItem()>Create</b-button>
        </div>
        <div class="p-2 shadow-lg">
            <table class="table table-striped table-hover table-bordered text-center text-white table-dark text-wrap-table">
                <thead>
                    <tr class="table-info text-dark">
                        <!-- <th>ID</th> -->
                        <th>S.No</th>
                        <th>NAME</th>
                        <th>CODE</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in responseData" :key="item.id">
                        <!-- <td>{{ item.id }}</td> -->
                        <td >{{ index + 1 }}</td>
                        <td class="text-wrap text-break text-truncate" style="max-width: 200px;">{{ item.name }}</td>
                        <td>{{ item.code }}</td>
                        <td class="text-wrap text-break" >{{ item.description }}</td>
                        <td>{{ item.status }}</td>
                        <td>
                            <b-button variant="primary" class="m-2" @click=updateItem(item)>Update</b-button>
                            <b-button variant="danger" class="m-2" @click="openDeleteModal(item)">Delete</b-button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <b-modal v-model="deleteModal" title="Confirm Delete" ok-title="Delete" ok-variant="Danger" @ok="confirmDelete()"
        class="overflow-auto ">
        Are you sure you want to delete <span class="text-break"><b>{{ itemToDelete?.name }}-{{ itemToDelete?.code
                }}</b></span>
    </b-modal>
</template>
