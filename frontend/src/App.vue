<template>
  <div class="container">
    <h1>Shipping Calculator</h1>

    <div class="form-group">
      <label>Carrier</label>
      <select v-model="carrier">
        <option disabled value="">Select carrier</option>
        <option value="transcompany">TransCompany</option>
        <option value="packgroup">PackGroup</option>
        <option value="test">test</option>
      </select>
    </div>

    <div class="form-group">
      <label>Weight (kg)</label>
      <input
          type="number"
          step="0.1"
          v-model="weightKg"
          placeholder="Enter weight"
      />
    </div>

    <button @click="calculate">Calculate price</button>

    <div v-if="price !== null" class="result success">
      Price: {{ price }} EUR
    </div>

    <div v-if="error" class="result error">
      {{ error }}
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const carrier = ref('')
const weightKg = ref('')
const price = ref(null)
const error = ref('')

async function calculate() {
  price.value = null
  error.value = ''

  try {
    const response = await fetch('http://localhost:8080/api/shipping/calculate', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({
        carrier: carrier.value,
        weightKg: weightKg.value
      })
    })

    const data = await response.json()

    if (!response.ok) {
      error.value = data.error ?? 'Something went wrong'
      return
    }

    price.value = data.price
  } catch (e) {
    error.value = 'Network error'
  }
}
</script>

<style>
.container {
  max-width: 400px;
  margin: 50px auto;
  font-family: Arial, sans-serif;
}

.form-group {
  margin-bottom: 15px;
}

input, select {
  width: 100%;
  padding: 6px;
}

button {
  padding: 8px 12px;
  cursor: pointer;
  background-color: #93c5fd;
}

.result {
  margin-top: 20px;
  font-weight: bold;
}

.success {
  color: green;
}

.error {
  color: red;
}
</style>
