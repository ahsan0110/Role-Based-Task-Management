<template>
  <div>
    <ul>
      <li v-for="task in tasks" :key="task.id">
        {{ task.title }} - {{ task.status }}
      </li>
    </ul>
  </div>
</template>

<script>
import { ref, onMounted } from 'vue'
import api from '../services/api'

export default {
  setup() {
    const tasks = ref([])

    const getTasks = async () => {
      const res = await api.get('/tasks')
      tasks.value = res.data
    }

    onMounted(getTasks)
    return { tasks }
  }
}
</script>
