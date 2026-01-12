import axios from "axios";
import { ref } from "vue";

export default function CreateItem(items) {
    const createModal = ref(false);

    const newItem = ref({
        name: "",
        code: "",
        description: "",
        status: "active",
    });

    const openCreateModal = () => {
        newItem.value = {
            name: "",
            code: "",
            description: "",
            status: "active",
        };
        createModal.value = true;
    };

    const confirmCreate = async () => {
        try {
            const response = await axios.post("/api/items", newItem.value);
            items.value.unshift(response.data);

            createModal.value = false;
        } catch (error) {
            console.log(error);
        }
    };

    return {
        createModal,
        newItem,
        openCreateModal,
        confirmCreate,
    };
}
