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
    const errors = ref({});
    const openCreateModal = () => {
        newItem.value = {
            name: "",
            code: "",
            description: "",
            status: "active",
        };
        errors.value = {};
        createModal.value = true;
    };

    const confirmCreate = async (event) => {
        event.preventDefault();
        errors.value = {};
        try {
            const response = await axios.post("/api/items", newItem.value);
            items.value.unshift(response.data);

            createModal.value = false;
        } catch (error) {
            console.log(error);
            if (error.response?.status === 422) {
                errors.value = error.response.data.errors || {};
            } else {
                console.log(error);
            }
        }
    };

    return {
        createModal,
        newItem,
        openCreateModal,
        confirmCreate,
        errors
    };
}
