<template>
    <div class="w-25">
        <form @submit.prevent="saveData">
        <div class="input-group mb-3 w-full">
            <input v-model="form.title" type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-success" type="submit">Add this to your list</button>
            </div>
        </div>
        </form>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                form: new Form({
                    title: '11',
                })
            }
        },
        methods:{
            saveData(){
                let data = new FormData();
                data.append('title',this.form.title);
                axios.post('/api/todo',data)
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
