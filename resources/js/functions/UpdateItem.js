import axios from "axios";
import { ref } from "vue";

export default function EditItem(items) {
    const editModal = ref(false);
    const editItem = ref({});

    const openEditModal = (item) => {
        editItem.value = { ...item };
        editModal.value = true;
    };

    const confirmEdit = async () => {
        const response = await axios.put(
            `/api/items/${editItem.value.id}`,
            editItem.value
        );
        const index = items.value.findIndex((i) => i.id === editItem.value.id);

        items.value[index] = response.data;
        editModal.value = false;
    };

    return {
        editModal,
        editItem,
        openEditModal,
        confirmEdit,
    };
}
