import axios from "axios";
import { ref } from "vue";

export default function EditItem(items) {
    const editModal = ref(false);
    const editItem = ref({});
    const errors = ref({});

    const openEditModal = (item) => {
        editItem.value = { ...item };
        errors.value = {};
        editModal.value = true;
    };

    const confirmEdit = async (event) => {
        event.preventDefault();
        errors.value = {};
        try {
            const response = await axios.put(
                `/api/items/${editItem.value.id}`,
                editItem.value
            );
            const index = items.value.findIndex(
                (i) => i.id === editItem.value.id
            );

            items.value[index] = response.data;
            editModal.value = false;
        } catch (error) {
            if (error.response?.status === 422) {
                errors.value = error.response.data.errors || {};
            } else {
                console.log(error);
            }
        }
    };

    return {
        editModal,
        editItem,
        openEditModal,
        confirmEdit,
        errors
    };
}
