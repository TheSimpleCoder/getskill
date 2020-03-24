<template>
    <div class="container">
        <input type="file" multiple @change>
    </div>
    <div class="container-img">
        <ul>
            <li class="list-group-item" v-for="file in filesOrder">
                {{ file.name }} : {{ file.type }}
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        data() {
            filesOrder: [],
            filesFinish: [],
            fileProgress: 0,
            fileCurrent: ''
        }
    }
</script>
