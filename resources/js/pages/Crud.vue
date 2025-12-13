<script setup>
import { ref } from 'vue';

const headers = [
  { title: 'ID', key: 'id' },
  { title: 'Name', key: 'name' },
  { title: 'Email', key: 'email' },
  { title: 'Role', key: 'role' },
  { title: 'Status', key: 'status' },
  { title: 'Actions', key: 'actions', sortable: false },
];

const items = ref([
  { id: 1, name: 'John Doe', email: 'john@example.com', role: 'Admin', status: 'Active' },
  { id: 2, name: 'Jane Smith', email: 'jane@example.com', role: 'Editor', status: 'Inactive' },
  { id: 3, name: 'Bob Johnson', email: 'bob@example.com', role: 'User', status: 'Active' },
  { id: 4, name: 'Alice Williams', email: 'alice@example.com', role: 'Viewer', status: 'Pending' },
]);

const dialog = ref(false);
const editedItem = ref({});
const editedIndex = ref(-1);

const openDialog = (item) => {
  if (item) {
    editedItem.value = { ...item };
    editedIndex.value = items.value.indexOf(item);
  } else {
    editedItem.value = {};
    editedIndex.value = -1;
  }
  dialog.value = true;
};

const closeDialog = () => {
    dialog.value = false;
    editedItem.value = {};
    editedIndex.value = -1;
}

const saveItem = () => {
  if (editedIndex.value > -1) {
    Object.assign(items.value[editedIndex.value], editedItem.value);
  } else {
    items.value.push({ ...editedItem.value, id: items.value.length + 1 });
  }
  closeDialog();
};

const deleteItem = (item) => {
    if(confirm('Are you sure you want to delete this item?')) {
        const index = items.value.indexOf(item);
        items.value.splice(index, 1);
    }
}
</script>

<template>
  <div>
    <h1 class="text-h4 font-weight-bold mb-6">User Management</h1>

    <v-card rounded="lg" elevation="2">
        <v-data-table :headers="headers" :items="items" class="pa-4">
            <template v-slot:top>
                <v-toolbar flat>
                    <v-toolbar-title>Users</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" prepend-icon="mdi-plus" variant="flat" @click="openDialog(null)">
                        Add User
                    </v-btn>

                    <v-dialog v-model="dialog" max-width="500px">
                        <v-card rounded="lg">
                            <v-card-title class="pa-4 text-h5">
                                <span class="text-h5">{{ editedIndex === -1 ? 'New User' : 'Edit User' }}</span>
                            </v-card-title>

                            <v-card-text>
                                <v-container>
                                    <v-row>
                                        <v-col cols="12">
                                            <v-text-field v-model="editedItem.name" label="Name" variant="outlined" density="compact"></v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-text-field v-model="editedItem.email" label="Email" variant="outlined" density="compact"></v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-text-field v-model="editedItem.role" label="Role" variant="outlined" density="compact"></v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-select v-model="editedItem.status" :items="['Active', 'Inactive', 'Pending']" label="Status" variant="outlined" density="compact"></v-select>
                                        </v-col>
                                    </v-row>
                                </v-container>
                            </v-card-text>

                            <v-card-actions class="pa-4">
                                <v-spacer></v-spacer>
                                <v-btn color="blue-darken-1" variant="text" @click="closeDialog">Cancel</v-btn>
                                <v-btn color="primary" variant="elevated" @click="saveItem">Save</v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                </v-toolbar>
            </template>

            <template #item.status="{ item }">
                <v-chip
                    :color="item.status === 'Active' ? 'success' : item.status === 'Inactive' ? 'error' : 'warning'"
                    size="small"
                    class="text-uppercase"
                    label
                >
                    {{ item.status }}
                </v-chip>
            </template>

            <template #item.actions="{ item }">
                <v-icon size="small" class="me-2" @click="openDialog(item)" color="primary">mdi-pencil</v-icon>
                <v-icon size="small" @click="deleteItem(item)" color="error">mdi-delete</v-icon>
            </template>
        </v-data-table>
    </v-card>
  </div>
</template>
