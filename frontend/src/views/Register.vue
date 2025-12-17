<template>
  <div>
    <h2>Register</h2>
    <form @submit.prevent="register">
      <input v-model="name" placeholder="Name" />
      <input v-model="email" placeholder="Email" />
      <input v-model="password" type="password" placeholder="Password" />
      <input v-model="password_confirmation" type="password" placeholder="Confirm Password" />
      <select v-model="role">
        <option value="admin">Admin</option>
        <option value="user">User</option>
      </select>
      <button type="submit">Register</button>
    </form>
    <p>{{ error }}</p>
  </div>
</template>

<script>
import api from '../services/api'
import { useRouter } from 'vue-router'
import { ref } from 'vue'

export default {
  setup() {
    const router = useRouter()
    const name = ref('')
    const email = ref('')
    const password = ref('')
    const password_confirmation = ref('')
    const role = ref('user')
    const error = ref('')

    const register = async () => {
      try {
        await api.post('/register', { name: name.value, email: email.value, password: password.value, password_confirmation: password_confirmation.value, role: role.value })
        router.push('/login')
      } catch (err) {
        error.value = err.response?.data?.message || 'Registration failed'
      }
    }

    return { name, email, password, password_confirmation, role, error, register }
  }
}
</script>
