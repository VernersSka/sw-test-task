<template>
  <router-view />
</template>

<style>
* {
  box-sizing: border-box;
}

body {
  font-family: Arial, sans-serif;
  margin: 0;
}

.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  border-bottom: 2px solid black;
}

h2 {
  margin: 0.5rem 2rem;
}

.btn-container {
  margin-right: 2rem;
}

.btn {
  margin: 0.5rem;
}

.item-container {
  border: 1px solid black;
  min-width: 210px;
  max-height: 210px;
  margin: 0.5rem;
}

.delete-checkbox {
  margin: 0.5rem;
}

p {
  text-align: center;
}

.list-container {
  display: grid;
  grid-template-columns: repeat(auto-fill, 230px);
  justify-content: center;
}

form {
  margin: 2rem auto;
  min-width: 25rem;
  max-width: 50vw;
}

form p {
  text-align: left;
  padding: 0.5rem;
}

form input {
  width: 55%;
}

label {
  padding: 0.5rem;
  width: 40%;
}

.error-msg {
  color: red;
  list-style: none;
  font-size: 0.8rem;
}
</style>
