<script setup>
import { BButton, BModal, BTable } from "bootstrap-vue-next";
import { ref, onMounted } from "vue";
import FetchItems from "../functions/FetchItems";
import CreateItem from '../functions/CreateItem'
import DeleteItem from "../functions/DeleteItem";
import EditItem from "../functions/UpdateItem";

const { items, getAllItems } = FetchItems();
const { confirmCreate, createModal, newItem, openCreateModal } = CreateItem(items);
const { deleteModal, itemToDelete, openDeleteModal, confirmDelete } = DeleteItem(items);
const { editModal, editItem, openEditModal, confirmEdit } = EditItem(items);


onMounted(() => {
    getAllItems();
});

</script>

<template>
    <div class="text-white">
        <h2 class="d-flex justify-content-center py-4">ASSET MANAGEMENT</h2>
        <!-- <router-link to="/test"> Take me to Test page </router-link> -->
    </div>

    <div class="d-flex flex-column">
        <div class="d-flex  justify-content-end mr-4">
            <b-button variant="success px-5" @click=openCreateModal()>Create</b-button>
        </div>
        <div class="p-2 shadow-lg">
            <table
                class="table table-striped table-hover table-bordered text-center text-white table-dark text-wrap-table">
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
                    <tr v-for="(item, index) in items" :key="item.id">
                        <!-- <td>{{ item.id }}</td> -->
                        <td>{{ index + 1 }}</td>
                        <td class="text-wrap text-break text-truncate" style="max-width: 200px;">{{ item.name }}</td>
                        <td>{{ item.code }}</td>
                        <td class="text-wrap text-break">{{ item.description }}</td>
                        <td>{{ item.status }}</td>
                        <td>
                            <b-button variant="primary" class="m-2" @click=openEditModal(item)>Update</b-button>
                            <b-button variant="danger" class="m-2" @click="openDeleteModal(item)">Delete</b-button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <b-modal v-model="deleteModal" title="Confirm Delete" ok-title="Delete" ok-variant="danger" @ok="confirmDelete()"
        class="overflow-auto ">
        Are you sure you want to delete <span class="text-break"><b>{{ itemToDelete?.name }}-{{ itemToDelete?.code
                }}</b></span>
    </b-modal>

    <b-modal v-model="createModal" title="Create Item" ok-title="Save" ok-variant="success" @ok="confirmCreate">
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input v-model="newItem.name" type="text" class="form-control" required />
        </div>

        <div class="mb-3">
            <label class="form-label">Code</label>
            <input v-model="newItem.code" type="text" class="form-control" required />
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea v-model="newItem.description" class="form-control" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select v-model="newItem.status" class="form-select">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>
    </b-modal>

    <b-modal v-model="editModal" title="Edit Item" ok-title="Update" ok-variant="primary" @ok="confirmEdit">
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input v-model="editItem.name" class="form-control" />
        </div>

        <div class="mb-3">
            <label class="form-label">Code</label>
            <input v-model="editItem.code" class="form-control" />
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea v-model="editItem.description" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select v-model="editItem.status" class="form-select">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>
    </b-modal>
</template>