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
        
        </form>
        <div class="w-full">
            <div v-for="todo in todos" :key="todo.id" class="w-full flex items-center p-3 bg-white border-b-2">
                <span class="mr-2">
                    <svg v-if="todo.completed == false" v-on:click="toggleTodo(todo)" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle" width="36" height="36" viewBox="0 0 24 24" stroke-width="1.5" stroke="#009688" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <circle cx="12" cy="12" r="9" />
                    </svg>
                    <svg v-if="todo.completed == true" v-on:click="toggleTodo(todo)" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-check" width="36" height="36" viewBox="0 0 24 24" stroke-width="1.5" stroke="#009688" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <circle cx="12" cy="12" r="9" />
                    <path d="M9 12l2 2l4 -4" />
                    </svg>
                </span>
                <div class=" font-weight-bolder">
                    <span>{{todo.title}}</span>
                    <input type="text">
                </div>
                <div class="ml-auto mr-2 flex items-center">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="36" height="36" viewBox="0 0 24 24" stroke-width="1.5" stroke="#009688" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                        <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                        <line x1="16" y1="5" x2="19" y2="8" />
                        </svg>

                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-checkbox" width="36" height="36" viewBox="0 0 24 24" stroke-width="1.5" stroke="#009688" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <polyline points="9 11 12 14 20 6" />
                        <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9" />
                        </svg>
                    </span>
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="36" height="36" viewBox="0 0 24 24" stroke-width="1.5" stroke="#009688" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <line x1="4" y1="7" x2="20" y2="7" />
                        <line x1="10" y1="11" x2="10" y2="17" />
                        <line x1="14" y1="11" x2="14" y2="17" />
                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                        </svg>
                    </span>
                </div>
            </div>
        </div>
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
            toggleTodo(e){
                e.completed = !e.completed
                let data = new FormData();
                data.append('_method','PATCH')
                if(e.completed){
                    data.append('completed',1)
                }else{
                    data.append('completed',0)
                }
                axios.post('/api/todo/'+e.id,data)
            },
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
