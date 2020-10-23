<template>
    <div class="w-25">
        <form @submit.prevent="saveData">
        <div class="input-group mb-3 w-full">
            <input v-model="form.title" :class="{'is-invalid':form.errors.has('title')}" 
            type="text" class="form-control" placeholder="Recipient's username" 
            aria-label="Recipient's username" aria-describedby="basic-addon2" @keydown="form.errors.clear('title')">
            <div class="input-group-append">
                <button class="btn btn-success" type="submit">Add this to your list</button>
            </div>
        </div>
            <span class=" text-danger pt-3" v-if="form.errors.has('title')" v-text="form.errors.get('title')"></span>
        <div class="w-25">
            <div v-for="todo in todos" :key="todo.id" class="w-full">{{todo.title}}</div>
        </div>
        </form>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                todos:'',
                form: new Form({
                    title: '',
                })
            }
        },
        methods:{
            getTodo(){
                axios.get('/api/todo').then( (res) => {
                    this.todos = res.data;
                }).catch((error)=>{
                    console.log(error);
                })
            },
            saveData(){
                let data = new FormData();
                data.append('title',this.form.title);
                axios.post('/api/todo',data).then((res)=>{
                    this.form.reset();
                    this.getTodo();
                }).catch((error)=>{

                    this.form.errors.record(error.response.data.errors)
                    console.log(error.response);
                })
            }
        },
        mounted() {
            this.getTodo();
            console.log('Component mounted.')
        }
    }
</script>
