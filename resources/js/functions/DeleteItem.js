import axios from "axios";
import { ref } from "vue";

export default function DeleteItem(items) {
    const deleteModal = ref(false);
    const itemToDelete = ref(null);

    const openDeleteModal = (item) => {
        itemToDelete.value = item;
        deleteModal.value = true;
    };

    const confirmDelete = async () => {
        if (!itemToDelete) return;

        try {
            await axios.delete(`api/items/${itemToDelete.value.id}`);
            items.value = items.value.filter(
                (item) => item.id !== itemToDelete.value.id
            );
            deleteModal.value = false;
            itemToDelete.value = null;
        } catch (error) {
            console.log(error);
        }
    };

    return{
        deleteModal,
        itemToDelete,
        openDeleteModal,
        confirmDelete
    }
}