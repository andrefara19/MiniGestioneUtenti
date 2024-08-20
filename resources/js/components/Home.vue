<template>
    <div>
      <h1 style="text-align: center; margin-bottom: 20px">Welcome, {{ nome }}!</h1>
      <h2 style="text-align: center; margin-bottom: 30px">Elenco degli utenti:</h2>
      <table class="table table-striped mt-5">
        <tr v-for="(user, index) in users" :key="user.id">
          <td :style="{ color: user.id === authId ? 'aqua' : '#1a1a1a' }">
            {{ `${user.userMeta.cognome} ${user.userMeta.nome}` }}
          </td>
          <td :style="{ color: user.id === authId ? 'aqua' : '#1a1a1a' }">
            {{ user.email }}
          </td>
          <td :style="{ color: user.id === authId ? 'aqua' : '#1a1a1a' }">
            {{ user.userMeta ? user.userMeta.cellulare : 'N/A' }}
          </td>
          <td>
            <a :href="`/user/profile/${user.id}`" :style="{ color: user.id === authId ? 'aqua' : '#1a1a1a' }">
              <i class="fa-regular fa-user"></i>
            </a>
          </td>
        </tr>
      </table>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      nome: String,
      users: Array,
      authId: Number,
    },
  };
  </script>
  

  