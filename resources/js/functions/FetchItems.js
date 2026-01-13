import axios from "axios";
import { ref } from "vue";

export default function FetchItems() {
    const items = ref([]);

    const getAllItems = async () => {
        try {
            const response = await axios.get("/api/items");
            items.value = response.data;
        } catch (error) {
            console.log(error);
        }
    };

    return{
        getAllItems, items
    }
}
