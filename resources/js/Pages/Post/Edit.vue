<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Post Form
                <inertia-link :href="route('post')" class="bg-purple-500 ml-1 p-1 text-sm text-white px-2 rounded hover:bg-blue-400 float-right">View All</inertia-link>
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white p-4 overflow-hidden shadow-xl sm:rounded-lg">
                    <form action="#" method="PATCH" @submit.prevent="updatePost">
                    	<div class="form-group m-3">
                    		<label for="title" class="w-full text-gray-500">* Title</label>
    	                    <input type="text" class="w-full p-2 border rounded" id="title" v-model="form.title" placeholder="title">    
                            <div v-if="errors.title" class="text-red-500">{{ errors.title }}</div>
            		
                    	</div>
                    	<div class="form-group m-3">
                            <label for="body" class="w-full text-gray-500">* Body</label>
    	                    <textarea class="w-full p-2 border rounded" id="body" v-model="form.body" placeholder="body"></textarea> 
                            <div v-if="errors.body" class="text-red-500">{{ errors.body }}</div>	
                    	</div>
                    	<div class="form-group m-3">
                            <label for="excerpt" class="w-full text-gray-500">* Excerpt</label>
    	                    <textarea class="w-full p-2 border rounded" placeholder="excerpt" id="excerpt" v-model="form.excerpt"></textarea>           
                            <div v-if="errors.excerpt" class="text-red-500">{{ errors.excerpt }}</div>     		
                    	</div>
                    	<div class="form-group m-3">
    	                    <select class="w-full p-2 border rounded" id="status" v-model="form.status">
    	                    	<option value="1">Publish</option>
    	                    	<option value="0">Draft</option>
    	                    </select>                
                            <div v-if="errors.status" class="text-red-500">{{ errors.status }}</div>		
                    	</div>
                        <div class="form-group m-3 mt-4">
                            <button type="submit" class="border rounded bg-green-500 text-white px-2 py-1 hover:bg-green-700">
                                <div v-if="isLoading" class="text-center">
                                    <div class="trinity-rings-spinner my-1">
                                      <div class="circle"></div>
                                      <div class="circle"></div>
                                      <div class="circle"></div>
                                    </div>
                                </div>
                                Save
                            </button>
                            <button @click.prevent="resetForm()" class="border rounded bg-pink-500 text-white px-2 py-1 ml-2 hover:bg-pink-700">Reset</button>
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
        props: {
            errors: Object,
            post: ''
        },
        data() {
            return{
                form:{
                    title: this.post.title,
                    body: this.post.body,
                    excerpt: this.post.excerpt,
                    status: this.post.status,
                },
                isLoading: false
            }
        },
        methods: {
            updatePost(){
                this.$inertia.patch(`/post/${this.post.id}`, this.form)
                .then(() => {

                });
            },
            resetForm(){
                this.form.title = '';
                this.form.body = '';
                this.form.excerpt = '';
                this.form.status = '';
            }
        },
    }
</script>
