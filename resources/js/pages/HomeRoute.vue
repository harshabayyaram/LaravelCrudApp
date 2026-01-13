<script setup>
import { BButton, BModal, BTable } from "bootstrap-vue-next";
import { ref, onMounted, computed } from "vue";
import FetchItems from "../functions/FetchItems";
import CreateItem from '../functions/CreateItem'
import DeleteItem from "../functions/DeleteItem";
import EditItem from "../functions/UpdateItem";

const { items, getAllItems } = FetchItems();
const { confirmCreate, createModal, newItem, openCreateModal, errors: createErrors } = CreateItem(items);
const { deleteModal, itemToDelete, openDeleteModal, confirmDelete } = DeleteItem(items);
const { editModal, editItem, openEditModal, confirmEdit, errors: editErrors } = EditItem(items);


onMounted(() => {
    getAllItems();
});

const filters = ref({
    search: "",
    status: ""
})

const filteredItems = computed(() => {
    return items.value.filter(item => {
        const matchesSearch =
            !filters.value.search ||
            item.name.toLowerCase().includes(filters.value.search.toLowerCase()) ||
            item.code.toLowerCase().includes(filters.value.search.toLowerCase());

        const matchesStatus =
            !filters.value.status ||
            item.status === filters.value.status;

        return matchesSearch && matchesStatus;
    });
});

</script>

<template>

    <div class="d-flex flex-column py-4">
        <div class="d-flex justify-content-between align-items-center mb-3 px-2">
            <div class="d-flex align-items-center gap-2 flex-grow-1 me-3">
                <input v-model="filters.search" type="text" class="form-control form-control-sm bg-dark text-white m-2"
                    placeholder="Search by name or code" style="max-width: 320px;" />
                <select v-model="filters.status" class="form-select form-select-sm bg-dark text-white border-secondary"
                    style="width: 120px; height: calc(1em + 0.5rem + 2px);">
                    <option value="">All status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
                <b-button size="sm" variant="outline-secondary" @click="filters.search = ''; filters.status = ''" class="m-2">
                    Reset
                </b-button>
            </div>

            <b-button variant="success" size="sm" class="px-4" @click="openCreateModal()">
                Create
            </b-button>

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
                    <tr v-for="(item, index) in filteredItems" :key="item.id">
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
            <small v-if="createErrors.name" class="text-danger">{{ createErrors.name[0] }}</small>
        </div>

        <div class="mb-3">
            <label class="form-label">Code</label>
            <input v-model="newItem.code" type="text" class="form-control" required />
            <small v-if="createErrors.code" class="text-danger">{{ createErrors.code[0] }}</small>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea v-model="newItem.description" class="form-control" rows="3"></textarea>
            <small v-if="createErrors.description" class="text-danger">{{ createErrors.description[0] }}</small>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select v-model="newItem.status" class="form-select">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
            <small v-if="createErrors.status" class="text-danger">{{ createErrors.status[0] }}</small>
        </div>
    </b-modal>

    <b-modal v-model="editModal" title="Edit Item" ok-title="Update" ok-variant="primary" @ok="confirmEdit">
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input v-model="editItem.name" class="form-control" />
            <small v-if="editErrors.name" class="text-danger">{{ editErrors.name[0] }}</small>
        </div>

        <div class="mb-3">
            <label class="form-label">Code</label>
            <input v-model="editItem.code" class="form-control" />
            <small v-if="editErrors.code" class="text-danger">{{ editErrors.code[0] }}</small>

        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea v-model="editItem.description" class="form-control"></textarea>
            <small v-if="editErrors.description" class="text-danger">{{ editErrors.description[0] }}</small>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select v-model="editItem.status" class="form-select">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
            <small v-if="editErrors.status" class="text-danger">{{ editErrors.status[0] }}</small>
        </div>
    </b-modal>
</template>
