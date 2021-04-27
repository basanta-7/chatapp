<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Post Form
                <inertia-link :href="route('post')" class="bg-purple-500 ml-1 p-1 text-sm text-white px-2 rounded hover:bg-blue-400 float-right">View All</inertia-link>
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white p-4 overflow-hidden shadow-xl sm:rounded-lg">
                    <form action="/posts" method="post" @submit.prevent="createPost">
                    	<div class="form-group m-3">
                    		<label for="title" class="w-full text-gray-500">* Title</label>
    	                    <input type="text" class="w-full p-2 border rounded" id="title" v-model="form.title" placeholder="title">                		
                    	</div>
                    	<div class="form-group m-3">
                            <label for="body" class="w-full text-gray-500">* Body</label>
    	                    <textarea class="w-full p-2 border rounded" id="body" v-model="form.body" placeholder="body"></textarea>                		
                    	</div>
                    	<div class="form-group m-3">
                            <label for="excerpt" class="w-full text-gray-500">* Excerpt</label>
    	                    <textarea class="w-full p-2 border rounded" placeholder="excerpt" id="excerpt" v-model="form.excerpt"></textarea>                		
                    	</div>
                    	<div class="form-group m-3">
    	                    <select class="w-full p-2 border rounded" id="status" v-model="form.status">
    	                    	<option value="1">Publish</option>
    	                    	<option value="0">Draft</option>
    	                    </select>                		
                    	</div>
                        <div class="form-group m-3 mt-4">
                            <button type="submit" class="border rounded bg-green-500 text-white px-2 py-1 hover:bg-green-700">Save</button>
                            <button class="border rounded bg-pink-500 text-white px-2 py-1 ml-2 hover:bg-pink-700">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'

    export default {
        components: {
            AppLayout,
        },
        data() {
            return{
                form:{
                    title: '',
                    body: '',
                    excerpt: '',
                    status: '',
                }
            }
        },
        methods: {
            createPost(){
                this.$inertia.post('/posts', this.form)
                .then(() => {

                });
            }
        }
    }
</script>
