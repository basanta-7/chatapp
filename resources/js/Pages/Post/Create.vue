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

                        <div class="form-group m-3">
                            <label for="" class="w-full text-gray-500">* Image</label>
                            <br>
                            <input type="file" @change="setImage" accept="image/*" id="images">
                            <div v-if="errors.images" class="text-red-500">{{ errors.images }}</div>        
                        </div>
                        
                        <div class="form-group m-3 mt-4">
                            <hr>
                            <button type="submit" :disabled="form.processing" class="border rounded mt-2 bg-green-500 text-white px-2 py-1 hover:bg-green-700">Save</button>
                            <button type="reset" @click.prevent="resetForm()" class="border rounded mt-2 bg-pink-500 text-white px-2 py-1 ml-2 hover:bg-pink-700">Reset</button>
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
        },
        data() {
            return{
                form:{
                    title: '',
                    body: '',
                    excerpt: '',
                    status: '',
                    images: ''
                }
            }
        },
        methods: {
            createPost(){
                this.$inertia.post('/post', this.form)
                .then(() => {
                });
            },
            resetForm(){
                this.form.title = '';
                this.form.body = '';
                this.form.excerpt = '';
                this.form.status = '';
                this.form.images = '';
            },
            setImage(e){
                this.form.images = e.target.files[0];
            }
        }
    }
</script>
